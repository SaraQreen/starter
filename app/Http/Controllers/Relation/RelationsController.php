<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Phone;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function hasOneRelation(){
        $user= User::with(['phone'=>function($q){
            $q->select('code','phone','user_id');
        }])-> find(6);

        //return $user->phone->code;
       //$phone= $user->phone;
         return response()->json($user);
    }

    public function hasOneRelationReverse(){
        //$phone=Phone::with('user')->find(1);

        $phone=Phone::with(['user'=>function($q){
            $q->select('id','name');
        }])->find(1);
        //make some attribute visible
        $phone->makeVisible(['user_id']);
        //make some attribute hidden
        //$phone->makeHidden(['code']);
        
       //return  $phone->user; //return user of this phone number

       //get all data phone + user

        return $phone;


    }

    public function getUserHasPhone(){
      return User::whereHas('phone')->get();

    }

    public function getUserNotHasPhone(){
        return User::whereDoesntHave('phone')->get();

    }

    public function getUserHasPhoneWithCondition(){
        return User::whereHas('phone',function($q){
            $q->where('code',963);
          })->get();

    }

#################### One To Many Relationship Methods ####################

    public function getHospitalDoctors(){
     $hospital= Hospital::find(1); //Hospital::where('id',1)->first();  //Hospital::first(1);

     //return $hospital->doctors;   //return hospital doctors

     $hospital= Hospital::with('doctors')->find(1);
     //return $hospital->name;
     /*
     $doctors=$hospital->doctors;
     foreach($doctors as $doctor){
      echo  $doctor->name.'<br>';

     }*/

     $doctor=Doctor::find(1);
    return $doctor->hospital->name;  

    }

    public function hospitals(){
        $hospitals=Hospital::select('id','name','address')->get();
        return view('doctors.hospitals',compact('hospitals'));
    }

    public function doctors($hospital_id){
      $hospital= Hospital::find('$hospital_id');
        $doctors=$hospital->doctors;
        return view('doctors.doctors',compact('doctors'));
    }

     //get all hospital which must has doctors
    public function hospitalsHasDoctor(){
      return $hospitals=  Hospital::whereHas('doctors')->get();

    }

    public function hospitalsHasOnlyMaleDoctors(){
        return $hospitals=  Hospital::with('doctors')->whereHas('doctors',function($q){
            $q->where('gender',1);
        })->get();

    }

    public function hospitalsNotHasDoctors(){
        return Hospital::whereDoesntHave('doctors')->get();

    }

    public function deleteHospital($hospital_id){
      $hospital= Hospital::find($hospital_id);
        if(!$hospital)
            return abort('404');
            //delete doctors in this hospital
            $hospital->doctors()->delete();
            $hospital->delete();

            //return redirect()->route('hospital.all');
    }

    public function getDoctorServices(){
      return $doctor=Doctor::with('services')->find(5);
      //return $doctro->name;
       //return $doctor->services;
    }

    public function getServiceDoctors(){
      return  $doctors=Service::with(['doctors'=>function($q){
        $q->select('doctors.id','name','title');
      }])->find(1);
    } 

    public function getDoctorServicesById($doctor_id){
        $doctor=Doctor::find($doctor_id);
        $services=$doctor->services;  //doctor services
        $doctors=Doctor::select('id','name')->get();
        $allServices=Service::select('id','name')->get();  //all database services
        return view('doctors.services',compact('services','doctors','allServices'));

    }

    public function saveServicesToDoctors(Request $request){
       $doctor=Doctor::find($request->doctor_id);
       if(!$doctor)
         return abort('404');

       //$doctor->services()->attach($request->servicesIds); //many to many insert to database
       //$doctor->services()->sync($request->servicesIds);
       $doctor->services()->syncWithoutDetaching($request->servicesIds);
       return 'Success';  
    }

    public function getPatientDoctor(){
       $patient= Patient::find(2);
      return $patient->doctor;

    }

    public function getCountryDoctor(){
     return  $country= Country::with('doctors')->find(1);
      // return $country->doctors;
    }

    public function getHospitalCountry(){
      return $country=Country::find(1);
      
    }

    public function getDoctors(){
    return  $doctors= Doctor::select('id','name','gender')->get();

     /* if(isset( $doctors) &&  $doctors->count() > 0)
        foreach( $doctors as $doctor){
          $doctor->gender=$doctor->gender== 1 ? 'male' : 'femal';
          //$doctor->newVal='new';
        }
        return $doctors; */



    }
}
