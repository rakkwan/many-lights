<?php

/**
 * Robert Hill
 * 10/22/2019
 * CoderLite
 * This Class connects the db and runs Read queries
 */

/*
//universal database connection
$user = $_SERVER['USER'];
if($user == 'slegreen') {
//    require_once '/home/$user/config.php';
}
else if($user == 'jgoodri1') {
    require_once '/home/jgoodri1/config.php';
}
else if($user == '') {
    // robert
}
else {
    // samantha
}

*/




class database
{

    private $_dbh;
    private $_errorMessage;

    public function __construct()
    {
        //$this->connect();
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
            //$this->_dbh = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD );
            //echo 'Connected to DB with securely';
        } catch(PDOException $e) {
            $this->_errorMessage = $e->getMessage();

            echo $this->_errorMessage;
        }
    }




}



