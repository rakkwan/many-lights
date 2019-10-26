<?php

//--
//-- Database: `rhillgre_coderLite`
//--
//
//-- --------------------------------------------------------
//
//--
//-- Table structure for table `countyOfWA`
//--
//
//CREATE TABLE `countyOfWA` (
//`county_ID` int(11) NOT NULL,
//  `city` varchar(100) NOT NULL,
//  `zip` varchar(100) NOT NULL,
//  `countiesServed` varchar(255) NOT NULL
//) ENGINE=InnoDB DEFAULT CHARSET=latin1;
//
//-- --------------------------------------------------------
//
//--
//-- Table structure for table `genderTypes`
//--
//
//CREATE TABLE `genderTypes` (
//`genderTypes` int(11) NOT NULL,
//  `gender` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
//) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
//
//-- --------------------------------------------------------
//
//--
//-- Table structure for table `operationHours`
//--
//
//CREATE TABLE `operationHours` (
//`resource_ID` int(11) NOT NULL,
//  `day_ID` int(11) NOT NULL,
//  `startTime` varchar(10) NOT NULL,
//  `endTime` varchar(10) NOT NULL
//) ENGINE=InnoDB DEFAULT CHARSET=latin1;
//
//-- --------------------------------------------------------
//
//--
//-- Table structure for table `optionalInfo`
//--
//
//CREATE TABLE `optionalInfo` (
//`optional_ID` int(11) NOT NULL,
//  `streetAddress` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `city` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `state` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `zip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `website` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `agesSeen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `agesSeen_ID` int(11) NOT NULL,
//  `languages` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `insurance` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `fees` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `operationHours_ID` int(11) NOT NULL,
//  `operationDay` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `operationStart` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `operationEnd` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `serviceCounty_ID` int(11) NOT NULL
//) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
//
//-- --------------------------------------------------------
//
//--
//-- Table structure for table `recommendedInfo`
//--
//
//CREATE TABLE `recommendedInfo` (
//`recommendedInfo_ID` int(11) NOT NULL,
//  `firstName` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
//) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
//
//-- --------------------------------------------------------
//
//--
//-- Table structure for table `resourcesContact`
//--
//
//CREATE TABLE `resourcesContact` (
//`resources_ID` int(11) NOT NULL,
//  `service_ID` int(11) NOT NULL,
//  `serviceType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `officeName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `officePhone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `officeEmail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `therapistFirstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `therapistLastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `therapistGender` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `therapistGender_ID` int(11) NOT NULL,
//  `recommendedInfo_ID` int(11) NOT NULL,
//  `status_ID` int(11) NOT NULL,
//  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `street` int(100) NOT NULL,
//  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `state` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `zip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `website` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `optional_ID` int(11) NOT NULL,
//  `agesSeen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `languages` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `insurance` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `fees` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `dayOfOperations` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `startTime` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `endTime` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
//) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
//
//-- --------------------------------------------------------
//
//--
//-- Table structure for table `serviceType`
//--
//
//CREATE TABLE `serviceType` (
//`service_ID` int(11) NOT NULL,
//  `typeName` varchar(255) CHARACTER SET latin1 NOT NULL
//) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
//
//-- --------------------------------------------------------
//
//--
//-- Table structure for table `status`
//--
//
//CREATE TABLE `status` (
//`status_ID` int(11) NOT NULL,
//  `statusName` varchar(255) NOT NULL
//) ENGINE=InnoDB DEFAULT CHARSET=latin1;
//
//-- --------------------------------------------------------
//
//--
//-- Table structure for table `waMap`
//--
//
//CREATE TABLE `waMap` (
//`wa_ID` int(11) NOT NULL,
//  `ty` varchar(28) DEFAULT NULL,
//  `city_ascii` varchar(28) DEFAULT NULL,
//  `state_id` varchar(2) DEFAULT NULL,
//  `state_name` varchar(10) DEFAULT NULL,
//  `county_fips` int(5) DEFAULT NULL,
//  `county_name` varchar(12) DEFAULT NULL,
//  `county_fips_all` varchar(17) DEFAULT NULL,
//  `county_name_all` varchar(22) DEFAULT NULL,
//  `lat` decimal(6,4) DEFAULT NULL,
//  `lng` decimal(8,4) DEFAULT NULL,
//  `population` int(7) DEFAULT NULL,
//  `density` int(4) DEFAULT NULL,
//  `source` varchar(7) DEFAULT NULL,
//  `military` varchar(5) DEFAULT NULL,
//  `incorporated` varchar(5) DEFAULT NULL,
//  `timezone` varchar(19) DEFAULT NULL,
//  `ranking` int(1) DEFAULT NULL,
//  `zips` varchar(287) DEFAULT NULL
//) ENGINE=InnoDB DEFAULT CHARSET=utf8;



/**
 * Robert Hill
 * 10/22/2019
 * CoderLite
 * This Class connects the db and runs Read queries
 */

require_once '/home/jgoodri1/config.php';
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


////universal database switch connection
//$user = $_SERVER['USER'];
//switch($user) {
//    case 'slegreen':
//        require_once '/home/slegreen/config.php';
//        break;
//    case 'rhillgre':
//        require_once '/home2/$user/config3.php';
//        break;
//    default:
//        echo "/home/jgoodri1/config.php";
//}


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



