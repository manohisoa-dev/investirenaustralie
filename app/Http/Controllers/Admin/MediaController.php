<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Jleon\LaravelPnotify\Notify;
use itskodinger\midia;

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
        if ($_GET['directory_name'] == '') {
            $directory = '';
        } else {
            $directory = $_GET['directory_name'];
        }

        $path = $base_path . '/' . $directory;
        $content = '';
        $dirs = array();
        $dir = dir($path);
        while (false !== ($folder = $dir->read())) {
            if ($folder != '.' && $folder != '..') {
                if (is_dir($path . '/' . $folder)) {
                    if ($folder != 'css' && $folder != 'js' && $folder != 'xml' && $folder !=
                        'style') {
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
                $content .= '<a href="javascript:void(0)" onclick="read_folder(this)" data-href="' . $new_directory .
                    '">';
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
                $content .= '<div class="file-box">';
                $content .= '<div class="file">';
                $content .= '<a href="#">';
                $content .= '<span class="corner"></span>';
                $content .= '<div class="icon">';
                $content .= '<i class="fa '.$this->set_icon_file($file['extension']).'"></i>';
                $content .= '</div>';
                $content .= '<div class="file-name">';
                $content .= str_limit($file['fullname'],10) . '<br/>';
                $content .= '<small>' . $file['size'] . '</small>';
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
                    $_files[$i]['fullname'] = $item;
                    $_files[$i]['name'] = pathinfo($item, PATHINFO_FILENAME);
                    $_files[$i]['url'] = $this->url($dir . '/' . $item);
                    $_files[$i]['thumbnail'] = $this->url($dir . '/' . $this->default_thumb . '/' .
                        $item);
                    $_files[$i]['extension'] = strtolower(pathinfo($item, PATHINFO_EXTENSION));
                    $_files[$i]['size'] = $this->toMb(filesize($dir . '/' . $item));
                    $_files[$i]['filetime'] = midia_time_elapsed(filemtime($dir . '/' . $item));
                }
            }
        }
        return ($_files);
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
                        'style') {
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

        $type_image = array('jpg','gif','png','jpeg');
        $type_pdf = array('pdf');
        
        if (in_array($mime_type, $type_image)){
            return 'fa-file-image-o';
        }elseif(in_array($mime_type, $type_pdf)){
            return 'fa-file-pdf-o';
        }else{
            return "fa-file-o";
        }
    }
}
