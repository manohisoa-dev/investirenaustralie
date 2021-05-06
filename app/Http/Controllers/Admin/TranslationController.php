<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use Lang;

class TranslationController extends Controller
{

    private $lang = '';
    private $file;
    private $key;
    private $value;
    private $path;
    private $arrayLang = array();


    //------------------------------------------------------------------------------
    // Add or modify lang files content
    //------------------------------------------------------------------------------

    private function changeLangFileContent($lang, $file, $key, $value) 
    {
        $this->read();
        $this->arrayLang[$this->key] = $this->value;
        $this->save();
    }


    //------------------------------------------------------------------------------
    // Read lang file content
    //------------------------------------------------------------------------------

    private function read() 
    {
        if ($this->lang == '') $this->lang = App::getLocale();
        $this->path = base_path().'/resources/lang/'.$this->lang.'/'.$this->file.'.php';
        $this->arrayLang = Lang::get($this->file);
        if (gettype($this->arrayLang) == 'string') $this->arrayLang = array();
    }

    //------------------------------------------------------------------------------
    // Save lang file content
    //------------------------------------------------------------------------------

    private function save() 
    {
        $content = "<?php\n\nreturn\n[\n";

        foreach ($this->arrayLang as $this->key => $this->value) 
        {
            $content .= "\t'".$this->key."' => '".$this->value."',\n";
        }

        $content .= "];";

        file_put_contents($this->path, $content);
    }


    public function translation(Request $request){

        return view('admin.config.translation');
    }
}
