<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ ];

    protected $fillable = [ 'name', 'desc', 'price', 'stock', 'slug', 'image' ];

    public function categories()
    {
        return $this->belongsToMany( 'App\Category', "products_category",  "product_id", "category_id" );
    }

    public function getPhotoAttribute()
    {
        if( is_file( public_path().$this->image ) ) return $this->image;
        else return 'http://placehold.it/512x512';
    }
}
