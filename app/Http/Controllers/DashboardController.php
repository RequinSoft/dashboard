<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        return view('index');
    }

    public function loginIndex(){

        return view('login.index');
    }

    public function login(){

        return view('admin.index');
    }
}
