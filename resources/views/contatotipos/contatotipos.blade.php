<form action="#" method="post" name="form_cadastro_contatotipos" id="form_cadastro_contatotipos">

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
            carregarContatoTipo(result);
        @endif

        function carregarContatoTipo(result) {

            if (!result) {
                if (result['mensagem'])
                    alertify.error(result['mensagem']);
                else
                    alertify.error("Erro ao processar dados");
            } else {
                $('#form_cadastro_contatotipos #id').val(result['id']);
                $('#form_cadastro_contatotipos #descricao').val(result['descricao']);
            }
        }

        $("#modal-pane-n1 .btn_modal_salvar").prop('onclick',null).off('click');
        $("#modal-pane-n1 .btn_modal_salvar").click(function () {

            main.enviarAjaxPostValidate(
                "contatotipos/salvar",
                'form_cadastro_contatotipos',
                function (){
                    main.atualizarDataTable('tb_contatotipos');
                    modal.close_n1();
                }
            );

        });
    });

</script>