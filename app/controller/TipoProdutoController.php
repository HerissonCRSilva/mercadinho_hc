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

class TipoProdutoController extends Controller {

    public function index() {
        return;
    }

    public function get($id_tipo_produto = NULL) {
        if (empty($id_tipo_produto)) {

            $result = $this->TipoProduto->findAll();
            return ['list' => $result];
        } else {
            $result = $this->TipoProduto->findById($id_tipo_produto);
            return ['list' => $result];
        }
    }

    public function add($data) {
        return ['result' => $this->TipoProduto->store($data)];
    }

    public function remove($data) {
        return ['result' => $this->TipoProduto->delete(array("id_tipo_produto"=>$data))];
    }

}
