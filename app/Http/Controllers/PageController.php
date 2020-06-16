<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function contactEmail(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'name' => 'required',
            'message' => 'required',
        ]);

        Mail::to('michaelthomas372@gmail.com')->send(new ContactFormMail(
            $data['email'],
            $data['name'],
            $data['message']
        ));

        $request->session()->flash('sent_email');

        return view('pages.contact');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }
}
