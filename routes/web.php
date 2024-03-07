<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Database\Factories\listingFactory;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing  

Route::get('/', [ListingController::class , 'index']);


Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');


Route::get('/listing/{listing}', [ListingController::class, 'show']);

Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

Route::get('/listing/{listing}/edit',[ListingController::class,'edit'])->middleware('auth');

Route::put('/listings/{listing}',[ListingController::class,'update'])->middleware('auth');

Route::delete('listings/{listing}',[ListingController::class,'destroy']);

Route::get('/listings/manage',[ListingController::class,'manage'])->middleware('auth');

Route::get('/register',[UserController::class,'register'])->middleware('guest');

Route::post('/users',[UserController::class,'store']);

Route::post('/logout',[UserController::class,'logout'])->middleware('auth');

Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');

Route::post('/users/authnticate',[UserController::class,'authnticate']);






// Route::get('/hello',function(){
//     return response('<h1>Hello World</h1>',200)
//     ->header('Content-Type','Text/plain')
//     ->header('foo','bar');
// });

// Route::get('/posts/{id}',function($id){
//     return response('My number of posts today is: '. $id);
// })->where('id','[0-9]+');

// Route::get('/search', function(Request $request){
// return $request ->name.' '.$request->city;
// });
