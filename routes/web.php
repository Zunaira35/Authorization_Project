<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin',[LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin',[LoginController::class,'adminLogin'])->name('admin.login');

Route::get('/admin/register',[RegisterController::class,'showAdminRegisterForm'])->name('admin.register-view');
Route::post('/admin/register',[RegisterController::class,'createAdmin'])->name('admin.register');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/dashboard',function(){
    return view('admin');
})->middleware('auth:admin');

Route::group(['middleware' => ['role:writer']], function () {
    Route::get('/createArticlePage',[HomeController::class,'createArticle'])->name('createArticlePage');
    Route::get('/publishArticlePage',[HomeController::class,'publishArticle'])->name('publishArticlePage');
});  


Route::group(['middleware' => ['role:manager']], function () {
    Route::get('/editArticlePage',[HomeController::class,'editArticle'])->name('editArticlePage')->middleware('auth:admin');
    Route::get('/deleteArticlePage',[HomeController::class,'deleteArticle'])->name('deleteArticlePage')->middleware('auth:admin');
});  
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

