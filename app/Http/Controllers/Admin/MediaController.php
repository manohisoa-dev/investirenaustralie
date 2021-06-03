<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Jleon\LaravelPnotify\Notify;
use itskodinger\midia;
use App\Models\Image;
use Session;

class MediaController extends Controller {
    protected $directory;
    protected $directory_name;
    protected $url_prefix;
    protected $thumbs, $default_thumb;
    protected $imageTypes;

    public function __construct() {
        if (request()->has('directory_name')) {
            $directoryName = request()->get('directory_name', null);
        }

        if (isset($directoryName)) {
            $currentDirectory = config('midia.directories.' . $directoryName, null);

            if ($currentDirectory == null) {
                $this->directory = $directoryName;
            } else {
                $this->directory = $currentDirectory['path'];
                $this->directory_name = $currentDirectory['name'];
            }
        } else {
            $this->directory = config('midia.directory');
            $this->directory_name = config('midia.directory_name');
        }

        if ($this->url_prefix == $this->directory_name) {
            $this->url_prefix = '';
        }

        $this->url_prefix .= '/';

        // thumbnail
        $this->thumbs = [100];
        if (!in_array(250, $this->thumbs))
            $this->thumbs[count($this->thumbs)] = 250;

        $this->default_thumb = 'thumbs-250';

        $this->imageTypes = ['image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png',
            'image/x-png', 'image/gif', 'image/webp', 'image/x-webp', 'image/x-icon',
            'application/pdf'];
    }

    public function show() {
        $path = public_path();
        $folder = $this->folder_list($path);
        return view("admin.media.index", ['folder' => $folder, 'path' => $path]);
    }

    public function index() {
        $base_path = public_path();
        if (isset($_GET['directory_name'])) {
            if ($_GET['directory_name'] == '') {
                $directory = '';
            } else {
                $directory = $_GET['directory_name'];
            }
        } else {
            $directory = '';
        }

        $path = $base_path . '/' . $directory;
        $content = '';
        $menu = preg_split('#/#', $directory);
        $content .= '<div style="margin-bottom: 10px">';
        $content .= '<ol class="breadcrumb" style="background-color: #f3f3f4;margin-bottom: 10px;">';
        $content .= '<li class="breadcrumb-item">';
        $content .= '<a href="javascript:void(0)" onclick="read_folder(this)" data-href="">Public</a>';
        $content .= '</li>';
        if (!empty($menu)) {
            for ($m = 0; $m < count($menu); $m++) {
                $content .= '<li class="breadcrumb-item">';
                $content .= '<a href="javascript:void(0)" onclick="read_folder(this)" data-href="' .
                    $menu[$m] . '">' . $menu[$m] . '</a>';
                $content .= '</li>';
            }
        }
        $content .= '</ol>';
        $content .= '<input type="hidden" name="path_directory" id="path_directory" value="' .
            $directory . '" />';
        $content .= '<a class="btn btn-primary" onclick="show_upload()">Upload Files</a>';
        $content .= '<a class="btn btn-default" data-href="' . ltrim($directory, '/') .
            '" onclick="read_folder(this)"><i class="fa fa-refresh"></i></a>';
        $content .= '<div style="clear:both"></div></div>';

        $dirs = array();
        $dir = dir($path);
        while (false !== ($folder = $dir->read())) {
            if ($folder != '.' && $folder != '..') {
                if (is_dir($path . '/' . $folder)) {
                    if ($folder != 'css' && $folder != 'js' && $folder != 'xml' && $folder !=
                        'style' && $folder != 'plugin') {
                        $dirs[] = $folder;
                    }
                }
            }
        }
        if (!empty($dirs)) {
            foreach ($dirs as $key => $value) {
                $new_directory = $directory . '/' . $value;
                $content .= '<div class="file-box">';
                $content .= '<div class="file">';
                $content .= '<a href="javascript:void(0)" onclick="read_folder(this)" data-href="' .
                    $new_directory . '">';
                $content .= '<span class="corner"></span>';
                $content .= '<div class="icon">';
                $content .= '<i class="fa fa-folder"></i>';
                $content .= '</div>';
                $content .= '<div class="file-name">';
                $content .= $value . '<br/>';
                $content .= '<small>' . midia_time_elapsed(filemtime($path . '/' . $value)) .
                    '</small>';
                $content .= '</div>';
                $content .= '</a>';
                $content .= '</div>';
                $content .= '</div>';
            }
        }
        $fichier = $this->file_list($path);
        if (!empty($fichier)) {
            foreach ($fichier as $file) {
                $id_base = Image::where('filename', $file['fullname'])->first();
                if (!empty($id_base)) {
                    $id_file = $id_base->id;
                } else {
                    $id_file = 0;
                }
                $content .= '<div class="file-box">';
                $content .= '<div class="file">';
                $content .= '<a href="#" data-href="' . $path . '/' . $file['fullname'] . '">';
                $content .= '<span class="corner"></span>';
                if ($file['extension'] == 'png' || $file['extension'] == 'jpg' || $file['extension'] ==
                    'gif') {
                    $content .= '<div class="image">';
                    $content .= '<img alt="image" class="img-fluid" src="' . $file['thumbnail'] .
                        '">';
                    $content .= '</div>';
                } else {
                    $content .= '<div class="icon">';
                    $content .= '<i class="fa ' . $this->set_icon_file($file['extension']) .
                        '"></i>';
                    $content .= '</div>';
                }
                $content .= '<div class="file-name">';
                $content .= str_limit($file['fullname'], 10) . '<br/>';
                $content .= '<small>' . $file['size'] . '</small>';
                //suppression
                $content .= '<a class="btn btn-default btn-circle pull-right" href="javascript:void(0)" data-info="' .
                    $directory . '" data-name="' . $file['fullname'] . '" data-base="' . $id_file .
                    '" onclick="delete_file(this)">';
                $content .= '<i class="fa fa-times text-danger"></i></a>';

                //modification
                $content .= '<a class="btn btn-default btn-circle pull-right" style="margin-right:5px" href="javascript:void(0)" data-info="' .
                    $directory . '" data-name="' . $file['fullname'] . '" data-base="' . $id_file .
                    '" onclick="edit_file(this)" data-mime="' . $file['extension'] . '">';
                $content .= '<i class="fa fa-pencil"></i></a>';

                $content .= '</div>';
                $content .= '</a>';
                $content .= '</div>';
                $content .= '</div>';
            }
        }
        echo $content;
    }

