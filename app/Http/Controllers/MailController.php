<?php

namespace App\Http\Controllers;

use App\Mail\ResumeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class MailController extends Controller
{

    public function edit($id)
    {
        $mail = \App\Models\Mail::where('id',$id)->first();
        return view('admin.settings.mails-edit',compact('mail'));
    }

    public function update(Request $request,$id)
    {

        $this->validate($request, [
            'mail' => 'required|email',
        ]);
        $mail = \App\Models\Mail::where('id',$id)->first();
        $mail->mail = $request->mail;
        $mail->save();
        return redirect()->route('settings.index');
    }
    public function sendEmail($file): \Illuminate\Http\RedirectResponse
    {
        $email = 'stfincos@gmail.com';

        $mailData = [
            'title' => 'Demo Email',
            'url' => 'https://www.positronx.io'
        ];
        Mail::to($email)->send(new ResumeMail($mailData,$file));
//        $data = array('name'=>"Virat Gandhi");
//        Mail::send('mail', $data, function($message) {
//            $message->to('abc@gmail.com', 'Tutorials Point')->subject
//            ('Laravel Testing Mail with Attachment');
//            $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
//            $message->from('xyz@gmail.com','Virat Gandhi');
//        });
//        echo "Email Sent with attachment. Check your inbox.";
        return redirect()->back();
    }
}
