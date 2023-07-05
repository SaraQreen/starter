<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Routing\Controller;

use Illuminate\Http\Request;

class SecondController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('showString1');
    }

    public function showString(){
        return 'Static String';
    }

    public function showString1(){
        return 'Static String1';
    }

    public function showString2(){
        return 'Static String2';
    }
}
