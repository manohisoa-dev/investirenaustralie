<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Parameter;
use View;
use Redirect;
use Jleon\LaravelPnotify\Notify;

class ParameterController extends Controller
{
    public function show(){

        $params = Parameter::all();

        return view('admin.config.parameter', compact(['params']));
    }

    public function update(Request $request){   
        $count = Parameter::count();
        $params = Parameter::all();

        foreach ($params as $value) {
            $name = $value->name;
            Parameter::where('id','=',$request->param_.$value->id )->update(['value'=>$request->$name]);
        }

        # notification
        Notify::success('Paramètre a été mise à jour avec succès');
        return back();
    }
}
