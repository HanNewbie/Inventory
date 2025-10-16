<?php

namespace App\Http\Controllers\admin\data_barang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LokawisataController extends Controller
{
    public function index(){
        return view('admin.data_barang.lokawisata');
    }
}
