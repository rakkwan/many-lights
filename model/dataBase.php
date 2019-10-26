<?php

/**
 * Robert Hill
 * 10/22/2019
 * CoderLite
 * This Class connects the db and runs Read queries
 */


////universal database connection
//$user = $_SERVER['USER'];
//if($user == 'slegreen') {
////    require_once '/home/$user/config.php';
//}
//else if($user == 'jgoodri1') {
//    require_once '/home/jgoodri1/config.php';
//}
//else if($user == 'rhillgre') {
//    // robert
//    require_once '/home2/rhillgre/config3.php';
//}
//else {
//    // samantha
//}


//universal database switch connection
$user = $_SERVER['USER'];
switch($user) {
    case 'slegreen':
        require_once '/home/slegreen/config.php';
        break;
    case 'jgoodri1':
        require_once '/home/jgoodri1/config.php';
        break;
    case 'rhillgre':
        require_once '/home2/rhillgre/config3.php';
        break;
        // samantha not sure
    case 'sdesmul?':
        require_once '/home/sdesmulUserName/config.php';
        break;
    default:
        echo "$user is not authorized to connect to the database";
}


class Databases
{

    private $_dbh;
    private $_errorMessage;

    public function __construct()
    {
        $this->connect();
    }

    /**
     * Attempts to connect to database, saves error message if not connected
     * @return void
     */

    public function connect()
    {
        //Connect to DB
        try{
            //Instantiate a database object
            $this->_dbh = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD );
//            $user = $_SERVER['USER'];
//            echo "Connected to DB with $user";

        } catch(PDOException $e) {
            $this->_errorMessage = $e->getMessage();

            echo $this->_errorMessage;
        }
    }

    /**
     * Function to get all the resources
     */
    public function getResource()
    {
        //Define Query
        $sql = "SELECT * FROM resourcesContact LIMIT 5";

        //prepare statement
        $statement = $this->_dbh->prepare($sql);

        //execute statement
        $statement->execute();

        //Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }



}



