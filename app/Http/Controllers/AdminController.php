<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\ConfigEmpresa;
use App\Models\ConfigKw;

class AdminController extends Controller
{
    public function energiaIndex(){
        
        $empresa = ConfigEmpresa::first();
        $data = ConfigKw::first();

        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }
        if($data == null){
            $data = (object)[
                'ip' => '',
                'port' => '',
                'setpoint' => '',
                'description' => '',
                'status' => 0,
            ];
        }

        
        return view('admin.energia.index', compact('data', 'empresa'));
    }

    public function energiaEditar(){
        
        $empresa = ConfigEmpresa::first();
        $data = ConfigKw::first();

        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }
        if($data == null){
            $data = (object)[
                'ip' => '',
                'port' => '',
                'setpoint' => '',
                'description' => '',
                'status' => 0,
            ];
        }

        
        return view('admin.energia.editar', compact('data', 'empresa'));
    }

    public function energiaUpdate(Request $request){
        
        $request->validate(
            [
                'ip' => 'required',
                'port' => 'required|numeric',
                'setpoint' => 'required|numeric',
            ],
            [
                'ip.required' => 'El campo IP es obligatorio.',
                'port.required' => 'El campo Puerto es obligatorio.',
                'port.numeric' => 'El campo Puerto debe ser un número.',
                'setpoint.required' => 'El campo Setpoint es obligatorio.',
                'setpoint.numeric' => 'El campo Setpoint debe ser un número.',
            ]
        );
        
        ConfigKw::updateOrCreate(
            ['id' => 1],
            [
                'ip' => $request->ip,
                'port' => $request->port,
                'setpoint' => $request->setpoint,
                'name' => $request->name,
                'status' => $request->has('status') ? 1 : 0,
            ]
        );

        return redirect()->route('energia.index')
            ->with('success', 'Los datos se han actualizado correctamente.');
    }

    public function usuariosIndex(){
        
        $empresa = ConfigEmpresa::first();
        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        $usuarios = User::all();

        return view('admin.users.index', compact('empresa', 'usuarios'));
    }
}
