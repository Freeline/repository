<?php

class model_catalog extends model{

    public function getHoodies(){
        return $this->PDO->db->query("SELECT * FROM hoodies")->fetchAll();
    }
} 