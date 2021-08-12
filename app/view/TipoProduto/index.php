<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$header = APP_VIEW . 'default' . DS . 'header' . PHP;
if (file_exists($header)) {
    include $header;
}
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Tipo Produto</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#modalCadastroTipoProduto">Novo</button>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table id="tbTipoProduto" class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Descrição</th>
                <th width="20%">Ação</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="modalCadastroTipoProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro Tipo Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTipoProduto">
                    <div class="form-group">
                        <label for="descricao_tipo_produto">Descrição Tipo Produto</label>
                        <input type="text" class="form-control" id="descricao_tipo_produto" name="descricao_tipo_produto">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveTipoProduto();">Salvar</button>
            </div>
        </div>
    </div>
</div>
<?php
$footer = APP_VIEW . 'default' . DS . 'footer' . PHP;
if (file_exists($footer)) {
    include $footer;
}
?>

<script src="<?= BASE_URL ?>public/js/TipoProduto.js" type="text/javascript"></script>