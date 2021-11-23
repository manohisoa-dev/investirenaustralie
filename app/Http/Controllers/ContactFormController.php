<?php

namespace App\Http\Controllers;

use App\Models\Badword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JCrowe\BadWordFilter\BadWordFilter;

class ContactFormController extends Controller
{

    public function form(Request $request)
    {
        // $this->setCookie($request);
        // \Cookie::forget('name');
        \Cookie::queue('namexxx', 'value', '');

        \Cookie::queue(\Cookie::forget('namexxx'));
        $value = \Cookie::get('namexxx');        return view('contactform');
    }

    public function setCookie(Request $request){
        $minutes = 10080;
        $response = new Response('Set Cookie');
        $response->withCookie(cookie('name', 'MyValue', $minutes));
        return $response;
    }

    public function getCookie(Request $request){
        $value = $request->cookie('name');
        echo $value;
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