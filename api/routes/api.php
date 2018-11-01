<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('user','UserController');
Route::resource('article','NewsController');
Route::resource('role','RoleController');
Route::get(('userarticle'),function(){
    return DB::table('articles')
        ->join ('users','articles.user_id','=','user_id')
        ->select ('articles.id','articles.title','users.name')
        ->get();
});
Route::get(('userrole'),function(){
    return DB::table('users')
        ->join ('roles','roles.id','=','users.id')
        ->select ('roles.id','roles.role','users.name')
        ->get();
});
Route::resource ('post','PostController');