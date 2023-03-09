<?php

namespace App\Http\Controllers;

use App\TipoClientes;
use Illuminate\Http\Request;

/**
 * Class TipoClientesController
 * @package App\Http\Controllers
 */
class TipoClientesController extends Controller
{
    /**
     * @var TipoClientes
     */
    private $tipoClientes;

    public function __construct(TipoClientes $tipoClientes)
    {
        $this->tipoClientes = $tipoClientes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tipoclientes.index');
    }

    public function listar()
    {
        $response = $this->tipoClientes->all();

        $data = [];
        if (isset($response[0]->descricao)) {
            foreach ($response as $tipo) {
                $data[] = [
                    'id' => $tipo->id,
                    'descricao' => $tipo->descricao
                ];
            }
        }

        return json_encode(["data" => $data]);
    }

    public function salvar(Request $request)
    {
        $tipoCliente = new TipoClientes();
        $tipoCliente->fill($request->all());
        $tipoCliente->save();

        $response = response()->json(["tipo_cliente" => $tipoCliente]);

        return [
            'status' => $response->getStatusCode(),
            'response' => json_decode($response)
        ];
    }

    public function editar(Request $request)
    {
        $tipoCliente = $this->tipoClientes->find($request->input('id'));
        $tipoCliente->descricao = $request->input('descricao');
        $tipoCliente->save();

        $response = response()->json(["tipo_cliente" => $tipoCliente]);

        return [
            'status' => $response->getStatusCode(),
            'response' => json_decode($response)
        ];
    }

    public function show($id)
    {
        $response = $this->tipoClientes->find($id);

        return view('tipoclientes.tipoclientes',[
            'response' => $response
        ]);
    }

    public function cadastrar()
    {
        return view('tipoclientes.tipoclientes');
    }

    public function destroy($id)
    {
        $tipoClientes = $this->tipoClientes->find($id);
        if(empty($tipoClientes))
            throw new \InvalidArgumentException('Tipo de cliente não encontrado');

        $tipoClientes->delete();

        return response()->json(["mensagem" => "Excluido com sucesso"]);
    }
}
