<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiaPromo extends Model
{
    public function promocion()
    {
        return $this->hasMany('App\Promocion');
    }
}
