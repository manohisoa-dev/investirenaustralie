<?php

namespace App\Http\Controllers\admin;

use App\Models\Slider;
use App\Models\Image;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class SliderController extends Controller {
    public $viewDir = "admin.slider";

    public function index() {
        $records = Slider::findRequested();
        return $this->view("index", ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create() {
        return $this->view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if ($request->type == 'pub') {
            $this->validate($request, Slider::validationRules());
            Slider::create($request->all());
        } else {
            $slider = new Slider();
            if ($file = $request->file('image')) {
                $image = Image::storeAndSave($file, 'slider');
                $slider->image_id = $image->id;
            }

            if ($fileVideo = $request->file('video')) {
                $video = Image::storeAndSave($fileVideo, 'slider');
                $slider->image_id = $video->id;
            }

            $slider->type = $request->type;
            $slider->status = $request->status;
            $slider->content = $request->content;
            $slider->save();
        }


        # notification
        Notify::success('Slider a été créer avec succès');
        return redirect(route('admin.slider.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Slider $slider) {
        return $this->view("show", ['slider' => $slider]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Slider $slider) {
        return $this->view("edit", ['slider' => $slider]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider) {
        if ($request->type == 'pub') {
            $slider->content = $request->content;
            $slider->type = $request->type;
            $slider->status = $request->status;
            $slider->image_id = $request->image_id;
            $slider->update();
        } else {
            if ($file = $request->file('image')) {
                $image = Image::storeAndSave($file, 'slider');
                $slider->image_id = $image->id;
            }
            $slider->content = $request->content1;
            $slider->type = $request->type;
            $slider->status = $request->status;
            $slider->update();
        }

        /*if ($request->isXmlHttpRequest()) {
            $data = [$request->name => $request->value];
            $validator = \Validator::make($data, Slider::validationRules($request->name));
            if ($validator->fails())
                return response($validator->errors()->first($request->name), 403);
            $slider->update($data);
            return "Record updated";
        }

        $this->validate($request, Slider::validationRules());
        $slider->update($request->all());*/

        # notification
        Notify::success('Slider a été mise à jour avec succès');
        return redirect(route('admin.slider.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Slider $slider) {
        $slider->delete();

        # notification
        Notify::success('Slider a été supprimer avec succès');
        return redirect(route('admin.slider.index'));
    }

    /**
     * Disable User
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function desactiver(Request $request, Slider $slider) {
        $slider->status = 0;
        $slider->save();

        Notify::success("Le slider a été desactivé avec succés");
        return redirect(route('admin.slider.index'));
    }

    public function activer(Request $request, Slider $slider) {
        $slider->status = 1;
        $slider->save();

        // désactivation des autres types de slider
        Slider::where('type', '!=' ,$slider->type)
            ->update(['status' => 0]);

        Notify::success("Le slider a été activé avec succés");
        return redirect(route('admin.slider.index'));
    }

    protected function view($view, $data = []) {
        return view($this->viewDir . "." . $view, $data);
    }

}
