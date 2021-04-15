<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

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

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    // methods

    // public function hasRole( ... $roles ) {

    //     foreach ($roles as $role) {
    //       if ($this->roles->contains('name', $role)) {
    //         return true;
    //       }
    //     }
    //     return false;
    // }

    // public function hasAnyRoles($roles){
    //     if($this->roles()->whereIn('name',$roles)->first()){
    //         return true;
    //     }
    //     return false;
    // }

    public function hasRole($role){
        // dd($this->roles()->where('name',$role)->first());
        if($this->roles()->where('name',$role)->first()){
            
            return true;
        }
        return false;
    }
    
    public function isAdmin(){
        if($this->roles()->where('name', 'Admin')->first()){
            
            return true;
        }
        return false;
    }

    public function assignRole($role) {
        $role = Role::where('name', $role)->first();
        return $this->roles()->attach($role->id);
    }
}