    public function file_list($dir) {
        $exec = scandir($dir);
        $exec = array_splice($exec, 2);

        $files = [];
        foreach ($exec as $file) {
            $files[$file] = filemtime($dir . '/' . $file);
        }

        arsort($files);
        $files = array_keys($files);
        $exec = $files;

        $thumbs = $this->thumbs;
        foreach ($thumbs as $i => $t) {
            $thumbs[$i] = 'thumbs-' . $t;
        }

        $_files = [];
        foreach ($exec as $i => $item) {
            if (!is_dir($dir . '/' . $item)) {
                if (in_array(mime_content_type($dir . '/' . $item), $this->imageTypes)) {
                    $path = $this->getRelativePath($dir);
                    $path = str_replace('public', "", $path);
                    $_files[$i]['fullname'] = $item;
                    $_files[$i]['name'] = pathinfo($item, PATHINFO_FILENAME);
                    $_files[$i]['url'] = $this->url($dir . '/' . $item);
                    $_files[$i]['thumbnail'] = $path . '/' . $item;
                    $_files[$i]['extension'] = strtolower(pathinfo($item, PATHINFO_EXTENSION));
                    $_files[$i]['size'] = $this->toMb(filesize($dir . '/' . $item));
                    $_files[$i]['filetime'] = midia_time_elapsed(filemtime($dir . '/' . $item));
                }
            }
        }
        return ($_files);
    }

    function getRelativePath($path, $from = __file__) {
        $path = explode(DIRECTORY_SEPARATOR, $path);
        $from = explode(DIRECTORY_SEPARATOR, dirname($from . '.'));
        $common = array_intersect_assoc($path, $from);

        $base = array('.');
        if ($pre_fill = count(array_diff_assoc($from, $common))) {
            $base = array_fill(0, $pre_fill, '..');
        }
        $path = array_merge($base, array_diff_assoc($path, $common));
        return implode(DIRECTORY_SEPARATOR, $path);
    }

    public function url($path = '') {
        return url($this->url_prefix . $path);
    }

    public function folder_list($path) {
        $dirs = array();
        $dir = dir($path);
        while (false !== ($folder = $dir->read())) {
            if ($folder != '.' && $folder != '..') {
                if (is_dir($path . '/' . $folder)) {
                    if ($folder != 'css' && $folder != 'js' && $folder != 'xml' && $folder !=
                        'style' && $folder != 'plugin') {
                        $dirs[] = $folder;
                    }
                }
            }
        }
        return $dirs;
    }

    public function toMb($bytes) {
        for ($i = 0; $bytes >= 1024 && $i < 5; $i++)
            $bytes /= 1024;

        return round($bytes, 2) . [' B', ' KB', ' MB', ' GB', ' TB', ' PB'][$i];
    }

    function set_icon_file($mime_type) {

        $type_image = array(
            'jpg',
            'gif',
            'png',
            'jpeg');
        $type_pdf = array('pdf');

        if (in_array($mime_type, $type_image)) {
            return 'fa-file-image-o';
        } elseif (in_array($mime_type, $type_pdf)) {
            return 'fa-file-pdf-o';
        } else {
            return "fa-file-o";
        }
    }

