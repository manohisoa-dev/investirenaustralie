<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Localisation;
use App\Models\User;
use App\Models\Message;


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
        
        return view('backend.sale.all')
            ->with('title', __('afa.orders'))
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
        
        return view('backend.sale.all')
            ->with('title', __('afa.sales'))
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
        
        return view('backend.sale.all')
            ->with('title', $title)
            ->with('items', $items);
    }

    
    public function showMessage(Request $request, $role){
        $action = route('send.message', ['role'=>$role]);
        $apls = User::ofRole(4)->isActive()->get();
        
        $lafas = User::where('role',3)
            ->where('status','active')
            ->where('location_id',Auth::user()->location_id)
            ->orderBy('id','desc')
            ->get();

        $lcontact = Message::where("to_id", Auth::user()->id)
        ->orderBy('created_at', 'ASC')
        ->groupBy('from_id')
        ->get();
        
        return view('backend.contact.afa')
            ->with('action', $action)
            ->with('lafas', $lafas)
            ->with('apls', $apls)
            ->with('role', $role)
            ->with('title', trans('app.chat'));
    }
    
}
