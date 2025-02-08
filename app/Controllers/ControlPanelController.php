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
            'username' => 'required|min_length[3]|max_length[50]',
            'password' => 'permit_empty|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        // Data untuk update
        $updateData = ['username' => $data['username']];
        if (!empty($data['password'])) {
            $updateData['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        // Update data di database
        $this->cPanelmodel->update($id, $updateData);

        return redirect()->back()->with('success', 'Username dan password berhasil diperbarui.');
    }
}
