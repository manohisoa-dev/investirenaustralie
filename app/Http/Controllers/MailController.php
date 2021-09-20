<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;

use App\Models\User;
use App\Models\Email;
use App\Models\MailUser;
use App\Notifications\NewMail;
use App\Models\Localisation;
use App\Models\Role;
use App\Models\Newsletter;

use App\Mail\MailTemplate;
use Mail;

class MailController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    public function contact(Request $request) {
        if ($request->isMethod('post')) {
            // Validate request
            $datas = $request->all();
            $validator = Validator::make($datas, ['email' => 'required|email|max:100',
                'name' => 'required|max:100', 'subject' => 'required|max:100', 'content' =>
                'required|max:1000']);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            try {
                $to = option('site.admin_email', env('ADMIN_MAIL'));
                $to_name = option('site.admin_name', 'admin');
                $name = $request->name;
                $email = $request->email;
                $subject = $request->subject;
                $content = $request->content;

                $data = array(
                    'name' => "admin",
                    'content' => $content,
                    );

                \Mail::send('mail', $data, function ($message)use ($subject, $email, $name, $to,
                    $to_name) {
                    $message->to($to, $to_name)->subject($subject)->from($email, $name); }
                );

            }
            catch (\Exception $e) {
                return back()->with('error', trans('app.txt.message_notsent') . ' ' . $e->getMessage
                    ());
            }
            return back()->with('success', trans('app.txt.message_sent'));
        }
        $locale = \App::getLocale();
        $content = \App\Models\Config::login()->get_meta_array('content', $locale);
        $address = \App\Models\Config::login()->get_meta_array('address', $locale);
        $contact = \App\Models\Config::login()->get_meta_array('contact', $locale);

