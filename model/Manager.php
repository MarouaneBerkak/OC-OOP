<?php

class Manager
{
    protected $db;
    
    public function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=exercicepoo;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
    }
}