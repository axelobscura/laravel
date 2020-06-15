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

Route::get('/', function () {
    return view('welcome');
    //return 'Admin...';
});

Route::get('/about', function () {
    return 'Hi about page...';
});

Route::get('/contact', function () {
    return 'Contact page...';
});

//Route::get('/post/{id}/{name}', function($id, $name){
//    return "This is the post ".$id." and the name is ".$name;
//});

Route::get('/admin/posts/example', array('as'=>'admin.home', function(){
    $url = route('admin.home');
    return "This is url ".$url;
}));

//Route::get('/post/{nombre}', 'PostsController@index');

Route::resource('posts', 'PostsController');
