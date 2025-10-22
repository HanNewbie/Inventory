<?php

namespace App\Http\Controllers\admin\notifikasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        return view('admin.notifikasi.index');
    }
}
