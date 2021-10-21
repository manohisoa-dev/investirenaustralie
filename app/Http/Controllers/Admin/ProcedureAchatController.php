<?php

namespace App\Http\Controllers\Admin;

use App\Models\DossierTransaction;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Models\Image;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class ProcedureAchatController extends Controller {
    public $viewDir = "admin.prodecureAchat";

    public function index() {
        
    }
    
    public function liste(Request $request)
    {
        $items = DossierTransaction::paginate(25);
        return view("admin.prodecureAchat.liste", ['items' => $items]); 
    }
}
