<?php

namespace App\Http\Controllers;

use App\Models\Badword;
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
        $value = \Cookie::get('namexxx');


        $wordsToRemove = Badword::pluck('content')->toArray() ;
        $wordsToRemove = array_flatten($wordsToRemove) ;
        $filterOptions = array(
            'strictness' => 'permissive',
            'also_check' => $wordsToRemove
        );

        $content = 'Lorem ipsum dolor sit amet, point com consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.  rakoto@gmail.com 
        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt site http://test.fr  mollit anim id est laborum.' ;

        $filter = new BadWordFilter($filterOptions);
        $cleanString = $filter->clean($content, "#!%^");

        echo $cleanString ;
        dd("");

        return view('contactform');
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