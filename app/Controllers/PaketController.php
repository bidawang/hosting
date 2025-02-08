<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ControlPanelModel;
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
    
    public function confirm()
{
    $userId = $this->request->getPost('user_id');
    $paketId = $this->request->getPost('paket_id');
    $jumlahBulan = $this->request->getPost('jumlah_bulan');
    
    if (!$userId || !$paketId) {
        return redirect()->back()->with('error', 'User ID or Package ID is missing.');
    }

    $paketHostingModel = new PaketHostingModel();

    // Hitung total harga
    $total = $paketHostingModel->find($paketId);
    $hargaPerBulan = $total['harga_beli'];
    $totalHarga = $hargaPerBulan * $jumlahBulan;

    // Atur data untuk disimpan ke tabel subscription
    $data = [
        'id_customer' => $userId,
        'id_paket_hosting' => $paketId,
        'jumlah' => $jumlahBulan,
        'total' => $totalHarga,
        'status' => 'pending',
        'tanggal_pesan' => null,
        'expirated_date' => null,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];

    $hostingOrderModel = new SubscriptionModel();

    if ($hostingOrderModel->insert($data)) {
        // Ambil last inserted ID dari subscription
        $lastId = $hostingOrderModel->getInsertID();
        $generatedPassword = $this->generateRandomPassword(8);
        // Atur data untuk disimpan ke tabel control_panel
        $controlPanelData = [
            'id_subscription' => $lastId,
            'username' => 'user_' . $lastId, // Username bisa di-generate seperti ini
            'password' => $generatedPassword,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Simpan data ke tabel control_panel
        $controlPanelModel = new ControlPanelModel();
        $controlPanelModel->insert($controlPanelData);

        // Kirim notifikasi ke customer dan admin
        $userModel = new UserModel();
        $customer = $userModel->find($userId);
        $adminEmails = $userModel->getAdminEmails();

        // Notifikasi ke customer
        $this->sendNotification($customer['email'], "Konfirmasi Pembelian Paket Hosting", "Terima kasih telah melakukan pembelian paket hosting. Status pesanan Anda saat ini adalah 'Pending'. Kami akan segera memproses pesanan Anda.");

        // Notifikasi ke admin
        foreach ($adminEmails as $admin) {
            $this->sendNotification($admin['email'], "Notifikasi Pembelian Paket Hosting Baru", "Seorang pengguna dengan nama {$customer['nama_lengkap']} telah melakukan pembelian paket hosting baru. Silakan cek dashboard admin untuk detail lebih lanjut.");
        }

        return redirect()->to('clientarea')->with('message', 'Order has been successfully confirmed.');
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
