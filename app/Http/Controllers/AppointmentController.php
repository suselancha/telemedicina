<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialty;
use App\Appointment; 
use Validator; 
use Carbon\Carbon;

require_once "/var/www/html/telemedicina/vendor/autoload.php";

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
            'specialty_id' => 'required|exists:specialties,id',
            'doctor_id' => 'required|exists:users,id',
            'scheduled_time' => 'required'
        ];
        $messages = [
            'scheduled_time.required' => 'Por favor selecciones una hora validad para su cita.',
            'description' => 'Ingrese una descripción',
            'specialty_id' => 'Seleccione una especialidad',
            'doctor_id' => 'Selecciones un médico'
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

        
        
        /**$data = $request->only([
            'description',
            'doctor_id',
            'specialty_id',
            'scheduled_date',
            'scheduled_time',
            'type'
        ]);
        $data['patient_id'] = auth()->id();
        Appointment::create($data);**/
        //$notificacion = 'La cita se ha registrado correctamente!';
        $notificacion = `<script src="https://www.mercadopago.com.ar/integrations/v1/web-tokenize-checkout.js" data-public-key="TEST-f718ec65-86df-4525-af2f-73c035963b84" data-transaction-amount="100.00"></script>`;
        return back()->with(compact('notificacion'));
    }
}
