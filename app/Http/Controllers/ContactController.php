<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //
    public function showForm(){
        return view('blog.contact');
    }

    public function sendContactInfo(Requests\ContactMeRequest $request){
        $data = $request->only('name','email','phone');
        $data['messageLines'] = explode("\n",$request->get('message'));
        //queue添加到队列后再发送,send是直接发送
        Mail::queue('emails.contact',$data,function ($message) use ($data){
//            Mail::send('emails.contact',$data,function ($message) use ($data){
                $message->subject('Blog Contact From '.$data['name'])
                    ->to(config('blog.contact_email'))
                    ->replyTo($data['email']);
            });
        return back()->withSuccess("Think you for your message.It has been sent.");
    }
}
