<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SubscriptionModel;
use App\Models\ControlpanelModel;

class ControlPanelController extends BaseController
{
    protected $subscriptionModel;

    public function __construct()
    {
        $this->subscriptionModel = new SubscriptionModel();
        $this->cPanelmodel = new ControlpanelModel();
    }

    // Menampilkan halaman Control Panel berdasarkan id_subscribtion
    public function controlPanel($id)
    {
        $subscription = $this->subscriptionModel
        ->select('subscription.id as subscription_id, subscription.*, control_panel.*') // Pilih kolom dari kedua tabel
        ->join('control_panel', 'control_panel.id_subscription = subscription.id', 'left') // Left join control_panel
        ->where('subscription.id', $id) // Filter berdasarkan id
        ->first(); // Ambil satu data (bukan findAll)
    
        if (!$subscription) {
            return redirect()->to('/clientarea')->with('error', 'Data tidak ditemukan.');
        }

        return view('ClientArea/Services/controlpanel', [
            'subscription' => $subscription
        ]);
    }

    // Memproses update username dan password berdasarkan id_subscribtion
    public function updateControlPanel($id)
    {

        
        $data = $this->request->getPost();
        // Validasi input
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        // Data untuk update
        $updateData = ['username' => $data['username']];
        $updateData = ['domain' => $data['domain']];
        if (!empty($data['password'])) {
            $updateData['password'] = $data['password'];
        }
        // Update data di database
        $update = $this->cPanelmodel
        ->where('id_subscription', $id)
        ->set($updateData)
        ->update();
        return redirect()->back()->with('success', 'Username dan password berhasil diperbarui.');
    }

    public function login()
{
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    // Query untuk cek username dan password
    $cpanel = $this->cPanelmodel
                        ->where('username', $username)
                        ->where('password', $password)
                        ->first();    
    $subscription = $this->subscriptionModel->where('id', $cpanel['id_subscription'])->first();
    if ($subscription) {
        // Cek expired_date
        $isExpired = date('Y-m-d') > $subscription['expirated_date'];
        $status = $subscription['status'];
        return view('ClientArea/Services/cekexpired', ['status'=>$status,'isExpired' => $isExpired, 'expiredDate' => $subscription['expirated_date']]);
    } else {
        return redirect()->back()->with('error', 'Username atau password salah.');
    }
}


}