    public function ajaxFile(Request $request) {
        //echo(public_path().$request->dir_name).'<br>';
        //dd($request->All());
        $image = $request->file('file');
        if ($request->dir_name) {
            $dir = $request->dir_name;
            $path = public_path() . '/' . $dir;
        } else {
            $dir = '';
            $path = public_path();
        }
        $imageName = time() . $image->getClientOriginalName();
        $upload_success = $image->move($path, $imageName);
        if ($upload_success) {
            return response()->json(['success' => $dir]);
        }
        // Else, return error 400
        else {
            return response()->json('error', 400);
        }
    }

    public function ajaxDeleteFile(Request $request) {
        if (empty($request->folder)) {
            $link_file = public_path() . '/' . $request->file_name;
            $dir = '';
        } else {
            $link_file = public_path() . '/' . $request->folder . '/' . $request->file_name;
            $dir = $request->folder;
        }

        if ($request->id_file_base != 0) {
            Image::where('id', $request->id_file_base)->delete();
        }

        $delete_file = unlink($link_file);
        if ($delete_file) {
            return response()->json(['success' => $dir]);
        } else {
            return response()->json('error', 400);
        }
    }

    public function ajaxGetFile(Request $request) {
        $base_path = public_path();
        $path_file = $request->folder . '/' . $request->file_name;
        $file = $base_path . '/' . $path_file;
        $info = pathinfo($file);

        $dir = $base_path . '/' . $request->folder;
        $path = $this->getRelativePath($dir);
        $path = str_replace('public', "", $path);

        $content = '';
        $content .= '<div class="col-lg-6">';
        $content .= '<div class="file-box">';
        $content .= '<div class="file">';
        $content .= '<a>';
        $content .= '<span class="corner"></span>';
        if ($info['extension'] == 'png' || $info['extension'] == 'jpg' || $info['extension'] ==
            'gif') {
            $content .= '<div class="image">';
            $content .= '<img alt="image" class="img-fluid" src="' . $path . '/' . $request->file_name .
                '">';
            $content .= '</div>';
        } else {
            $content .= '<div class="icon">';
            $content .= '<i class="fa ' . $this->set_icon_file($info['extension']) .
                '"></i>';
            $content .= '</div>';
        }

        $content .= '<div class="file-name">';
        $content .= $info['filename'];
        $content .= '<br>';
        $content .= '<small>' . midia_time_elapsed(filemtime($file)) . '</small>';
        $content .= '</div>';
        $content .= '</a>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="col-lg-6">';
        $content .= '<p><b>Date : </b><small>' . date("F d Y H:i:s.", filemtime($file)) .
            '</small></p>';
        $content .= '<p><b>Size : </b><small>' . $this->toMb(filesize($file)) .
            '</small></p>';
        $content .= '<p style="overflow-wrap: break-word"><b>Url : </b><small>' . asset($path_file) .
            '</small></p>';
        $content .= '</div>';

        $content .= '<input type="hidden" name="dir_name_file_edit" id="dir_name_file_edit" value="' .
            $request->folder . '" />';
        $content .= '<input type="hidden" name="name_file_edit" id="name_file_edit" value="' .
            $request->file_name . '" />';

        echo $content;
    }

    public function ajaxSaveFileEdit(Request $request) {
        $image = $request->file('new_file');
        $name_file = $request->name_file_edit;
        $dir_file = $request->dir_name_file_edit;

        if ($dir_file) {
            $dir = $dir_file;
            $path = public_path() . '/' . $dir;
            $link_file = public_path() . '/' . $dir_file . '/' . $name_file;
        } else {
            $dir = '';
            $path = public_path();
            $link_file = public_path() . '/' . $dir_file . '/' . $name_file;
        }
        
        Session::flash('dirFile', $dir); 
        if ($request->file('new_file')) {
            $delete = unlink($link_file);
            if ($delete) {
                $upload_success = $image->move($path, $name_file);
                if ($upload_success) {
                    return response()->json(['success' => ltrim($dir_file, '/')]);
                }
                // Else, return error 400
                else {
                    return response()->json('error', 400);
                }
            }else{
                return response()->json('error', 400);
            }
        } else {
            return response()->json(['success' => $dir_file]);
        }
    }
    
    public function ajaxReadFile()
    {
        if (isset($_GET['directory_name'])) {
            if ($_GET['directory_name'] == '') {
                $directory = '';
            } else {
                $directory = $_GET['directory_name'];
            }
        } else {
            $directory = '';
        }
        
        Session::flash('dirFile', ltrim($directory, '/')); 
        return response()->json(['success' => '']);
    }
}
