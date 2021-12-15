<?php

namespace App\Http\Controllers\admin;

use App\Models\Video;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class VideoController extends Controller {
    public $viewDir = "admin.video";

    public function index() {
        $records = Video::findRequested();
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
        if ($request->type_source == 1) {
            $validator = \Validator::make($request->all(), ['file' => 'max:200000', ]);
            if ($validator->fails()) {
                return redirect()->back()->withInput($request->all())->withErrors($validator,
                    'error');
            }

            $slug = generateSlug($request->video_titre);
            $video_file = $request->file('video_path');

            $fileInfo = $video_file->getClientOriginalName();
            $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
            $name = $slug . '.' . time() . '.' . $extension;

            $video_file->move(public_path('uploads/videos'), $name);

            $video = new Video;
            $video->video_titre = $request->video_titre;
            $video->type_source = $request->type_source;
            $video->video_path = $name;
            $video->save();
        } else {
            $video = new Video;
            $video->video_titre = $request->video_titre;
            $video->type_source = $request->type_source;
            $video->video_url = $request->video_url;
            $video->save();
        }

        # notification
        Notify::success('Video a été créer avec succès');
        return redirect(route('admin.video.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Video $video) {
        return $this->view("show", ['video' => $video]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Video $video) {
        return $this->view("edit", ['video' => $video]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video) {
        if ($request->type_source == 0) {
            $video = Video::where('id', $video->id)->update(['video_titre' => $request->video_titre,
                'type_source' => $request->type_source, 'video_url' => $request->video_url]);
        } else {
            
            $validator = \Validator::make($request->all(), ['file' => 'max:200000', ]);
            if ($validator->fails()) {
                return redirect()->back()->withInput($request->all())->withErrors($validator,
                    'error');
            }
            $slug = generateSlug($request->video_titre);
            $video_file = $request->file('video_path');

            $fileInfo = $video_file->getClientOriginalName();
            $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
            $name = $slug . '.' . time() . '.' . $extension;

            $video_file->move(public_path('uploads/videos'), $name);
            $video = Video::where('id', $video->id)->update(['video_titre' => $request->video_titre,
                'type_source' => $request->type_source, 'video_path' => $name]);
        }
        /*if ($request->isXmlHttpRequest()) {
        $data = [$request->name => $request->value];
        $validator = \Validator::make($data, Video::validationRules($request->name));
        if ($validator->fails())
        return response($validator->errors()->first($request->name), 403);
        $video->update($data);
        return "Record updated";
        }

        $this->validate($request, Video::validationRules());

        $video->update($request->all());*/

        # notification
        Notify::success('Video a été mise à jour avec succès');
        return redirect(route('admin.video.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Video $video) {
        $video->delete();

        # notification
        Notify::success('Video a été supprimer avec succès');
        return redirect(route('admin.video.index'));
    }

    protected function view($view, $data = []) {
        return view($this->viewDir . "." . $view, $data);
    }

}
