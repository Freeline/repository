<?php
class Model{
    public $PDO;

    public function __construct(){
        require_once 'classes/Database.php';
        $this->PDO = new Database('config/settings.ini');
    }
}