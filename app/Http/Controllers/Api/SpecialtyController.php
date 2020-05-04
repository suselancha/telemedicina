<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Specialty;

class SpecialtyController extends Controller
{
    //EN EL MODELO OCULTAR EL CAMPO 'pivot'
    //Devuelve en JSON
    public function doctors(Specialty $specialty)
    {
        //return $specialty->users;
        return $specialty->users()->get([
            'users.id', 'users.name'
        ]);
    }
}
