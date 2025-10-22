<?php

namespace App\Http\Controllers\admin\barang_keluar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OutboundController extends Controller
{
    public function index()
    {
        return view('admin.barang_keluar.index');
    }
}
