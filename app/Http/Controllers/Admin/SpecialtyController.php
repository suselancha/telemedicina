<?php
//Agregar cuando se usa carpetas para los controladores
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Specialty;

//Agregar cuando se usa carpetas para los controladores
use App\Http\Controllers\Controller;

class SpecialtyController extends Controller
{
    public function index()
    {
        $especialidades = Specialty::all();
        return view('backend.especialidad.index', compact('especialidades'));
    }

    public function create()
    {
        return view('backend.especialidad.create');
    }

    private function validaciones(Request $request)
    {
        $rules = [
            'nombre' => 'required|min:3'
        ];
        $messages = [
            'nombre.required' => 'Es necesario ingresar un nombre',
            'nombre.min' => 'Como mínimo el nombre debe tener 3 caracteres'
        ];
        $this->validate($request, $rules, $messages);
    }


    public function store(Request $request)
    {
        //dd($request->all());
        $this->validaciones($request);
                
        $especialidad = new Specialty();
        $especialidad->nombre = $request->input('nombre');
        $especialidad->descripcion = $request->input('descripcion');
        $especialidad->save();
        $notificacion = 'La especilidad se ha registrado correctamente';
        return redirect('/especialidades')->with(compact('notificacion'));
    }

    public function edit(Specialty $specialty)
    {
        return view('backend.especialidad.edit', compact('specialty'));
    }

    public function update(Request $request, Specialty $specialty)
    {
        //dd($request->all());
        $this->validaciones($request);
        
        $specialty->nombre = $request->input('nombre');
        $specialty->descripcion = $request->input('descripcion');
        $specialty->save();
        $notificacion = 'La especilidad se ha actualizado correctamente';
        return redirect('/especialidades')->with(compact('notificacion'));
    }

    public function destroy(Specialty $specialty)
    {
        $nombreEliminado = $specialty->nombre;
        $specialty->delete();
        $notificacion = 'La especilidad '. $nombreEliminado .' se ha eliminado correctamente';
        return redirect('/especialidades')->with(compact('notificacion'));
    }

    
}
