<?php

namespace App\Models;

use App\Scopes\OfferScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table="offers";
    protected $fillable=['name_ar','name_en','price','photo','details_ar','details_en','status','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];
    //public $timestamps=false;

      // Register Global Scope 
    protected static function boot()
    {
        parent::boot();
 
        static::addGlobalScope(new OfferScopes);
    }



    ############################ Local Scopes ############################

    public function scopeInactive($query){
       return $query->where('status',0);
    } 

    public function scopeInvalid($query){
        return $query->where('status',0)->whereNull('details_ar');
     }  

   ##################################################################  


   //mutators
   public function setNameEnAttribute($value){
     $this->attributes['name_en']=strtoupper($value);
   }
 
}
