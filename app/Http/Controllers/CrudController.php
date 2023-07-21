<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;
class CrudController extends Controller
{
   
    public function __construct()
    {
        
    }

    public function getOffers(){
       return Offer::select('name','price')->get();
    }
/*
    public function store()
    {
        Offer::create([
            'name'=>'offer3',
            'price'=>'400',
            'details'=>'offer3 details',
        ]);
    } */

    public function create(){
        return view('offers.create');
    }

    public function store(OfferRequest $request){

        //validate data before insert to database

        //$rules= $this->getRules();
        //$messages= $this->getMessages();

        //$validator=Validator::make($request->all(),$rules,$messages);

        //($validator->fails())
        //{
         //   return redirect()->back()->withErrors($validator)->withInput($request->all());
        //}

        //insert
        Offer::create([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'price'=>$request->price,
            'details_ar'=>$request->details_ar,
            'details_en'=>$request->details_en,
        ]);
        return redirect()->back()->with(['success'=>'تم إضافة العرض بنجاح']);
    }
/*
    protected function getMessages(){
        return $messages=[
            'name.required'=>__('messages.offer name required'),   //trans()
            'name.unique'=>__('messages.offer name must be uniqe'),
            'price.required'=>'سعر العرض مطلوب',
            'price.numeric'=>'سعر العرض يجب أن يكون أرقام',
            'details.required'=>'التفاصيل مطلوبة '
        ];

    }

    protected function getRules(){
        return $rules= [
            'name'=>'required|max:100|unique:offers,name',
            'price'=>'required|numeric',
            'details'=>'required',
        ];

    }*/

    public function getAllOffers(){
       $offers= Offer::select('id',
       'price',
       'name_'.LaravelLocalization::getCurrentLocale().' as name',
       'details_'.LaravelLocalization::getCurrentLocale().' as details'
       )->get(); //return collection
       return view('offers.all',compact('offers'));
    }

}
