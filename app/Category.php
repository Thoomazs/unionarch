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

    protected $fillable = [ 'name', 'slug', 'order' ];

    public function projects()
    {
        return $this->belongsToMany( 'App\Project', "projects_category",  "category_id", "project_id" );
    }
}
