<?php
/**
 * Created by PhpStorm.
 * User: Thomazs
 * Date: 30.10.14
 * Time: 14:40
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

class Author extends Model {

    protected $table = 'authors';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ ];

    protected $fillable = [ 'name' ];

    public function projects()
    {
        return $this->belongsToMany( 'App\Project', "projects_author",  "author_id", "project_id" );
    }
}