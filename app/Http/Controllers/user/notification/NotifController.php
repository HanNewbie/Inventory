<?php

namespace App\Http\Controllers\user\notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotifController extends Controller
{
    public function index(){
        return view('user.notification.index');
    }
}
