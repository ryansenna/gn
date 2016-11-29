<?php
/**
 * This Class takes care of all database access operations.
 * Created by PhpStorm.
 * User: 1333612
 * Date: 11/11/2016
 * Time: 4:20 PM
 */
require 'DBConnection.php';

class DAO
{
    /**
     * This Method will read the file line by line
     * and put the line information into the database.
     */
    function readFileToDB()
    {
        $conn = new DBConnection();
        $query = "INSERT INTO Cities (POPULATION, CITY) VALUES (?,?);";
        try {
            $pdo = $conn->plug();
            $stmt = $pdo->prepare($query);
            $file = fopen("cities.txt", "r");
            while ($line = fgets($file)) {
                $population = $this->getPopulationField($line);
                $city = $this->getCityField($line);

                //execute queries
                $stmt->bindParam(1, $population);
                $stmt->bindParam(2, $city);
                $stmt->execute();
                echo $population . ";" . $city . " loaded to Db " . "<br/>";
            }
            fclose($file);
        } catch (PDOException $e) {
            echo $e->getMessage();
        } finally {
            $conn->unplug();
        }

    }

    /**
     * This helper method serves to get the population field from the line of the file.
     * @param $line from the file
     * @return string
     */
    function getPopulationField($line)
    {
        $semiColonPos = strpos($line, ';');// find the semicolon position
        $populationStr = substr($line, 0, $semiColonPos);// get its substring
        return $populationStr;
    }

    /**
     * This helper method serves to get the city field from the line of the file.
     * @param $line
     * @return string
     */
    function getCityField($line)
    {
        $semiColonPos = strpos($line, ';');// find the semicolon position
        $cityStr = substr($line, $semiColonPos + 1);//get the city str.

        return $cityStr;
    }

