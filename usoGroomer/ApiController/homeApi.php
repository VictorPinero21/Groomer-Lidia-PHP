<?php

require_once __DIR__ . '/../views/homeView.php';

class homeApi{
    private $view;

    public function __construct()
    {
        $this->view = new HomeView();
    }

    public function showHome(){
        $this->view->showHomeView();
    }
}