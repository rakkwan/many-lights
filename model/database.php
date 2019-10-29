<?php


/*
 *
 *
 * create table referee
(
  refereeID int         not null auto_increment,
  primary key (refereeID),
  fname     varchar(50) not null,
  lname     varchar(50) not null,
  email     varchar(50) not null,
  phone     varchar(50) not null
);
//Updated by rhill34
create table statusBrand
(
  statusID int not null auto_increment,
  primary key (statusID),
  statusLabel   varchar(20)
);

INSERT INTO `status`( `status`) VALUES ("Pending");
create table service
(
  serviceID int not null auto_increment,
  primary key (serviceID),
  service   varchar(40)
);

INSERT INTO `service` (`service`) VALUES (VAL-1);


create table resources
(

  resourceID  int         not null auto_increment,
  primary key (resourceID),
  speciality  varchar(60),
  days        linestring,
  office      varchar(50) not null,
  officeEmail varchar(50) not null,
  officePhone varchar(15) not null,
  theraFname  varchar(50),
  theraLname  varchar(50),
  theraGender boolean,
  interpreter varchar(100),
  insurance   varchar(50),
  fee         int,
  age         int,
  countyOne   varchar(50),
  countyTwo   varchar(50),
  countyThree varchar(50),
  address     varchar(50),
  city        varchar(25),
  state       varchar(3),
  zip         int,
  website     varchar(40),
  serviceID   int,
  refereeID   int,

  FOREIGN KEY (serviceID) REFERENCES service (serviceID),
  FOREIGN KEY (refereeID) REFERENCES referee (refereeID)

)


 *
 *
 *
 *
 *
 *
 * SAMANTHA's CHANGES ABOVE
 *

Database: `rhillgre_coderLite`

-- --------------------------------------------------------

Table structure for table `countyOfWA`

CREATE TABLE `countyOfWA` (
    county_ID` int(11) NOT NULL,
    city` varchar(100) NOT NULL,
    zip` varchar(100) NOT NULL,
    countiesServed` varchar(255) NOT NULL
    )ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

Table structure for table `genderTypes`

CREATE TABLE `genderTypes` (
    genderTypes` int(11) NOT NULL,
    gender` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

Table structure for table `operationHours`

CREATE TABLE `operationHours` (
    resource_ID` int(11) NOT NULL,
    day_ID` int(11) NOT NULL,
    startTime` varchar(10) NOT NULL,
    endTime` varchar(10) NOT NULL
   )ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

Table structure for table `optionalInfo`

CREATE TABLE `optionalInfo` (
    optional_ID` int(11) NOT NULL,
    streetAddress` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
    city` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
    state` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
    zip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
    website` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
    agesSeen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    agesSeen_ID` int(11) NOT NULL,
    languages` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    insurance` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    fees` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    operationHours_ID` int(11) NOT NULL,
    operationDay` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    operationStart` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    operationEnd` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    serviceCounty_ID` int(11) NOT NULL
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

Table structure for table `recommendedInfo`


CREATE TABLE `recommendedInfo` (
    recommendedInfo_ID` int(11) NOT NULL,
    firstName` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
    lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

Table structure for table `resourcesContact`


CREATE TABLE `resourcesContact` (
    resources_ID` int(11) NOT NULL,
    service_ID` int(11) NOT NULL,
    serviceType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    officeName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    officePhone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
    officeEmail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    therapistFirstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    therapistLastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    therapistGender` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
    therapistGender_ID` int(11) NOT NULL,
    recommendedInfo_ID` int(11) NOT NULL,
    status_ID` int(11) NOT NULL,
    status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
    street` int(100) NOT NULL,
    city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    state` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    zip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
    website` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
    optional_ID` int(11) NOT NULL,
    agesSeen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    languages` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    insurance` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    fees` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    dayOfOperations` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
    startTime` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
    endTime` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

Table structure for table `serviceType`

CREATE TABLE `serviceType` (
    service_ID` int(11) NOT NULL,
    typeName` varchar(255) CHARACTER SET latin1 NOT NULL
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
Table structure for table `statusBrand`

CREATE TABLE `status` (
    status_ID` int(11) NOT NULL,
    statusName` varchar(255) NOT NULL
    )ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

 Table structure for table `waMap`

CREATE TABLE `waMap` (
    'wa_ID` int(11) NOT NULL,
    ty` varchar(28) DEFAULT NULL,
    city_ascii` varchar(28) DEFAULT NULL,
    state_id` varchar(2) DEFAULT NULL,
    state_name` varchar(10) DEFAULT NULL,
    county_fips` int(5) DEFAULT NULL,
    county_name` varchar(12) DEFAULT NULL,
    county_fips_all` varchar(17) DEFAULT NULL,
    county_name_all` varchar(22) DEFAULT NULL,
    lat` decimal(6,4) DEFAULT NULL,
    lng` decimal(8,4) DEFAULT NULL,
    population` int(7) DEFAULT NULL,
    density` int(4) DEFAULT NULL,
    source` varchar(7) DEFAULT NULL,
    military` varchar(5) DEFAULT NULL,
    incorporated` varchar(5) DEFAULT NULL,
    timezone` varchar(19) DEFAULT NULL,
    ranking` int(1) DEFAULT NULL,
    zips` varchar(287) DEFAULT NULL
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;

------------------------------------------------------------
*/

