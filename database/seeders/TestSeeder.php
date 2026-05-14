<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Paciente;
use App\Models\Area;
use App\Models\Cita;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Crear un área (necesaria para la cita)
    $area = Area::create(['nombre' => 'Urgencias']);

    // 2. Crear Usuario Doctor
    $userDoc = User::create([
        'name' => 'Dr. Alexander',
        'email' => 'doctor@gmail.com',
        'password' => bcrypt('admin123'),
        'role' => 'doctor'
    ]);

    // 3. Crear Perfil de Doctor ligado al usuario
    Doctor::create([
        'nombre' => 'Dr. Alexander',
        'especialidad' => 'Informática Médica',
        'user_id' => $userDoc->id
    ]);

    // 4. Crear Usuario Paciente
    $userPac = User::create([
        'name' => 'Juan Pérez',
        'email' => 'paciente@gmail.com',
        'password' => bcrypt('paciente123'),
        'role' => 'paciente'
    ]);
/*
    // 5. Crear Perfil de Paciente ligado al usuario
    $paciente = Paciente::create([
        'nombre' => 'Juan Pérez',
        'user_id' => $userPac->id,
        'nfc_uid' => '7DF21707',
        'telefono' => '4491234567'
    ]);

    // 6. Crear la Cita de prueba
    Cita::create([
        'id_paciente' => $paciente->id_paciente,
        'id_doctor' => 1,
        'id_area' => $area->id_area,
        'fecha' => now(),
        'motivo' => 'Paciente presenta fiebre alta tras escaneo de tarjeta NFC.'
    ]);
    */
    }
}
