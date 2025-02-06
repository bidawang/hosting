<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'username', 
        'email', 
        'password', 
        'nama_lengkap', 
        'tanggal_lahir', 
        'jenis_kelamin', 
        'alamat', 
        'kota', 
        'provinsi', 
        'kode_pos', 
        'nomor_telepon',
        'level' // Make sure this is included
    ];

    public function registerUser($data)
    {
        // Hash the password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->save($data);
    }

    public function validateUser($username, $password)
    {
        $user = $this->where('username', $username)->first();
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return user data if valid
        }
        return false; // Return false if not valid
    }

    public function getAdminEmails()
    {
        return $this->where('level', 'admin') // Memfilter user dengan level admin
                    ->select('email')
                    ->findAll();
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
