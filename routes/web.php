<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

Route::controller(DashboardController::class)->group(function(){

    // Ruta Principal
    Route::get('/','index')
        ->name('index');

    // Login
    Route::get('/login','loginIndex')
        ->name('loginIndex');
        
    // Login
    Route::post('/login','login')
        ->name('login');

    // Logout
    Route::get('/logout','logout')
        ->name('logout');

    // Admin
    Route::get('/admin','adminIndex')
        ->name('admin.index');

});

Route::controller(AdminController::class)
    ->group(function(){

    /************************************ */
    /************ Energía *************** */
    /************************************ */
    Route::get('/energia','energiaIndex')
        ->name('energia.index');

    Route::get('/energia/editar','energiaEditar')
        ->name('energia.editar');

    Route::post('/energia/update','energiaUpdate')
        ->name('energia.update');

    /************************************* */
    /************ Usuarios *************** */
    /************************************* */
    Route::get('/usuarios', 'usuariosIndex')
        ->name('usuarios.index');

    Route::get('/usuarios/crear', 'usuariosCrear')
        ->name('usuarios.crear');

    Route::post('/usuarios/store', 'usuariosStore')
        ->name('usuarios.store');

    Route::get('/usuarios/editar/{id}', 'usuariosEditar')
        ->name('usuarios.editar');
        
    Route::post('/usuarios/update', 'usuariosUpdate')
        ->name('usuarios.update');

    Route::get('/usuarios/eliminar/{id}', 'usuariosEliminar')
        ->name('usuarios.eliminar');

    Route::get('/usuarios/activar/{id}', 'usuariosActivar')
        ->name('usuarios.activar');

    /************************************ */
    /************* LDAP ***************** */
    /************************************ */
    Route::get('/ldap','ldapIndex')
        ->name('ldap.index');

    Route::get('/ldap/editar','ldapEditar')
        ->name('ldap.editar');

    Route::put('/ldap/update','ldapUpdate')
        ->name('ldap.update');

    /************************************* */
    /************ Equipos *************** */
    /************************************* */
    Route::get('/equipos', 'equiposIndex')
        ->name('equipos.index');

    Route::get('/equipos/crear', 'equiposCrear')
        ->name('equipos.crear');

    Route::post('/equipos/store', 'equiposStore')
        ->name('equipos.store');

    Route::get('/equipos/editar/{id}', 'equiposEditar')
        ->name('equipos.editar');
        
    Route::post('/equipos/update', 'equiposUpdate')
        ->name('equipos.update');

    Route::get('/equipos/eliminar/{id}', 'equiposEliminar')
        ->name('equipos.eliminar');

    Route::get('/equipos/activar/{id}', 'equiposActivar')
        ->name('equipos.activar');

    /************************************* */
    /************ Molienda *************** */
    /************************************* */
    Route::get('/molienda', 'moliendaIndex')
        ->name('molienda.index');

    Route::get('/molienda/editar/{id}', 'moliendaEditar')
        ->name('molienda.editar');

    Route::post('/molienda/update', 'moliendaUpdate')
        ->name('molienda.update');

    Route::get('/molienda/configuracion', 'moliendaConfiguracion')
        ->name('molienda.configuracion');

    Route::get('/molienda/configuracion/editar', 'moliendaConfiguracionEditar')
        ->name('molienda.configuracion.editar');

    Route::post('/molienda/configuracion/update', 'moliendaConfiguracionUpdate')
        ->name('molienda.configuracion.update');

    /************************************* */
    /************ Barrenación ************ */
    /************************************* */
    Route::get('/barrenacion', 'barrenacionIndex')
        ->name('barrenacion.index');

    Route::get('/barrenacion/tabla/{id}', 'barrenacionTabla')
        ->name('barrenacion.tabla');

    Route::get('/barrenacion/nuevo/{id}', 'barrenacionNuevo')
        ->name('barrenacion.nuevo');

    Route::post('/barrenacion/store', 'barrenacionStore')
        ->name('barrenacion.store');

    Route::get('/barrenacion/editar/{id}', 'barrenacionEditar')
        ->name('barrenacion.editar');

    Route::post('/barrenacion/update', 'barrenacionUpdate')
        ->name('barrenacion.update');

    Route::get('/barrenacion/configuracion', 'barrenacionConfiguracion')
        ->name('barrenacion.configuracion');

    Route::get('/barrenacion/configuracion/editar', 'barrenacionConfiguracionEditar')
        ->name('barrenacion.configuracion.editar');

    Route::post('/barrenacion/configuracion/update', 'barrenacionConfiguracionUpdate')
        ->name('barrenacion.configuracion.update');

    /************************************* */
    /**************** PI ***************** */
    /************************************* */
    Route::get('/pi', 'piIndex')
        ->name('pi.index');
    
    Route::get('/pi/editar/{id}', 'piEditar')
        ->name('pi.editar');

    Route::post('/pi/update/', 'piUpdate')
        ->name('pi.update');
});