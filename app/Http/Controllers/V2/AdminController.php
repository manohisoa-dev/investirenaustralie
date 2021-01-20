<?php

namespace App\Http\Controllers\V2;

use Illuminate\Http\Request;

use Auth;
use Validator;

use App\Models\Product;
use App\Models\User;
use App\Models\Mail;
use App\Models\MailUser;

use App\Notifications\NewMail;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Show the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('V2.admin.dashboard.index');
    }

}
