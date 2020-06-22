<?php

use App\Post;
use App\User;


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

// Database RAW sql queries

Route::get('/insert', function(){
    DB::insert('insert into posts(title, content, is_admin) values(?, ?, ?)', ['PHP With Laravel', 'Laravel is the best thing', '1']);
});

Route::get('/read', function(){
    $results = DB::select('select * from posts where id = ?', [2]);
    foreach($results as $post){
        return $post->title;
    }
});

Route::get('/update', function(){
    $updated = DB::update('update posts set title = "Updated title" where id = ?', [3]);
    return $updated;
});

Route::get('/delete', function(){
    $deleted = DB::delete('delete from posts where id = ?', [2]);
    return $deleted;
});

// Database Eloquent sql queries

Route::get('/find', function(){
    $posts = Post::all();
    foreach($posts as $post){
        return $post->title;
    }
});

Route::get('/findwhere', function(){
    $post = Post::where('id', 3)->orderBy('id', 'desc')->take(1)->get();
    return $post;
});

Route::get('/findmore', function(){
    //$posts = Post::findOrFail(3);
    //return $posts;
    $posts = Post::where('title', '<', '50')->firstOrFail();
});

Route::get('/basicinsert', function(){
    $post = new Post;
    //If you want to update by id
    //$post = Post::find(1);
    $post->title = 'Cuando llueve en México';
    $post->content = 'Woe this is magical...';
    $post->is_admin = '1';
    $post->save();
});

Route::get('/create', function(){
    Post::create(['title'=>'The create method', 'content'=>'I\'m learning pretty beautiful things', 'is_admin'=>'2']);
});

Route::get('/updatedos', function(){
    Post::where('id', 3)->where('is_admin', '1')->update(['title'=>'The Wave', 'content'=>'Energy at its purest', 'is_admin'=>'2']);
});

Route::get('/deletedos', function(){
    $post = Post::find(5);

    $post->delete();
});

Route::get('/deletetres', function(){
    Post::destroy(3);
    //Post::destroy([4,5]);
    //Post::where('is_admin', 0)=>delete();
});

Route::get('/softdelete', function(){
    $post = Post::find(1);
    $post->delete();
});

Route::get('/readsoftdelete', function(){
    //$post = Post::find(7);
    //return $post;
    //$post = Post::withTrashed()->where('id', 8)->get();
    //return $post;
    $post = Post::onlyTrashed()->where('id', 7)->get();
    return $post;
});

Route::get('/restore', function(){
    $post = Post::withTrashed()->where('id', 1)->restore();
    return $post;
});

Route::get('/forcedelete', function(){
    $post = Post::withTrashed()->where('id', 8)->forceDelete();

});


// Eloquent relationships
// Get post bid user_id

// ONE TO ONE RELATIONSHIP
Route::get('/user/{id}/post', function($id){
    return User::find($id)->post;
});