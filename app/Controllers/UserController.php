<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function register()
    {
        return view('Customer/register');
    }

    public function store()
    {
        $model = new UserModel();

        // Prepare user data
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat' => $this->request->getPost('alamat'),
            'kota' => $this->request->getPost('kota'),
            'provinsi' => $this->request->getPost('provinsi'),
            'kode_pos' => $this->request->getPost('kode_pos'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'level' => 'customer', // Set default level to customer
        ];

        // Register user
        if ($model->registerUser($data)) {
            return redirect()->to('/')->with('success', 'Registration successful. You can now log in.');
        }
        return redirect()->back()->with('errors', ['Registration failed']);
    }

    public function login()
    {
        return view('Customer/login');
    }

    public function authenticate()
{
    $model = new UserModel();

    // Get username and password from the form
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    // Validate user
    $user = $model->validateUser($username, $password);

    if ($user) {
        // Set session data
        session()->set([
            'id' => $user['id'],
            'username' => $user['username'],
            'level' => $user['level'],
            'isLoggedIn' => true
        ]);

        // Check the user's level and redirect accordingly
        if ($user['level'] === 'admin') {
            // Redirect to admin dashboard if the level is 'admin'
            return redirect()->to('admin/dashboard')->with('success', 'Login successful.');
        } elseif ($user['level'] === 'customer') {
            // Redirect to the homepage or customer page if the level is 'customer'
            return redirect()->to('/')->with('success', 'Login successful.');
        }
    }

    // If user not found or credentials are incorrect
    return redirect()->back()->with('errors', ['Invalid username or password']);
}


    public function logout()
    {
        session()->destroy(); // Destroy the session on logout
        return redirect()->to('')->with('success', 'You have logged out successfully.');
    }

    public function admin(){
        return view('Admin/index');
    }
}
