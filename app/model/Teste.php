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

class Teste extends Model {

    protected $table = 'teste';
    protected $pk = 'id_teste';

    public function store($data) {
        return $this->save($data);
    }

}
