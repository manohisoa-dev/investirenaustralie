<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RelationMembreApl;
use App\Models\Product;
use App\Models\ConjunctionAgreement;
use Auth;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;


class DossierController extends Controller
{
    /**
     * Liste des dossiers
     *
     * @return \Illuminate\Http\Response
     */
    public function showDossier() {
        $aplActive = User::find(Auth::user()->id);
        $allApl = RelationMembreApl::where('membre_id', Auth::user()->id)->get();
        return view('backend.dossier.index')->with('title', __('member.menu_relation_apl'))->with('aplActive',
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

    private function storeFile($file,$path){
        // Get filename with the extension
        $filenameWithExt = $file->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $file->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename.'_finalized.'.$extension;
        // Upload Image
        $path = $file->move($path, $fileNameToStore);

        return false;
    }

    public function updateCa(Request $request){
        ConjunctionAgreement::where('id', $request->id)->update(['status' => 1]);

        return response()->json(['success' => 'true']);
    }
}
