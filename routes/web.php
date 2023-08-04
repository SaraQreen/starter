<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\Admin\SecondController;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\CollectTut;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\Relation\RelationsController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

define('PAGINATION_COUNT',3);
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    
    return view('welcome');
});

Route::get('/test1', function () {
    return 'welcome';
});


//route parameters & route name

Route::get('/show-number/{id}', function ($id) {
    return $id;
}) -> name('a');


Route::get('/show-string/{id?}', function () {
    return 'welcome';
}) -> name('b');


Route::namespace('Front')->group(function(){

    //all routes only access controller or methods in folder name Front
      
    Route::get('users',[UserController::class,'showUserName']);
});

/*Route::group(['prefix'=>'users','middleware'=>'auth'],function(){
     //set of routes
   
    Route::get('/',function(){
        return 'Work';

    });  
    Route::get('show','UserController@showUserName');
    Route::delete('delete','UserController@showUserName');
    Route::get('edit','UserController@showUserName');
    Route::put('update','UserController@showUserName');
    
});*/
/*
Route::get('check',function(){
    return 'Middleware';

})->middleware('auth');


Route::group(['namespace'=>'Admin','middleware'=>'auth'],function(){
    Route::get('second',[SecondController::class,'showString']);
    Route::get('second1',[SecondController::class,'showString1']);
    Route::get('second2',[SecondController::class,'showString2']);

});

Route::get('login',function(){

    return 'Must Be Login To Access This Route';
})->name('login');

Route::get('/test',[TestController::class,'test']);

Route::resource('news','NewsController');

Route::get('index',[UserController::class,'getIndex']);


Route::get('/landing', function () {
    return view('landing');
});

Route::get('/about', function () {
    return view('about');
});*/

Route::get('/dashboard', function () {
    return 'Not Adualt';
})->name('not.adualt');





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/',function(){
    return 'Home';
});

Route::get('fillable',[CrudController::class,'getOffers']);

Route::group(['prefix' => LaravelLocalization::setlocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
     Route::group(['prefix'=>'offers'],function(){
    //Route::get('store',[CrudController::class,'store']);
   
    Route::get('create',[CrudController::class,'create']);
    Route::post('store',[CrudController::class,'store'])->name('offers.store');


    Route::get('edit/{offer_id}',[CrudController::class,'editOffer']);
    Route::post('update/{offer_id}',[CrudController::class,'updateOffer'])->name('offers.update');
    Route::get('delete/{offer_id}',[CrudController::class,'delete'])->name('offers.delete');


    Route::get('all',[CrudController::class,'getAllOffers'])->name('offers.all');
    Route::get('get-all-anactive-offer',[CrudController::class,'getAllInactiveOffers']);
});
    Route::get('youtube',[CrudController::class,'getVideo'])->middleware('auth');


});

############## Begin AJAX Routes ####################

Route::group(['prefix'=>'ajax-offers'],function(){
    Route::get('create',[OfferController::class,'create']);
    Route::post('store',[OfferController::class,'store'])->name('ajax.offers.store');
    Route::get('all',[OfferController::class,'all'])->name('ajax.offers.all');
    Route::post('delete',[OfferController::class,'delete'])->name('ajax.offers.delete');
    Route::get('edit/{offer_id}',[OfferController::class,'edit'])->name('ajax.offers.edit');
    Route::post('update',[OfferController::class,'update'])->name('ajax.offers.update');

});

############## End AJAX Routes ####################



############## Begin Authentication && Guards ##############
Route::group(['middleware'=>'CheckAge'],function(){
    Route::get('adualts',[CustomAuthController::class,'adualt'])->name('adualt');

});

Route::get('site',[CustomAuthController::class,'site'])->middleware('auth:web')->name('site');
Route::get('admin',[CustomAuthController::class,'admin'])->middleware('auth:admin')->name('admin');

Route::get('admin/login',[CustomAuthController::class,'adminLogin'])->name('admin.login');
Route::post('admin/login',[CustomAuthController::class,'checkAdminLogin'])->name('save.admin.login');


############## End Authentication && Guards ##############


############## Begin relation routes ##############
Route::get('has-one',[RelationsController::class,'hasOneRelation']);

Route::get('has-one-reverse',[RelationsController::class,'hasOneRelationReverse']);

Route::get('get-user-has-phone',[RelationsController::class,'getUserHasPhone']);
Route::get('get-user-not-has-phone',[RelationsController::class,'getUserNotHasPhone']);
Route::get('get-user-has-phone-cond',[RelationsController::class,'getUserHasPhoneWithCondition']);

################ Begin One To Many Relationship ################

Route::get('hospital-has-many',[RelationsController::class,'getHospitalDoctors']);
Route::get('hospitals',[RelationsController::class,'hospitals'])->name('hospital.all');
Route::get('hospitals/{hospital_id}',[RelationsController::class,'deleteHospital'])->name('hospital.delete');
Route::get('doctors/{hospital_id}',[RelationsController::class,'doctors'])->name('hospital.doctors');

Route::get('hospitals_has_doctors',[RelationsController::class,'hospitalsHasDoctor']);
Route::get('hospitals_has_doctors_male',[RelationsController::class,'hospitalsHasOnlyMaleDoctors']);
Route::get('hospitals_not_has_doctors',[RelationsController::class,'hospitalsNotHasDoctors']);

################ End One To Many Relationship ################


Route::get('doctors-services',[RelationsController::class,'getDoctorServices']);
Route::get('service-doctros',[RelationsController::class,'getServiceDoctors']);
   
Route::get('doctors/services/{doctor_id}',[RelationsController::class,'getDoctorServicesById'])->name('doctors.services');
   
Route::post('saveServices-to-doctor',[RelationsController::class,'saveServicesToDoctors'])->name('save.doctors.services');




################### Has One Through ##############
Route::get('has-one-through',[RelationsController::class,'getPatientDoctor']);

Route::get('has-many-through',[RelationsController::class,'getCountryDoctor']);

Route::get('has-many-through-hospital',[RelationsController::class,'getHospitalCountry']);


############## End relation routes ##############


################### Begin Accessors $ Mutators #####################

Route::get('accessors',[RelationsController::class,'getDoctors']);  //get data

################### End Accessors $ Mutators #####################


####################### Collection #########################
Route::get('collection',[CollectTut::class,'index']);

Route::get('mainuser',[CollectTut::class,'complex']);

Route::get('main-user',[CollectTut::class,'complexFilter']);

Route::get('main-user3',[CollectTut::class,'complexTransform']);
