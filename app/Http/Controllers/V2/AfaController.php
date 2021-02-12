<?php

namespace App\Http\Controllers\V2;

use Illuminate\Http\Request;
use Auth;
use App\Localisation;

class AfaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:3');
    }
    
    /**
     * Render view with list of ordered products
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        $items = Auth::user()->orders()
            ->where('status', 'ordered')
            ->paginate($this->pageSize);
        $lapls = Localisation::select('localizations.*')
            ->join('users','users.location_id','=','localizations.id')
            ->where('users.role','=','4')
            ->groupBy('localizations.locality')
            ->get();
        
        return view('V2.backend.sale.all')
            ->with('title', __('afa.orders'))
            ->with('lapls', $lapls)
            ->with('items', $items);
    }
    
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function sales()
    {
        $items = Auth::user()->orders()
            ->where('status', 'paid')
            ->paginate($this->pageSize);
        $lapls = Localisation::select('localizations.*')
            ->join('users','users.location_id','=','localizations.id')
            ->where('users.role','=','4')
            ->groupBy('localizations.locality')
            ->get();
        
        return view('V2.backend.sale.all')
            ->with('title', __('afa.sales'))
            ->with('lapls', $lapls)
            ->with('items', $items);
    }
    
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function commissions($filter = 'paid')
    {
        $items = Auth::user()->orders()
            ->where('status', 'ordered');
        $lapls = Localisation::select('localizations.*')
            ->join('users','users.location_id','=','localizations.id')
            ->where('users.role','=','4')
            ->groupBy('localizations.locality')
            ->get();
        
        switch($filter){
            case 'paid':
                $items = $items->where('apl_paid_at', '<>', 'NULL');
                $title = __('app.commissions.paid');
                break;
            case 'not-paid':
                $items = $items->where('apl_paid_at', 'NULL');
                $title = __('app.commissions.not_paid');
                break;
            default:
                abort(404);
                break;
        }
        
        $items = $items->paginate($this->pageSize);
        
        return view('V2.backend.sale.all')
            ->with('title', $title)
            ->with('lapls', $lapls)
            ->with('items', $items);
    }
}
