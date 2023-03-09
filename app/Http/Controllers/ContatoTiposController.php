<?php

namespace App\Http\Controllers;

use App\ContatoTipos;
use Illuminate\Http\Request;

class ContatoTiposController extends Controller
{
    /**
     * @var ContatoTipos
     */
    private $contatoTipos;

    public function __construct(ContatoTipos $contatoTipos)
    {
        $this->contatoTipos = $contatoTipos;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contatotipos.index');
    }

    /**
     * @return string
     */
    public function listar()
    {
        $response = $this->contatoTipos->all();

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

    /**
     * @param Request $request
     * @return array
     */
    public function salvar(Request $request)
    {
        $id = $request->input('id');
        if(!is_null($id)){
            $this->editar($request);
        }else{
            $contatoTipos = new ContatoTipos();
            $contatoTipos->fill($request->all());
            $contatoTipos->save();

            $response = response()->json(["contato_tipo" => $contatoTipos]);

            return [
                'status' => $response->getStatusCode(),
                'response' => json_decode($response)
            ];
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function editar(Request $request)
    {
        $contatoTipos = $this->contatoTipos->find($request->input('id'));
        $contatoTipos->descricao = $request->input('descricao');
        $contatoTipos->save();

        $response = response()->json(["contato_tipo" => $contatoTipos]);

        return [
            'status' => $response->getStatusCode(),
            'response' => json_decode($response)
        ];
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $response = $this->contatoTipos->find($id);

        return view('contatotipos.contatotipos',[
            'response' => $response
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cadastrar()
    {
        return view('contatotipos.contatotipos');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $contatoTipos = $this->contatoTipos->find($id);
        if(empty($contatoTipos))
            throw new \InvalidArgumentException('Tipo de contato não encontrado');

        $contatoTipos->delete();

        return response()->json(["mensagem" => "Excluido com sucesso"]);
    }
}
