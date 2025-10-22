<?php

namespace App\Http\Controllers\admin\barang_masuk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InboundController extends Controller
{
    public function index()
    {
        return view('admin.barang_masuk.index');
    }
}
