<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DbRelField extends Model
{
    protected $fillable = ['lan_id', 'db_id'];

    public function db_field()
    {
        return $this->belongsTo('App\LandingDbField','db_id');
    }
    public function landing()
    {
        return $this->belongsTo('App\Landing', 'lan_id');
    }
}
