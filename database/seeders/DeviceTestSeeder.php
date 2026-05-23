<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Device;

class DeviceTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            Device::updateOrCreate(
            
            // Criterio de búsqueda para evitar duplicados si lo corres más de una vez
            ['paciente_name' => 'Juan Perez', 'clinica_id' => '1'],
            // Datos que se van a insertar/actualizar
            [
                'mac_address' => '80:B5:4E:C1:C1:A0',
                'ssid'        => 'Armor22',//'Docentes',//'iPhone de Pitosue',//'iPhone de David',//'Mega_2.4G_1243',
                'password'    => 'Lapapa123',//'DocAgs987-',//'josue2005',//'David124',//'2UPLrPg5',
                'is_active'   => true,
            ]
            

            /*
            ['paciente_name' => 'Juan Perez', 'clinica_id' => '1'],
            // Datos que se van a insertar/actualizar
            [
                'mac_address' => '80:B5:4E:C1:C1:A0',
                'ssid'        => 'Mega_2.4G_1243',
                'password'    => '2UPLrPg5',
                'is_active'   => true,
            ]
            */
        );
    }
}
