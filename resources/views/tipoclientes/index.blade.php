@extends('adminlte::page')

@section('title', 'SeuNome')

@section('content_header')
    {{--<h3>Tipo de Clientes</h3>--}}
@stop

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box-body">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tipo de Cliente</h3>
                    </div>
                    <div class="box-body">

                        <div class="row" style="margin-bottom: 10px">
                            <div class="col-md-4">
                                <button id="btn_novo_tipo" class="btn btn-primary btn-sm" >
                                    <span class="glyphicon glyphicon-plus"></span>
                                    Novo
                                </button>
                            </div>
                        </div>

                        <table id="tb_tipoclientes" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Descrição</th>
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

        main.iniView();

        $(function () {

            $('#tb_tipoclientes').DataTable({
                "ajax": "tipoclientes/listar",
                "columns": [
                    {"data": "descricao"},
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
                    var val = $('td:eq(1)', nRow).html();
                    $('td:eq(1)', nRow).html("<button class='btn btn-info btn-sm' value='" + val + "' title='Visualizar'><span class='glyphicon glyphicon-search'></span></button>");
                },
                "fnDrawCallback": function (oSettings) {
                    $(".grid-column-value-nowrap-button").on('click', 'button', function () {
                        var tipoId = $(this).val();
                        modal.open_n("tipoclientes/show/" + tipoId, 'Editar Tipo de Cliente', 40);
                    });
                }
            });

            $('#btn_novo_tipo').click(function () {
                modal.open_n("tipoclientes/cadastrar", 'Novo Tipo de Cliente', 40);
            });

        });

    </script>

@stop
