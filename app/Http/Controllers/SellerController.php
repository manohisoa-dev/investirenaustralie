<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Localisation;
use App\Models\Solicitor;
use App\Models\Message;
use App\Models\User;
use Auth;

class SellerController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:2');
        $this->middleware('user', ['only' => ['active','temp']]);
    }

    /**
     * List of products
     *
     * @return \Illuminate\Http\Response
     */
    public function products() {
        $items = Auth::user()->products()->paginate($this->pageSize);

        return view('backend.product.all')->with('title', __('seller.products'))->with('items',
            $items);
    }

    /**
     * List of ordered products
     *
     * @return \Illuminate\Http\Response
     */
    public function orders() {
        $items = Auth::user()->products()->where('products.status', 'ordered')->paginate($this->pageSize);

        return view('backend.product.all')->with('title', __('seller.orders'))->with('items',
            $items);
    }

    /**
     * List of sale products
     *
     * @return \Illuminate\Http\Response
     */
    public function sales() {
        $items = Auth::user()->products()->where('products.status', 'paid')->paginate($this->pageSize);

        return view('backend.product.all')->with('title', __('seller.sales'))->with('items',
            $items);
    }

    public function solicitor() {
        $solicitors = Solicitor::where('vendeur_id', Auth::user()->id)->get();
        return view('backend.solicitor.all')->with('title', __('seller.solicitor'))->with('solicitors',
            $solicitors);
    }

    public function ajaxGetSolicitorById(Request $request) {
        $solicitors = Solicitor::find($request->id);
        return response()->json(['solicitor' => $solicitors]);
    }

    public function ajaxSaveProduct(Request $request) {
        $solicitor = new Solicitor();
        $solicitor->cabinet_name = $request->cabinet_name;
        $solicitor->cabinet_cp = $request->cabinet_cp;
        $solicitor->cabinet_email = $request->cabinet_email;
        $solicitor->cabinet_phone = $request->cabinet_phone;
        $solicitor->vendeur_id = Auth::user()->id;
        $solicitor->save();
        return response()->json(['success' => 'true']);
    }

    public function ajaxModifSolicitor(Request $request) {
        Solicitor::where('id', $request->id)->update(['cabinet_name' => $request->cabinet_name,
            'cabinet_cp' => $request->cabinet_cp, 'cabinet_email' => $request->cabinet_email,
            'cabinet_phone' => $request->cabinet_phone]);
        return response()->json(['success' => 'true']);
    }
    
    public function ajaxDropSolicitor(Request $request)
    {
        Solicitor::where('id', $request->id)->delete();
        return response()->json(['success' => 'true']);
    }

    public function contact(Request $request, $role) {
        $action = route('send.message', ['role' => $role]);
        $getAllMessage = $this->getAllMessage($role);
        $user_name = Auth::user()->name;

        return view('backend.contact.seller')->with('action', $action)->with('role', $role)->with('user_name', $user_name)->with('title',
            __('app.contact_' . $role))->with(['data' => $getAllMessage]);
    }

    public function getAllMessage($role) {
        $to_id = "";

        switch ($role) {
            case 'admin':
                $to_id = 1;
                break;

            case 'member':
                $to_id = User::where('id', Auth::user()->id)->first()->afa_id;
                break;

            default:
                # code...
                break;
        }

        $messages = Message::whereRaw("(to_id = " .
            Auth::user()->id . " AND from_id = 1 )")->orderBy('created_at', 'ASC')->get();

        $data = [];
        foreach ($messages as $message) {
            $data[] = ['id' => $message->id, 'from_id' => $message->from_id, 'from_name' =>
                User::where('id', $message->from_id)->first()->name, 'to_id' => $message->to_id,
                'body' => nl2br(e($message->body)), 'created_at' => $message->created_at,
                'created_at_send' => $message->created_at->diffForHumans(), 'seen' => $message->seen ?
                trans('app.txt.read') : trans('app.txt.unread'), ];
        }


        // update message showing
        Message::where('from_id', $to_id)->where('to_id', Auth::user()->id)->update(['seen' =>
            1]);


        return json_encode($data);
    }

}
