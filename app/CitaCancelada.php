<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CitaCancelada extends Model
{
    public function cancelado_por() //Busca un campo en la tabala: cancelado_por_id
    {   
        // cita_canceladas N - 1 User (Un usuario puede cancelar varias citas)
        return $this->belongsTo(User::class);
    }
}