    /**
     * This method will search the item in the database.
     * It is a helper method for the autcomplete feature.
     * Basically on every key up ajax calls this method to make a search on that item and returns 5 items or less
     * from the database.
     * @param $item
     * @return array
     */
    function search($item)
    {
        $conn = new DBConnection();
        $query = "select city from Cities where city like ? order by population desc limit 5";
        $cities = array();
        $item = $item . '%';
        try {
            $pdo = $conn->plug();
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $item);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'value');
            $stmt->execute();
            while ($thisCity = $stmt->fetch()) {
                array_push($cities, $thisCity);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        } finally {
            $conn->unplug();
        }
        $result = array();
        foreach ($cities as $city) {
            foreach ($city as $key => $value) {
                if (is_numeric($key))
                    $result[] = $value;
            }
        }
        return $result;
    }

    /**
     * This method will help when the user presses enter on the search.
     * Basically, whatever he was searching will get inserted to the database to his own history table.
     * Based on that, the next searches will get pulled from his own history instead of the Cities table.
     * @param $term to be inserted.
     * @return
     */
    function insertTermToHistory($term)
    {
        $userEmail = trim(strip_tags($_SESSION["email"]));
        $id = $this->getUserIdFromDB($userEmail);
        if ($this->isTermInDB($id, $term)) {
            $this->updateTermDate($term);
        } else {
            if (empty($id))
                return false;// meaning that the method could not find the user Id in DB therefore return false.
            $conn = new DBConnection();
            $query = "INSERT INTO History (userid, term, termDate) VALUES (?,?,?)";
            try {
                $pdo = $conn->plug();
                $stmt = $pdo->prepare($query);
                $date = new DateTime();
                $date->setTimezone(new DateTimeZone('America/New_York'));
                $dateStr = $date->format('Y-m-d H:i:s');

                $stmt->bindParam(1, $id);
                $stmt->bindParam(2, $term);
                $stmt->bindParam(3, $dateStr);

                $stmt->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
            } finally {
                $conn->unplug();
            }
        }

        return true;

    }

    /**
     * This method will be responsible for getting the terms
     * of a particular userId.
     * For example, the userId is 4, all the terms searched by userid 4
     * will be loaded and returned
     * @param $userId
     * @return an array with the terms
     */
    function getTermsByUserId($userId)
    {
        $conn = new DBConnection();
        $query = "select term from History where userId like ? order by historyId Desc limit 5";
        $terms = array();
        $item = $userId . '%';
        try {
            $pdo = $conn->plug();
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $item);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'value');
            $stmt->execute();
            while ($thisTerm = $stmt->fetch()) {
                array_push($terms, $thisTerm);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        } finally {
            $conn->unplug();
        }
        $result = array();
        foreach ($terms as $term) {
            //var_dump($term);
            foreach ($term as $key => $value) {
                //var_dump($term);
                if (is_numeric($key))
                    array_push($result, $value);
            }
        }
        return $result;
    }

    /**
     * This method will check if a given term from
     * a user is already in the database.
     * @param $userId
     * @return true if the term is in db false if it is not.
     */
    function isTermInDB($userId, $term)
    {
        //var_dump($userId);

        $conn = new DBConnection();
        $query = "select term from History where term = ? and userId like ?";
        try {
            $pdo = $conn->plug();
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $term);
            $stmt->bindParam(2, $userId);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'value');
            $stmt->execute();
            $result = $stmt->fetchColumn(0);

            //var_dump($result);
        } catch (PDOException $e) {
            echo $e->getMessage();
        } finally {
            $conn->unplug();
        }
        if (!isset($result) || empty($result))
            return false;

        return true;

    }


    /**
     * This method will update the date from an existing term in the database.
     *
     * @param $term
     */
    function updateTermDate($term)
    {
        var_dump($term);
        $conn = new DBConnection();
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('America/New_York'));
        $dateStr = $date->format('Y-m-d H:i:s');
        $query = "update History set termDate = ? where term like ?";
        try {
            $searchStr = "".$term;
            $pdo = $conn->plug();
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $dateStr);
            $stmt->bindParam(2, $term);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        } finally {
            $conn->unplug();
        }
    }


    /**
     * This method will verify if the user email address is in fact in the database.
     * Since email addresses are unique fields in my database, the email must be there in order to have a history,
     * a password, etc.
     * @param $email the email to be verified
     * @return bool true or false based on if he is there or not.
     */
    function isEmailAddressInDB($email)
    {
        $conn = new DBConnection();
        $query = "SELECT emailAddress FROM Users WHERE emailAddress LIKE ?";
        $result = "";
        try {
            $pdo = $conn->plug();
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(1, $email);

            $stmt->execute();
            $result = $stmt->fetchColumn(0);

        } catch (PDOException $e) {
            echo $e->getMessage();
        } finally {
            $conn->unplug();
        }

        if (empty($result))
            return false;
        return true;
    }

    /**
     * This method will get the hashed password from that particular user from the database.
     * @param $email the email to be searched
     * @return string the user hashed password.
     */
    function getPasswordFromDB($email)
    {
        $conn = new DBConnection();
        $query = "SELECT password FROM Users WHERE emailAddress LIKE ?";
        $result = "";
        try {
            $pdo = $conn->plug();
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(1, $email);

            $stmt->execute();
            $result = $stmt->fetchColumn(0);
        } catch (PDOException $e) {
            echo $e->getMessage();
        } finally {
            $conn->unplug();
        }

        return $result;
    }

    /**
     * This method gets the user's first name from the database.
     * @param $email
     * @return string
     */
    function getUserNameFromDB($email)
    {
        $conn = new DBConnection();
        $query = "SELECT firstname FROM Users WHERE emailAddress LIKE ?";
        $result = "";
        try {
            $pdo = $conn->plug();
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(1, $email);

            $stmt->execute();
            $result = $stmt->fetchColumn(0);
        } catch (PDOException $e) {
            echo $e->getMessage();
        } finally {
            $conn->unplug();
        }

        return $result;
    }

    /**
     * This method will get the userId field from the db based on the user's email.
     * In order to insert the term on the history table, I need to know which id im gonna insert to.
     * Therefore, this method allows me to have access to the User's id based on his email.
     *
     * @param  the email to search for
     * @return string the user's id.
     */
    function getUserIdFromDB($email)
    {
        $conn = new DBConnection();
        $query = "SELECT userId FROM Users WHERE emailAddress LIKE ?";
        $result = "";
        try {
            $pdo = $conn->plug();
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(1, $email);

            $stmt->execute();
            $result = $stmt->fetchColumn(0);
        } catch (PDOException $e) {
            echo $e->getMessage();
        } finally {
            $conn->unplug();
        }

        return $result;
    }

    /**
     * This helper method will simply compare user's password with what is already stored in the database
     * in order to log the person in.
     * @param $userPass what the user entered at login page.
     * @param $dbPass what is stored in the database.
     * @return bool true or false.
     */
    function comparePasswords($userPass, $dbPass)
    {
        $result = password_verify($userPass, $dbPass);
        return $result;
    }
}