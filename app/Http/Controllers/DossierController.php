<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RelationMembreApl;
use Auth;

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
}
