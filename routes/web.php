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
/* use App\Models\Image;
use App\Models\User; */

/* Route::get('/', function () {
    /* $images = Image::all();

    foreach($images as $image){
     echo $image->image_path."<br>";
     echo $image->description."<br>";
     echo $image->user->name.' '.$image->user->surname."<br>"; 
     
     
   
    if(count($image->comments)>=1){
        echo '<br><strong>comentarios:</strong><br>';
        foreach($image->comments as $comment){
        echo $comment->user->name.': '.$comment->content."<br>";
        }
    }
     echo '<br>LIKES:'.count($image->likes)."<br>";
     echo "-------------------------------------------------<br>";
    }

    return view('welcome');
});  */


//Generales
Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Usuario
Route::get('/configuracion','App\Http\Controllers\UserController@config')->name('config');
Route::post('user/update','App\Http\Controllers\UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}','App\Http\Controllers\UserController@getImage')->name('user.avatar');
Route::get('/profile/{id}','App\Http\Controllers\UserController@profile')->name('profile');
Route::get('/gente/{search?}','App\Http\Controllers\UserController@index')->name('user.index');

//Imagen
Route::get('/subir-imagen','App\Http\Controllers\ImageController@create')->name('image.create');
Route::post('/image/save','App\Http\Controllers\ImageController@save')->name('image.save');
Route::get('/image/file/{filename}','App\Http\Controllers\ImageController@getImage')->name('image.file');
Route::get('/image/{id}','App\Http\Controllers\ImageController@detail')->name('image.detail');
Route::get('/image/delete/{id}','App\Http\Controllers\ImageController@delete')->name('image.delete');
Route::get('/image/editar/{id}','App\Http\Controllers\ImageController@edit')->name('image.edit');
Route::post('/image/update','App\Http\Controllers\ImageController@update')->name('image.update');

//Comments
Route::post('/comment/save','App\Http\Controllers\CommentController@save')->name('comment.save');
Route::get('/comment/delete/{id}','App\Http\Controllers\CommentController@delete')->name('comment.delete');

//likes
Route::get('/like/{image_id}','App\Http\Controllers\LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}','App\Http\Controllers\LikeController@dislike')->name('like.delete');
Route::get('/likes','App\Http\Controllers\LikeController@likes')->name('likes');


