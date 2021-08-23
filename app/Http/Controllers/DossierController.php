<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RelationMembreApl;
use App\Models\Product;
use App\Models\ConjunctionAgreement;
use App\Models\MandatRecherche;
use App\Models\Message;
use App\Notifications\AfaMandatRechercheMessage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
use Validator;
use Auth;
use App;


class DossierController extends Controller
{
    /**
     * Liste des dossiers
     *
     * @return \Illuminate\Http\Response
     */
    public function showMemberDossier() {
        $aplActive = User::find(Auth::user()->id);
        $allApl = RelationMembreApl::where('membre_id', Auth::user()->id)->get();
        return view('backend.dossier.member')->with('title', __('member.menu_relation_apl'))->with('aplActive',
            $aplActive)->with('allApl', $allApl);
    }

    /**
     * Liste des dossiers afa
     *
     * @return \Illuminate\Http\Response
     */
    public function showAfaDossier() {
        $records = ConjunctionAgreement::getAllFolders();

        return view('backend.dossier.afa')->with('records',$records);
    }

    /*
    * Store ca for afa in storage file
    *
    * @param  Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function uploadAfaDossierCa(Request $request)
    {    
        $datas = $request->all();
        $validator = Validator::make($datas, ['file_ca' => 'required|mimes:pdf']);

        // Validate file
        if ($validator->fails()) {
            return response()->json(['response'=>'false']);
        }

        // Handle file Upload
        $file = $request->file('file_ca');
        $path = public_path('uploads/pdf/ca');
        $this->storeFile($file,$path);

        
        return response()->json(['response'=>'true']);
    }
    
    /*
    * Store mr for afa in storage file
    *
    * @param  Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function uploadMemberDossierMr(Request $request)
    {    
        $datas = $request->all();
        $validator = Validator::make($datas, ['file_mr' => 'required|mimes:pdf']);

        // Validate file
        if ($validator->fails()) {
            return response()->json(['response'=>'false']);
        }

        // Handle file Upload to uploads/pdf/transaction path
        $file = $request->file('file_mr');
        $path = public_path('uploads/pdf/transaction');
        $this->storeFile($file,$path);

        // Send message and email to afa from IEA
        App::setLocale('en'); //change lang to en
        $user=Auth::user();
        $dt = Carbon::now();
        $dtDate = $dt->format('m-d-Y');
        $dtTime = $dt->format('H:i:m');
        $user_name= $user->isPerson()?$user->name:$user->userinfos()->first()->orga_name;
        $mr_id=$request->mr_id;
        $mandatesearch= url(MandatRecherche::whereId($mr_id)->first()->path);
        $city=$user->afa->location->locality;
        $content=trans('member.gothere.mr.message_to_afa', ['date'=>$dtDate,'hour'=>$dtTime,'name'=>$user_name,'immat'=>$user->immat,'city'=>$city,'afa' =>$user->afa->name,'mandatesearch'=>$mandatesearch]);
        // send message
        Message::create(['type'=>'admin','from_id'=>1,'to_id'=>$user->afa->id,'body'=>$content]);
        // send email
        // $user->afa->notify(new AfaMandatRechercheMessage($user,$mandatesearch));
        
        return response()->json(['response'=>'true']);
    }

    private function storeFile($file,$path){
        // Get filename with the extension
        $filenameWithExt = $file->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $file->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename.'.'.$extension;
        // Upload Image
        $path = $file->move($path, $fileNameToStore);

        return false;
    }

    public function updateCa(Request $request){
        ConjunctionAgreement::where('id', $request->id)->update(['status' => 1]);

        return response()->json(['success' => 'true']);
    }

    public function updateMr(Request $request){
        MandatRecherche::where('id', $request->id)->update(['status' => 1]);

        return response()->json(['success' => 'true']);
    }

}
