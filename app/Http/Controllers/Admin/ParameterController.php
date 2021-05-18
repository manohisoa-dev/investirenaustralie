<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Parameter;

class ParameterController extends Controller
{
    public function show(){

        $data = Parameter::all();

        return view('admin.config.parameter')->with('params',$data);
    }

    public function update(Request $request){   
        $count = Parameter::count();
        $params = Parameter::all();

        foreach ($params as $value) {
            $name = $value->name;
            Parameter::where('id','=',$request->param_.$value->id )->update(['value'=>$request->$name]);
        }

        return view('admin.config.parameter')->with('params',$params);
    }
}
