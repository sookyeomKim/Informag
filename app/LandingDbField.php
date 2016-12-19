<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandingDbField extends Model
{
    protected $fillable = ['lan_db_title', 'lan_db_types', 'lan_id'];

    public function db_rel_fields()
    {
        return $this->hasMany('App\DbRelField', 'lan_id');
    }
}
