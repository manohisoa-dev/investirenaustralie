<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\ImageResizer ;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pub extends Model {
    use ImageResizer;
    use SoftDeletes;
    protected static $directory = 'pub';
    protected static $directoryResize = 'pub/pub-resize';
    protected $dates = ['deleted_at'];

    protected static $aImageSize = array(
        'mini'              => [25, 25],
        'thumb'             => [50, 50],
        'medium'            => [374, 200],
        'large'             => [598, 418]
    );


    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Pub::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('title') and $query->where('title','like','%'.\Request::input('title').'%');
        \Request::input('content') and $query->where('content',\Request::input('content'));
        \Request::input('links') and $query->where('links','like','%'.\Request::input('links').'%');
        \Request::input('author_id') and $query->where('author_id',\Request::input('author_id'));
        \Request::input('image_id') and $query->where('image_id',\Request::input('image_id'));
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
            'title' => 'string|max:150',
            'content' => '',
            'links' => 'string|max:191',
            'author_id' => '',
            'image_id' => '',
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
     * Get the author record associated with the blog.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
    
    /**
     * Get Url of Attached Image OR Default Image
     *
     * @param Boolean $thumb
     * @return String
     */
    public function imageUrl($thumb=false)
    {
        // Image is setted
        if($this->image){
            if($thumb) return thumbnail($this->image->filepath);
            return storage($this->image->filepath);
        } 
        return asset('images/pub.png');
    }
    
    /**
     * An many pubs can have many pages from pubs_pages table
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function pages()
    {
      return $this->belongsToMany(Page::class, 'pubs_pages', 'pub_id', 'page_id');
    }
    
    /**
     * Get the image record associated with the pub.
     */
    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }

    public function getImageUrl($imageSizeName = "medium"){
        return $this->getAvatar($imageSizeName);
    }

}

