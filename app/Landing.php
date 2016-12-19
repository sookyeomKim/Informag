<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Landing extends Model
{
    protected $fillable = ['user_id', 'lan_c_name', 'lan_m_name', 'lan_start_date', 'lan_end_date', 'lan_title', 'lan_kakao_id', 'lan_phone', 'lan_page_script', 'lan_db_script', 'lan_mobile_confirm'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function images()
    {
        return $this->hasMany('App\Image','lan_id');
    }

    /*public function db_fields()
    {
        return $this->hasMany('App\LandingDbField', 'lan_id');
    }*/

    public function db_rel_fields()
    {
        return $this->hasMany('App\DbRelField', 'lan_id');
    }

    public function db_manage_fields()
    {
        return $this->hasMany('App\DbManageField', 'lan_id');
    }

    public function url_fields()
    {
        return $this->hasMany('App\LandingUrlField','lan_id');
    }

    public function terms_fields()
    {
        return $this->hasMany('App\LandingTermsField', 'lan_id');
    }
}