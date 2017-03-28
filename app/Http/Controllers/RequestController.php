<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    
    public function getBasetest(Request $request){
        $input=$request->input('test');
        return $input;
    }
    
    public function getUrl(Request $request){
        if (!$request->is('request/*')) {
            abort(404);
        }
        $uri=$request->path();
        $url=$request->url();
        echo $uri;
        echo "</br>";
        echo $url;
    }
    
    public function getMethod(Request $request){
        //非get请求不能访问
        if (!$request->isMethod('get')) {
            abort(404);
        }
        $get=$request->method();
        return $get;
    }
    public function getFileupload()
    {
        $postUrl = '/request/fileupload';
        $csrf_field = csrf_field();
        $html = <<<CREATE
<form action="$postUrl" method="POST" enctype="multipart/form-data">
$csrf_field
<input type="file" name="file"><br/><br/>
<input type="submit" value="提交"/>
</form>
CREATE;
        return $html;
    }
    
    //文件上传处理
    public function postFileupload(Request $request){
        //判断请求中是否包含name=file的上传文件
        if(!$request->hasFile('file')){
            exit('上传文件为空！');
        }
        $file = $request->file('file');
        //判断文件上传过程中是否出错
        if(!$file->isValid()){
            exit('文件上传出错！');
        }
        $destPath = realpath(public_path('images'));
        if(!file_exists($destPath))
            mkdir($destPath,0755,true);
            $filename = $file->getClientOriginalName();
            if(!$file->move($destPath,$filename)){
                exit('保存文件失败！');
            }
            exit('文件上传成功！');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