        return view('index.contact')->with('title', __('app.send_mail'))->with('content',
            $content)->with('address', $address)->with('contact', $contact)->with('breadcrumbs',
            __('app.send_mail'));
    }

    public function read(Request $request, MailUser $mailuser) {
        $mailuser->read = 1;
        $mailuser->save();

        $path = storage_path('app/public/logo.png');
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    /**
     * Show a mail
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Mail $mail
     * @return Illuminate\Http\Response
     */
    public function view(Request $request, Email $mail) {
        $this->middleware('auth');

        $mail->load('sender')->load('receiver');

        if (\Auth::user()->isAdmin()) {
            return view('admin.mail.index')->with('item', $mail);
        }

        return view('backend.mail.index')->with('item', $mail);
    }

    /**
     * Show all conversation in admin panel
     *
     * @param  Request $request
     * @return Response
     */
    public function all(Request $request, $filter = 'all') {
        $user = Auth::user();
        $title = __('app.admin.mail.list');

        switch ($filter) {
            case "inbox":
                $items = $user->mails();
                break;
            case "sent":
                $items = $user->mails()->wherePivot('is_sent', 1);
            case "unsent":
                $items = $user->mails()->wherePivot('is_sent', 0);
            case "spam":
                $items = $user->mails()->wherePivot('is_spam', 1);
            case "unread":
                $items = $user->mails()->wherePivot('read', 0);
            case "read":
                $items = $user->mails()->wherePivot('read', 0);
                break;
            case "outbox":
                $items = Email::orderBy('created_at', 'desc');
                $items = $items->where('sender_id', $user->id);
                break;
            case "draft":
            case "model":
                $items = Email::orderBy('created_at', 'desc');
                $items = $items->where('status', $filter);
                break;
            case "all":
                $items = Email::orderBy('created_at', 'desc');
                $this->middleware('role:admin');
                break;
        }

        $record = $request->get('record');
        if (!$record)
            $record = $this->pageSize;

        $q = $request->get('q');
        $q = trim($q);
        if ($q) {
            $items = $items->where(function ($query)use ($q) {
                return $query->orWhere('subject', 'LIKE', '%' . $q . '%')->orWhere('content',
                    'LIKE', '%' . $q . '%'); }
            );
        }

        $receiver = $request->get('receiver');
        $receiver = intval($receiver);
        if ($receiver) {
            if ($user->isAdmin()) {
                $items = $items->where(function ($query)use ($receiver) {
                    return $query->where('sender_id', $receiver); }
                );
            } else {
                $items = $items->where(function ($query)use ($receiver) {
                    return $query->where('sender_id', $receiver); }
                );
            }
        }


        if ($user->isAdmin()) {
            $view = view('admin.mail.all');

            $view->with('users', User::all());

        } else {
            $view = view('backend.mail.all');

            switch (Role::find(Auth::user()->role)->role_initial) {
                case 'apl':
                    $view->with('users', User::isActive()->get());
                    break;
                case 'afa':
                    $view->with('users', User::isActive()->where(function ($query) {
                        return $query->where('role', 'admin')->orWhere('role', 'apl'); }
                    )->get());
                    break;
                case 'seller':
                    $view->with('users', User::isActive()->where(function ($query) {
                        return $query->where('role', 'admin')->orWhere('role', 'apl'); }
                    )->get());
                    break;
                case 'member':
                    $view->with('users', User::isActive()->where(function ($query) {
                        return $query->where('role', 'admin')->orWhere('role', 'apl'); }
                    )->get());
                    break;
            }
        }

        $items = $items->paginate($record);


        return $view->with('items', $items)->with('q', $q)->with('record', $record)->with('title',
            $title)->with('receiver', $receiver)->with('breadcrumbs', $title);
    }

    public function basic_email() {
        $data = array('name' => "Virat Gandhi");
        \Mail::send(['text' => 'mail'], $data, function ($message) {
            $message->to('joelinjatovo@gmail.com', 'Tutorials Point')->subject('Laravel Basic Testing Mail');
                $message->from('joelinjatovo@gmail.com', 'Virat Gandhi'); }
        );
        echo "Basic Email Sent. Check your inbox.";
    }

    public function html_email() {
        $data = array('name' => "Virat Gandhi");
        \Mail::send('mail', $data, function ($message) {
            $message->to('joelinjatovo@gmail.com', 'Tutorials Point')->subject('Laravel HTML Testing Mail');
                $message->from('joelinjatovo@gmail.com', 'Virat Gandhi'); }
        );
        echo "HTML Email Sent. Check your inbox.";
    }

    public function attachment_email() {
        $data = array('name' => "Virat Gandhi");
        \Mail::send('mail', $data, function ($message) {
            $message->to('joelinjatovo@gmail.com', 'Tutorials Point')->subject('Laravel Testing Mail with Attachment');
                $message->attach('C:\laravelmaster\laravel\public\uploads\image.png'); $message->attach
                ('C:\laravelmaster\laravel\public\uploads\test.txt'); $message->from('joelinjatovo@gmail.com',
                'Virat Gandhi'); }
        );
        echo "Email Sent with attachment. Check your inbox.";
    }

    public function saveNewsletter(Request $request) {
        //$validator = $this->validate($request, Newsletter::validationRules());
        $datas = $request->all();
        $validator = Validator::make($datas, ['email_adresse' =>
            'required|unique:newsletters|string|max:255|email']);
        if ($validator->fails()) {
            return response()->json(['reponse' => $request->email_adresse .
                ' est déjà enregistré']);
        } else {
            Newsletter::create($request->all());
            return response()->json(['reponse' => 'OK']);
        }
    }

    public function ajaxSendEmail(Request $request) {
        //save email
        $item = new Email();
        $item->subject = $request->subject;
        $item->content = $request->content;
        $item->sender_id = $request->sender_id;
        $item->status = 'send';
        $item->save();

        //save email user
        $mailItem = new MailUser();
        $mailItem->mail_id = $item->id;
        $mailItem->user_id = 1;
        $mailItem->is_sent = 1;
        $mailItem->read = 0;
        $mailItem->save();
        
        //envoyer un email
        $email_to = 'iea.dev.v2@gmail.com';
        $content = ['title' => '', 'body' => $request->content];
        Mail::to($email_to)->send(new MailTemplate($content, $request->subject));                     
        return response()->json(['success' => 'true']);
    }
    
    public function ajaxDeleteEmail(Request $request)
    {
        Email::where('id', $request->id_email)->delete();
        return response()->json(['success' => 'true']);
    }


}
