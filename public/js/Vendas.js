/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getVenda() {
    var tabela;
    $.ajax({
        url: '/Venda/get',
        type: "GET",
        dataType: "json",
        success: function (data) {
            $.each(data.produtos, function (index, value) {
                tabela += "<tr>";
                tabela += " <td>" + value.id_produto_venda + "</td>";
                tabela += " <td>" + value.descricao_produto + "</td>";
                tabela += " <td>" + parseFloat(value.valor_produto).toFixed(2) + "</td>";
                tabela += " <td>" + value.quantidade_venda + "</td>";
                tabela += " <td>" + parseFloat(value.total_sem_imposto).toFixed(2) + "</td>";
                tabela += " <td>" + parseFloat(value.perc_imposto).toFixed(2) + "</td>";
                tabela += " <td>" + parseFloat(value.total_imposto_produto).toFixed(2);
                +"</td>";
                tabela += " <td>" + value.total_produto.toFixed(2);
                +"</td>";
                tabela += "<td>";
                if (data.status_venda != 'finalizada') {
                    tabela += '<button type="button" class="btn btn-outline-warning btn-sm"  onClick ="removerProduto(' + value.id_produto_venda + ');">Remover</button>';
                    tabela += ' | <button type="button" class="btn btn-outline-info btn-sm" onClick="editarProduto(' + value.id_produto_venda + ');">Continuar</button>';
                }
                tabela += '</td>';
                tabela += " </tr>";
            });
            $('#tbProdutos tbody').append(tabela);
            $("#total_venda").text((data.total_venda).toFixed(2));
            $("#total_impostos").text((data.total_impostos).toFixed(2));
            $("#status_venda").text(data.status_venda);

            if (data.status_venda == 'finalizada') {
                $("#btnVendaAberta").remove();
            }
        }
    });
}

function getProdutos() {
    select = document.getElementById("id_produto");
    $.ajax({
        url: '/Produto/get/',
        type: "GET",
        dataType: "json",
        success: function (data) {
            $.each(data, function (index, value) {

                option = document.createElement('option');
                option.value = value.id_produto;
                option.text = value.descricao_produto;
                option.id = "produto_id_" + value.id_produto;
                select.add(option);
                $("#produto_id_" + value.id_produto).attr('data-preco', value.valor_produto);
                $("#produto_id_" + value.id_produto).attr('data-imposto', value.perc_imposto);
                $
            });
        }
    });
}


function editarProduto(id_produto_venda) {
    var inputIdProdutoVenda = '<input type="hidden" class="form-control" id="id_produto_venda" name="id_produto_venda" value="' + id_produto_venda + '">';
    $("#formAddProduto").append(inputIdProdutoVenda);
    $.ajax({
        url: '/Venda/produto/' + id_produto_venda,
        type: "GET",
        dataType: "json",
        success: function (data) {
            populateForm($("#formAddProduto"), data);
            setTextCalc();
        },
        error: function (request, status, error) {
            alert("Erro, tente novamente mais tarde!");
        }
    });
    $('#modalVenda').modal('show');
}

function finalizarVenda() {
    $.ajax({
        url: '/Venda/finalizar',
        type: "GET",
        dataType: "json",
        success: function (data) {
            if (data.status) {
                alert("Finalizado com sucesso!");
                window.location.href = "/Venda/VerTodas";
            } else {

                alert("Erro, tente novamente mais tarde!");
            }
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
}

function removerProduto(id_venda) {
    console.log(id_venda);
    $.ajax({
        url: '/Venda/removeProduto/' + id_venda,
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
            alert("Erro, tente novamente mais tarde!");
        }
    });
}

function saveProduto() {

    var form = $("#formAddProduto");
    $.ajax({
        type: "POST",
        url: '/Venda/addProduto',
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

function setTextCalc() {
    var preco = parseFloat($("#id_produto").find(':selected').data('preco'));
    var imposto = parseFloat($("#id_produto").find(':selected').data('imposto'));
    var quantidade_venda = parseInt($("#quantidade_venda").val());
    var total = (quantidade_venda * (((preco * imposto) / 100) + preco));


    $("#imposto_add").text();
    $("#imposto_add").text((imposto).toFixed(2));


    $("#valor_unitario_add").text();
    $("#valor_unitario_add").text((preco).toFixed(2));

    $("#total_add").text();
    $("#total_add").text((total).toFixed(2));
}

$("#id_produto, #quantidade_venda").change(function () {
    setTextCalc();
});

$('#modalCadastroTipoProduto').on('hide.bs.modal', function (event) {
    $("#id_tipo_produto").remove();
});
getVenda();
getProdutos();