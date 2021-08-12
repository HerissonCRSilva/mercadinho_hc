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

    private function helperSession($id_venda = NULL) {

        if (!empty($id_venda)) {
            $_SESSION['id_venda'] = $id_venda;
        } else {

            if (!isset($_SESSION['id_venda'])) {
                $this->Venda->store(array("status" => "aberta"));
                $_SESSION['id_venda'] = $this->Venda->lastSavedId();
            }
        }
    }

    public function __construct() {
        $this->use[] = 'Produto';
        $this->use[] = 'Venda';
        $this->use[] = 'ProdutoVenda';
        parent::__construct();
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function verTodas() {
        return;
    }

    public function index($id_venda = NULL) {
        if (empty($id_venda)) {
            unset($_SESSION['id_venda']);
            $this->helperSession($id_venda);
            header('Location: ' . BASE_URL . 'Venda/index/' . $_SESSION['id_venda']);
        }
        $this->helperSession($id_venda);
    }

    public function get() {
        $this->helperSession();
        $venda = $this->Venda->findById($_SESSION['id_venda']);

        $produtos = $this->produtos()['result'];

        $total_produtos = array_sum(array_column($produtos, 'total_sem_imposto'));
        $total_impostos = array_sum(array_column($produtos, 'total_imposto_produto'));
        $total_venda = array_sum(array_column($produtos, 'total_produto'));

        $return = array("status_venda" => $venda['status'], "total_produtos" => $total_produtos, "total_impostos" => $total_impostos, "total_venda" => $total_venda, "produtos" => $produtos);

        return ['list' => $return];
    }

    public function getAll() {
        $vendas = $this->Venda->findAll();

        foreach ($vendas as $key => $item) {

            $data['id_venda'] = $item['id_venda'];
            $produtos = $this->ProdutoVenda->findAll($data);

            $vendas[$key]['quantidade_produtos'] = count($produtos);
            $vendas[$key]['quantidade_itens'] = count($produtos) * array_sum(array_column($produtos, 'quantidade_venda'));
            $vendas[$key]['total_produtos'] = number_format(array_sum(array_column($produtos, 'valor_produto')), 2);
            $vendas[$key]['total_impostos'] = number_format(array_sum(array_column($produtos, 'total_imposto_produto')), 2);
            $vendas[$key]['total_venda'] = number_format(array_sum(array_column($produtos, 'total_produto')), 2);
        }

        return ['list' => $vendas];
    }

    public function add($data) {
        $this->helperSession();
        return ['result' => $this->Produto->store($data)];
    }

    public function produtos() {
        $this->helperSession();
        $data['id_venda'] = $_SESSION['id_venda'];
        return ['result' => $this->ProdutoVenda->findAll($data)];
    }

    public function produto($id_produto_venda) {
        return ['result' => $this->ProdutoVenda->findById($id_produto_venda)];
    }

    public function addProduto($data) {
        $this->helperSession();
        $data['id_venda'] = $_SESSION['id_venda'];
        return ['result' => $this->ProdutoVenda->store($data)];
    }

    public function removeProduto($id_produto_Venda) {
        $data = array("id_produto_Venda" => $id_produto_Venda);
        return ['result' => $this->ProdutoVenda->delete($data)];
    }

    public function finalizar() {
        $this->helperSession();
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

    public function remove($id_venda) {

        $data['id_venda'] = $id_venda;
        $this->ProdutoVenda->delete($data);
        return ['result' => $this->Venda->delete($data)];
    }

}
