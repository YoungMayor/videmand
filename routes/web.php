<?php

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

Route::get('test', function () {
  return view('welcome');
});


Route::get("/", function(){
  if (Auth::check()){
    return redirect()->route('video.list.all');
  }
  return view("pages.index");
})->name("index");


Route::middleware(['auth', 'verified'])->group(function(){
  Route::get("videos", "VideosController@showPage")->name("video.list.all");

  Route::post("get_videos", "VideosController@getVideos")->name("video.list.all.get");

  Route::get("my-videos", "VideosController@showMyPage")->name("video.list.mine");
  
  Route::post("get-my-videos", "VideosController@getMyVideos")->name("video.list.mine.get");

  Route::get("search", "VideosController@showSearchPage")->name("video.search");

  Route::post("get_search", "VideosController@searchVideos")->name("video.search.get");

  Route::get("watch@{token}", "VideosController@showVideoPage")->name("video.watch");

  Route::get("upload", "UploadController@showForm")->name("video.upload");

  Route::post("upload", "UploadController@saveUpload")->name("video.upload.save");

  Route::get("purhase_video@{token}", "PaymentController@showForm")->name("payment_form");

  Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay'); 

  Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
});

Auth::routes(['verify' => true]);


Route::get("logout", function(){
  Auth::logout();
  return redirect()->route("index");
})->name("logout");

