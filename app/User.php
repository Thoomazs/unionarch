<?php namespace App;

use Illuminate\Auth\Passwords\CanResetPasswordTrait;
use Illuminate\Auth\UserTrait;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\User as UserContract;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements UserContract, CanResetPasswordContract
{

    use UserTrait, CanResetPasswordTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ 'password', 'remember_token' ];

    protected $fillable = [ 'firstname',
                            'lastname',
                            'email',
                            'password',
                            'slug' ];

    public function getNameAttribute()
    {
        return $this->firstname." ".$this->lastname;
    }

    public function roles()
    {
        return $this->belongsToMany( 'App\Role', "assigned_roles", "user_id", "role_id" );
    }

    public function hasRole( $name )
    {
        foreach ( $this->roles as $role )
        {
            if ( $role->name == $name )
            {
                return true;
            }
        }

        return false;
    }

}
