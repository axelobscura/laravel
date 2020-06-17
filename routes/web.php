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

//Route::get('/post/{id}/{name}', function($id, $name){
//    return "This is the post ".$id." and the name is ".$name;
//});

Route::get('/admin/posts/example', array('as'=>'admin.home', function(){
    $url = route('admin.home');
    return "This is url ".$url;
}));

//Route::get('/post/{nombre}', 'PostsController@index');

Route::resource('posts', 'PostsController');

Route::get('/contact', 'PostsController@contact');

Route::get('/mensajes/{id}/{name}/{password}', 'PostsController@mensajes');

// Insert data to db the hard way

Route::get('/insert', function(){
    DB::insert('insert into posts(title, content, is_admin) values(?, ?, ?)', ['PHP With Laravel', 'Laravel is the best thing', '1']);
});