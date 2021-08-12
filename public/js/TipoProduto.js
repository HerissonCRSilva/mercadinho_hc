/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getTiposProdutos() {
    var tabela;
    $.ajax({
        url: '/TipoProduto/get/',
        type: "GET",
        dataType: "json",
        success: function (data) {
            $.each(data, function (index, value) {
                tabela += "<tr>";
                tabela += " <td>" + value.id_tipo_produto + "</td>";
                tabela += " <td>" + value.descricao_tipo_produto + "</td>";
                tabela += "<td>";
                tabela += '<button type="button" class="btn btn-outline-warning btn-sm"  onClick ="removeTipoProduto(' + value.id_tipo_produto + ');">Remover</button>';
                tabela += ' | <button type="button" class="btn btn-outline-info btn-sm" onClick="editarTipoProduto(' + value.id_tipo_produto + ');">Editar</button></td>';
                tabela += '</td>';
                tabela += " </tr>";
            });
            $('#tbTipoProduto tbody').append(tabela);
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

function removeTipoProduto(id_produto) {
    console.log(id_produto);
    $.ajax({
        url: '/TipoProduto/remove/' + id_produto,
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