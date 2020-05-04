<?php

use Illuminate\Database\Seeder;
use App\Specialty;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $especialidades = [
            'Oftalmología',
            'Pediatría',
            'Neurología',
            'Cardiología'
        ];
        foreach($especialidades as $especialidad){
            Specialty::create([
                'nombre' => $especialidad
            ]);
        }
        
    }
}
