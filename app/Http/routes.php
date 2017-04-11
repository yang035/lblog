<?php

/*
 * |--------------------------------------------------------------------------
 * | Application Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register all of the routes for an application.
 * | It's a breeze. Simply tell Laravel the URIs it should respond to
 * | and give it the controller to call when that URI is requested.
 * |
 */

Route::get('/', function () {
    return redirect('/blog');
});
Route::get('blog','BlogController@index');
Route::get('blog/{slug}','BlogController@showPost');
//邮件路由
Route::get('contact', 'ContactController@showForm');
Route::post('contact', 'ContactController@sendContactInfo');
//rss路由
Route::get('rss','BlogController@rss');
//站点地图
Route::get('sitemap.xml','BlogController@siteMap');

//admin area
Route::get('admin',function (){
    return redirect('admin/post');
});

Route::group(['namespace'=>'Admin','middleware'=>'auth'],function (){
    resource('admin/post', 'PostController', ['except' => 'show']);
    resource('admin/tag', 'TagController');
    resource('admin/message', 'MessageController');
    get('admin/upload','UploadController@index');
    
    post('admin/upload/file', 'UploadController@uploadFile');
    delete('admin/upload/file', 'UploadController@deleteFile');
    post('admin/upload/folder', 'UploadController@createFolder');
    delete('admin/upload/folder', 'UploadController@deleteFolder');
});

//logging in and out
Route::get('/auth/login','Auth\AuthController@getLogin');
Route::post('/auth/login','Auth\AuthController@postLogin');
Route::get('/auth/logout','Auth\AuthController@getLogout');

Route::resource('post','PostController');
Route::resource('post','TestController');
Route::controller('request','RequestController');
Route::get('testViewHello',function (){
    return view('hello');
});
    Route::get('testViewHome',function (){
        return view('home');
    });
Route::get('/age/refuse',['as'=>'refuse',function(){
    return "18岁以上男子才能访问！";
}]);
//用于监控打印执行的sql
Event::listen('illuminate.query',function($query){
//    var_dump($query);
});

