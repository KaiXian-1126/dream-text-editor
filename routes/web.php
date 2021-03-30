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

//Non verify version
Route::get('/docsManager/new-doc',  "App\Http\Controllers\DocsController@newDoc")->middleware('auth');
Route::post('/docsManager/save-new-doc', "App\Http\Controllers\DocsController@createDoc")->middleware('auth');
Route::get('/docsManager/view-all-docs',  "App\Http\Controllers\DocsController@viewAllDocs")->middleware('auth');;
Route::get('/docsManager/update-doc/{id}', "App\Http\Controllers\DocsController@updateDoc")->middleware('auth');;
Route::get('/docsManager/delete-doc/{id}', "App\Http\Controllers\DocsController@deleteDoc")->middleware('auth');;
Route::post('/docsManager/save-updated-doc/{id}', "App\Http\Controllers\DocsController@saveUpdatedDocs")->middleware('auth');
Route::post('/docsManager/search', "App\Http\Controllers\DocsController@searchDocs")->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//login routes
Auth::routes();


//Shared doc routes
Route::get('/shared/shared-with-me', "App\Http\Controllers\DocsController@getSharedDocInfo")->middleware('auth');
Route::get("/shared/update-accessibility/{accessibility}/{id}", "App\Http\Controllers\DocsController@updateAccessibility")->middleware('auth');
Route::post("/shared/view-shared-doc", "App\Http\Controllers\DocsController@accessToOtherDoc")->middleware('auth');


/*
**********************************************************************************************************
//email verify version
Route::get('/docsManager/new-doc',  "App\Http\Controllers\DocsController@newDoc")->middleware('verified');
Route::post('/docsManager/save-new-doc', "App\Http\Controllers\DocsController@createDoc")->middleware('verified');
Route::get('/docsManager/view-all-docs',  "App\Http\Controllers\DocsController@viewAllDocs")->middleware('verified');;
Route::get('/docsManager/update-doc/{id}', "App\Http\Controllers\DocsController@updateDoc")->middleware('verified');;
Route::get('/docsManager/delete-doc/{id}', "App\Http\Controllers\DocsController@deleteDoc")->middleware('verified');;
Route::post('/docsManager/save-updated-doc/{id}', "App\Http\Controllers\DocsController@saveUpdatedDocs")->middleware('verified');

Auth::routes(['verify' => true]);


//Shared doc routes
Route::get('/shared/shared-with-me', "App\Http\Controllers\DocsController@getSharedDocInfo")->middleware('verified');
Route::get("/shared/update-accessibility/{accessibility}/{id}", "App\Http\Controllers\DocsController@updateAccessibility")->middleware('verified');
Route::post("/shared/view-shared-doc", "App\Http\Controllers\DocsController@accessToOtherDoc")->middleware('verified');;
****************************************************************************************************************
*/


