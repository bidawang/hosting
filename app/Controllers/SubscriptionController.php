<?php

namespace App\Controllers;

use DateTime;
use App\Models\UserModel;
use App\Models\StorageModel;
use App\Models\KategoriModel;
use App\Models\PaketHostingModel;
use App\Models\SubscriptionModel;
use App\Models\ControlPanelModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SubscriptionController extends BaseController
{
    protected $subsModel;
    protected $userModel;
    protected $paketHostingModel;
    protected $cpanel;

    public function __construct()
    {
        $this->subsModel = new SubscriptionModel();
        $this->userModel = new UserModel();
        $this->paketHostingModel = new PaketHostingModel();
        $this->cpanel = new ControlPanelModel();
    }

    // ========================
    // SUBSCRIPTION MANAGEMENT
    // ========================

    public function index()
    {
        $subscriptions = $this->subsModel->getOrderWithCustomer();
        if (!empty($subscriptions)) {
            foreach ($subscriptions as &$sub) {
                $currentDate = new DateTime();
                $expirationDate = new DateTime($sub['expirated_date']);

                // Pastikan expirated_date valid
                $sub['remaining_days'] = $expirationDate >= $currentDate 
                    ? (int) $currentDate->diff($expirationDate)->format('%a') 
                    : 0;
            }

            // Urutkan berdasarkan tanggal expired (ascending)
            usort($subscriptions, function ($a, $b) {
                return strtotime($a['expirated_date']) <=> strtotime($b['expirated_date']);
            });
        }

        return view('Admin/subscription/index', ['subscriptions' => $subscriptions]);
    }

    public function create()
    {
        $data = [
            'customers' => $this->userModel->findAll(),
            'paket_hosting' => $this->paketHostingModel->getNamaHosting()
        ];
        return view('Admin/subscription/create', $data);
    }

    public function store()
    {
        dd($this->request->getPost());
        $this->subsModel->insert($this->request->getPost());
        return redirect()->to(base_url('subscription'))->with('success', 'Subscription berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $subscription = $this->subsModel->find($id);
        if (!$subscription) {
            return redirect()->to(base_url('subscription'))->with('error', 'Subscription tidak ditemukan.');
        }

        $data = [
            'subscription' => $subscription,
            'customers' => $this->userModel->findAll(),
            'paket_hosting' => $this->paketHostingModel->getNamaHosting()
        ];
        return view('Admin/subscription/edit', $data);
    }

    public function update($id)
    {
        $this->subsModel->update($id, $this->request->getPost());
        return redirect()->to(base_url('subscription'))->with('success', 'Subscription berhasil diperbarui.');
    }

    public function delete($id)
{
    // Perbaikan sintaks pada where clause dan delete
    $this->cpanel->where('id_subscription', $id)->delete();
    
    // Hapus data dari subsModel
    $this->subsModel->delete($id);

    // Redirect dengan pesan sukses
    return redirect()->to(base_url('subscription'))->with('success', 'Subscription berhasil dihapus.');
}


    // ========================
    // STATUS & EXPIRATION
    // ========================

    public function updateStatus($id)
{
    $newStatus = $this->request->getPost('status');
    $validStatuses = ['active', 'expired', 'pending', 'cancelled'];
    if (!in_array($newStatus, $validStatuses)) {
        return redirect()->back()->with('error', 'Status tidak valid');
    }

    $subscription = $this->subsModel->find($id);

    if ($newStatus === 'active') {
        $paketHosting = $this->paketHostingModel->find($subscription['id_paket_hosting']);
        $lamaHosting = $paketHosting['lama_hosting'] * $subscription['jumlah'];
        $satuanLama = $paketHosting['satuan_lama'];

        $currentDate = date('Y-m-d H:i:s');
        $expiredDate = ($satuanLama === 'bulan') 
            ? date('Y-m-d H:i:s', strtotime("+$lamaHosting months", strtotime($currentDate)))
            : date('Y-m-d H:i:s', strtotime("+$lamaHosting years", strtotime($currentDate)));

        // Generate random password
        $generatedPassword = $this->generateRandomPassword(8);

        // Update status dan expired_date di tabel subscription
        $this->subsModel->update($id, [
            'status' => $newStatus,
            'expirated_date' => $expiredDate,
        ]);

        // Insert atau update data di control_panel
        $controlPanelModel = new ControlPanelModel();
        $controlPanelData = [
            'id_subscription' => $id,
            'username' => 'user_' . $id,
            'password' => $generatedPassword,
            'created_at' => $currentDate,
            'updated_at' => $currentDate
        ];
        
        $existingControlPanel = $controlPanelModel->where('id_subscription', $id)->first();
        if ($existingControlPanel) {
            $controlPanelModel->update($existingControlPanel['id'], $controlPanelData);
        } else {
            $controlPanelModel->insert($controlPanelData);
        }

        return redirect()->back()->with('success', 'Status dan expired_date berhasil diperbarui, dan password control panel telah di-generate');
    }

    $this->subsModel->update($id, ['status' => $newStatus]);
    return redirect()->back()->with('success', 'Status berhasil diperbarui');
}

private function generateRandomPassword($length = 12)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $charactersLength = strlen($characters);
    $randomPassword = '';
    for ($i = 0; $i < $length; $i++) {
        $randomPassword .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomPassword;
}


    public function checkExpirationDates()
    {
        $subscriptions = $this->subsModel->getOrderWithCustomer();
        foreach ($subscriptions as $sub) {
            $currentDate = new DateTime();
            $expirationDate = new DateTime($sub['expirated_date']);
            $remainingDays = (int) $currentDate->diff($expirationDate)->format('%r%a');

            if ($remainingDays === 7) {
                $this->sendNotification($sub['email'], "Paket Hosting Akan Expired Dalam 7 Hari", "Paket hosting Anda akan kadaluarsa dalam 7 hari.");
            } elseif ($remainingDays === 1) {
                $this->sendNotification($sub['email'], "Paket Hosting Akan Expired Besok", "Paket hosting Anda akan kadaluarsa besok.");
            } elseif ($remainingDays < 0) {
                $this->sendNotification($sub['email'], "Paket Hosting Sudah Expired", "Paket hosting Anda telah kadaluarsa.");
                $this->notifyAdmins($sub);
            }
        }
        return redirect()->to(base_url('subscription'))->with('success', 'Proses pengecekan expiration selesai.');
    }

    public function autoExpireSubscriptions()
{
    $currentDate = date('Y-m-d H:i:s');
    $expiredSubscriptions = $this->subsModel
        ->where('expirated_date <=', $currentDate)
        ->where('status !=', 'expired')
        ->findAll();

    foreach ($expiredSubscriptions as $subscription) {
        $this->subsModel->update($subscription['id'], ['status' => 'expired']);
    }
dd($expiredSubscriptions);
    return "Subscription statuses updated successfully.";
}


    private function notifyAdmins($sub)
    {
        $adminEmails = $this->userModel->getAdminEmails();
        foreach ($adminEmails as $admin) {
            $this->sendNotification($admin['email'], "Paket Hosting Pengguna {$sub['nama_lengkap']} Sudah Expired", "Paket hosting pengguna {$sub['nama_lengkap']} telah kadaluarsa.");
        }
    }

    private function sendNotification($to, $subject, $message)
    {
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);

        if (!$email->send()) {
            log_message('error', 'Gagal mengirim email ke ' . $to . ': ' . print_r($email->printDebugger(['headers']), true));
        }
    }

    // ========================
    // CLIENT AREA
    // ========================

    public function clientarea()
    {
        $userId = session()->get('id');
        $user = $this->userModel->find($userId);

        $subscriptions = $this->subsModel
            ->select('subscription.id as subscription_id, subscription.status, subscription.expirated_date, paket_hosting.*, kategori.nama_kategori, users.nama_lengkap, control_panel.*')
            ->join('paket_hosting', 'paket_hosting.id = subscription.id_paket_hosting')
            ->join('kategori', 'kategori.id = paket_hosting.id_kategori')
            ->join('users', 'users.id = subscription.id_customer')
            ->join('control_panel', 'control_panel.id_subscription = subscription.id', 'left')
            ->where('subscription.id_customer', $userId)
            ->findAll();

        $data = [
            'kategori' => (new KategoriModel())->getKategori(),
            'paketHosting' => $this->paketHostingModel->getPaketWithDetails(),
            'storage' => (new StorageModel())->getStorage(),
            'user' => $user,
            'subscriptions' => $subscriptions,
        ];

        return view('ClientArea/index', $data);
    }
}
