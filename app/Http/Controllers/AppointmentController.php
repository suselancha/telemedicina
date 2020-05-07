<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialty;
use App\User;
use App\Appointment; 
use Validator; 
use Carbon\Carbon;

use MercadoPago\SDK;
use MercadoPago\Payment;


class AppointmentController extends Controller
{
    public function create()
    {
        $especialidades = Specialty::all();
        return view('backend.cita.create', compact('especialidades'));
    }

    public function store(Request $request)
    {
        //dd($request);
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
        //PASO DATA
        $nombre_esp = Specialty::where('id', $request->specialty_id)->get(['nombre']);
        $nombre_doc = User::where('id', $request->doctor_id)->get(['name']);
        //dd ($nombre_esp);
        //dd($nombre_esp['0']->nombre);
        $data = $request->only([
            'description',
            'doctor_id',
            'specialty_id',
            'scheduled_date',
            'scheduled_time',
            'type'
        ]);
        $data['patient_id'] = auth()->id();
        $data['nombre_esp'] = $nombre_esp['0']->nombre;
        $data['nombre_doc'] = $nombre_doc['0']->name;
        return view('backend.cita.confirmar', compact('data'));
    }


    public function pagar(Request $request)
    {
        /**
         * Tarjetas demo: https://www.mercadopago.com.ar/developers/es/guides/payments/api/testing
         * Como POST: https://www.mercadopago.com.ar/developers/es/guides/payments/web-tokenize-checkout/receiving-payment-by-card/
        **/
        //dd($request);

        //REALIZAR EL PAGO
        $token = $request->token;
        $payment_method_id = $request->payment_method_id;
        $installments = $request->installments;
        $issuer_id = $request->issuer_id;
        
        
        //MP\SDK::setAccessToken("ENV_ACCESS_TOKEN");

        SDK::setAccessToken("TEST-12042052548259-041321-2c54eef48ff5b311a32b400e625d9aba-170757050");
        $payment = new Payment();
        $payment->transaction_amount = 100.00;
        $payment->token = $token;
        $payment->description = "Pago";
        $payment->installments = $installments;
        $payment->payment_method_id = $payment_method_id;
        $payment->issuer_id = $issuer_id;
        $payment->payer = array(
        "email" => "suselancha@hotmail.com"
        );
        // Guarda y postea el pago
        $payment->save();
        //dd($payment);
        // Imprime el estado del pago
        //dd($payment->status);
        if($payment->status == "approved") {
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
        //FIN REALIZAR EL PAGO
    }
}
