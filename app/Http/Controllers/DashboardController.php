<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Barrenos;
use App\Models\BarrenosPlan;
use App\Models\ConfigEmpresa;
use App\Models\ConfigKw;
use App\Models\Equipo;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){

        $empresa = ConfigEmpresa::first();
        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        $equiposBarrenacion = Equipo::query()->where('tipo', 'Perforadora')
            ->where('activo', 1)
            ->get();

        
        return view('index', compact('empresa', 'equiposBarrenacion'));
    }

    public function loginIndex(){

        return view('login.index');
    }

    public function login(Request $request){

        // Validar los datos
        $request->validate([
            'user' => 'required',
            'password' => 'required'
        ]);       

        $password = $request->password;
        //$password = bcrypt($password);

        $usuario = $request->user;
        $userdb = User::query()->where('user', $usuario)->get();
        //return $userdb[0]['id'];
        //return $password.' ----- '.$userdb[0]['password'];
        
        if($userdb->count() == 0){
            return redirect()->to('/login')->with('empty', "El Usuarios no existe");
        }
        
        if(auth()->attempt(['user' => $usuario, 'password' => $password]) == false){
            return back()->withErrors([
                'message' => '¡El Usuario y/o la Contraseña son incorrectos!',
            ]);
        }else {
            return redirect()->route('admin.index');
        }
    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->to('/');
    }

    public function adminIndex(){

        $empresa = ConfigEmpresa::first();
        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        return view('admin.index', compact('empresa'));
    }
}
