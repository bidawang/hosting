<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('Dashboard/index');
    }

    public function domain(){
        return view('Dashboard/domain');
    }

    public function about(){
        return view('Dashboard/about');
    }
    public function contact(){
        return view('Dashboard/contact');
    }

    public function admindashboard(){
        return view('Admin/dashboard');
    }
}
