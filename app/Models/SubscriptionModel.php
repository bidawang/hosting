<?php

namespace App\Models;

use CodeIgniter\Model;

class SubscriptionModel extends Model
{
    protected $table            = 'subscription';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'id_customer', 
        'id_paket_hosting', 
        'jumlah',
        'status', 
        'expirated_date',
        'total',
        'created_at', 
        'updated_at'
    ];

    public function getOrderWithCustomer()
    {
        return $this->select('subscription.*, users.username, users.nama_lengkap, paket_hosting.id_kategori, paket_hosting.id_storage, kategori.nama_kategori, storage.kapasitas, storage.satuan, control_panel.username, control_panel.password')
                    ->join('users', 'users.id = subscription.id_customer','left')
                    ->join('paket_hosting', 'paket_hosting.id = subscription.id_paket_hosting','left')
                    ->join('kategori', 'kategori.id = paket_hosting.id_kategori','left')
                    ->join('storage', 'storage.id = paket_hosting.id_storage','left')
                    ->join('control_panel', 'control_panel.id_subscription = subscription.id', 'left')
                    ->findAll();
    }

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
