<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\RolesController;
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

Route::get('/', function () {
  return view('auth.login');
});

Auth::routes();

Route::get('/home', [UserController::class, 'home'])->name('home');

Route::group(['middleware' => ['auth']], function() {

    Route::resource('/roles',RolesController::class);

    Route::resource('/users',UserController::class);
    
    });
    Route::get('/chat', [ChatController::class, 'index'])->middleware('auth');
Route::get('/messages/{user}', [ChatController::class, 'fetchMessages'])->middleware('auth');
Route::post('/messages', [ChatController::class, 'sendMessage'])->middleware('auth');
Route::post('/pusher/auth', [ChatController::class, 'pusherAuth'])->middleware('auth');

    Route::get('languageConverter/{locale}',function($locale){
        if(in_array($locale,['ar','en'])){
          session()->put('locale',$locale);
        }
        
        return redirect()->back();
        })->name('languageConverter');
