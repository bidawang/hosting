<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $data['kategori'] = $this->kategoriModel->findAll();

        // Decode fitur JSON untuk menampilkan sebagai array di view
        foreach ($data['kategori'] as &$kat) {
            $kat['fitur'] = json_decode($kat['fitur'], true);
        }

        return view('Admin/kategori/index', $data);
    }

    public function create()
    {
        return view('Admin/kategori/create');
    }

    public function store()
    {
        $fiturJson = $this->request->getPost('fitur');

        // Validate JSON format
        $fiturDecoded = json_decode($fiturJson, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return redirect()->back()->with('error', 'Format JSON tidak valid.')->withInput();
        }

        $this->kategoriModel->save([
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'keterangan'    => $this->request->getPost('keterangan'),
            'fitur' => $this->request->getPost('fitur'),  // Tidak perlu json_encode di sini

        ]);

        return redirect()->to('/kategori')->with('message', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
{
    $data['kategori'] = $this->kategoriModel->find($id);

    if (!$data['kategori']) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Data kategori tidak ditemukan.');
    }

    // Decode JSON string ke array agar dapat digunakan di editor
    $data['kategori']['fitur'] = json_decode($data['kategori']['fitur'], true);

    return view('Admin/kategori/edit', $data);
}


    public function update($id)
{
    $fiturJson = $this->request->getPost('fitur');

    // Periksa apakah fitur sudah berbentuk JSON string atau masih berbentuk array
    $fiturDecoded = json_decode($fiturJson, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return redirect()->back()->with('error', 'Format JSON tidak valid.')->withInput();
    }

    // Simpan data JSON mentah
    $this->kategoriModel->update($id, [
        'nama_kategori' => $this->request->getPost('nama_kategori'),
        'keterangan'    => $this->request->getPost('keterangan'),
        'fitur'         => $fiturJson,  // Jangan gunakan json_encode di sini
    ]);

    return redirect()->to('/kategori')->with('message', 'Kategori berhasil diperbarui.');
}



    public function delete($id)
    {
        $this->kategoriModel->delete($id);
        return redirect()->to('/kategori')->with('message', 'Kategori berhasil dihapus.');
    }
}
