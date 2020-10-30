<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/docsManager/new-doc',  "App\Http\Controllers\DocsController@newDoc")->middleware('verified');
Route::post('/docsManager/save-new-doc', "App\Http\Controllers\DocsController@createDoc")->middleware('verified');
Route::get('/docsManager/view-all-docs',  "App\Http\Controllers\DocsController@viewAllDocs")->middleware('verified');;
Route::get('/docsManager/update-doc/{id}', "App\Http\Controllers\DocsController@updateDoc")->middleware('verified');;
Route::get('/docsManager/delete-doc/{id}', "App\Http\Controllers\DocsController@deleteDoc")->middleware('verified');;
Route::post('/docsManager/save-updated-doc/{id}', "App\Http\Controllers\DocsController@saveUpdatedDocs")->middleware('verified');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Login routes
//Auth::routes();
Auth::routes(['verify' => true]);


//Shared doc routes
Route::get('/shared/shared-with-me', "App\Http\Controllers\DocsController@getSharedDocInfo")->middleware('verified');

//password reset route

//Route::post("/passwords/email", "App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail");
//Route::get("/password/reset/{token?}", "App\Http\Controllers\Auth\ForgotPasswordController@showResetForm");
//Route::post("/password/reset", "App\Http\Controllers\Auth\ForgotPasswordController@reset");

//Make sure session is valid in every devices
