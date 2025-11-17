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
});