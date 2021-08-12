<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsersController
 *
 * @author Herisson Silva
 */

namespace MercadinhoHC\app\controller;

use MercadinhoHC\core\controller\Controller;

class ProdutoController extends Controller {

    public function index() {
        return;
    }

    public function get($id_produto = NULL) {
        if (empty($id_produto)) {
            $result = $this->Produto->findAll();
            return ['list' => $result];
        } else {
            $result = $this->Produto->findById($id_produto);
            return ['list' => $result];
        }
    }

    public function add($data) {
        return ['result' => $this->Produto->store($data)];
    }

    public function remove($data) {
        return ['result' => $this->Produto->delete(array("id_produto"=>$data))];
    }

}
