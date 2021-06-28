<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TranslationRequest;
use App;
use Lang;

class TranslationController extends Controller
{

    private $lang = '';
    private $file = 'app';
    private $key;
    private $value;
    private $path;
    private $arrayLang = array();
    private $data;


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

    private function read1() 
    {   
        if ($this->lang == '') $this->lang = App::getLocale();
        if ($this->file == '') $this->file = 'app';

        $this->path = base_path().'/resources/lang/'.$this->lang.'/'.$this->file.'.php';
        $this->arrayLang = Lang::get($this->file);
        if (gettype($this->arrayLang) == 'string') $this->arrayLang = array();

        $this->data = [];
        foreach ($this->arrayLang as $key=>$lang) {
            $this->data[] = ['key'=>$key,'content'=>$lang];
        }
        
        return $this->data; 
    }

    private function read($lang,$file) 
    {   
        if ($lang == '') $lang = App::getLocale();
        if ($file !== 'app') $file = $file;

        $this->path = base_path().'/resources/lang/'.$lang.'/'.$file.'.php';
        App::setLocale($lang);
        $this->arrayLang = Lang::get($file);
        if (gettype($this->arrayLang) == 'string') $this->arrayLang = array();

        $this->data = [];
        $i=0;
        foreach ($this->arrayLang as $key=>$lang) {
            $this->data[] = ['id'=>$i++,'key'=>$key,'content'=>$lang];
        }
        
        return $this->data; 
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

        $langFiles = ['app','apl','afa','auth','mail','member','pagination','passwords','seller','validation'];

        return view('admin.config.translation')->with('langFiles', $langFiles);
    }
    

    public function getTranslation(Request $request)
    {
        if($request->get('select_lang')){
            $this->lang = strtolower($request->get('select_lang'));
        }

        if($request->get('select_file_name')){
            $this->file = strtolower($request->get('select_file_name'));
        }

        $data = $this->read($this->lang,$this->file);

        return response()->json(['data'=>$data]);
    }

    public function saveTranslation(Request $request){
        $lang = $request->get('lang');
        $file = strtolower($request->get('file'));
        $key = $request->get('key');
        $value = str_replace("'","&rsquo;",$request->get('new_content'));

        if(is_array($lang)){
            $value_fr = $request->get('new_content_fr');
            $value_en = $request->get('new_content_en');

            foreach ($lang as $lg) {
                // Read file
                $this->path = base_path().'/resources/lang/'.$lg.'/'.$file.'.php';
                App::setLocale($lg);
                $this->arrayLang = Lang::get($file);
                if (gettype($this->arrayLang) == 'string') $this->arrayLang = array();

                $this->arrayLang[$key] = $lg=='fr'?$value_fr:$value_en;

                // save change
                $content = "<?php\n\nreturn\n[\n";

                foreach ($this->arrayLang as $key => $value) 
                {
                    $content .= "\t'".$key."' => '".$value."',\n";
                }

                $content .= "];";

                file_put_contents($this->path, $content);
            }
        }else{
            // Read file
            $lang = strtolower($lang);
            $this->path = base_path().'/resources/lang/'.$lang.'/'.$file.'.php';
            App::setLocale($lang);
            $this->arrayLang = Lang::get($file);
            if (gettype($this->arrayLang) == 'string') $this->arrayLang = array();

            $this->arrayLang[$key] = $value;

            // save change
            $content = "<?php\n\nreturn\n[\n";

            foreach ($this->arrayLang as $key => $value) 
            {
                $content .= "\t'".$key."' => '".$value."',\n";
            }

            $content .= "];";

            file_put_contents($this->path, $content);
        }

        return response()->json(['success'=>'success']);
        
    }
}