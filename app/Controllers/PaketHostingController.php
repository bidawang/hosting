<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PaketHostingModel;
use App\Models\KategoriModel;
use App\Models\StorageModel;

class PaketHostingController extends BaseController
{
    protected $paketHostingModel;
    protected $kategoriModel;
    protected $storageModel;

    public function __construct()
    {
        $this->paketHostingModel = new PaketHostingModel();
        $this->kategoriModel = new KategoriModel();
        $this->storageModel = new StorageModel();
    }

    public function index()
    {
        $data['paket_hosting'] = $this->paketHostingModel->getPaketWithDetails();
        return view('Admin/paket_hosting/index', $data);
    }

    public function create()
    {
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['storage'] = $this->storageModel->findAll();
        return view('Admin/paket_hosting/create', $data);
    }

    public function store()
    {
        $this->paketHostingModel->save([
            'id_kategori'       => $this->request->getPost('id_kategori'),
            'id_storage'        => $this->request->getPost('id_storage'),
            'harga_beli'        => $this->request->getPost('harga_beli'),
            'harga_perpanjangan'=> $this->request->getPost('harga_perpanjangan'),
            'lama_hosting'      => $this->request->getPost('lama_hosting'),
            'satuan_lama'       => $this->request->getPost('satuan_lama')
        ]);

        return redirect()->to('/paket-hosting')->with('message', 'Paket hosting berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['paket'] = $this->paketHostingModel->getPaketWithDetails($id);
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['storage'] = $this->storageModel->findAll();

        if (!$data['paket']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data paket hosting tidak ditemukan.');
        }

        return view('Admin/paket_hosting/edit', $data);
    }

    public function update($id)
    {
        $this->paketHostingModel->update($id, [
            'id_kategori'       => $this->request->getPost('id_kategori'),
            'id_storage'        => $this->request->getPost('id_storage'),
            'harga_beli'        => $this->request->getPost('harga_beli'),
            'harga_perpanjangan'=> $this->request->getPost('harga_perpanjangan'),
            'lama_hosting'      => $this->request->getPost('lama_hosting'),
            'satuan_lama'       => $this->request->getPost('satuan_lama')
        ]);

        return redirect()->to('/paket-hosting')->with('message', 'Paket hosting berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->paketHostingModel->delete($id);
        return redirect()->to('/paket-hosting')->with('message', 'Paket hosting berhasil dihapus.');
    }
}
