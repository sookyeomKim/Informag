<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandingUrlField extends Model
{
    protected $fillable = ['lan_url', 'lan_ref', 'lan_id','hits'];

    public function landing()
    {
        return $this->belongsTo('App\Landing', 'lan_id');
    }
}
