<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'c_name', 'm_name', 'm_email', 'c_id', 'phone', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comments()
    {
        return $this->hasMany('App\Landing', 'from_user');
    }

    public static $rules = array(
        'c_name' => 'required|max:60|unique:users',
        'm_name' => 'required|max:60',
        'm_email' => 'required|max:60|email',
        'c_id' => 'required|max:60|unique:users',
        /*'phone' => ['required', 'regex:/^(010|011|016|017|018|019)-\d{3,4}-\d{4}$/', 'max:13', 'unique:users'],*/
        'phone' => ['required', 'regex:/^(010|011|016|017|018|019)\d{3,4}\d{4}$/', 'max:11', 'unique:users'],
        'password' => 'required|min:6|confirmed',
    );

    public function is_admin()
    {
        $role = $this->role;
        if ($role == 'admin') {
            return true;
        }
        return false;
    }

    public function is_client()
    {
        $role = $this->role;
        if ($role == 'admin') {
            return true;
        }
        return false;
    }
}
