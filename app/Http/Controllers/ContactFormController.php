<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class ContactFormController extends Controller
{
    public function create()
    {
        return View::make('Contact.create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'website' => ['nullable','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'message' => 'required|string'
        ]);
        // send an email
        Mail::to('test@test.com')->send(new ContactFormMail($data));

        return redirect(route('Contact.create'));

    }
}
