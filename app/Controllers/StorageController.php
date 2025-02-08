<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StorageModel;

class StorageController extends BaseController
{
    protected $storageModel;

    public function __construct()
    {
        $this->storageModel = new StorageModel();
    }

    public function index()
    {
        $data['storage'] = $this->storageModel->findAll();
        return view('Admin/storage/index', $data);
    }

    public function create()
    {
        return view('Admin/storage/create');
    }

    public function store()
    {
        $this->storageModel->save([
            'kapasitas' => $this->request->getPost('kapasitas'),
            'satuan' => $this->request->getPost('satuan'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to('/storage')->with('message', 'Storage berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['storage'] = $this->storageModel->find($id);

        if (!$data['storage']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data storage tidak ditemukan.');
        }

        return view('Admin/storage/edit', $data);
    }

    public function update($id)
    {
        $this->storageModel->update($id, [
            'kapasitas' => $this->request->getPost('kapasitas'),
            'satuan' => $this->request->getPost('satuan'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to('/storage')->with('message', 'Storage berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->storageModel->delete($id);
        return redirect()->to('/storage')->with('message', 'Storage berhasil dihapus.');
    }
}
