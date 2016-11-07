<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DbManageField extends Model
{
    protected $casts = [
        'db_content' => 'array',
    ];

    protected $fillable = ['db_content', 'db_inflow', 'lan_id'];

    public function landing()
    {
        return $this->belongsTo('App\Landing', 'lan_id');
    }
}
