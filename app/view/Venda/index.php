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
    <h1 class="h2">Venda: #<?= $_SESSION['id_venda'] ?> | <span id="status_venda"></span></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2" id="btnVendaAberta" >
            <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#modalVenda">Adicionar Produto</button>
            <button class="btn btn-sm btn-outline-secondary" onclick="finalizarVenda();">Finalizar Venda</button>
        </div>
    </div>
</div>
<div class="table-responsive">
    <h2 class="h4">Produtos</h2>
    <table id="tbProdutos" class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Descrição do Produto</th>
                <th>Preço(R$)</th>
                <th>Quantidade</th>
                <th>Total s/ Imposto</th>
                <th>Imposto(%)</th>
                <th>Total Impostos(R$)</th>
                <th>Total(R$)</th>
                <th width="20%">Ação</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h2 class="h4">Total da Venda (R$) = </h2>
                </div>
                    <div class="col-md-8"><h2 class="h4" id="total_venda"></h2></div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h2 class="h5">Total de Impostos (R$) = </h2>
                </div>
                    <div class="col-md-8"><h2 class="h5" id="total_impostos"></h2></div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalVenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAddProduto" name="formAddProduto">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_produto">Produto</label>
                                <select class="form-control" id="id_produto" name="id_produto">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="quantidade_disponivel">Quantidade</label>
                                <input type="number" class="form-control" id="quantidade_venda" name="quantidade_venda">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label >V. Unitário(R$)</label>
                                <span  class="form-control" id="valor_unitario_add"> &nbsp; </span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label >Imp.(%)</label>
                                <span  class="form-control" id="imposto_add"> &nbsp; </span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label >Total(R$)</label>
                                <span  class="form-control" id="total_add"> &nbsp;</span>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveProduto();">Salvar</button>
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

<script src="<?= BASE_URL ?>public/js/Vendas.js" type="text/javascript"></script>