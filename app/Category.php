<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ ];

    protected $fillable = [ 'name', 'desc', 'superior_id', 'slug' ];

    public function products()
    {
        return $this->belongsToMany( 'App\Product', "products_category",  "category_id", "product_id" );
    }
}
