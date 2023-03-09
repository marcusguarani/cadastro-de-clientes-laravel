<form action="#" method="post" name="form_cadastro_tipoclientes" id="form_cadastro_tipoclientes">

    <div class="modal-body">
        {{ csrf_field() }}
        <input type="hidden" name="id" id="id">

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input type="text" name="descricao" id="descricao" class="form-control" placeholder="Descrição" required>
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
            console.log(result);
            carregarTipoCliente(result);
        @endif

        function carregarTipoCliente(result) {

            if (!result) {
                if (result['mensagem'])
                    alertify.error(result['mensagem']);
                else
                    alertify.error("Erro ao processar dados");
            } else {
                $('#form_cadastro_tipoclientes #id').val(result['id']);
                $('#form_cadastro_tipoclientes #descricao').val(result['descricao']);
            }
        }

        $("#modal-pane-n1 .btn_modal_salvar").prop('onclick',null).off('click');
        $("#modal-pane-n1 .btn_modal_salvar").click(function () {

            main.enviarAjaxPostValidate(
                "tipoclientes/salvar",
                'form_cadastro_tipoclientes',
                function (){
                    main.atualizarDataTable('tb_tipoclientes');
                    modal.close_n1();
                }
            );

        });
    });

</script>