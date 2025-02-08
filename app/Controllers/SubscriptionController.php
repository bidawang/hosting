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

    public function __construct()
    {
        $this->subsModel = new SubscriptionModel();
        $this->userModel = new UserModel();
    }

    public function index()
{
    $subscriptions = $this->subsModel->getOrderWithCustomer();
    if (!empty($subscriptions)) {
        foreach ($subscriptions as &$sub) {
            $currentDate = new DateTime();
            $expirationDate = new DateTime($sub['expirated_date']);

            // Pastikan expirated_date valid
            if ($expirationDate >= $currentDate) {
                $interval = $currentDate->diff($expirationDate);
                $sub['remaining_days'] = (int) $interval->format('%a');
            } else {
                $sub['remaining_days'] = 0;  // Sudah expired
            }
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
    $userModel = new UserModel();
    $paketHostingModel = new PaketHostingModel();

    $data = [
        'customers' => $userModel->findAll(),  // Ambil semua data customer
        'paket_hosting' => $paketHostingModel->getNamaHosting()  // Ambil semua data paket hosting
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
    
        $userModel = new UserModel();
        $paketHostingModel = new PaketHostingModel();
    
        $data = [
            'subscription' => $subscription,  // Data subscription yang akan diedit
            'customers' => $userModel->findAll(),  // Ambil semua data customer
            'paket_hosting' => $paketHostingModel->getNamaHosting()  // Ambil semua data paket hosting
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

    public function checkExpirationDates()
    {
        $subscriptions = $this->subsModel->getOrderWithCustomer();

        foreach ($subscriptions as $sub) {
            $currentDate = new DateTime();
            $expirationDate = new DateTime($sub['expirated_date']);
            $remainingDays = (int) $currentDate->diff($expirationDate)->format('%r%a');

            if ($remainingDays === 7) {
                $this->sendNotification($sub['email'], "Peringatan: Paket Hosting Akan Expired Dalam 7 Hari", "Paket hosting Anda akan kadaluarsa dalam 7 hari. Segera perpanjang.");
            } elseif ($remainingDays === 1) {
                $this->sendNotification($sub['email'], "Peringatan: Paket Hosting Akan Expired Besok", "Paket hosting Anda akan kadaluarsa besok. Segera perpanjang.");
            } elseif ($remainingDays < 0) {
                $this->sendNotification($sub['email'], "Paket Hosting Sudah Expired", "Paket hosting Anda telah kadaluarsa. Silakan hubungi kami untuk memperpanjang.");

                $adminEmails = $this->userModel->getAdminEmails();
                foreach ($adminEmails as $admin) {
                    $this->sendNotification($admin['email'], "Paket Hosting Pengguna {$sub['nama_lengkap']} Sudah Expired", "Paket hosting pengguna {$sub['nama_lengkap']} telah kadaluarsa.");
                }
            }
        }

        return redirect()->to(base_url('subscription'))->with('success', 'Proses pengecekan expiration selesai.');
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

    public function clientarea()
    {
        $userId = session()->get('id');
        $kategoriModel = new KategoriModel();
        $paketHostingModel = new PaketHostingModel();
        $storageModel = new StorageModel();
        $userModel = new UserModel();
        $subscriptionModel = new SubscriptionModel(); 

        $user = $userModel->find($userId);

        $subscriptions = $subscriptionModel
    ->select('subscription.id as subscription_id, paket_hosting.id as paket_hosting_id, kategori.id as kategori_id, 
              users.id as user_id, control_panel.id as control_panel_id, 
              subscription.*, paket_hosting.*, kategori.nama_kategori, users.nama_lengkap, control_panel.*') 
    ->join('paket_hosting', 'paket_hosting.id = subscription.id_paket_hosting') // Join paket_hosting
    ->join('kategori', 'kategori.id = paket_hosting.id_kategori')
    ->join('users', 'users.id = subscription.id_customer')
    ->join('control_panel', 'control_panel.id_subscription = subscription.id', 'left') // Join control_panel
    ->where('subscription.id_customer', $userId) // Filter berdasarkan id_customer
    ->findAll();


        $data = [
            'kategori' => $kategoriModel->getKategori(),
            'paketHosting' => $paketHostingModel->getPaketWithDetails(),
            'storage' => $storageModel->getStorage(),
            'user' => $user,
            'subscriptions' => $subscriptions,
        ];

        return view('ClientArea/index', $data);
    }
}
