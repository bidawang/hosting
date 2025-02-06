<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketHostingModel extends Model
{
    protected $table            = 'paket_hosting';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['id_kategori', 'id_storage', 'harga_beli', 'harga_perpanjangan', 'lama_hosting', 'satuan_lama', 'created_at', 'updated_at'];

    // Method untuk mengambil semua paket hosting dengan join ke kategori dan storage
    // Contoh dalam model PaketHostingModel
    public function getPaketWithDetails($id = null)
    {
        $query = $this->select('paket_hosting.*, kategori.*, storage.*')
            ->join('kategori', 'paket_hosting.id_kategori = kategori.id')
            ->join('storage', 'paket_hosting.id_storage = storage.id');
        
        // If an ID is provided, add a condition to filter by that ID
        if ($id !== null) {
            $query->where('paket_hosting.id', $id);
        }
        
        return $id === null ? $query->findAll() : $query->first();
    }
    

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
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
