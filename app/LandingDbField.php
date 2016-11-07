<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandingDbField extends Model
{
    protected $fillable = ['lan_db_title', 'lan_db_types', 'lan_id'];

    public function landing()
    {
        return $this->belongsTo('App\Landing', 'lan_id');
    }
}
