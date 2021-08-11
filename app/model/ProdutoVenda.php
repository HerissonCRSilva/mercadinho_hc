<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Users
 *
 * @author Herisson Silva
 */

namespace MercadinhoHC\app\model;

use MercadinhoHC\core\model\Model;

class ProdutoVenda extends Model {

    protected $table = 'produto_venda';
    protected $pk = 'id_produto_venda';

    public function store($data) {
        return $this->save($data);
    }

    public function findAll($data = NULL) {
        $join = array("type" => "INNER", "table" => "produto", "condition" => "produto_venda.id_produto = produto.id_produto");
        $this->setJoin($join);
        $data['conditions'] = $data;
        $return = parent::findAll($data);

        foreach ($return as $key => $item) {
            $return[$key]["valor_produto"] =  $item['quantidade_venda']*$item['valor_produto'];
            $return[$key]["total_imposto_produto"] = ($return[$key]["valor_produto"]*$item['perc_imposto'])/100;
            $return[$key]["total_produto"] = $return[$key]["valor_produto"]+$return[$key]["total_imposto_produto"];
        }

        return $return;
    }

}
