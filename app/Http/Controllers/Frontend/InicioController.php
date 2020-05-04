<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Specialty;
use App\User;

class InicioController extends Controller
{
    public function index()
    {
        $especialidades = Specialty::all();
        $medicos = User::doctores()->paginate(12);
        return view('frontend.inicio.index', compact('especialidades','medicos'));
    }

    public function especialidades()
    {
        $especialidades = Specialty::all();
        //dd($especialidades);
        return view('frontend.especialidad.index', compact('especialidades'));
    }

    public function contactos()
    {        
        return view('frontend.contacto.index');
    }
}
