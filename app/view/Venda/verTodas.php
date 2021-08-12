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
    <h1 class="h2">Vendas</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" href="/Venda">Nova Venda</a>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table id="tbVenda" class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Qtd. Produtos</th>
                <th>Qtd. Itens</th>
                <th>Total de Produtos (R$)</th>
                <th>Total de Impostos (R$)</th>
                <th>Total da Venda (R$)</th>
                <th>Status</th>
                <th width="20%">Ação</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<?php
$footer = APP_VIEW . 'default' . DS . 'footer' . PHP;
if (file_exists($footer)) {
    include $footer;
}
?>

<script src="<?= BASE_URL ?>public/js/VendasVerTodas.js" type="text/javascript"></script>