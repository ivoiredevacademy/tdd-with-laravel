<?php

namespace App\Http\Controllers;


use App\Mail\Message;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessagesController extends Controller
{
    public function create()
    {
        $contacts = auth()->user()->contacts()->get(['id', 'name']);

        return view('messages.form', compact('contacts'));
    }

    public function send(Request $request)
    {

        $contactEmails = Contact::whereIn('id', $request->contacts)
            ->whereUserId(auth()->id())
            ->pluck('email')->toArray();

        foreach ($contactEmails as $email) {
            Mail::to($email)->send(new Message($request->title, $request->message));
        }

        return redirect('/dashboard')->with('success', 'Le message a bien été envoyé');
    }

}
