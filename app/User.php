<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'c_name', 'm_name', 'm_email', 'c_id', 'phone', 'password', 'role_id'
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

    public static $updateRules = array(
        'c_name' => 'required|max:60',
        'm_name' => 'required|max:60',
        'm_email' => 'required|max:60|email',
        'c_id' => 'required|max:60',
        /*'phone' => ['required', 'regex:/^(010|011|016|017|018|019)-\d{3,4}-\d{4}$/', 'max:13', 'unique:users'],*/
        'phone' => ['required', 'regex:/^(010|011|016|017|018|019)\d{3,4}\d{4}$/', 'max:11'],
        'password' => 'required|min:6|confirmed',
    );

    public function role()
    {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }

    public function hasRole($roles)
    {
        $this->have_role = $this->getUserRole();
        // Check if the user is a root account
        if ($this->have_role->name == 'Root') {
            return true;
        }
        if (is_array($roles)) {
            foreach ($roles as $need_role) {
                if ($this->checkIfUserHasRole($need_role)) {
                    return true;
                }
            }
        } else {
            return $this->checkIfUserHasRole($roles);
        }
        return false;
    }

    private function getUserRole()
    {
        return $this->role()->getResults();
    }

    private function checkIfUserHasRole($need_role)
    {
        return (strtolower($need_role) == strtolower($this->have_role->name)) ? true : false;
    }
}
