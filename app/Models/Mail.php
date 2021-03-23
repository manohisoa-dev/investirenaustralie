<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Mail extends Model {


    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Mail::query();
        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('subject') and $query->where('subject','like','%'.\Request::input('subject').'%');
        \Request::input('content') and $query->where('content','like','%'.\Request::input('content').'%');
        \Request::input('copied_from') and $query->where('copied_from',\Request::input('copied_from'));
        \Request::input('status') and $query->where('status','like','%'.\Request::input('status').'%');
        \Request::input('sender_id') and $query->where('sender_id',\Request::input('sender_id'));
        \Request::input('created_at') and $query->where('created_at',\Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at',\Request::input('updated_at'));
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }
    
    public static function allEmail()
    {
        $query = Mail::query();        
        $query->join('mails_users','mails_users.mail_id','=','mails.id');
        //$query->join('users','users.id','=','mails_users.user_id');
        //$query->join('roles','roles.id','=','users.role');
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('subject') and $query->where('subject','like','%'.\Request::input('subject').'%');
        \Request::input('content') and $query->where('content','like','%'.\Request::input('content').'%');
        \Request::input('copied_from') and $query->where('copied_from',\Request::input('copied_from'));
        \Request::input('status') and $query->where('status','like','%'.\Request::input('status').'%');
        \Request::input('sender_id') and $query->where('sender_id',\Request::input('sender_id'));
        \Request::input('created_at') and $query->where('created_at',\Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at',\Request::input('updated_at'));
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));
        // paginate results
        return $query->paginate(15);
    }
    
    public static function listeEmailByStatuts($status,$id_user)
    {
        $query = Mail::query(); 
        $query->join('mails_users','mails_users.mail_id','=','mails.id');
        if($status == 'send'){
            $query->where("mails.sender_id","$id_user");
        }elseif($status == 'inbox'){
            $query->where("mails_users.user_id","$id_user");
        }
        
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('subject') and $query->where('subject','like','%'.\Request::input('subject').'%');
        \Request::input('content') and $query->where('content','like','%'.\Request::input('content').'%');
        return $query->paginate(15);
    }

    public static function validationRules( $attributes = null )
    {
        $rules = [
            'subject' => 'string',
            'content' => 'string',
            'copied_from' => 'required',
            'status' => 'required|string|max:20',
            'sender_id' => 'required',
        ];

        // no list is provided
        if(!$attributes)
            return $rules;

        // a single attribute is provided
        if(!is_array($attributes))
            return [ $attributes => $rules[$attributes] ];

        // a list of attributes is provided
        $newRules = [];
        foreach ( $attributes as $attr )
            $newRules[$attr] = $rules[$attr];
        return $newRules;
    }

    /**
     * Excerpt
     *
     * @param int $length
     * @return String
     */
    public function excerpt($length = 100)
    {
        return substr($this->content, 0, $length);
    }

    /**
     * Get the sender associated with the mail.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    /**
     * Get the receiver associated with the mail.
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

    /**
     * An user can have many mails with mails_users pivot table
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'mails_users', 'mail_id', 'user_id');
    }

}

