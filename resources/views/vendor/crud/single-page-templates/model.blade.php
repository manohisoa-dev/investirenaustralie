<?php
/* @var $gen \Nvd\Crud\Commands\Crud */
/* @var $fields [] */
?>
<?='<?php'?>

namespace App{!! $gen->getModelDir() !!};

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class <?=$gen->modelClassName()?> extends Model {

@if( !empty($gen->translatableFields))
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes =  ['{!! implode("','",$gen->translatableFields) !!}'];
@endif

    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = <?=$gen->modelClassName()?>::query();

        // search results based on user input
        @foreach ( $fields as $field )
\Request::input('{{$field->name}}') and $query->where({!! \Nvd\Crud\Db::getConditionStr($field) !!});
        @endforeach

        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(Config::get('constants.perpage.admin'));
    }

    public static function validationRules( $attributes = null )
    {
        $rules = [
@foreach ( $fields as $field )
@if( $rule = \Nvd\Crud\Db::getValidationRule( $field ) )
            {!! $rule !!}
@endif
@endforeach
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

}

@if( !empty($gen->translatableFields))
class <?=$gen->modelTranslationClassName()?> extends Model {
    public $timestamps = false;
    protected $fillable = ['{!! implode("','",$gen->translatableFields) !!}'];
}
@endif