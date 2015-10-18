<?php

class Database extends PDO
{
    public $db;

    public function __construct($file)
    {
        if (!$setting = parse_ini_file($file, TRUE))
            throw new \Exception('Unable to open ' . $file . '.');

        $dns = $setting['database']['driver'] . ':host=' . $setting['database']['host'] . (($setting['database']['port']) ? (';port=' . $setting['database']['port']) : '') .
            ';dbname=' . $setting['database']['db'] . '; charset=utf8';

        $this->db = new \PDO($dns, $setting['database']['name'], $setting['database']['password']);

    }
}