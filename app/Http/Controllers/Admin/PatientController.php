<?php
//Agregar cuando se usa carpetas para los controladores
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;

//Agregar cuando se usa carpetas para los controladores
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$patients = User::all();
        //$patients = User::where('role', 'paciente')->get();
        //$patients = User::pacientes()->get(); 
        $patients = User::pacientes()->paginate(5); 
        return view('backend.paciente.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.paciente.create');
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
            'direccion' => 'nullable|min:5',
            'telefono' => 'nullable|min:5'
        ];
        $this->validate($request, $rules);
        // Asignacion Masiva hay q definir en el modelo: fillable
        User::create(
            //$request->all();
            $request->only('name', 'email', 'dni', 'direccion', 'telefono')
            + [
                'role' => 'paciente',
                'matricula' => NULL,
                'password' => bcrypt($request->password)
            ]   
        );
        $notificacion = 'El paciente se ha registrado correctamente.';
        return redirect('/patients')->with(compact('notificacion'));
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
        $paciente = User::pacientes()->findOrFail($id);
        return view('backend.paciente.edit', compact('paciente'));
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
            'direccion' => 'nullable|min:5',
            'telefono' => 'nullable|min:5'
        ];
        $this->validate($request, $rules);
        // Asignacion Masiva hay q definir en el modelo: fillable
        $user = User::pacientes()->findOrFail($id);
        $data = $request->only('name', 'email', 'dni', 'direccion', 'telefono');
        $password = $request->input('password');
        if($password)
            $data += [
                'password' => bcrypt($password),
                'matricula' => NULL
            ];
        $user->fill($data);
        $user->save();
        $notificacion = 'La información del paciente se ha actualizado correctamente.';
        return redirect('/patients')->with(compact('notificacion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function destroy($id)
    public function destroy(User $patient)
    {
        $pacienteName = $patient->name;
        $patient->delete();
        //Comillas doble no hace falta concatenar la variable, la reconoce directamente
        $notificacion = "El paciente $pacienteName se ha eliminado correctamente";
        return redirect('/patients')->with(compact('notificacion'));
    }
}
