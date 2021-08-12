/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getProdutos() {
    var tabela;
    $.ajax({
        url: '/Produto/get/',
        type: "GET",
        dataType: "json",
        success: function (data) {
            $.each(data, function (index, value) {
                tabela += "<tr>";
                tabela += " <td>" + value.id_produto + "</td>";
                tabela += " <td>" + value.descricao_produto + "</td>";
                tabela += "<td>" + value.valor_produto + "</td>";
                tabela += " <td>" + value.perc_imposto + "</td>";
                tabela += " <td>" + value.quantidade_disponivel + "</td>";
                tabela += "<td>";
                tabela += '<button type="button" class="btn btn-outline-warning btn-sm"  onClick ="removeProduto(' + value.id_produto + ');">Remover</button>';
                tabela += ' | <button type="button" class="btn btn-outline-info btn-sm" onClick="editarProduto(' + value.id_produto + ');">Editar</button></td>';
                tabela += '</td>';
                tabela += " </tr>";
            });
            $('#tbProdutos tbody').append(tabela);
        }
    });
}

function getTiposProdutos() {
    select = document.getElementById("id_tipo_produto");
    $.ajax({
        url: '/TipoProduto/get/',
        type: "GET",
        dataType: "json",
        success: function (data) {
            $.each(data, function (index, value) {

                option = document.createElement('option');
                option.value = value.id_tipo_produto;
                option.text = value.descricao_tipo_produto;
                select.add(option);
            });
        }
    });
}

function saveProduto() {

    var form = $("#formProduto");
    $.ajax({
        type: "POST",
        url: '/Produto/add/',
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

function editarProduto(idProduto) {
    var inputIdProduto = '<input type="hidden" class="form-control" id="id_produto" name="id_produto" value="' + idProduto + '">';
    $("#formProduto").append(inputIdProduto);
    $.ajax({
        url: '/Produto/get/' + idProduto,
        type: "GET",
        dataType: "json",
        success: function (data) {
            populateForm($("#formProduto"), data);
        },
        error: function (request, status, error) {
            alert("Erro, tente novamente mais tarde!");
        }
    });
    $('#modalCadastroProduto').modal('show');
}

function removeProduto(id_produto) {
    console.log(id_produto);
    $.ajax({
        url: '/Produto/remove/' + id_produto,
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

$('#modalCadastroProduto').on('hide.bs.modal', function (event) {
    $("#id_produto").remove();
});
getProdutos();
getTiposProdutos();