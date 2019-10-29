<?php


/*
 *
 *
 * create table recommendedInfo
(
  recommendedInfoID int         not null auto_increment,
  primary key (refereeID),
  fname     varchar(50) not null,
  lname     varchar(50) not null,
  email     varchar(50) not null,
  phone     varchar(50) not null
);


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
  recommendedInfoID   int,

  FOREIGN KEY (serviceID) REFERENCES service (serviceID),
  FOREIGN KEY (refereeID) REFERENCES referee (refereeID)

)

------------------------------------------------------------
*/

/**
 * Robert Hill, Jittima Goodrich, Samantha Desmul
 * 10/22/2019
 * CoderLite
 * This Class connects the db and runs Read queries
 */


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
           //$user = $_SERVER['USER'];
            //echo "Connected to DB with $user";

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

    /*
     * -----------------------------------Jittima & Sang functions
     */


    /**
     * insert recommendedInfo of the user to database
     * @param $user - the user object
     * @return void
     */
    function recommendedInfo($user)
    {
        // prepare sql statement
        $sql = "INSERT INTO recommendedInfo (fname, lname, email, phone)
        VALUES (:fname, :lname, :email, :phone)";

        // save prepared statement
        $statement = $this->_dbh->prepare($sql);

        // assign values
        $fname = $user->getFname();
        $lname = $user->getLname();
        $email = $user->getEmail();
        $phone = $user->getPhone();

        // bind params
        $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
        $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);

        // execute insert into recommendedInfo
        $statement->execute();

        global $f3;
        $lastID = $this->_dbh->lastInsertId();
        $f3->set('recommendedInfoID', $lastID);
    }

    /**
     * gets the recommended info
     * @param $user - gets the user
     * @return array - mixed user info
     */
    function getRecommendedInfo($user)
    {
        // define the query
        $sql = 'SELECT * FROM recommendedInfo WHERE recommendedInfoID = :recommendedInfoID';

        // prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Bind the parameters
        $statement->bindParam(':recommendedInfoID', $user, PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();

        // Return the results
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Insert the service category
     * @param $service - gets the service info
     * @return void
     */
    function serviceInfo($service)
    {
        // prepare sql statement
        $sql = "INSERT INTO service (service)
        VALUES (:service)";

        // save prepared statement
        $statement = $this->_dbh->prepare($sql);

        // assign values
        $service = $service->getService();


        // bind params
        $statement->bindParam(':service', $service, PDO::PARAM_STR);

        // execute insert into recommendedInfo
        $statement->execute();

        global $f3;
        $lastServiceID = $this->_dbh->lastInsertId();
        $f3->set('serviceID', $lastServiceID);
    }

    /**
     * Gets the service info
     * @param $service
     * @return mixed
     */
    function getServiceInfo($service)
    {
        // define the query
        $sql = 'SELECT * FROM service WHERE serviceID = :serviceID';

        // prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Bind the parameters
        $statement->bindParam(':serviceID', $service, PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();

        // Return the results
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /*
    function insertService($service, $lastRecommendedInfoID)
    {
        $sqlSerID = 'SELECT serviceID FROM service WHERE service = :service';
        // save prepared statement
        $statementSerID = $this->_dbh->prepare($sqlSerID);
        // bind params
        $statementSerID->bindParam(':service', $service, PDO::PARAM_STR);
        // execute insert into recommendedInfo
        $statementSerID->execute();
        $serviceID = $statementSerID->fetch(PDO::FETCH_NUM);

        $sqlService = 'INSERT INTO resources()'

    }
    */




    /*
     * -----------------------------------------------------------------------------------------------
     */


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


