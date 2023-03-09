<form action="#" method="post" name="form_editar_cliente" id="form_editar_cliente" enctype="multipart/form-data">

    <div class="modal-body">

        {{ csrf_field() }}
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="modal_pane_id" id="modal_pane_id">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>CNPJ/CPF</label>
                    <input type="text" name="cnpj_cpf" id="cnpj_cpf" class="form-control cnpjCpfMask"
                           placeholder="CNPJ/CPF" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Razão Social</label>
                    <input type="text" name="nome_razaoSocial" id="nome_razaoSocial" class="form-control"
                           placeholder="Razão Social">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nome Fantasia</label>
                    <input type="text" name="sobrenome_nomeFantasia" id="sobrenome_nomeFantasia"
                           class="form-control"
                           placeholder="Nome Fantasia">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="cliente_observacao">Observação</label>
                    <textarea name="cliente_observacao" id="cliente_observacao"
                              class="form-control"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul id="tab_edita_cliente" class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_edita_contato" data-toggle="tab">Contato</a>
                        </li>
                        <li>
                            <a href="#tab_edita_endereco" data-toggle="tab">Endereço</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_edita_contato">

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <button type="button" class="btn btn-default" id="btn_adicionar_contato">
                                        <span class="glyphicon glyphicon-plus"></span> Novo contato
                                    </button>
                                </div>
                            </div>

                            <table id="tb_contatos" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                        </div>
                        <div class="tab-pane" id="tab_edita_endereco">

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <button type="button" class="btn btn-default" id="btn_adicionar_endereco">
                                        <span class="glyphicon glyphicon-plus"></span> Novo endereço
                                    </button>
                                </div>
                            </div>

                            <table id="tb_enderecos" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Logradouro</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>

<script>

    $(function () {

        main.iniView();
        mascaras.init();



        @if(isset($response))
            var result = JSON.parse('{!! json_encode($response) !!}');
            carregarCliente(result);
        @endif

        function carregarCliente(result) {

            if (result.id == "") {
                alertify.error("Erro ao processar dados");
            } else {

                $('#form_editar_cliente #id').val(result.id);
                $('#form_editar_cliente #cnpj_cpf').val(result.cnpj_cpf);
                $('#form_editar_cliente #nome_razaoSocial').val(result.nome_razaoSocial);
                $('#form_editar_cliente #sobrenome_nomeFantasia').val(result.sobrenome_nomeFantasia);
                $('#form_editar_cliente #cliente_observacao').val(result.observacao);

                listarContatos(result.id);
                listarEnderecos(result.id);
            }
        }

        /**
         * Lista contatos do cliente
         * @param clienteId
         */
        function listarContatos(clienteId) {

            $('#form_editar_cliente #tb_contatos').DataTable({
                "ajax": "clientes/" + clienteId + "/contatos",
                "columns": [
                    {"data": "nome"},
                    {"data": "email"},
                    {"data": "id", "width": 15, "sClass": "grid-column-value-nowrap-button-contato"}
                ],
                "destroy": true,
                'retrieve': false,
                'paging': false,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': false,
                'autoWidth': false,
                "fnRowCallback": function (nRow) {
                    var val = $('td:eq(2)', nRow).html();
                    $('td:eq(2)', nRow).html("<button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='.modal-contato' value='" + val + "' title='Visualizar'><span class='glyphicon glyphicon-search'></span></button>");
                },
                "fnDrawCallback": function (oSettings) {
                    $(".grid-column-value-nowrap-button-contato").on('click', 'button', function () {
                        var contatoId = $(this).val();
                        modal.open_n("contatos/" + contatoId, 'Editar contato', 70);
                    });
                }
            });
        }

        /**
         * Lista enderecos do cliente
         * @param clienteId
         */
        function listarEnderecos(clienteId) {

            $('#form_editar_cliente #tb_enderecos').DataTable({
                "ajax": "clientes/" + clienteId + "/enderecos",
                "columns": [
                    {"data": "logradouro"},
                    {"data": "id", "width": 15, "sClass": "grid-column-value-nowrap-button-endereco"}
                ],
                "destroy": true,
                'retrieve': false,
                'paging': false,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': false,
                'autoWidth': false,
                "fnRowCallback": function (nRow) {
                    var val = $('td:eq(1)', nRow).html();
                    $('td:eq(1)', nRow).html("<button type='button' class='btn btn-info btn-sm' value='" + val + "' title='Visualizar'><span class='glyphicon glyphicon-search'></span></button>");
                },
                "fnDrawCallback": function (oSettings) {
                    $(".grid-column-value-nowrap-button-endereco").on('click', 'button', function () {
                        var enderecoId = $(this).val();
                        modal.open_n("enderecos/" + enderecoId, 'Editar endereço', 70);
                    });
                }
            });
        }

        $($('#form_editar_cliente #modal_pane_id').val() + " .btn_modal_salvar").prop('onclick',null).off('click');
        $($('#form_editar_cliente #modal_pane_id').val() + " .btn_modal_salvar").click(function () {
            main.enviarAjaxPostValidate(
                "clientes/salvar",
                'form_editar_cliente',
                function (){
                    main.atualizarDataTable('tb_clientes');
                }
            );
        });

        $('#btn_adicionar_contato').click(function () {
            modal.open_n("contatos/cadastrar/" + $('#form_editar_cliente #pessoa_id').val(), 'Novo contato', 70);
        });

        $('#btn_adicionar_endereco').click(function () {
            modal.open_n("enderecos/cadastrar/" + $('#form_editar_cliente #pessoa_id').val(), 'Novo endereço', 70);
        });

    });

</script>