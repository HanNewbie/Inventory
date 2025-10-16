<?php

namespace App\Http\Controllers\user\stok_barang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserStokBarangController extends Controller
{
    public function index(){
        return view('user.stok_barang.index');
    }
}
