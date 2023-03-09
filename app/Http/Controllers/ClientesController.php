<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\Contatos;
use App\Enderecos;
use Illuminate\Http\Request;

class ClientesController extends Controller
{

    /**
     * @var Clientes
     */
    private $clientes;

    public function __construct(Clientes $clientes)
    {
        $this->clientes = $clientes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clientes.index');
    }

    /**
     * @return string
     */
    public function listar()
    {
        $response = $this->clientes->all();

        $data = [];
        if (isset($response[0]->id)) {
            foreach ($response as $cliente) {
                $data[] = [
                    'id' => $cliente->id,
                    'tipo_clientes_id' => $cliente->tipo_clientes_id,
                    'nome_razaoSocial' => $cliente->nome_razaoSocial,
                    'sobrenome_nomeFantasia' => $cliente->sobrenome_nomeFantasia,
                    'cnpj_cpf' => $cliente->cnpj_cpf,
                    'rg_inscricaoEstadual' => $cliente->rg_inscricaoEstadual,
                    'inscricao_municipal' => $cliente->inscricao_municipal,
                    'status' => ($cliente->status == 1 ? "Ativo" : "Inativo"),
                    'observacao' => $cliente->observacao,
                ];
            }
        }

        return json_encode(["data" => $data]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cadastrar()
    {
        return view('clientes.cadastro');
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
            $clientes = new Clientes();
            $clientes->fill($request->all());
            $clientes->tipo_clientes_id = 1;
            $clientes->observacao = $request->cliente_observacao;
            if(!$clientes->save()){
                throw new \InvalidArgumentException('Erro ao cadastrar novo Cliente');
            }

            $contatos = new Contatos();
            $contatos->fill($request->all());
            $contatos->clientes_id = $clientes->id;
            $contatos->contato_tipos_id = 1;
            $contatos->observacao = $request->contato_observacao;
            $contatos->save();

            $enderecos = new Enderecos();
            $enderecos->fill($request->all());
            $enderecos->clientes_id = $clientes->id;
            $enderecos->observacao = $request->endereco_observacao;
            $enderecos->save();

            $response = response()->json(["clientes" => $clientes]);

            return [
                'status' => $response->getStatusCode(),
                'response' => json_decode($response)
            ];
        }
    }

    /**
     * @param $clienteId
     * @return string
     */
    public function contatos($clienteId)
    {
        $response = $this->clientes->find($clienteId)->contatos;

        $data = [];
        if (isset($response[0]->id)) {
            foreach ($response as $contato) {
                $data[] = [
                    'id' => $contato->id,
                    'contato_tipos_id' => $contato->contato_tipos_id,
                    'nome' => $contato->nome,
                    'email' => $contato->email,
                    'telefone1' => $contato->telefone1,
                    'telefone2' => $contato->telefone2,
                    'celular' => $contato->celular,
                    'status' => ($contato->status == 1 ? "Ativo" : "Inativo"),
                    'observacao' => $contato->observacao,
                ];
            }
        }

        return json_encode(["data" => $data]);
    }

    /**
     * @param $clienteId
     * @return string
     */
    public function enderecos($clienteId)
    {
        $response = $this->clientes->find($clienteId)->enderecos;

        $data = [];
        if (isset($response[0]->id)) {
            foreach ($response as $endereco) {
                $data[] = [
                    'id' => $endereco->id,
                    'logradouro' => $endereco->logradouro,
                    'numero' => $endereco->numero,
                    'complemento' => $endereco->complemento,
                    'bairro' => $endereco->bairro,
                    'cidade' => $endereco->cidade,
                    'uf' => $endereco->uf,
                    'cep' => $endereco->cep,
                    'status' => ($endereco->status == 1 ? "Ativo" : "Inativo"),
                    'observacao' => $endereco->observacao,
                ];
            }
        }

        return json_encode(["data" => $data]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $response = $this->clientes->find($id);

        return view('clientes.editar',[
            'response' => $response
        ]);
    }
}
