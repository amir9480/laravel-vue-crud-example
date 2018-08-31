<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Watson\Rememberable\Rememberable;

/** 
 * @mixin 
 * \Eloquent 
 */
class User extends Authenticatable
{
    use Notifiable, Rememberable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'last_update'
    ];

    public function getLastUpdateAttribute()
    {
        return $this->updated_at->diffForHumans();
    }

}
