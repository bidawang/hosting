<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\StorageModel;
use App\Models\KategoriModel;
use App\Models\PaketHostingModel;
use App\Models\SubscriptionModel;

class PaketController extends BaseController
{
    
    public function index()
    {
        $kategoriModel = new KategoriModel();
        $paketHostingModel = new PaketHostingModel();
        $storageModel = new StorageModel();

        // Ambil data dari setiap tabel
        $kategori = $kategoriModel->getKategori();
        $paketHosting = $paketHostingModel->getPaketWithDetails();
        $storage = $storageModel->getStorage();

        // Kirim data ke view
        return view('Dashboard/index', [
            'kategori' => $kategori,
            'paketHosting' => $paketHosting,
            'storage' => $storage
        ]);
    }
    public function hosting()
    {
        $kategoriModel = new KategoriModel();
        $paketHostingModel = new PaketHostingModel();
        $storageModel = new StorageModel();

        // Ambil data dari setiap tabel
        $kategori = $kategoriModel->getKategori();
        $paketHosting = $paketHostingModel->getPaketWithDetails();
        $storage = $storageModel->getStorage();

        // Kirim data ke view
        return view('Dashboard/hosting', [
            'kategori' => $kategori,
            'paketHosting' => $paketHosting,
            'storage' => $storage
        ]);
    }

    public function verifikasi($id)
    {
        $paketHostingModel = new PaketHostingModel();
        
        // Fetch package details by ID
        $paket = $paketHostingModel->getPaketWithDetails($id);
        
        if (!$paket) {
            return redirect()->to('/'); // Redirect if package not found
        }
        
        return view('Customer/subscription', ['paket' => $paket]); // Send to verification view
    }

    public function confirm()
    {
        $userId = $this->request->getPost('user_id');
        $paketId = $this->request->getPost('paket_id');
        
        if (!$userId || !$paketId) {
            return redirect()->back()->with('error', 'User ID or Package ID is missing.');
        }

        // Atur data untuk disimpan
        $data = [
            'id_customer' => $userId,
            'id_paket_hosting' => $paketId,
            'status' => 'pending', // set initial status as pending
            'tanggal_pesan' => null, // set as null initially
            'expirated_date' => null, // set as null initially
            'created_at' => date('Y-m-d H:i:s'), // set current date-time
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Inisialisasi model dan simpan data
        $hostingOrderModel = new SubscriptionModel();
        if ($hostingOrderModel->insert($data)) {
            // Dapatkan email customer
            $userModel = new UserModel();
            $customer = $userModel->find($userId);

            // Dapatkan email semua admin
            $adminEmails = $userModel->getAdminEmails();

            // Kirim email notifikasi ke customer
            $this->sendNotification($customer['email'], "Konfirmasi Pembelian Paket Hosting", "Terima kasih telah melakukan pembelian paket hosting. Status pesanan Anda saat ini adalah 'Pending'. Kami akan segera memproses pesanan Anda.");

            // Kirim email notifikasi ke semua admin
            foreach ($adminEmails as $admin) {
                $this->sendNotification($admin['email'], "Notifikasi Pembelian Paket Hosting Baru", "Seorang pengguna dengan nama {$customer['nama_lengkap']} telah melakukan pembelian paket hosting baru. Silakan cek dashboard admin untuk detail lebih lanjut.");
            }

            return redirect()->to('/')->with('message', 'Order has been successfully confirmed.');
        } else {
            return redirect()->back()->with('error', 'Failed to confirm the order.');
        }
    }

    // Fungsi untuk mengirim email
    private function sendNotification($to, $subject, $message)
    {
        $email = \Config\Services::email();

        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);

        if (!$email->send()) {
            // Logging atau debug jika gagal mengirim email
            log_message('error', 'Gagal mengirim email ke ' . $to . ': ' . print_r($email->printDebugger(['headers']), true));
        }
    }
}
