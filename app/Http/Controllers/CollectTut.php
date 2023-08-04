<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;

class CollectTut extends Controller
{
   public function index(){
   /* $numbers=[1,2,3,3];
    $col=collect($numbers);
    //return $col->avg();
    return $col; */

  /* $names= collect(['name','age']);
  $res= $names->combine(['sara','24']);
  return $res; */

  /*  $ages=collect([2,3,4,5,6,7]);
     return $ages->count(); */

   /*  $ages=collect([2,3,3,5,6,6]);
     return $ages->countBy(); */

     $ages=collect([2,3,3,5,6,6]);
     return $ages->duplicates();

     //each 
     //search
     //filter
     //transform

   }

   public function complex(){
     $users= User::get();

    //remove
    /*   
    $users->each(function($user){
        if($user->expire==0){
        unset($user->age);
        }
        return $user;
      });
      return $users; */

     //add
     $users->each(function($user){
        $user->country='Syria';
        return $user;
      });
      return $users;
   }

   
   public function complexFilter(){
    $users=User::get();
    $users=collect($users);
   $res= $users->filter(function($value,$key){
        return $value['age']==18;
    });
    return array_values($res->all());
   }

   public function complexTransform(){
    $users=User::get();
    $users=collect($users);
   return $res= $users->transform(function($value,$key){
        return 'Eng'.$value['name'];
    });

   }
}
