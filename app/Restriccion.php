<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restriccion extends Model
{
    public function promocion()
    {
        return $this->belongsTo('App\Promocion');
    }
}
