/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getTiposProdutos() {
    var tabela;
    $.ajax({
        url: '/Venda/getAll',
        type: "GET",
        dataType: "json",
        success: function (data) {
            $.each(data, function (index, value) {
                tabela += "<tr>";
                tabela += " <td>" + value.id_venda + "</td>";
                tabela += " <td>" + value.quantidade_produtos + "</td>";
                tabela += " <td>" + value.quantidade_itens + "</td>";
                tabela += " <td>" + value.total_produtos + "</td>";
                tabela += " <td>" + value.total_impostos + "</td>";
                tabela += " <td>" + value.total_venda + "</td>";
                tabela += " <td>" + value.status + "</td>";
                tabela += "<td>";
                tabela += '<button type="button" class="btn btn-outline-warning btn-sm"  onClick ="removeVenda(' + value.id_venda + ');">Remover</button>';
                    tabela += ' | <a type="button" class="btn btn-outline-info btn-sm" href="/Venda/index/' + value.id_venda + '">Visualizar</a>';
                tabela += '</td>';
                tabela += " </tr>";
            });
            $('#tbVenda tbody').append(tabela);
        }
    });
}

function saveTipoProduto() {

    var form = $("#formTipoProduto");
    $.ajax({
        type: "POST",
        url: '/TipoProduto/add/',
        data: form.serialize(),
        dataType: "json",
        success: function (data)
        {
            if (data.status) {
                alert("Salvo com sucesso!");
                location.reload();
            } else {

                alert("Erro, tente novamente mais tarde!");
            }
        }, error: function (request, status, error) {
            alert("Erro, tente novamente mais tarde!");
        }
    });
}

function editarTipoProduto(idTipoProduto) {

    var inputIdTipoProduto = '<input type="hidden" class="form-control" id="id_tipo_produto" name="id_tipo_produto" value="' + idTipoProduto + '">';
    $("#formTipoProduto").append(inputIdTipoProduto);
    $.ajax({
        url: '/TipoProduto/get/' + idTipoProduto,
        type: "GET",
        dataType: "json",
        success: function (data) {
            populateForm($("#formTipoProduto"), data);
        },
        error: function (request, status, error) {
            alert("Erro, tente novamente mais tarde!");
        }
    });
    $('#modalCadastroTipoProduto').modal('show');
}

function removeVenda(id_venda) {
    console.log(id_venda);
    $.ajax({
        url: '/Venda/remove/' + id_venda,
        type: "GET",
        dataType: "json",
        success: function (data) {
            if (data.status) {
                alert("Removido com sucesso!");
                location.reload();
            } else {

                alert("Erro, tente novamente mais tarde!");
            }
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
}

$('#modalCadastroTipoProduto').on('hide.bs.modal', function (event) {
    $("#id_tipo_produto").remove();
});
getTiposProdutos();