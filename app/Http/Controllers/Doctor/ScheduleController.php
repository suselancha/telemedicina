<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\WorkDay;
use Carbon\Carbon;
class ScheduleController extends Controller
{
    /**public function edit()
    {
        $days = [
             'Lunes', 'Martes', 'Miércoles',
             'Jueves', 'Viernes', 'Sábado', 'Domingo'
        ];
        $workDays = WorkDay::where('user_id', auth()->id())->get();
        //dd($workDays->toArray());
        //DAMOS FORMATO HORA:MINUTO Y PM O AM
        $workDays->map(function ($workDay){
            $workDay->morning_start = (new Carbon($workDay->morning_start))->format('g:i A');
            $workDay->morning_end = (new Carbon($workDay->morning_end))->format('g:i A');
            $workDay->afternoon_start = (new Carbon($workDay->afternoon_start))->format('g:i A');
            $workDay->afternoon_end = (new Carbon($workDay->afternoon_end))->format('g:i A');
            return $workDay;
        });
        //dd($workDays->toArray());
        return view('backend.doctor.schedule', compact('workDays','days'));
    }**/

    public function index()
    {
        //$workDays = WorkDay::where('user_id', auth()->id())->get();
        $workDays = WorkDay::where('user_id', auth()->id())->paginate(10); 
        return view('backend.schedule.index', compact('workDays'));
    }

    public function create()
    {
        return view('backend.schedule.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        //$active = $request->input('active') ?: []; //SI ES NULL ASIGNA UN ARRAY VACIO
        $day = $request->input('day');
        $morning_start = $request->input('morning_start');
        $morning_end = $request->input('morning_end');
        $afternoon_start = $request->input('afternoon_start');
        $afternoon_end = $request->input('afternoon_end');

        $errors = [];

        for ($i=0; $i<5; $i++) {
            if($day[$i] != null) { //Valido que el campo traiga la fecha                
                $workDays = WorkDay::where('user_id', auth()->id())
                    ->where('day', $day[$i])->exists();

                if($workDays)
                {
                    $errors[] = "El $day[$i] ya tiene horarios asignados.";
                }else{
                    WorkDay::create([                    
                    'day' => $day[$i],
                    'user_id' => auth()->id(),
                    'morning_start' => $morning_start[$i],
                    'morning_end' => $morning_end[$i],
                    'afternoon_start' => $afternoon_start[$i],
                    'afternoon_end' => $afternoon_end[$i],
                    ]);
                    if($morning_start[$i] > $morning_end[$i]){
                        $errors[] = "Las horas del turno mañana son inconsistentes para el dia $day[$i].";
                    }
                    if($afternoon_start[$i] > $afternoon_end[$i]){
                        $errors[] = "Las horas del turno tarde son inconsistentes para el dia $day[$i].";
                    }
                }
            }
        }
    
        if(count($errors)>0)
            return redirect('/schedule')->with(compact('errors'));
            
        $notificacion = 'Los cambios se han guardado correctamente';
        return redirect('/schedule')->with(compact('notificacion'));
            
    }
}
