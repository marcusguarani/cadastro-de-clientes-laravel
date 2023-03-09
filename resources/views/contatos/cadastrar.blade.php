<form action="#" method="post" name="form_cadastro_contato" id="form_cadastro_contato">

    <div class="modal-body">
        {{ csrf_field() }}
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="pessoa_id" id="pessoa_id">
        <input type="hidden" name="form_parent_id" id="form_parent_id">
        <input type="hidden" name="modal_pane_id" id="modal_pane_id">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="contato_tipo_id">Tipo contato</label>
                    <select name="contato_tipo_id" id="contato_tipo_id" class="form-control select2"
                            style="width: 100%;" required>
                        <option value="">Selecione</option>
                        @foreach($contatoTipos['response']['contatoTipo'] as $contatoTipo)
                            <option value="{{ $contatoTipo['id'] }}">{{ $contatoTipo['descricao'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cargo_id">Cargo</label>
                    <select name="cargo_id" id="cargo_id" class="form-control select2" style="width: 100%;" required>
                        <option value="">Selecione</option>
                        @foreach($cargos['response']['cargo'] as $cargo)
                            <option value="{{ $cargo['id'] }}">{{ $cargo['descricao'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="form-control cpfMask" placeholder="CPF" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="telefone1">Telefone 1</label>
                    <input type="text" name="telefone1" id="telefone1" class="form-control telefoneMask"
                           placeholder="Telefone 1" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="telefone2">Telefone 2</label>
                    <input type="text" name="telefone2" id="telefone2" class="form-control telefoneMask"
                           placeholder="Telefone 2" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="celular">Celular</label>
                    <input type="text" name="celular" id="celular" class="form-control celularMask"
                           placeholder="Celular" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="contato_observacao">Observação</label>
                    <textarea name="contato_observacao" id="contato_observacao"
                              class="form-control"></textarea>
                </div>
            </div>
        </div>
    </div>

</form>

<script>

    $(function () {

        main.iniView();
        mascaras.init();

        @if(isset($pessoaId))
            $('#form_cadastro_contato #pessoa_id').val('{{ $pessoaId }}');
        @endif

        @if(isset($formParentId))
            $('#form_cadastro_contato #form_parent_id').val('{{ $formParentId }}');
        @endif

        @if(isset($response))
            var result = JSON.parse('{!! json_encode($response) !!}');
            carregarContato(result);
        @endif

        function carregarContato(result) {

            if (result['status'] != 200) {
                if (result['mensagem'])
                    alertify.error(result['mensagem']);
                else
                    alertify.error("Erro ao processar dados");
            } else {
                $('#form_cadastro_contato #id').val(result['response']['contato']['id']);
                $('#form_cadastro_contato #pessoa_id').val(result['response']['pessoa_id']);
                $('#form_cadastro_contato #contato_tipo_id').val(result['response']['contato']['contato_tipo_id']);
                $('#form_cadastro_contato #cargo_id').val(result['response']['contato']['cargo_id']);
                $('#form_cadastro_contato #cpf').val(result['response']['contato']['cpf']);
                $('#form_cadastro_contato #nome').val(result['response']['contato']['nome']);
                $('#form_cadastro_contato #email').val(result['response']['contato']['email']);
                $('#form_cadastro_contato #telefone1').val(result['response']['contato']['telefone1']);
                $('#form_cadastro_contato #telefone2').val(result['response']['contato']['telefone2']);
                $('#form_cadastro_contato #celular').val(result['response']['contato']['celular']);
                $('#form_cadastro_contato #contato_observacao').val(result['response']['contato']['observacao']);
            }
        }

        $($('#form_cadastro_contato #modal_pane_id').val() + " .btn_modal_salvar").prop('onclick',null).off('click');
        $($('#form_cadastro_contato #modal_pane_id').val() + " .btn_modal_salvar").click(function () {
            main.enviarAjaxPostValidate(
                "contatos/salvar",
                'form_cadastro_contato',
                function (){
                    main.atualizarDataTable('tb_contatos');
                    modal.close_n2();
                }
            );
        });
    });

</script>