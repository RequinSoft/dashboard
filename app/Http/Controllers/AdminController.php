<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\ConfigEmpresa;
use App\Models\ConfigKw;
use App\Models\Ldap;
use App\Models\Equipo;
use App\Models\Molienda;
use App\Models\MoliendaConfiguracion;

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
        $ldap = Ldap::first();

        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        $roles = Role::all();
        
        return view('admin.users.crear', compact('empresa', 'roles', 'ldap'));
    }

    public function usuariosStore(Request $request){
        
        $request->validate(
            [
                'user' => 'required|unique:users,user',
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
            ],
            [
                'user.required' => 'El campo Usuario es obligatorio.',
                'user.unique' => 'El Usuario ya está en uso.',
                'name.required' => 'El campo Nombre Completo es obligatorio.',
                'email.required' => 'El campo Email es obligatorio.',
                'email.email' => 'El campo Email debe ser una dirección de correo electrónico válida.',
                'email.unique' => 'El Email ya está en uso.',
            ]
        );
        //return $request->all();
        if($request->password){
            $request->validate(
                [
                    'password' => 'required|min:6',
                    'password_confirmation' => 'required|same:password',
                ],
                [
                    'password.required' => 'El campo Contraseña es obligatorio.',
                    'password.min' => 'El campo Contraseña debe tener al menos 6 caracteres.',
                    'password_confirmation.required' => 'El campo Confirmar Contraseña es obligatorio.',
                    'password_confirmation.same' => 'El campo Confirmar Contraseña debe coincidir con la Contraseña.',
                ]
            );
        }

        $data = [
            'user' => $request->user,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'authen' => $request->auth,
            'activo' => 1,
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
        $ldap = Ldap::first();

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

        return view('admin.users.editar', compact('empresa', 'user', 'roles', 'ldap'));
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
        $user->authen = $request->authen;

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

    /************************************************* */
    /******************** LDAP *********************** */
    /************************************************* */
    public function ldapIndex(){
        
        $empresa = ConfigEmpresa::first();
        $data = Ldap::first();

        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }
        if($data == null){
            $data = (object)[
                'ip' => '',
                'port' => '',
                'domain' => '',
                'base_dn' => '',
                'user' => '',
                'password' => '',
                'version' => '',
                'status' => 0,
            ];
        }


        return view('admin.ldap.index', compact('data', 'empresa'));
    }

    public function ldapEditar(){
        
        $empresa = ConfigEmpresa::first();
        $data = Ldap::first();

        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }
        if($data == null){
            $data = (object)[
                'ip' => '',
                'port' => '',
                'domain' => '',
                'base_dn' => '',
                'user' => '',
                'password' => '',
                'version' => '',
                'status' => 0,
            ];
        }


        return view('admin.ldap.editar', compact('data', 'empresa'));
    }

    public function ldapUpdate(Request $request){
        $request->validate(
            [
                'ip' => 'required',
                'port' => 'required|numeric',
                'domain' => 'required|string',
            ],
            [
                'ip.required' => 'El campo IP es obligatorio.',
                'port.required' => 'El campo Puerto es obligatorio.',
                'port.numeric' => 'El campo Puerto debe ser un número.',
            ]
        );
        
        Ldap::updateOrCreate(
            ['id' => 1],
            [
                'ip' => $request->ip,
                'port' => $request->port,
                'domain' => $request->domain,
                'base_dn' => $request->base_dn,
                'user' => $request->user,
                'password' => $request->password,
                'version' => $request->version,
                'status' => $request->has('status') ? 1 : 0,
            ]
        );

        return redirect()->route('ldap.index')
            ->with('success', 'Los datos se han actualizado correctamente.');
    }

    /************************************************* */
    /****************** Equipos ********************** */
    /************************************************* */
    public function equiposIndex(){
        
        $empresa = ConfigEmpresa::first();
        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        $equipos = Equipo::all();

        return view('admin.equipos.index', compact('empresa', 'equipos'));
    }

    public function equiposCrear(){
        
        $empresa = ConfigEmpresa::first();

        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        return view('admin.equipos.crear', compact('empresa'));
    }

    public function equiposStore(Request $request){
        
        $request->validate(
            [
                'name' => 'required|unique:equipos,name',
                'tipo' => 'required',
            ],
            [
                'name.required' => 'El campo Equipo es obligatorio.',
                'name.unique' => 'El Equipo ya está en uso.',
                'tipo.required' => 'El campo Tipo es obligatorio.',
                'image.image' => 'El campo Imagen debe ser una imagen.',
                'image.mimes' => 'El campo Imagen debe ser un archivo de tipo: jpeg, png, jpg.',
                'image.max' => 'El campo Imagen no debe ser mayor de 2MB.',
            ]
        );
        //return $request->all();

        $data = [
            'name' => $request->name,
            'tipo' => $request->tipo,
        ];

        if($request->has('image')){
            $file = $request->file('image');
            $imagePath = $file->storeAs('avatars', $file->getClientOriginalName(), 'public');
            // guardar nombre original del archivo
            $imageFilename = $file->getClientOriginalName();
            $data['image'] = $imageFilename;
        }
        
        $equipo = Equipo::create($data);

        return redirect()->route('equipos.index')
            ->with('success', 'El equipo se ha creado correctamente.');
    }

    public function equiposEditar($id){
        
        $empresa = ConfigEmpresa::first();
        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        $equipo = Equipo::find($id);
        if(!$equipo){
            return redirect()->route('equipos.index')
                ->with('error', 'El equipo no existe.');
        }

        return view('admin.equipos.editar', compact('empresa', 'equipo'));
    }

    public function equiposUpdate(Request $request){
        
        $request->validate(
            [
                'id' => 'required|exists:equipos,id',
                'name' => 'required|unique:equipos,name,'.$request->id,
                'tipo' => 'required',
            ],
            [
                'id.required' => 'El equipo es obligatorio.',
                'id.exists' => 'El equipo no existe.',
                'name.required' => 'El campo Equipo es obligatorio.',
                'name.unique' => 'El Equipo ya está en uso.',
                'tipo.required' => 'El campo Tipo es obligatorio.',
                'image.image' => 'El campo Imagen debe ser una imagen.',
                'image.mimes' => 'El campo Imagen debe ser un archivo de tipo: jpeg, png, jpg.',
                'image.max' => 'El campo Imagen no debe ser mayor de 2MB.',
            ]
        );
        //return $request->all();

        $equipo = Equipo::find($request->id);

        $equipo->name = $request->name;
        $equipo->tipo = $request->tipo;

        if($request->has('image')){
            $file = $request->file('image');
            $imagePath = $file->storeAs('avatars', $file->getClientOriginalName(), 'public');
            // guardar nombre original del archivo
            $imageFilename = $file->getClientOriginalName();
            $equipo->image = $imageFilename;
        }


        if($request->has('image')){
            $file = $request->file('image');
            $imagePath = $file->storeAs('avatars', $file->getClientOriginalName(), 'public');
            // guardar nombre original del archivo
            $imageFilename = $file->getClientOriginalName();
            $equipo->image = $imageFilename;
        }

        $equipo->save();

        return redirect()->route('equipos.index')
            ->with('success', 'El equipo se ha actualizado correctamente.');
    }

    public function equiposActivar($id){
        
        $equipo = Equipo::find($id);
        
        if(!$equipo){
            return redirect()->route('equipos.index')
                ->with('error', 'El equipo no existe.');
        }

        $equipo->activo = 1;
        $equipo->save();

        return redirect()->route('equipos.index')
            ->with('success', 'El equipo se ha activado correctamente.');
    }

    public function equiposEliminar($id){
        
        $equipo = Equipo::find($id);
        
        if(!$equipo){
            return redirect()->route('equipos.index')
                ->with('error', 'El equipo no existe.');
        }

        $equipo->activo = 0;
        $equipo->save();

        return redirect()->route('equipos.index')
            ->with('error', 'El equipo se ha inactivado correctamente.');
    }

    /************************************************* */
    /****************** Molienda ********************* */
    /************************************************* */
    public function moliendaIndex(){
        
        $anio = date('Y');
        $empresa = ConfigEmpresa::first();
        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        $enero = Molienda::whereMonth('fecha', 1)->whereYear('fecha', $anio)->orderBy('fecha')->get();
        $febrero = Molienda::whereMonth('fecha', 2)->whereYear('fecha', $anio)->orderBy('fecha')->get();
        $marzo = Molienda::whereMonth('fecha', 3)->whereYear('fecha', $anio)->orderBy('fecha')->get();
        $abril = Molienda::whereMonth('fecha', 4)->whereYear('fecha', $anio)->orderBy('fecha')->get();
        $mayo = Molienda::whereMonth('fecha', 5)->whereYear('fecha', $anio)->orderBy('fecha')->get();
        $junio = Molienda::whereMonth('fecha', 6)->whereYear('fecha', $anio)->orderBy('fecha')->get();
        $julio = Molienda::whereMonth('fecha', 7)->whereYear('fecha', $anio)->orderBy('fecha')->get();
        $agosto = Molienda::whereMonth('fecha', 8)->whereYear('fecha', $anio)->orderBy('fecha')->get();
        $septiembre = Molienda::whereMonth('fecha', 9)->whereYear('fecha', $anio)->orderBy('fecha')->get();
        $octubre = Molienda::whereMonth('fecha', 10)->whereYear('fecha', $anio)->orderBy('fecha')->get();
        $noviembre = Molienda::whereMonth('fecha', 11)->whereYear('fecha', $anio)->orderBy('fecha')->get();
        $diciembre = Molienda::whereMonth('fecha', 12)->whereYear('fecha', $anio)->orderBy('fecha')->get();

        //return $enero;
        
        return view('admin.molienda.index', compact('empresa', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'));
    }

    public function moliendaEditar($id){
        
        $empresa = ConfigEmpresa::first();
        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        $molienda = Molienda::find($id);
        if(!$molienda){
            return redirect()->route('molienda.index')
                ->with('error', 'El registro de molienda no existe.');
        }

        return view('admin.molienda.editar', compact('empresa', 'molienda'));
    }

    public function moliendaUpdate(Request $request){
        
        $request->validate(
            [
                'id' => 'required|exists:moliendas,id',
                'fecha' => 'required|date',
                'plan' => 'required|numeric',
            ],
            [
                'id.required' => 'El registro es obligatorio.',
                'id.exists' => 'El registro no existe.',
                'fecha.required' => 'El campo Fecha es obligatorio.',
                'fecha.date' => 'El campo Fecha debe ser una fecha válida.',
                'plan.required' => 'El campo Toneladas es obligatorio.',
                'plan.numeric' => 'El campo Toneladas debe ser un número.',
            ]
        );
        //return $request->all();

        $molienda = Molienda::find($request->id);

        $molienda->fecha = $request->fecha;
        $molienda->toneladas = $request->toneladas;
        $molienda->humedad = $request->humedad;

        $molienda->save();

        return redirect()->route('molienda.index')
            ->with('success', 'El registro de molienda se ha actualizado correctamente.');
    }

    public function moliendaConfiguracion(){
        
        $empresa = ConfigEmpresa::first();
        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        $data = MoliendaConfiguracion::first();

        return view('admin.molienda.configuracion', compact('empresa', 'data'));
    }

    public function moliendaConfiguracionEditar(){
        
        $empresa = ConfigEmpresa::first();
        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        $data = MoliendaConfiguracion::first();

        return view('admin.molienda.configuracionEdit', compact('empresa', 'data'));
    }

    public function moliendaConfiguracionUpdate(Request $request){
        
        $request->validate(
            [
                'plan' => 'required|numeric',
            ],
            [
                'plan.required' => 'El campo Plan es obligatorio.',
                'plan.numeric' => 'El campo Plan debe ser un número.',
            ]
        );

        $data = MoliendaConfiguracion::first();

        if(!$data){
            $data = new MoliendaConfiguracion();
        }

        $data->plan = $request->plan;
        if($request->has('activo')){
            $data->activo = 1;
        }else{
            $data->activo = 0;
        }

        $data->save();

        return redirect()->route('molienda.configuracion')
            ->with('success', 'La configuración de molienda se ha actualizado correctamente.');
    }
}