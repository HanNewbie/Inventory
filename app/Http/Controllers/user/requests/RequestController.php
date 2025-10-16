<?php

namespace App\Http\Controllers\user\requests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index(){
        return view('user.request.index');
    }
}
