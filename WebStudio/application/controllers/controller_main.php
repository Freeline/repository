<?php

class Controller_main extends Controller{

    function action_index()
    {
        $this->view->generate('header/header_main.php', 'content/content_main.php', 'footer/footer_main.php');
    }

    function action_pay(){
        $this->view->generate('header/header_main.php', 'content/content_pay.php', 'footer/footer_main.php');
    }

    function action_delivery(){
        $this->view->generate('header/header_main.php', 'content/content_delivery.php', 'footer/footer_main.php');
    }

    function action_catalog(){
        $this->view->generate('header/header_main.php', 'content/content_catalog.php', 'footer/footer_main.php', 'model_catalog.php');
    }

    function action_contacts(){
        $this->view->generate('header/header_main.php', 'content/content_contacts.php', 'footer/footer_main.php');
    }

    function action_purchase(){
        $this->view->generate('header/header_main.php', 'content/content_purchase.php', 'footer/footer_main.php', 'model_catalog.php');
    }
}