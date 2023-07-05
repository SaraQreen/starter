<?php

namespace App\Http\Controllers\Front;
use Illuminate\Routing\Controller;

use Illuminate\Http\Request;
use stdClass;

class UserController extends Controller
{

        public function showUserName()
    {
        return 'Sara Qreen';
    }

    public function getIndex(){
       
    /*$obj=new stdClass();
    $obj->name='Sara';
    $obj->age=22;
    $obj->gender='fmale';*/

    $data=[];
    return view('welcome',compact('data'));
    }
    
}


