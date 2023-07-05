<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\Admin\SecondController;
use App\Http\Controllers\Front\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

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





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/',function(){
    return 'Home';
});

