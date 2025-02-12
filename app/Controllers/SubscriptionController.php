<?php

namespace App\Controllers;

use DateTime;
use App\Models\UserModel;
use App\Models\StorageModel;
use App\Models\KategoriModel;
use App\Models\PaketHostingModel;
use App\Models\SubscriptionModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SubscriptionController extends BaseController
{
    protected $subsModel;
    protected $userModel;
    protected $paketHostingModel;

    public function __construct()
    {
        $this->subsModel = new SubscriptionModel();
        $this->userModel = new UserModel();
        $this->paketHostingModel = new PaketHostingModel();
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
        $this->subsModel->delete($id);
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
    ? date('Y-m-d H:i:s', strtotime("+$lamaHosting months"))
    : date('Y-m-d H:i:s', strtotime("+$lamaHosting years"));

// dd($id, $newStatus, $lamaHosting, $expiredDate);
            $this->subsModel->update($id, [
                'status' => $newStatus,
                'expirated_date' => $expiredDate,
            ]);

            return redirect()->back()->with('success', 'Status dan expired_date berhasil diperbarui');
        }

        $this->subsModel->update($id, ['status' => $newStatus]);
        return redirect()->back()->with('success', 'Status berhasil diperbarui');
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
            ->select('subscription.id as subscription_id, paket_hosting.*, kategori.nama_kategori, users.nama_lengkap, control_panel.*')
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
