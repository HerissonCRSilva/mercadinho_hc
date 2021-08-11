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

class VendaController extends Controller {

    protected $use = array();

    public function __construct() {
        $this->use[] = 'Produto';
        $this->use[] = 'Venda';
        $this->use[] = 'ProdutoVenda';
        parent::__construct();

        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['id_venda'])) {
            $this->Venda->store(array("status" => "aberta"));
            $_SESSION['id_venda'] = $this->Venda->lastSavedId();
        }
    }

    public function index() {
        return ['texto' => 'teste', "texto2" => "aqui foi"];
    }

    public function get() {

        $venda = $this->Venda->findById($_SESSION['id_venda']);

        $produtos = $this->produtos()['result'];

        $total_produtos = array_sum(array_column($produtos, 'valor_produto'));
        $total_impostos = array_sum(array_column($produtos, 'total_imposto_produto'));
        $total_venda = array_sum(array_column($produtos, 'total_produto'));

        $return = array("status_venda" => $venda['status'], "total_produtos" => $total_produtos, "total_impostos" => $total_impostos, "total_venda" => $total_venda, "produtos" => $produtos);

        return ['list' => $return];
    }

    public function add($data) {
        return ['result' => $this->Produto->store($data)];
    }

    public function produtos() {
        $data['id_venda'] = $_SESSION['id_venda'];
        return ['result' => $this->ProdutoVenda->findAll($data)];
    }

    public function addProduto($data) {
        $data['id_venda'] = $_SESSION['id_venda'];
        return ['result' => $this->ProdutoVenda->store($data)];
    }

    public function removeProduto($data) {
        return ['result' => $this->ProdutoVenda->delete($data)];
    }

    public function finalizar() {
        foreach ($this->produtos()['result']as $key => $item) {
            $produto = $this->Produto->findById($item['id_produto']);
            $produto['quantidade_disponivel'] = $produto['quantidade_disponivel'] - $item['quantidade_venda'];
            $this->Produto->store($produto);
        } 

        $venda = array();
        $venda['id_venda'] = $_SESSION['id_venda'];
        $venda['status'] = 'finalizada';

        $return = $this->Venda->store($venda);

        session_unset();
        session_destroy();

        return ['result' => $return];
    }

}
