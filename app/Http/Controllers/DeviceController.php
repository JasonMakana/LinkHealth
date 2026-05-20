<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    // Funciones para la conexion de la ESP32 con la BD en ambito de Access Point

    public function setup(Request $request)
    {

        // Incorporación del nuevo portal cautivo con la version correcta

        // 1. Validación adaptada a lo que envía el ESP32 modificado
        $validated = $request->validate([
            'mac_address'   => 'required|string',
            'paciente_name' => 'required|string|max:255',
            'clinica_id'    => 'required|string',
        ]);

        // 2. Buscamos si existe un registro que coincida con el Paciente y la Clínica
        // Para tu simulación, asegúrate de tener un registro en la tabla 'devices'
        // que coincida con estos datos y que tenga el SSID y password de tu casa.
        $device = Device::where('paciente_name', $validated['paciente_name'])
                        ->where('clinica_id', $validated['clinica_id'])
                        ->first();

        if ($device) {
            // Sincronizamos la dirección MAC actual del hardware con el registro existente
            $device->update([
                'mac_address' => $validated['mac_address'],
                'is_active'   => true
            ]);

            // 3. RESPUESTA CRÍTICA: Retornamos el JSON con código 200 y las credenciales que el ESP32 espera
            return response()->json([
                'status'   => 'success',
                'ssid'     => $device->ssid,       // El SSID de tu casa guardado en la BD
                'password' => $device->password,   // El Password de tu casa guardado en la BD
            ], 200); 
        }

        // Si el usuario pone datos que no existen en tu base de datos de LinkHealth
        return response()->json([
            'status'  => 'error',
            'message' => 'El paciente o la clínica no coinciden con ningún registro activo.',
        ], 404);

    /*
        // Version 1 del portal cautivo
        // Validación de los datos de LinkHealth
        $validated = $request->validate([
            'mac_address'     => 'required|string',
            'paciente_name' => 'required|string|max:255',
            'clinica_id'      => 'required|string',
            'ssid'            => 'required|string',
            'password'        => 'nullable|string|max:255',
        ]);

        // Guardado o actualización el dispositivo
        $device = Device::updateOrCreate(
            ['mac_address' => $validated['mac_address']],
            [
                'paciente_name' => $validated['paciente_name'],
                'clinica_id'      => $validated['clinica_id'],
                'ssid'            => $validated['ssid'],
                'password'        => $validated['password'],
                'is_active'       => true
            ]
        );

        // Respuesta JSON para la ESP32
        return response()->json([
            'status' => 'success',
            'message' => 'Dispositivo ' . $device->mac_address . ' vinculado correctamente.',
        ], 201);
    */
    }

    public function getCredentials($mac)
    {
        // Busqueda del dispositivo por direccion MAC
        $device = Device::where('mac_address', $mac)->first();

        // Respuesta JSON con las credenciales WiFi si el dispositivo esta registrado
        if ($device) {
            return response()->json([
                'registered' => true,
                'ssid'       => $device->ssid,
                'password'   => $device->password, // Implementacion de la contraseña en JSON
                'paciente'   => $device->paciente_name
            ], 200);
        }

        // Respuesta JSON indicando que el dispositivo no esta registrado
        return response()->json(['registered' => false], 404);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Device $device)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $device)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Device $device)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        //
    }
}
