<?php

namespace App\Http\Controllers;

use App\Contatos;
use Illuminate\Http\Request;

class ContatosController extends Controller
{


    private $contatos;

    public function __construct(Contatos $contatos)
    {
        $this->contatos = $contatos;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * @return string
     */
    public function listar()
    {
        $response = $this->contatos->all();

        $data = [];
        if (isset($response[0]->id)) {
            foreach ($response as $tipo) {
                $data[] = [
                    'nome' => $tipo->nome,
                    'email' => $tipo->email
                ];
            }
        }

        return json_encode(["data" => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contatos  $contatos
     * @return \Illuminate\Http\Response
     */
    public function show(Contatos $contatos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contatos  $contatos
     * @return \Illuminate\Http\Response
     */
    public function edit(Contatos $contatos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contatos  $contatos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contatos $contatos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contatos  $contatos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contatos $contatos)
    {
        //
    }
}
