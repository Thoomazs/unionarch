<?php
    /**
     * Created by PhpStorm.
     * User: Thomazs
     * Date: 25.10.14
     * Time: 13:17
     */

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class Role extends Model
    {
        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'roles';

        /**
         * The attributes excluded from the model's JSON form.
         *
         * @var array
         */
        protected $hidden = [ ];

        protected $fillable = [ 'name' ];

        public function users()
        {
            return $this->belongsToMany('App\User', 'assigned_roles');
        }
    }