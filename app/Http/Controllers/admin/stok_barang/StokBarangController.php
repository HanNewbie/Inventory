<?php

namespace App\Http\Controllers\admin\stok_barang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StokBarangController extends Controller
{
    public function index(){
        return view('admin.stok_barang.index');
    }
}