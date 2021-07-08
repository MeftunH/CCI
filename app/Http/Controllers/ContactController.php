<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    public function saveContact(Request $request): \Illuminate\Http\RedirectResponse
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'max:255',
            'message' => 'required'
        ]);

        $contact = new Contact;

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;

        $contact->save();
        Mail::send('emails.contact_email',
            array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'subject' => $request->get('subject'),
                'msg' => $request->get('message'),
            ), function ($message) use ($request) {
                $message->from($request->email);
                $message->to(\App\Models\Mail::where('type',0)->first()->mail)->subject
                (trans('mail.connect_request'));

            });
        if (Mail::failures()) {
            return back()->with('error', ':(');
        } else
        {
            return back()->with('success', ':)');

        }

    }
}
