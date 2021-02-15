<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Sale extends Model {


    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Sale::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('status') and $query->where('status','like','%'.\Request::input('status').'%');
        \Request::input('price') and $query->where('price',\Request::input('price'));
        \Request::input('tma') and $query->where('tma',\Request::input('tma'));
        \Request::input('currency') and $query->where('currency','like','%'.\Request::input('currency').'%');
        \Request::input('apl_id') and $query->where('apl_id',\Request::input('apl_id'));
        \Request::input('apl_paid_at') and $query->where('apl_paid_at',\Request::input('apl_paid_at'));
        \Request::input('apl_amount') and $query->where('apl_amount',\Request::input('apl_amount'));
        \Request::input('apl_transaction_id') and $query->where('apl_transaction_id','like','%'.\Request::input('apl_transaction_id').'%');
        \Request::input('apl_payment_type') and $query->where('apl_payment_type','like','%'.\Request::input('apl_payment_type').'%');
        \Request::input('afa_id') and $query->where('afa_id',\Request::input('afa_id'));
        \Request::input('afa_paid_at') and $query->where('afa_paid_at',\Request::input('afa_paid_at'));
        \Request::input('afa_amount') and $query->where('afa_amount',\Request::input('afa_amount'));
        \Request::input('afa_transaction_id') and $query->where('afa_transaction_id','like','%'.\Request::input('afa_transaction_id').'%');
        \Request::input('afa_payment_type') and $query->where('afa_payment_type','like','%'.\Request::input('afa_payment_type').'%');
        \Request::input('cancelled_by') and $query->where('cancelled_by',\Request::input('cancelled_by'));
        \Request::input('cancelled_at') and $query->where('cancelled_at',\Request::input('cancelled_at'));
        \Request::input('cancelled_by_role') and $query->where('cancelled_by_role','like','%'.\Request::input('cancelled_by_role').'%');
        \Request::input('cancelled_desc') and $query->where('cancelled_desc','like','%'.\Request::input('cancelled_desc').'%');
        \Request::input('product_id') and $query->where('product_id',\Request::input('product_id'));
        \Request::input('author_id') and $query->where('author_id',\Request::input('author_id'));
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
            'status' => 'required|string|max:150',
            'price' => 'required',
            'tma' => 'required',
            'currency' => 'string|max:20',
            'apl_id' => 'required',
            'apl_paid_at' => 'date',
            'apl_amount' => 'required',
            'apl_transaction_id' => 'string|max:191',
            'apl_payment_type' => 'string|max:191',
            'afa_id' => 'required',
            'afa_paid_at' => 'date',
            'afa_amount' => 'required',
            'afa_transaction_id' => 'string|max:191',
            'afa_payment_type' => 'string|max:191',
            'cancelled_by' => 'required',
            'cancelled_at' => 'date',
            'cancelled_by_role' => 'string|max:150',
            'cancelled_desc' => 'string|max:191',
            'product_id' => 'required',
            'author_id' => 'required',
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
     * Get the product record associated with the cart item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    
    /**
     * Get the apl record associated with the cart item.
     */
    public function apl()
    {
        return $this->belongsTo(User::class, 'apl_id', 'id');
    }
    
    /**
     * Get the afa record associated with the cart item.
     */
    public function afa()
    {
        return $this->belongsTo(User::class, 'afa_id', 'id');
    }
    
    /**
     * Get the author record associated with the blog.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
    
	/*
	*id du produit et le produit lui m�me
	*/
	public static function add($product, $apl, $afa){        
        // One product item
        $tma = max(option('payment.percent_reservation', 0.10), $product->tma);
        
        $storedItem = new Sale();
        
        $storedItem->afa_id     = $afa->id;
        $storedItem->apl_id     = $apl->id;
        
        $storedItem->product_id = $product->id;
		$storedItem->price      = $product->price;
		$storedItem->tma        = $product->price*$tma;
		$storedItem->currency   = $product->currency;
        
        $storedItem->save();
        
        return $storedItem;
	}
    
    /**
     * Set status as ordered
     *
     */
    public function setAsOrdered()
    {
        
        $this->status = 'ordered';
        $this->save();
        
        // Update product buyers
        if($this->product){
            $this->product->status = 'ordered';
            $this->product->buyer_id = $this->author_id;
            $this->product->save();
        }
        
        // Notify AFA
        if($this->afa){
            try{
                $this->afa->notify(new NewOrder($this->afa, $this));
            }catch(\Exception $e){}
        }
            
        // Notify APL
        if($this->apl){
            try{
                $this->apl->notify(new NewOrder($this->apl, $this));
            }catch(\Exception $e){}
        }
        
        // Notify Customer
        if($this->author){
            try{
                $this->author->notify(new NewOrder($this->author, $this));
            }catch(\Exception $e){}
        }
        
        // Notify Admin
        $adminId = option('site.admin', 1);
        $admin = User::find($adminId);
        if($admin){
            try{
                $admin->notify(new NewOrder($admin, $this));
            }catch(\Exception $e){}
        }
    }

}

