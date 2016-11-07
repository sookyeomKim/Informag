<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandingTermsField extends Model
{
    protected $fillable = ['lan_terms_name', 'lan_terms_content', 'lan_id'];

    public function landing()
    {
        return $this->belongsTo('App\Landing', 'lan_id');
    }
}
