<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\ConfigEmpresa;
use App\Models\ConfigKw;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /************************************************* */
    /****************** Energía ********************* */
    /************************************************* */
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


    /************************************************* */
    /****************** Usuarios ********************* */
    /************************************************* */
    public function usuariosIndex(){
        
        $empresa = ConfigEmpresa::first();
        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        if(auth()->user()->user == 'sa'){
            $usuarios = User::with('roles')->get();
        }else {
            $usuarios = User::where('user','!=','sa')->with('roles')->get();
        }

        return view('admin.users.index', compact('empresa', 'usuarios'));
    }

    public function usuariosCrear(){
        
        $empresa = ConfigEmpresa::first();
        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        $roles = Role::all();

        return view('admin.users.crear', compact('empresa', 'roles'));
    }

    public function usuariosStore(Request $request){
        
        $request->validate(
            [
                'user' => 'required|unique:users,user',
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password',
            ],
            [
                'user.required' => 'El campo Usuario es obligatorio.',
                'user.unique' => 'El Usuario ya está en uso.',
                'name.required' => 'El campo Nombre Completo es obligatorio.',
                'email.required' => 'El campo Email es obligatorio.',
                'email.email' => 'El campo Email debe ser una dirección de correo electrónico válida.',
                'email.unique' => 'El Email ya está en uso.',
                'password.required' => 'El campo Contraseña es obligatorio.',
                'password.min' => 'El campo Contraseña debe tener al menos 6 caracteres.',
                'password_confirmation.required' => 'El campo Confirmar Contraseña es obligatorio.',
                'password_confirmation.same' => 'El campo Confirmar Contraseña debe coincidir con la Contraseña.',
            ]
        );
        //return $request->all();

        $data = [
            'user' => $request->user,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];

        if($request->has('logo')){
            $file = $request->file('logo');
            $imagePath = $file->storeAs('avatars', $file->getClientOriginalName(), 'public');
            // guardar nombre original del archivo
            $imageFilename = $file->getClientOriginalName();
            $data['img'] = $imageFilename;
        }

        $user = User::create($data);

        if($request->has('role')){
            //return $request->has('role');
            $user->assignRole($request->role);
        }

        return redirect()->route('usuarios.index')
            ->with('success', 'El usuario se ha creado correctamente.');
    }

    public function usuariosEditar($id){
        
        $empresa = ConfigEmpresa::first();
        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        $user = User::find($id);
        if(!$user){
            return redirect()->route('usuarios.index')
                ->with('error', 'El usuario no existe.');
        }

        $roles = Role::all();

        return view('admin.users.editar', compact('empresa', 'user', 'roles'));
    }

    public function usuariosUpdate(Request $request){
        
        $request->validate(
            [
                'id' => 'required|exists:users,id',
                'user' => 'required|unique:users,user,'.$request->id,
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$request->id,
            ],
            [
                'id.required' => 'El usuario es obligatorio.',
                'id.exists' => 'El usuario no existe.',
                'user.required' => 'El campo Usuario es obligatorio.',
                'user.unique' => 'El Usuario ya está en uso.',
                'name.required' => 'El campo Nombre Completo es obligatorio.',
                'email.required' => 'El campo Email es obligatorio.',
                'email.email' => 'El campo Email debe ser una dirección de correo electrónico válida.',
                'email.unique' => 'El Email ya está en uso.',
            ]
        );
        //return $request->all();

        $user = User::find($request->id);

        $user->user = $request->user;
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->has('password') && $request->password != ''){
            $user->password = $request->password;
        }

        if($request->has('logo')){
            $file = $request->file('logo');
            $imagePath = $file->storeAs('avatars', $file->getClientOriginalName(), 'public');
            // guardar nombre original del archivo
            $imageFilename = $file->getClientOriginalName();
            $user->img = $imageFilename;
        }

        $user->save();

        // actualizar roles
        if($request->has('role')){
            $user->syncRoles([$request->role]);
        }

        return redirect()->route('usuarios.index')
            ->with('success', 'El usuario se ha actualizado correctamente.');
    }

    public function usuariosActivar($id){
        
        $user = User::find($id);
        
        if(!$user){
            return redirect()->route('usuarios.index')
                ->with('error', 'El usuario no existe.');
        }

        $user->activo = 1;
        $user->save();

        return redirect()->route('usuarios.index')
            ->with('success', 'El usuario se ha activado correctamente.');
    }

    public function usuariosEliminar($id){
        
        $user = User::find($id);
        
        if(!$user){
            return redirect()->route('usuarios.index')
                ->with('error', 'El usuario no existe.');
        }

        $user->activo = 0;
        $user->save();

        return redirect()->route('usuarios.index')
            ->with('error', 'El usuario se ha inactivado correctamente.');
    }
}
