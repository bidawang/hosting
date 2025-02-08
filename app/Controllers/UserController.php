<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function register()
    {
        return view('Customer/register');
    }
    public function index()
{
    $model = new UserModel();
    $data['users'] = $model->findAll(); // Ambil semua data user
    return view('Admin/User/index', $data);
}
public function create()
{
    return view('Admin/User/create');
}
    public function store()
    {
        // Prepare user data
        $data = [
            'username'      => $this->request->getPost('username'),
            'email'         => $this->request->getPost('email'),
            'password'      => $this->request->getPost('password'),
            'nama_lengkap'  => $this->request->getPost('nama_lengkap'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat'        => $this->request->getPost('alamat'),
            'kota'          => $this->request->getPost('kota'),
            'provinsi'      => $this->request->getPost('provinsi'),
            'kode_pos'      => $this->request->getPost('kode_pos'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'level'         => 'customer', // Default level
        ];

        // Basic validation
        if (!$this->validate([
            'username' => 'required|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        // Register user
        if ($this->userModel->insert($data)) {
            return redirect()->to('/login')->with('success', 'Registration successful. You can now log in.');
        }

        return redirect()->back()->with('error', 'Registration failed. Please try again.');
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);
        
        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'User not found.');
        }

        return view('Admin/User/edit', ['user' => $user]);
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'User not found.');
        }

        // Prepare updated data
        $data = [
            'username'      => $this->request->getPost('username'),
            'email'         => $this->request->getPost('email'),
            'nama_lengkap'  => $this->request->getPost('nama_lengkap'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat'        => $this->request->getPost('alamat'),
            'kota'          => $this->request->getPost('kota'),
            'provinsi'      => $this->request->getPost('provinsi'),
            'kode_pos'      => $this->request->getPost('kode_pos'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'level'         => $this->request->getPost('level'),
        ];

        // Validate data
        if (!$this->validate([
            'username' => "required|is_unique[users.username,id,{$id}]",
            'email'    => "required|valid_email|is_unique[users.email,id,{$id}]",
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update user
        $this->userModel->update($id, $data);
        return redirect()->to('admin/users')->with('success', 'User updated successfully.');
    }

    public function delete($id)
{
    $user = $this->userModel->find($id);

    if (!$user) {
        return redirect()->to('admin/users')->with('error', 'User not found.');
    }

    $this->userModel->delete($id);
    return redirect()->to('admin/users')->with('success', 'User deleted successfully.');
}


    public function login()
    {
        return view('Customer/login');
    }

    public function authenticate()
    {
        // Get username and password from the form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validate user
        $user = $this->userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Set session data
            session()->set([
                'id'        => $user['id'],
                'username'  => $user['username'],
                'level'     => $user['level'],
                'isLoggedIn'=> true
            ]);

            // Redirect based on user level
            if ($user['level'] === 'admin') {
                return redirect()->to('admin/dashboard')->with('success', 'Welcome to the admin dashboard.');
            } else {
                return redirect()->to('/')->with('success', 'Welcome back, ' . esc($user['nama_lengkap']) . '!');
            }
        }

        // If user not found or credentials are incorrect
        return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'You have logged out successfully.');
    }

    public function admin()
    {
        return view('Admin/index');
    }
}
