<?php

namespace App\Http\Controllers;

use App\EnderecoTipos;
use Illuminate\Http\Request;

class EnderecoTiposController extends Controller
{
    /**
     * @var enderecotipos
     */
    private $enderecotipos;

    public function __construct(enderecotipos $enderecotipos)
    {
        $this->enderecotipos = $enderecotipos;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('enderecotipos.index');
    }

    public function listar()
    {
        $response = $this->enderecotipos->all();

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
        $id = $request->input('id');
        if(!is_null($id)){
            $this->editar($request);
        }else{
            $enderecotipos = new enderecotipos();
            $enderecotipos->fill($request->all());
            $enderecotipos->save();

            $response = response()->json(["endereco_tipo" => $enderecotipos]);

            return [
                'status' => $response->getStatusCode(),
                'response' => json_decode($response)
            ];
        }
    }

    public function editar(Request $request)
    {
        $enderecotipos = $this->enderecotipos->find($request->input('id'));
        $enderecotipos->descricao = $request->input('descricao');
        $enderecotipos->save();

        $response = response()->json(["endereco_tipo" => $enderecotipos]);

        return [
            'status' => $response->getStatusCode(),
            'response' => json_decode($response)
        ];
    }

    public function show($id)
    {
        $response = $this->enderecotipos->find($id);

        return view('enderecotipos.enderecotipos',[
            'response' => $response
        ]);
    }

    public function cadastrar()
    {
        return view('enderecotipos.enderecotipos');
    }

    public function destroy($id)
    {
        $enderecotipos = $this->enderecotipos->find($id);
        if(empty($enderecotipos))
            throw new \InvalidArgumentException('Tipo de endereco não encontrado');

        $enderecotipos->delete();

        return response()->json(["mensagem" => "Excluido com sucesso"]);
    }
}
