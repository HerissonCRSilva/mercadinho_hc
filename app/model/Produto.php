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

class Produto extends Model {

    protected $table = 'produto';
    protected $pk = 'id_produto';

    public function store($data) {
        return $this->save($data);
    }

    public function findAll($data = NULL) {
        $join = array("type" => "LEFT", "table" => "tipo_produto", "condition" => "produto.id_tipo_produto = tipo_produto.id_tipo_produto");
        $this->setJoin($join);
        return parent::findAll($data);
    }

}
