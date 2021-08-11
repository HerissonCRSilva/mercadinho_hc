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

class Venda extends Model {

    protected $table = 'venda';
    protected $pk = 'id_venda';

    public function store($data) {
        return $this->save($data);
    }

}
