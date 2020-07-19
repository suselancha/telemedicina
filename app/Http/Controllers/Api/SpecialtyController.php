<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Specialty;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;

class SpecialtyController extends Controller
{
    //EN EL MODELO OCULTAR EL CAMPO 'pivot'
    //Devuelve en JSON
    public function doctors(Specialty $specialty)
    {
        //return $specialty->users;
        return $specialty->users()->get([
            'users.id', 'users.name'
        ]);
    }

    public function calendar()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=telemedicina-calendar-575ffcbb1d36.json');

        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->setScopes(['https://www.googleapis.com/auth/calendar']);
        $id_calendar = '8p6slotsc1mukod8afethv0pqs@group.calendar.google.com';

        $calendarService = new Google_Service_Calendar($client);
        $optParams = array(
            'orderBy' => 'startTime',
            'maxResults' => 20,
            'singleEvents' => TRUE,
        );

        //Listado de eventos
        $events=$calendarService->events->listEvents($id_calendar, $optParams);

        //Contador de eventos
        $count_events = count($events->getItems());

        //Nuevo evento
        $event = new Google_Service_Calendar_Event();
        $event->setSummary('Cita Dr. Gonzales');
        $event->setDescription('Sistema Turnos Online');
        

        $format = 'Y-m-d\TH:i:sP';

        $start = new Google_Service_Calendar_EventDateTime();
        $start->setDateTime('2020-07-20T20:00:00');
        $start->setTimeZone('America/Argentina/Jujuy');
        $event->setStart($start);

        $end = new Google_Service_Calendar_EventDateTime();
        $end->setDateTime('2020-07-20T20:30:00');
        $end->setTimeZone('America/Argentina/Jujuy');
        $event->setEnd($end);

        /*$attendee = new \Google_Service_Calendar_EventAttendee();
        $attendee->setEmail('fatynoe18@gmail.com');
        $attendee->setDisplayName('fATY');
        $attendees[] = $attendee;
        $event->attendees = $attendees;*/
        
        /*$event = new Google_Service_Calendar_Event(array(
            'summary' => 'Google I/O 2015',
            'location' => '800 Howard St., San Francisco, CA 94103',
            'description' => 'A chance to hear more about Google\'s developer products.',
            'start' => array(
              'dateTime' => '2020-07-20T09:00:00-07:00',
              'timeZone' => 'America/Los_Angeles',
            ),
            'end' => array(
              'dateTime' => '2020-07-20T09:30:00-07:00',
              'timeZone' => 'America/Los_Angeles',
            ),
            'recurrence' => array(
              'RRULE:FREQ=DAILY;COUNT=2'
            )
          ));*/

        

        $conference = new \Google_Service_Calendar_ConferenceData();

        $entryPoint = new \Google_Service_Calendar_EntryPoint();
        $entryPoint->setAccessCode('wx12z3s');
        $entryPoint->setEntryPointType('video');
        $entryPoint->setLabel('meet.google.com/wx12z3s');
        $entryPoint->setMeetingCode('wx12z3s');
        $entryPoint->setPasscode('wx12z3s');
        $entryPoint->setPassword('wx12z3s');
        $entryPoint->setPin('wx12z3s');
        $entryPoint->setUri('https://meet.google.com/wx12z3s');
    
        $conference->setEntryPoints($entryPoint);


        $conferenceRequest = new \Google_Service_Calendar_CreateConferenceRequest();
        $conferenceRequest->setRequestId('randomString123');
        $conference->setCreateRequest($conferenceRequest);
        $event->setConferenceData($conference);

        $createEvent = $calendarService->events->insert($id_calendar, $event,['conferenceDataVersion' => 1]);

    }
}
