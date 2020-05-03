<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    //Relacion mucho a muchos
    //$specialty->users
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
