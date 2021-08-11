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

class TesteController extends Controller
{

    public function index()
    {
        return ['texto'  => 'teste', "texto2"=>"aqui foi"];
    }

    public function get()
    {
        $result = $this->Teste->findAll();
        return ['list' => json_encode($result, true)];
    }

    public function add($data)
    {
        $this->Users->store($data);
    }

}
