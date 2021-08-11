<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Database
 *
 * @author Herisson Silva
 */

namespace MercadinhoHC\core\model;

abstract class Database {

    protected $conn;
    public $config;

    public function __construct() {
        if (empty($this->config)) {
            $this->config = parse_ini_file('config.ini');
        }
        $this->conn = new \PDO($this->config['dbdriver'] .
                ':host=' . $this->config['hostname'] .
                ';port=' . $this->config['port'] .
                ';dbname=' . $this->config['database'],
                $this->config['username'], $this->config['password']);
    }

}
