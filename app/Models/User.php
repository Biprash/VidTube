<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function subscribeing()
    {
        return $this->belongsToMany(User::class, 'subscribes', 'subscriber_user_id', 'subscribed_user_id');
    }
    
    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'subscribes', 'subscribed_user_id', 'subscriber_user_id');
    }

}
