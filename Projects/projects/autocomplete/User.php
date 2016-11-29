<?php
/**
 * Created by PhpStorm.
 * User: 1333612
 * Date: 11/8/2016
 * Time: 5:51 PM
 */
require 'DAO.php';
class User{
    private $fname;
    private $lname;
    private $emailAddr;
    private $pass;

    function __construct()
    {
        $this->emailAddr="";
        $this->fname="";
        $this->lname="";
        $this->pass="";
    }

    public function getFname()
    {
        return $this->fname;
    }

    public function getLname()
    {
        return $this->lname;
    }

    public function getEmailAddr()
    {
        return $this->emailAddr;
    }

    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param string $fname
     */
    public function setFname($fname)
    {
        $this->fname = $fname;
    }

    /**
     * @param string $lname
     */
    public function setLname($lname)
    {
        $this->lname = $lname;
    }

    /**
     * @param string $emailAddr
     */
    public function setEmailAddr($emailAddr)
    {
        $this->emailAddr = $emailAddr;
    }

    /**
     * @param string $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    public function loadToDatabase()
    {
        $conn = new DBConnection();
        $query = "INSERT INTO Users (emailAddress, password, firstname, lastname) VALUES (?,?,?,?)";
        try{
            $pdo = $conn->plug();
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(1, $this->emailAddr);
            $stmt->bindParam(2, $this->hashPassword());
            $stmt->bindParam(3, $this->fname);
            $stmt->bindParam(4, $this->lname);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        } finally {
            $conn->unplug();
        }
    }
    private function hashPassword(){
        return password_hash($this->pass, PASSWORD_DEFAULT);
    }


}