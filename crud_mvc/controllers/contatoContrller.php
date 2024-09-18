<?php
class ContatoContrller extends controller {
    public function index() {

    }

    // ADD
    public function add() {
        $dados = array();

        $this->loadTemplate('add', $dados);
    }
}