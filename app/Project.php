<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ ];

    protected $fillable = [ 'name', 'desc', 'client', 'slug' ];

    public function categories()
    {
        return $this->belongsToMany( 'App\Category', "projects_category",  "project_id", "category_id" );
    }

    public function authors()
    {
        return $this->belongsToMany( 'App\Author', "projects_author",  "project_id", "author_id" );
    }
}