/**
 * Robert Hill, Jittima Goodrich
 * 10/22/2019
 * CoderLite
 * This Class connects the db and runs Read queries
 */

//$user = $_SERVER['USER'];
require_once '/home/jgoodri1/config.php';


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
        try {
            //Instantiate a database object
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
//            $user = $_SERVER['USER'];
//            echo "Connected to DB with $user";

        } catch (PDOException $e) {
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

    /**
     * Function to get all the resources
     */
    public function getResourcesMain()
    {
        //Define Query
        $sql = "SELECT serviceType FROM resourcesContact LIMIT 2";

        //prepare statement
        $statement = $this->_dbh->prepare($sql);

        //execute statement
        $statement->execute();

        //Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * insert recommendedInfo of the user to database
     * @param $user - the user object
     * @return void
     */
    function recommendedInfo($user)
    {
        // prepare sql statement
        $sql = "INSERT INTO recommendedInfo (firstName, lastName, email, phone)
        VALUES (:firstName, :lastName, :email, :phone)";

        // save prepared statement
        $statement = $this->_dbh->prepare($sql);

        // assign values
        $firstName = $user->getFname();
        $lastName = $user->getLname();
        $email = $user->getEmail();
        $phone = $user->getPhone();

        // bind params
        $statement->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $statement->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);

        // execute insert into recommendedInfo
        $statement->execute();

        global $f3;
        $lastID = $this->_dbh->lastInsertId();
        $f3->set('recommendedInfo_ID', $lastID);
    }

    /**
     * gets the recommended info
     * @param $user - gets the user
     * @return array - mixed user info
     */
    function getRecommendedInfo($user)
    {
        // define the query
        $sql = 'SELECT * FROM recommendedInfo WHERE recommendedInfo_ID = :recommendedInfo_ID';

        // prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Bind the parameters
        $statement->bindParam(':recommendedInfo_ID', $user, PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();

        // Return the results
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * gets the Resources information based on a status param
     * @param $status is a String that is either Pending, Accepted, or Declined
     * @return array
     */
    function getResourceStatus($status)
    {
        switch($status)
        {
            case 3:
                //Declined
                $statusID = 3;
                break;
            case 2:
                //Accepted
                $statusID = 2;
                break;
            default:
                //Pending
                $statusID = 1;
        }

        // define the query
        $sql = 'SELECT
                    *,
                    statusBrand.statusLabel
                FROM
                    resources
                INNER JOIN statusBrand ON resources.statusID = statusBrand.statusID
                WHERE
                    resources.statusID = :statusID';

        //prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':statusID', $statusID, PDO::PARAM_STR);

        //Execute the statement
        $statement->execute();

        //Return the results
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}


