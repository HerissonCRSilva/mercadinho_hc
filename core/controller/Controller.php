<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author Herisson Silva
 */

namespace MercadinhoHC\core\controller;

abstract class Controller {

    private $class;

    public function __construct() {
        $this->class = self::setClass();
        self::loadModels();
    }

    private function setClass() {
        $className = (new \ReflectionClass($this))->getShortName();

        return str_replace('Controller', '', $className);
    }

    private function loadModels() {
        $this->use = (!isset($this->use)) ? [$this->class] : $this->use;

        if ($this->use) {
            foreach ($this->use as $model) {
                self::load('model', $model);
            }
        }
    }

    private function load($path, $class) {
        $load_class = 'MercadinhoHC\app\\' . $path . '\\' . $class;
        $this->{$class} = new $load_class();
    }

}
