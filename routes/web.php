<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('tipoclientes')->group(function () {

    Route::get('/', 'TipoClientesController@index')->name('tipoclientes.index');
    Route::get('listar', 'TipoClientesController@listar')->name('tipoclientes.listar');
    Route::get('show/{id}', 'TipoClientesController@show')->name('tipoclientes.show');
    Route::get('cadastrar', 'TipoClientesController@cadastrar')->name('tipoclientes.cadastrar');
    Route::post('salvar', 'TipoClientesController@salvar')->name('tipoclientes.salvar');
    Route::post('editar', 'TipoClientesController@editar')->name('tipoclientes.editar');

});

Route::prefix('clientes')->group(function () {

    Route::get('/', 'ClientesController@index')->name('clientes.index');
    Route::get('listar', 'ClientesController@listar')->name('clientes.listar');
    Route::get('show/{id}', 'ClientesController@show')->name('clientes.show');
    Route::get('{id}/enderecos', 'ClientesController@enderecos')->name('clientes.enderecos');
    Route::get('{id}/contatos', 'ClientesController@contatos')->name('clientes.contatos');
    Route::get('cadastrar', 'ClientesController@cadastrar')->name('clientes.cadastrar');
    Route::post('salvar', 'ClientesController@salvar')->name('clientes.salvar');
    Route::post('editar', 'ClientesController@editar')->name('clientes.editar');

});

Route::prefix('contatotipos')->group(function () {

    Route::get('/', 'ContatoTiposController@index')->name('contatotipos.index');
    Route::get('listar', 'ContatoTiposController@listar')->name('contatotipos.listar');
    Route::get('show/{id}', 'ContatoTiposController@show')->name('contatotipos.show');
    Route::get('cadastrar', 'ContatoTiposController@cadastrar')->name('contatotipos.cadastrar');
    Route::post('salvar', 'ContatoTiposController@salvar')->name('contatotipos.salvar');
    Route::post('editar', 'ContatoTiposController@editar')->name('contatotipos.editar');

});

Route::prefix('contatos')->group(function () {

    Route::get('/', 'ContatosController@index')->name('contatos.index');
    Route::get('listar', 'ContatosController@listar')->name('contatos.listar');
    Route::get('show/{id}', 'ContatosController@show')->name('contatos.show');
    Route::get('cadastrar', 'ContatosController@cadastrar')->name('contatos.cadastrar');
    Route::post('salvar', 'ContatosController@salvar')->name('contatos.salvar');
    Route::post('editar', 'ContatosController@editar')->name('contatos.editar');

});

Route::prefix('enderecotipos')->group(function () {

    Route::get('/', 'EnderecoTiposController@index')->name('enderecotipos.index');
    Route::get('listar', 'EnderecoTiposController@listar')->name('enderecotipos.listar');
    Route::get('show/{id}', 'EnderecoTiposController@show')->name('enderecotipos.show');
    Route::get('cadastrar', 'EnderecoTiposController@cadastrar')->name('enderecotipos.cadastrar');
    Route::post('salvar', 'EnderecoTiposController@salvar')->name('enderecotipos.salvar');
    Route::post('editar', 'EnderecoTiposController@editar')->name('enderecotipos.editar');

});

Route::prefix('enderecos')->group(function () {

    Route::get('/', 'EnderecosController@index')->name('enderecos.index');
    Route::get('listar', 'EnderecosController@listar')->name('enderecos.listar');
    Route::get('show/{id}', 'EnderecosController@show')->name('enderecos.show');
    Route::get('cadastrar', 'EnderecosController@cadastrar')->name('enderecos.cadastrar');
    Route::post('salvar', 'EnderecosController@salvar')->name('enderecos.salvar');
    Route::post('editar', 'EnderecosController@editar')->name('enderecos.editar');

});

