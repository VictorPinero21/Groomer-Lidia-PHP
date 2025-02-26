<?php

require_once __DIR__ . '/../views/homeView.php';

class HomeUso{
    private $view;

    public function __construct()
    {
        $this->view = new HomeView();
    }

    public function showHome(){
        $this->view->showHomeView();
    }
}