<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactFormController extends Controller
{

    public function form()
    {
        return view('contactform');
    }

    public function contactRequest(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        // send email
        return "Email has been sent. We will reply you soon.";
    }
}