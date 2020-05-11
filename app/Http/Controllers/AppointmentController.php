<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialty;
use App\User;
use App\Appointment; 
use App\CitaCancelada;
use Validator; 
use Carbon\Carbon;

use MercadoPago\SDK;
use MercadoPago\Payment;


class AppointmentController extends Controller
{
    public function index()
    {   
        //CITAS RESERVADAS
        $citasReservadas= Appointment::where('estado', 'Reservada')
            ->where('patient_id', auth()->id())
            ->paginate(10);

        //CITAS CONFIRMADAS
        $citasConfirmadas= Appointment::where('estado', 'Confirmada')
            ->where('patient_id', auth()->id())
            ->paginate(10);
        
        //CITAS ATENDIDAS Y CANCELAS
        $citasHistorial= Appointment::whereIn('estado', ['Atendida', 'Cancelada'])
            ->where('patient_id', auth()->id())
            ->paginate(10);
        return view('backend.cita.index', compact('citasReservadas', 'citasConfirmadas','citasHistorial'));
    }

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
        $nombre_doc = User::where('id', $request->doctor_id)->get(['name', 'consulta']);
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
        $data['consulta'] = $nombre_doc['0']->consulta;
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
        $payment->transaction_amount = $request->consulta;
        $payment->token = $token;
        $payment->description = "Pago Cita Médica";
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
            $data['medio'] = $payment_method_id;
            $data['cuotas'] = $installments;
            $data['id_emisor'] = $issuer_id;
            $data['monto'] = $request->consulta;
            Appointment::create($data);
            $notificacion = 'La cita se ha registrado correctamente!';        
            //FALTA REDICCIONAR A LA PANTALLA DE PACIENTE CON TURNOS PAGADOS.
            //return back()->with(compact('notificacion'));
            return redirect('/appointments/create')->with(compact('notificacion'));
        }
        //FIN REALIZAR EL PAGO
    }

    public function showCancelForm(Appointment $appointment)
    {
        if($appointment->estado == "Confirmada")
            return view('backend.cita.cancel', compact('appointment'));
        
        return redirect('/appointments/index');
    }

    //Appointment para el cancelar de la vista y cancelacion directa desde (citas-pendientes)
    //Request para el cancelar de la vista cancel (cancelacion con confirmacion)
    public function postCancel(Appointment $appointment, Request $request)
    {
        if($request->has('justificacion')) {
            $cancelacion = New CitaCancelada();
            $cancelacion->justificacion = $request->input('justificacion');
            $cancelacion->cancelado_por = auth()->id();
            //Por la relacion definida hacemos el save directamente
            $appointment->cancelacion()->save($cancelacion);
        }
            

        $appointment->estado = 'Cancelada';
        $appointment->save();
        $notificacion = 'La cita se ha cancelado correctamente.';
        return redirect('/appointments/index')->with(compact('notificacion'));
    }
}
