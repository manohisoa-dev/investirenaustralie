<?php

namespace App\Http\Controllers;

use App\Models\Badword;
use App\Models\Pub;
use App\Models\User;
use App\Models\Product;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use JCrowe\BadWordFilter\BadWordFilter;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContactFormController extends Controller
{

    public function form(Request $request)
    {
        // $this->setCookie($request);
        // \Cookie::forget('name');
        \Cookie::queue('namexxx', 'value', '');

        \Cookie::queue(\Cookie::forget('namexxx'));
        $value = \Cookie::get('namexxx');    


        # REDIMENTIONNEMENT MINIATURE
//        Product::regenerateAllAvatar() ;
//        Blog::regenerateAllAvatar() ;


        # MIGRATION EN CAS DE PHPMYADMIN ERREUR
//        Schema::create('search_mandates', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('state_id');
//            $table->string('search_mandate_name');
//            $table->integer('image_id');
//            $table->timestamps();
//            $table->softDeletes();
//        });

        $searchMandates = DB::table('search_mandates')->get();
        dd($searchMandates) ;

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