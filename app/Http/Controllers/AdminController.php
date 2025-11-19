<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BarrenosPlan;
use App\Models\ConfigEmpresa;
use App\Models\ConfigKw;
use App\Models\ConfigPi;
use App\Models\Equipo;
use App\Models\Ldap;
use App\Models\Molienda;
use App\Models\MoliendaConfiguracion;
use App\Models\Tags;
use App\Models\User;

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

        $roles = Role::query()->where('name', '<>', 'sa')->get();
        
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
            'authen' => $request->authen,
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
                'id' => 'required|exists:molienda_turno,id',
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
        $molienda->plan = $request->plan;

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

    /************************************************* */
    /******************* Barrenación ***************** */
    /************************************************* */
    public function barrenacionIndex(){
        
        $equipos = Equipo::where('activo', 1)->where('tipo', 'Perforadora')->get();
        $empresa = ConfigEmpresa::first();
        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        return view('admin.barrenacion.index', compact('empresa', 'equipos'));
    }

    public function barrenacionTabla($id){
        
        $anio = date('Y');
        $empresa = ConfigEmpresa::first();
        $equipo = Equipo::find($id);
        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }
        
        $enero = BarrenosPlan::whereMonth('fecha', 1)->whereYear('fecha', $anio)->where('equipo_id', $id)->orderBy('fecha')->get();
        $febrero = BarrenosPlan::whereMonth('fecha', 2)->whereYear('fecha', $anio)->where('equipo_id', $id)->orderBy('fecha')->get();
        $marzo = BarrenosPlan::whereMonth('fecha', 3)->whereYear('fecha', $anio)->where('equipo_id', $id)->orderBy('fecha')->get();
        $abril = BarrenosPlan::whereMonth('fecha', 4)->whereYear('fecha', $anio)->where('equipo_id', $id)->orderBy('fecha')->get();
        $mayo = BarrenosPlan::whereMonth('fecha', 5)->whereYear('fecha', $anio)->where('equipo_id', $id)->orderBy('fecha')->get();
        $junio = BarrenosPlan::whereMonth('fecha', 6)->whereYear('fecha', $anio)->where('equipo_id', $id)->orderBy('fecha')->get();
        $julio = BarrenosPlan::whereMonth('fecha', 7)->whereYear('fecha', $anio)->where('equipo_id', $id)->orderBy('fecha')->get();
        $agosto = BarrenosPlan::whereMonth('fecha', 8)->whereYear('fecha', $anio)->where('equipo_id', $id)->orderBy('fecha')->get();
        $septiembre = BarrenosPlan::whereMonth('fecha', 9)->whereYear('fecha', $anio)->where('equipo_id', $id)->orderBy('fecha')->get();
        $octubre = BarrenosPlan::whereMonth('fecha', 10)->whereYear('fecha', $anio)->where('equipo_id', $id)->orderBy('fecha')->get();
        $noviembre = BarrenosPlan::whereMonth('fecha', 11)->whereYear('fecha', $anio)->where('equipo_id', $id)->orderBy('fecha')->get();
        $diciembre = BarrenosPlan::whereMonth('fecha', 12)->whereYear('fecha', $anio)->where('equipo_id', $id)->orderBy('fecha')->get();

        return view('admin.barrenacion.tablaIndex', compact('empresa', 'equipo', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'));
    }

    public function barrenacionNuevo($id){
        
        $empresa = ConfigEmpresa::first();
        $equipo = Equipo::find($id);
        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        return view('admin.barrenacion.crear', compact('empresa', 'equipo'));
    }

    public function barrenacionStore(Request $request){
        
        $request->validate(
            [
                'equipo_id' => 'required|exists:equipos,id',
                'barrenos_plan' => 'required|numeric',
                'fecha_inicio' => 'required|date',
                'fecha_final' => 'required|date|after_or_equal:fecha_inicio',
            ],
            [
                'equipo_id.required' => 'El campo Equipo es obligatorio.',
                'equipo_id.exists' => 'El Equipo no existe.',
                'barrenos_plan.required' => 'El campo Plan de Barrenos es obligatorio.',
                'barrenos_plan.numeric' => 'El campo Plan de Barrenos debe ser un número.',
                'fecha_inicio.required' => 'El campo Fecha Inicial es obligatorio.',
                'fecha_inicio.date' => 'El campo Fecha Inicial debe ser una fecha válida.',
                'fecha_final.required' => 'El campo Fecha Final es obligatorio.',
                'fecha_final.date' => 'El campo Fecha Final debe ser una fecha válida.',
                'fecha_final.after_or_equal' => 'El campo Fecha Final debe ser una fecha posterior o igual a la Fecha Inicial.',
            ]
        );
        //return $request->all();

        $start = strtotime($request->fecha_inicio);
        $end = strtotime($request->fecha_final);

        for ($i = $start; $i <= $end; $i += 86400) {
            $date = date('Y-m-d', $i);

            BarrenosPlan::updateOrCreate(
                [
                    'equipo_id' => $request->equipo_id,
                    'fecha' => $date,
                ],
                [
                    'barrenos_plan' => $request->barrenos_plan,
                    'fecha' => $date,
                    'activo' => 1,
                ]
        );
        }

        return redirect()->route('barrenacion.tabla', $request->equipo_id)
            ->with('success', 'El plan de barrenación se ha creado correctamente.');
    }

    public function barrenacionEditar($id){
        
        $empresa = ConfigEmpresa::first();
        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        $data = BarrenosPlan::find($id);
        if(!$data){
            return redirect()->route('barrenacion.index')
                ->with('error', 'El registro de barrenación no existe.');
        }

        return view('admin.barrenacion.editar', compact('empresa', 'data'));
    }

    public function barrenacionUpdate(Request $request){
        
        $request->validate(
            [
                'id' => 'required|exists:barrenos_plan,id',
                'barrenos_plan' => 'required|numeric',
                'fecha' => 'required|date',
            ],
            [
                'id.required' => 'El registro es obligatorio.',
                'id.exists' => 'El registro no existe.',
                'barrenos_plan.required' => 'El campo Plan de Barrenos es obligatorio.',
                'barrenos_plan.numeric' => 'El campo Plan de Barrenos debe ser un número.',
                'fecha.required' => 'El campo Fecha es obligatorio.',
                'fecha.date' => 'El campo Fecha debe ser una fecha válida.',
            ]
        );
        //return $request->all();

        $data = BarrenosPlan::find($request->id);

        $data->barrenos_plan = $request->barrenos_plan;
        //$data->fecha = $request->fecha;

        $data->save();

        return redirect()->route('barrenacion.tabla', $data->equipo_id)
            ->with('success', 'El registro de barrenación se ha actualizado correctamente.');
    }

    /************************************************* */
    /************************ PI ********************* */
    /************************************************* */
    public function piIndex(){
        
        $empresa = ConfigEmpresa::first();
        $data = ConfigPi::first();
        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        return view('admin.pi.index', compact('empresa', 'data'));
    }

    public function piEditar($id){
        
        $empresa = ConfigEmpresa::first();
        $data = ConfigPi::find($id);
        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        return view('admin.pi.editar', compact('empresa', 'data'));
    }

    public function piUpdate(Request $request){

        $request->validate(
            [
                'id' => 'required|exists:config_pi,id',
                'ip_pi' => 'required',
                'port_pi' => 'required|numeric',
                'ip_af' => 'required',
                'port_af' => 'required|numeric',
            ],
            [
                'id.required' => 'El registro es obligatorio.',
                'id.exists' => 'El registro no existe.',
                'ip_pi.required' => 'El campo IP es obligatorio.',
                'port_pi.required' => 'El campo Puerto es obligatorio.',
                'port_pi.numeric' => 'El campo Puerto debe ser un número.',
                'ip_af.required' => 'El campo IP AF es obligatorio.',
                'port_af.required' => 'El campo Puerto AF es obligatorio.',
                'port_af.numeric' => 'El campo Puerto AF debe ser un número.',
            ]
        );
        
        $data = ConfigPi::find($request->id);

        $data->ip_pi = $request->ip_pi;
        $data->port_pi = $request->port_pi;
        $data->ip_af = $request->ip_af;
        $data->port_af = $request->port_af;
        $data->user = $request->user;
        $data->password = $request->password;
        $data->activo = $request->has('activo') ? 1 : 0;

        $data->save();

        return redirect()->route('pi.index')
            ->with('success', 'Los datos se han actualizado correctamente.');
    }

    public function piTags(){
        
        $empresa = ConfigEmpresa::first();
        $data = Tags::all();
        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        return view('admin.pi.tags', compact('empresa', 'data'));
    }

    public function piTagsEdit($id){
        
        $empresa = ConfigEmpresa::first();
        $data = Tags::find($id);
        if($empresa == null){
            $empresa = '';
        }else{
            $empresa = $empresa->nombre_empresa;
        }

        return view('admin.pi.editTag', compact('empresa', 'data'));
    }

    public function piTagsUpdate(Request $request){
        
        $request->validate(
            [
                'id' => 'required|exists:tags,id',
                'tag_name' => 'required',
            ],
            [
                'id.required' => 'El registro es obligatorio.',
                'id.exists' => 'El registro no existe.',
                'tag_name.required' => 'El campo Nombre del Tag es obligatorio.',
            ]
        );
        
        $pi = ConfigPi::find(1);
        $data = Tags::find($request->id);

        $data->tag = $request->tag;
        $data->description = $request->description;

        if($pi->activo){
            $webId = getWebId($request->tag, $pi->ip_pi, $pi->ip_af, $pi->user, $pi->password);
            $data->webid = $webId;
        }
        $data->save();

        return redirect()->route('pi.tags')
            ->with('success', 'Los datos del tag se han actualizado correctamente.');
    }
}