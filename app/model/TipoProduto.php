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

class TipoProduto extends Model {

    protected $table = 'tipo_produto';
    protected $pk = 'id_tipo_produto';

    public function store($data) {
        return $this->save($data);
    }

}
