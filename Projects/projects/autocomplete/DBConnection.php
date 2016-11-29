<?php
/**
 * Created by PhpStorm.
 * User: 1333612
 * Date: 11/8/2016
 * Time: 6:04 PM
 */
class DBConnection{

    private $serverName;
    private $user;
    private $pass;
    private $dbName;
    private $pdo;

    function __construct()
    {
        $this->serverName = 'korra.dawsoncollege.qc.ca';
        $this->user = 'CS1333612';
        $this->pass = 'rodybosp';
        $this->dbName = 'CS1333612';
    }

    /**
     * This method will create a connection to the database.
     */
    function plug()
    {
        $this->pdo = new PDO("mysql:host=$this->serverName;dbname=$this->dbName", $this->user, $this->pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->pdo;
    }

    /**
     * This method will close the database conenction
     */
    function unplug()
    {
        unset($pdo);
    }
}