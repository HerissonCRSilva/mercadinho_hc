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

class TipoProdutoController extends Controller
{

    public function index()
    {
        return ['texto'  => 'teste', "texto2"=>"aqui foi"];
    }

    public function get()
    {
        $result = $this->TipoProduto->findAll();
        return ['list' => $result];
    }

    public function add($data)
    {
       return ['result' =>$this->TipoProduto->store($data)];
    }

    public function remove($data)
    {
       return ['result' =>$this->TipoProduto->delete($data)];
    }

}