<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['id', 'image'];

    public function landing()
    {
        return $this->belongsTo('App\Landing', 'lan_id');
    }
}
