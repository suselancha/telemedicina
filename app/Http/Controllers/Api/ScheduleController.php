<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\WorkDay;
use Carbon\Carbon;
use App\Appointment;

class ScheduleController extends Controller
{
    public function hours(Request $request)
    {
        //dd($request->all());
        $day = $request->input('date');
        $doctor_id = $request->input('doctor_id');
        
        $workDays = WorkDay::where('active', true)
            ->where('day', $day)->where('user_id', $doctor_id)->first([
                'morning_start', 'morning_end',
                'afternoon_start', 'afternoon_end'
            ]);
        //dd($workDays);
        $data = [];
        //if($workDays != null)
        if(!$workDays){
            return [];
        }
        //{
            
            if($workDays->morning_start != '00:00:00')
            {
                $morning_intervals = $this->getIntervalos($workDays->morning_start, $workDays->morning_end, $day, $doctor_id);
                $data['morning'] = $morning_intervals;
            }

            if($workDays->afternoon_start != '00:00:00')
            {
                $afternoon_intervals = $this->getIntervalos($workDays->afternoon_start, $workDays->afternoon_end, $day, $doctor_id);    
                $data['afternoon'] = $afternoon_intervals;
            }
            //dd($data);
            
        //}
        
        return $data;
    }

    private function getIntervalos($start, $end, $date, $doctorId)
    {
        $start = new Carbon($start);
        $end = new Carbon($end);

        $intervalos = [];
        while($start < $end){
            $interal = [];
           
            $interval['start'] = $start->format('H:i');            

            $exist = Appointment::where('doctor_id', $doctorId)
                ->where('scheduled_date', $date)
                ->where('scheduled_time', $start->format('H:i:s'))
                ->exists();

            $start->addMinutes(30);
            $interval['end'] = $start->format('H:i');

            //Si no existe una cita para esta hora con este medico lo agregamos al intervalo            
            if(!$exist) {
                $intervalos [] = $interval;
            }
            

        }
        return $intervalos;
    }
}
