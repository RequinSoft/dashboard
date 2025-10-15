<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class DashboardController extends Controller
{
    public function index(){

        return view('index');
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

    public function adminIndex(){
        
        return view('admin.index');
    }
}
