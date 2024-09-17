<?php

class homeController extends controller{
    public function index(): void{
        $dados = array();

        $contatos = new Contatos();
        $dados['lista'] = $contatos->getAll();
        
        $this->loadtemplate('home', $dados);
    }
}