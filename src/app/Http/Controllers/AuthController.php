<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function admin()//index->admin
    {
        return view('admin');
        //管理画面ができたら’’内の名称変更->admin
    }
}
