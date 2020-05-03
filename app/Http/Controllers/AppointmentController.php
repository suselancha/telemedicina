<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialty;
use App\Appointment; 
use Validator; 
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function create()
    {
        $especialidades = Specialty::all();
        return view('backend.cita.create', compact('especialidades'));
    }

    public function store(Request $request)
    {
        $rules = [
            'description' => 'required',
            'specialty_id' => 'exists:specialties,id',
            'doctor_id' => 'exists:users,id',
            'scheduled_time' => 'required'
        ];
        $messages = [
            'scheduled_time.required' => 'Por favor selecciones una hora validad para su cita.'
        ];
//VALIDA QUE NO SE HAYA RESERVADO LA HORA ANTES DE GUARDAR
        //$this->validate($request, $rules, $messages);
        $validator = Validator::make($request->all(), $rules, $messages);
        //dd($validator);
        $validator->after(function ($validator) use ($request){
            $dia = $request->input('scheduled_date');
            $doctorId = $request->input('doctor_id');
            $hora = $request->input('scheduled_time');
            if($dia && $doctorId && $dia) {
                $start = new Carbon($hora);
            } else {
                return;
            }

            $exist = Appointment::where('doctor_id', $doctorId)
                ->where('scheduled_date', $dia)
                ->where('scheduled_time', $start->format('H:i:s'))
                ->exists();

            if($exist) {
               $validator->errors() 
                ->add('available_time', 'La hora seleccionada ya fue reservada por otro pacientes.');

            }
        });

        if($validator->fails()){
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }
//FIN VALIDA
        $data = $request->only([
            'description',
            'doctor_id',
            'specialty_id',
            'scheduled_date',
            'scheduled_time',
            'type'
        ]);
        $data['patient_id'] = auth()->id();
        Appointment::create($data);
        $notificacion = 'La cita se ha registrado correctamente!';
        return back()->with(compact('notificacion'));
    }
}
