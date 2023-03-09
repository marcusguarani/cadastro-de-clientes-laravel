@extends('adminlte::page')

@section('title', 'SeuNome')

@section('content_header')
    {{--<h3>Clientes</h3>--}}
@stop

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box-body">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Clientes</h3>
                    </div>
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-4">
                                <button id="btn_novo_cliente" class="btn btn-primary btn-sm" >
                                    <span class="glyphicon glyphicon-plus"></span>
                                    Novo
                                </button>
                            </div>
                        </div>

                        <table id="tb_clientes" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Razão Social</th>
                                <th>Fantasia</th>
                                <th>CNPJ</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('js')

    <script>

        $(function () {

            main.iniView();

            $('#tb_clientes').DataTable({
                "ajax": "clientes/listar",
                "columns": [
                    {"data": "nome_razaoSocial"},
                    {"data": "sobrenome_nomeFantasia"},
                    {"data": "cnpj_cpf"},
                    {"data": "status"},
                    {"data": "id", "width": 15, "sClass": "grid-column-value-nowrap-button"}
                ],
                "destroy": true,
                'paging': true,
                'lengthChange': false,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false,
                "fnRowCallback": function (nRow) {
                    var val = $('td:eq(4)', nRow).html();
                    $('td:eq(4)', nRow).html("<button class='btn btn-info btn-sm' value='" + val + "' title='Visualizar'><span class='glyphicon glyphicon-search'></span></button>");
                },
                "fnDrawCallback": function (oSettings) {
                    $(".grid-column-value-nowrap-button").on('click', 'button', function () {
                        var clienteId = $(this).val();
                        modal.open_n("clientes/show/" + clienteId, 'Editar cliente', 70);
                    });
                }
            });

            $('#btn_novo_cliente').click(function () {
                modal.open_n("clientes/cadastrar", 'Novo cliente', 70);
            });

        });

    </script>

@stop
