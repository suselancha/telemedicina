<?php
//Agregar cuando se usa carpetas para los controladores
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;

//Agregar cuando se usa carpetas para los controladores
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$doctors = User::all();
        //$doctors = User::where('role', 'medico')->get();
        $doctors = User::doctores()->get();
        return view('backend.doctor.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'dni' => 'required|digits:8|unique:users',
            'matricula' => 'required|digits:8|unique:users',
            'direccion' => 'nullable|min:5',
            'telefono' => 'nullable|min:5'
        ];
        $this->validate($request, $rules);
        // Asignacion Masiva hay q definir en el modelo: fillable
        User::create(
            //$request->all();
            $request->only('name', 'email', 'dni', 'matricula', 'direccion', 'telefono')
            + [
                'role' => 'medico',
                'password' => bcrypt($request->password)
            ]   
        );
        $notificacion = 'El médico se ha registrado correctamente.';
        return redirect('/doctors')->with(compact('notificacion'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = User::doctores()->findOrFail($id);
        return view('backend.doctor.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'dni' => 'required|digits:8|unique:users,dni,'.$id.',id',
            'matricula' => 'required|digits:8|unique:users,matricula,'.$id.',id',
            'direccion' => 'nullable|min:5',
            'telefono' => 'nullable|min:5'
        ];
        $this->validate($request, $rules);
        // Asignacion Masiva hay q definir en el modelo: fillable
        $user = User::doctores()->findOrFail($id);
        $data = $request->only('name', 'email', 'dni', 'matricula', 'direccion', 'telefono');
        $password = $request->input('password');
        if($password)
            $data += ['password' => bcrypt($password)];
        $user->fill($data);
        $user->save();
        $notificacion = 'La información del médico se ha actualizado correctamente.';
        return redirect('/doctors')->with(compact('notificacion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function destroy($id)
    public function destroy(User $doctor)
    {
        $doctorName = $doctor->name;
        $doctor->delete();
        //Comillas doble no hace falta concatenar la variable, la reconoce directamente
        $notificacion = "El médico $doctorName se ha eliminado correctamente";
        return redirect('/doctors')->with(compact('notificacion'));
    }
}
