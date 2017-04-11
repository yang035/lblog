<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use tests\thinkphp\library\think\cache\driver\redisTest;

class MessageController extends Controller
{
    protected $fields=[
        'title'=>'',
        'content'=>'',
        'status'=>'',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.message.index')->withMessages(Message::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data=[];
        foreach ($this->fields as $field => $default) {
            $data[$field]=old($field,$default);
        }
        return view('admin.message.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\MessageCreateRequest $request)
    {
        //
        $message = new Message();
        foreach (array_keys($this->fields) as $field){
            $message->$field = $request->get($field);
        }
        $message->save();
        return redirect('admin/message')->withSuccess("The message '$message->title' was create.");

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
        $message = Message::findOrFail($id);
        $data = ['id'=>$id];
        foreach (array_keys($this->fields) as $field){
            $data[$field] = old($field,$message->$field);
        }
        return view('admin.message.edit',$data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\MessageUpdateRequest $request, $id)
    {
        //
        $message = Message::findOrFail($id);
        foreach (array_keys($this->fields) as $field){
            $message->$field = $request->get($field);
        }
        $message->save();
        return redirect("admin/message/$id/edit")->withSuccess('Update success.');
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
        $message = Message::findOrFail($id);
        $message->delete();
        return redirect('admin/message')->withSuccess("This message '$message->title'delete success.");
    }
}
