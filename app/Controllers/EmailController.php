<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class EmailController extends BaseController
{
    public function index()
    {
        //
    }

    public function sendEmail()
    {
        $email = \Config\Services::email();

        $email->setTo('mistarlong@gmail.com');  // Email penerima
        $email->setSubject('Test Email dari CodeIgniter 4');
        $email->setMessage('<p>Ini adalah contoh email dari CodeIgniter 4 menggunakan Gmail SMTP.</p>');

        if ($email->send()) {
            echo "Email berhasil dikirim!";
        } else {
            echo "Gagal mengirim email.";
            // Tampilkan error jika ada
            print_r($email->printDebugger(['headers']));
        }
    }
}
