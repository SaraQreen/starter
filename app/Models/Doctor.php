<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table="doctors";
    protected $fillable=['name','title','price','hospital_id','medical_id','created_at','updated_at'];
    protected $hidden=['created_at','updated_at','pivot'];
    public $timestamps=false;

    public function hospital(){
        return $this->belongsTo('App\Models\Hospital','hospital_id','id');
    }

    public function services(){
        return $this->belongsToMany('App\Models\Service','doctor_service','doctor_id','service_id','id','id');
    }

         //Accessors
    public function getGenderAttribute($val){
       return $val== 1 ? 'male' : 'femal';
    }

        //mutators
       

    

}
