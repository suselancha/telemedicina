<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**Route::get('/', function () {
    return view('frontend/inicio/index');
})->name('inicio');
**/


Auth::routes();

Route::get('/', 'Frontend\InicioController@index')->name('inicio');
Route::get('/especialidad', 'Frontend\InicioController@especialidades')->name('especialidad');
Route::get('/contacto', 'Frontend\InicioController@contactos')->name('contacto');
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth','admin'])->namespace('Admin')->group(function () {
    //Specialty
    Route::get('/especialidades', 'SpecialtyController@index'); // Listado
    Route::get('/especialidades/create', 'SpecialtyController@create'); // Formulario de registro
    Route::get('/especialidades/{specialty}/edit', 'SpecialtyController@edit'); // Formulario de edicion
    Route::post('/especialidades', 'SpecialtyController@store'); // Envio del formulario
    Route::put('/especialidades/{specialty}', 'SpecialtyController@update'); // Update del formulario
    Route::delete('/especialidades/{specialty}', 'SpecialtyController@destroy'); // Eliminar registro
    //Doctores
    Route::resource('doctors','DoctorController');
    //Pacientes
    Route::resource('patients','PatientController');
});

Route::middleware(['auth','doctor'])->namespace('Doctor')->group(function () {
    Route::get('/schedule', 'ScheduleController@index');
    Route::get('/schedule/create', 'ScheduleController@create');
    Route::post('/schedule', 'ScheduleController@store');
    Route::put('/schedule/{workday}', 'ScheduleController@update'); // Update del formulario
    Route::delete('/schedule/{workday}', 'ScheduleController@destroy'); // Eliminar registro
});

Route::middleware(['auth'])->group(function () {
    Route::get('/appointments/index', 'AppointmentController@index');    
    Route::get('/appointments/create', 'AppointmentController@create');
    Route::get('/appointments/{appointment}', 'AppointmentController@show');
    Route::post('/appointments', 'AppointmentController@store');
    Route::post('/appointments/pagar', 'AppointmentController@pagar');
    Route::get('/appointments/{appointment}/cancel', 'AppointmentController@showCancelForm');
    Route::post('/appointments/{appointment}/postCancel', 'AppointmentController@postCancel');
    Route::post('/appointments/{appointment}/confirmar', 'AppointmentController@postConfirmar');
});

Route::get('/specialties/{specialty}/doctors', 'Api\SpecialtyController@doctors');
Route::get('/schedule/hours', 'Api\ScheduleController@hours');

Route::get('/schedule/calendar', 'Api\SpecialtyController@calendar');