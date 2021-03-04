<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Comment extends Model {


    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Comment::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('content') and $query->where('content',\Request::input('content'));
        \Request::input('status') and $query->where('status','like','%'.\Request::input('status').'%');
        \Request::input('votes') and $query->where('votes',\Request::input('votes'));
        \Request::input('spam') and $query->where('spam',\Request::input('spam'));
        \Request::input('reply_id') and $query->where('reply_id',\Request::input('reply_id'));
        \Request::input('blog_id') and $query->where('blog_id',\Request::input('blog_id'));
        \Request::input('user_id') and $query->where('user_id',\Request::input('user_id'));
        \Request::input('created_at') and $query->where('created_at',\Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at',\Request::input('updated_at'));
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }

    public static function validationRules( $attributes = null )
    {
        $rules = [
            'content' => '',
            'status' => 'required|string|max:20',
            'votes' => 'required|integer',
            'spam' => 'required|integer',
            'reply_id' => 'required',
            'blog_id' => 'required',
            'user_id' => 'required',
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
     * Get the comment's replies
     */
    public function replies()
    {
       return $this->hasMany(Comment::class, 'reply_id', 'id');
    }
   
    /**
     * Get the blog who owns comment.
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id', 'id');
    }
    
    /**
     * Get the author who owns comment.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    /**
     * Get the author who owns comment.
     */
    public function user()
    {
        return $this->author();
    }

}

