<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

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

**Table for adminLogin**

CREATE TABLE adminLogin
(
	adminID INTEGER NOT NULL AUTO_INCREMENT,
	email VARCHAR(254) NOT NULL,
	password VARCHAR(128) NOT NULL,
    masterAdmin BOOLEAN NOT NULL,
    fname VARCHAR(50),
    lname VARCHAR(50),
	UNIQUE (email),
	PRIMARY KEY (adminID)
);

ALTER TABLE adminLogin
ADD fname VARCHAR(50)


ALTER TABLE adminLogin
ADD masterAdmin BOOLEAN NOT NULL DEFAULT FALSE;

INSERT INTO adminLogin (email, password)
VALUES ('coderlite@email.com', 'coderLite1');

CREATE TABLE openHours(
    dayID INT NOT NULL AUTO_INCREMENT,
    primary key(dayID),
    day varchar(20),
    start varchar(20),
    end varchar(20),
	FOREIGN KEY (resourceID) REFERENCES resources (resourceID)
)

------------------------------------------------------------
*/

/**
 * Robert Hill, Jittima Goodrich, Samantha Desmul
 * 10/22/2019
 * CoderLite
 * This Class connects the db and runs Read queries
 */


require_once '/home/laursh/config.php';
class Databases
{

    private $_dbh;
    private $_errorMessage;
    private $_longSql = 'SELECT DISTINCT 
                resourceID,
                speciality,
                office,
                officeEmail,
                officePhone,
                theraFname,
                theraLname,
                theraGender,
                interpreter,
                insurance,
                fee,
                age,
                countyOne,
                countyTwo,
                countyThree,
                address,
                city,
                state,
                zip,
                website,
                service.service AS Resource_ServiceType,
                recommendedInfo.email AS Referral_email,
                recommendedInfo.fname AS Referral_fname,
                recommendedInfo.lname AS Referral_lname,
                recommendedInfo.phone AS Referral_phone,
                statusBrand.statusLabel AS Resource_status
            FROM
                resources';

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
        $sql = "SELECT * FROM resources LIMIT 5";

        //prepare statement
        $statement = $this->_dbh->prepare($sql);

        //execute statement
        $statement->execute();

        //Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }


    public function getResourcesMain()
    {
        //Define Query
        $sql = "SELECT service.service,theraFname,theraLname, officePhone, countyOne,countyTwo,countyThree, officeEmail,address,city,zip,state 
from resources join service on resources.serviceID = service.serviceID limit 2";

        //prepare statement
        $statement = $this->_dbh->prepare($sql);

        //execute statement
        $statement->execute();

        //Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }


    /**
     * --------------------------adminLogin functions (Jittima)----------------------------------------
     *
     */


    /**
     * Get the admin email
     * @param $adminEmail - admin email
     * @return mixed the ID of the admin
     */
    function getAdmin($adminEmail)
    {
        $sql = 'SELECT email FROM adminLogin WHERE email = :email';
        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':email', $adminEmail, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Get the all admin
     * @return mixed the ID of the admin
     */
    function getAllAdmin()
    {
        $sql = 'SELECT * FROM adminLogin';
        $statement = $this->_dbh->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Attempts to log the admin in
     * @param String $email - the email given
     * @param String $password - the password given
     * @return mixed the ID of the admin
     */
    function adminLogin($email, $password)
    {
        $sql = "SELECT adminID, masterAdmin FROM adminLogin WHERE email = :email AND password = :password ";
        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);


        global $f3;
        $f3->set('adminID', $row['adminID']);
        $f3->set('masterAdmin', $row['masterAdmin']);
        return $row;
    }

    /**
     * Check if the email is already in the database
     * @param String $email - the given email
     * @return mixed - the email if it was already in the database
     */
    function checkEmail($email)
    {
        $sql = "SELECT * FROM adminLogin WHERE email = :email";
        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Changes the user's email
     * @param int $admin the adminID
     * @param String $email - the new email
     * @return void
     */
    function changeEmail($admin, $email)
    {
        $sql = "UPDATE adminLogin SET email = :email WHERE adminID = :adminID";
        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':adminID', $admin, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->excute();
    }

    /**
     * Change the admin's current password
     * @param int $email - admin email
     * @param String $password - the new password
     * @return void
     */
    function changePassword($email, $password)
    {
        $sql = "UPDATE adminLogin SET password = :password WHERE email = :email";
        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
        $statement->execute();
    }


    /**
     * Function to create the new admin user
     * @param $admin - String admin object
     */
    function createAdmin($admin)
    {
        // prepare sql statement
        $sql = "INSERT INTO adminLogin (email, password, masterAdmin, fname, lname)
        VALUES (:email, :password, :masterAdmin, :fname, :lname)";

        // save prepared statement
        $statement = $this->_dbh->prepare($sql);

        // assign value
        $email = $admin->getEmail();
        $password = $admin->getPassword();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $masterAdmin = $admin->getAdminType();
        $fname = $admin->getFname();
        $lname = $admin->getLname();

        // bind params
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $hash, PDO::PARAM_STR);
        $statement->bindParam(':masterAdmin', $masterAdmin, PDO::PARAM_BOOL);
        $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
        $statement->bindParam(':lname', $lname, PDO::PARAM_STR);

        // execute insert into recommendedInfo
        $statement->execute();

        global $f3;
        $lastID = $this->_dbh->lastInsertId();
        $f3->set('adminID', $lastID);
    }

    /**
     * Deletes the given admin
     * @param $admin - admin that want to delete
     */
    function deleteAdmin($admin)
    {
        $sql = "DELETE FROM adminLogin WHERE adminID = :adminID";
        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':adminID', $admin, PDO::PARAM_STR);
        $statement->execute();
    }


    /**
     * ------------------------------------- Jittima & Sang (FE functions)-------------------------
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
        $sql = 'SELECT * FROM service WHERE service = :service';

        // prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Bind the parameters
        $statement->bindParam(':service', $service, PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();

        // Return the results
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function getServiceID($service)
    {
        // define the query
        $sql = 'SELECT serviceID FROM service WHERE service = :service';

        // prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Bind the parameters
        $statement->bindParam(':service', $service, PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();

        global $f3;

        // Return the results
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $f3->set('serviceID', $result);
    }

    function resourceInfo($resource)
    {
        // prepare sql statement
        $sql = "INSERT INTO resources 
        (speciality, office, officeEmail, officePhone, theraFname, theraLname, theraGender, serviceID, recommendedInfoID, statusID)
        VALUES (:speciality, :office, :officeEmail, :officePhone, :theraFname, :theraLname, :theraGender, :serviceID, :recommendedInfoID, 1)";

        // save prepared statement
        $statement = $this->_dbh->prepare($sql);

        global $f3;
        // assign values
        $speciality = $resource->getSpecialty();
        $office = $resource->getOffice();
        $officeEmail = $resource->getOfficeEmail();
        $officePhone = $resource->getOfficePhone();
        $theraFname = $resource->getTheraFname();
        $theraLname = $resource->getTheraLname();
        $theraGender = $resource->getTheraGender();
        $serviceID = $f3->get('serviceID');
        $recommendedInfoID = $f3->get('recommendedInfoID');


        // bind params
        $statement->bindParam(':speciality', $speciality, PDO::PARAM_STR);
        $statement->bindParam(':office', $office, PDO::PARAM_STR);
        $statement->bindParam(':officeEmail', $officeEmail, PDO::PARAM_STR);
        $statement->bindParam(':officePhone', $officePhone, PDO::PARAM_STR);
        $statement->bindParam(':theraFname', $theraFname, PDO::PARAM_STR);
        $statement->bindParam(':theraLname', $theraLname, PDO::PARAM_STR);
        $statement->bindParam(':theraGender', $theraGender, PDO::PARAM_STR);
        $statement->bindParam(':serviceID', $serviceID, PDO::PARAM_STR);
        $statement->bindParam(':recommendedInfoID', $recommendedInfoID, PDO::PARAM_INT);

        // execute insert into recommendedInfo
        $statement->execute();

        $lastID = $this->_dbh->lastInsertId();
        $f3->set('resourceID', $lastID);
    }

    function getResourceInfo()
    {
        // define the query
        $sql = 'SELECT * FROM resources';

        // prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Execute the statement
        $statement->execute();

        // Return the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function updateLocation($location, $resourceID)
    {
        // define the query
        $sql = 'UPDATE resources 
        SET address = :address, city = :city, state = :state, zip = :zip, website = :website 
        WHERE resourceID = :resourceID';

        // prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // assign values
        $address = $location->getAddress();
        $city = $location->getCity();
        $state = $location->getState();
        $zip = $location->getZip();
        $website = $location->getWebsite();

        // bind params
        $statement->bindParam(':address', $address, PDO::PARAM_STR);
        $statement->bindParam(':city', $city, PDO::PARAM_STR);
        $statement->bindParam(':state', $state, PDO::PARAM_STR);
        $statement->bindParam(':zip', $zip, PDO::PARAM_STR);
        $statement->bindParam(':website', $website, PDO::PARAM_STR);
        $statement->bindParam(':resourceID', $resourceID, PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();
    }


    function updateOptionalInfo($optional, $resourceID)
    {
        // define the query
        $sql = 'UPDATE resources 
        SET interpreter = :interpreter, insurance = :insurance, fee = :fee, age = :age
        WHERE resourceID = :resourceID';

        // prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // assign values
        $interpreter = $optional->getInterpreter();
        $insurance = $optional->getInsurance();
        $fee = $optional->getFee();
        $age = $optional->getAge();

        // bind params
        $statement->bindParam(':interpreter', $interpreter, PDO::PARAM_STR);
        $statement->bindParam(':insurance', $insurance, PDO::PARAM_STR);
        $statement->bindParam(':fee', $fee, PDO::PARAM_STR);
        $statement->bindParam(':age', $age, PDO::PARAM_STR);
        $statement->bindParam(':resourceID', $resourceID, PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();
    }


    function dayHours($day, $startTime, $endTime, $resourceID)
    {
        // prepare sql statement
        $sql = "INSERT INTO openHours
        (day, start, end, resourceID)
        VALUES (:day, :start, :end, :resourceID)";

        // save prepared statement
        $statement = $this->_dbh->prepare($sql);

        // bind params
        $statement->bindParam(':day', $day, PDO::PARAM_STR);
        $statement->bindParam(':start', $startTime, PDO::PARAM_STR);
        $statement->bindParam(':end', $endTime, PDO::PARAM_STR);
        $statement->bindParam(':resourceID', $resourceID, PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();
    }


    function updateCounties($countyOne, $countyTwo, $countyThree, $resourceID)
    {
        // define the query
        $sql = "UPDATE resources
        SET countyOne = :countyOne, countyTwo = :countyTwo, countyThree = :countyThree
        WHERE resourceID = :resourceID";

        // prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // bind params
        $statement->bindParam(':countyOne', $countyOne, PDO::PARAM_STR);
        $statement->bindParam(':countyTwo', $countyTwo, PDO::PARAM_STR);
        $statement->bindParam(':countyThree', $countyThree, PDO::PARAM_STR);
        $statement->bindParam(':resourceID', $resourceID, PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();
    }

    /**
     * -----------------------------------------------------------------------------------------------
     *
     *
     *
     *---------------------------------------- BE & Admin Functions ----------------------------------
     *
     *
     *
     *________________________________________________________________________________________________
     */

    /**
     * Function to get Selected resource and associated info values
     * @param int to represent resourceID
     * @return array (Associative)
     */
    function getSelectedListInfo($id)
    {

        //   join openHours on resources.resourceID = openHours.resourceID

        $sql = $this->_longSql . ' ' . " 
                INNER JOIN statusBrand ON resources.statusID = statusBrand.statusID
                INNER JOIN recommendedInfo ON resources.recommendedInfoID = recommendedInfo.recommendedInfoID
                INNER JOIN service ON resources.serviceID = service.serviceID
               
                WHERE resources.resourceID = :id";

        //prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':id', $id, PDO::PARAM_STR);

        //Execute the statement
        $statement->execute();

        //Return the results
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * This is to update the status of the resource
     * will return the updated resource
     * @param $resourceID int resourceID
     * @param $statusID int statusID
     * @return array (Associative)
     */
    function updateStatus($resourceID, $statusID)
    {
        // address city state zip website serviceID recommendedInfoID statusID

        // define the query
        $sql = 'UPDATE
                 resources
                SET
                statusID = :statusID
                WHERE
                resourceID = :resourceID';

        // prepare the statement
        $statement = $this->_dbh->prepare($sql);


        // bind params
        $statement->bindParam(':resourceID', $resourceID, PDO::PARAM_STR);
        $statement->bindParam(':statusID', $statusID, PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();

        //confirmation
        return $this->getSelectedListInfo($resourceID);
    }

    /**
     * Function gets all the Resource Information based on a status from the DB
     * @param $statusID int is either Pending(1), Accepted(2), or Declined(3)
     * @return array
     */
    function getViewListingInfo($statusID)
    {
        $sql = 'SELECT
                resourceID,
                service.service AS Resource_ServiceType,
                theraFname,
                theraLname,
                office,
                officePhone,
                officeEmail,
                address
                FROM
                resources
                INNER JOIN service ON resources.serviceID = service.serviceID
                WHERE
                resources.statusID = :statusID';

        // prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // bind params
        $statement->bindParam(':statusID', $statusID, PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();

        //Return the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * This function returns the information for the resources Listing view
     * @return array
     */
    function getResourcesInfo()
    {
        $sql = 'SELECT
                resourceID,
                service.service AS Resource_ServiceType,
                theraFname,
                theraLname,
                office,
                officePhone,
                officeEmail,
                address
                FROM
                resources
                INNER JOIN service ON resources.serviceID = service.serviceID';

        // prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Execute the statement
        $statement->execute();

        //Return the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * This function returns the information for the Admin Listing view
     * @return array
     */
    function getAdminListingInfo()
    {
        $sql = 'SELECT
                resourceID,
                service.service AS Resource_ServiceType,
                theraFname,
                theraLname,
                office,
                officePhone,
                officeEmail,
                city, 
                statusBrand.statusLabel AS Listing_Status
                FROM
                resources
                INNER JOIN service ON resources.serviceID = service.serviceID
                INNER JOIN statusBrand ON resources.statusID = statusBrand.statusID
                ';

        // prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Execute the statement
        $statement->execute();

        //Return the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Function to Modify information in the DB from  the Admin Listing View Edit
     * @param $info array $_POST
     * @return array ??? Always comes back false.
     */
    function putAdminListingInfo($info)
    {
        $id = $info["resKey"];

        $resKey = $info["resKey"];
        $resType = $info["resType"];
        $resName = $info["resName"];
        $resWeb = $info["resWeb"];
        $resCert = $info["resCert"];
        $resIns = $info["resIns"];
        $resFee = $info["resFee"];
        $resAdd = $info["resAdd"];
        $resCity = $info["resCity"];
        $resPoc = $info["resPoc"];
        $resPocL = $info["resPocL"];
        $resEmail = $info["resEmail"];
        $resPhone = $info["resPhone"];
        $resGender = $info["resGender"];
//        $resAges = $info["resAges"];
        $resLang = $info["resLang"];
        $resSt = $info["resSt"];
        $resZip = $info["resZip"];
        $resCou = $info["resCou"];
        $refName = $info["refName"];
        $refNameL = $info["refNameL"];
        $refEmail = $info["refEmail"];
        $refPhone = $info["refPhone"];
//        $resOsun = $info["resOsun"];
//        $resOmon = $info["resOmon"];
//        $resOtues = $info["resOtues"];
//        $resOwed = $info["resOwed"];
//        $resOthurs = $info["resOthurs"];
//        $resOfri = $info["resOfri"];
//        $resOsat = $info["resOsat"];
//        $resEsun = $info["resEsun"];
//        $resEmon = $info["resEmon"];
//        $resEtue = $info["resEtue"];
//        $resEwed = $info["resEwed"];
//        $resEthur = $info["resEthur"];
//        $resEfri = $info["resEfri"];
//        $resEsat = $info["resEsat"];

        $sql = '
            SET
            @res = :resKey;
            START TRANSACTION
                ;
            UPDATE
                resources
            SET
                office = :resName,
                address = :resAdd,
                city = :resCity,
                state = :resSt,
                fee = :resFee,
                zip = :resZip,
                insurance = :resIns,
                interpreter = :resLang,
                officeEmail = :resEmail,
                officePhone = :resPhone,
                theraFname = :resPoc,
                theraLname = :resPocL,
                theraGender = :resGender,
                website = :resWeb,
                speciality = :resType,
                fee = :resFee,
                countyOne = :resCou
            WHERE
                resourceID = @res;
            UPDATE
                recommendedInfo,
                resources
            SET
                recommendedInfo.email = :refEmail,
                recommendedInfo.fname = :refName,
                recommendedInfo.lname = :refNameL,
                recommendedInfo.phone = :refPhone
            WHERE
                resources.resourceID = @res AND recommendedInfo.recommendedInfoID = resources.recommendedInfoID;
            COMMIT
                ;
        ';

        // prepare the statement
        $statement = $this->_dbh->prepare($sql);


        // bind params
        $statement->bindParam(':resKey', $resKey, PDO::PARAM_STR);
        $statement->bindParam(':resType', $resType, PDO::PARAM_STR);
        $statement->bindParam(':resName', $resName, PDO::PARAM_STR);
        $statement->bindParam(':resWeb', $resWeb, PDO::PARAM_STR);
        $statement->bindParam(':resCert', $resCert, PDO::PARAM_STR);
        $statement->bindParam(':resIns', $resIns, PDO::PARAM_STR);
        $statement->bindParam(':resFee', $resFee, PDO::PARAM_STR);
        $statement->bindParam(':resAdd', $resAdd, PDO::PARAM_STR);
        $statement->bindParam(':resCity', $resCity, PDO::PARAM_STR);
        $statement->bindParam(':resPoc', $resPoc, PDO::PARAM_STR);
        $statement->bindParam(':resPocL', $resPocL, PDO::PARAM_STR);
        $statement->bindParam(':resEmail', $resEmail, PDO::PARAM_STR);
        $statement->bindParam(':resPhone', $resPhone, PDO::PARAM_STR);
        $statement->bindParam(':resGender', $resGender, PDO::PARAM_STR);
//        $statement->bindParam(':resAges',$resAges, PDO::PARAM_STR); Waiting for Ages Seen Table
        $statement->bindParam(':resLang', $resLang, PDO::PARAM_STR);
        $statement->bindParam(':resSt', $resSt, PDO::PARAM_STR);
        $statement->bindParam(':resZip', $resZip, PDO::PARAM_STR);
        $statement->bindParam(':resCou', $resCou, PDO::PARAM_STR);
        $statement->bindParam(':refName', $refName, PDO::PARAM_STR);
        $statement->bindParam(':refName', $refName, PDO::PARAM_STR);
        $statement->bindParam(':refNameL', $refNameL, PDO::PARAM_STR);
        $statement->bindParam(':refEmail', $refEmail, PDO::PARAM_STR);
        $statement->bindParam(':refPhone', $refPhone, PDO::PARAM_STR);

        //Waiting to see how the Hours will be stored
//        $statement->bindParam(':resOsun',$resOsun, PDO::PARAM_STR);
//        $statement->bindParam(':resOmon',$resOmon, PDO::PARAM_STR);
//        $statement->bindParam(':resOtues',$resOtues, PDO::PARAM_STR);
//        $statement->bindParam(':resOwed',$resOwed, PDO::PARAM_STR);
//        $statement->bindParam(':resOthurs',$resOthurs, PDO::PARAM_STR);
//        $statement->bindParam(':resOfri',$resOfri, PDO::PARAM_STR);
//        $statement->bindParam(':resOsat',$resOsat, PDO::PARAM_STR);
//        $statement->bindParam(':resEsun',$resEsun, PDO::PARAM_STR);
//        $statement->bindParam(':resEmon',$resEmon, PDO::PARAM_STR);
//        $statement->bindParam(':resEtue',$resEtue, PDO::PARAM_STR);
//        $statement->bindParam(':resEwed',$resEwed, PDO::PARAM_STR);
//        $statement->bindParam(':resEthur',$resEthur, PDO::PARAM_STR);
//        $statement->bindParam(':resEfri',$resEfri, PDO::PARAM_STR);
//        $statement->bindParam(':resEsat',$resEsat, PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();

        //confirmation
        return $this->getSelectedListInfo($id);
    }

    function bulkUpload($key, $info)
    {
        $batch = 0;
        $sql = '
        SET
            @res = :adminLogin;
        START TRANSACTION
            ;
        INSERT INTO resources(
            speciality,
            office,
            officeEmail,
            officePhone,
            theraFname,
            theraLname,
            theraGender,
            interpreter,
            insurance,
            fee,
            age,
            countyOne,
            countyTwo,
            countyThree,
            address,
            city,
            state,
            zip,
            website,
            serviceID,
            recommendedInfoID,
            statusID,
            credentials
            /**--,SOURCE**/
        )
        VALUES(
            :speciality,
            :office,
            :officeEmail,
            :officePhone,
            :theraFname,
            :theraLname,
            :theraGender,
            :interpreter,
            :insurance,
            :fee,
            :age,
            :countyOne,
            :countyTwo,
            :countyThree,
            :address,
            :city,
            :state,
            :zip,
            :website,
            :serviceID,
            @res,
            :statusID,
            :credentials
            /*:--,source*/
        );
        UPDATE
            recommendedInfo,
            adminLogin
        SET
            recommendedInfo.email = adminLogin.email,
            recommendedInfo.fname = adminLogin.fname,
            recommendedInfo.lname = adminLogin.lname,
            recommendedInfo.phone = "1-800-ManyLights"
        WHERE
            adminLogin.adminID = @res AND recommendedInfo.phone = "1-800-ManyLights";
        COMMIT
            ;
        ';

        foreach ($info as $data)
        {
            $adminLogin = $key;
            $speciality = $data["speciality"];
            $office = $data["office"];
            $officeEmail = $data["officeEmail"];
            $officePhone = $data["officePhone"];
            $theraFname = $data["theraFname"];
            $theraLname = $data["theraLname"];
            $theraGender = $data["theraGender"];
            $interpreter = $data["interpreter"];
            $insurance = $data["insurance"];
            $fee = $data["fee"];
            $age = $data["age"];
            $countyOne = $data["countyOne"];
            $countyTwo = $data["countyTwo"];
            $countyThree = $data["countyThree"];
            $address = $data["address"];
            $city = $data["city"];
            $state = $data["state"];
            $zip = $data["zip"];
            $website = $data["website"];
            $serviceID = $data["serviceID"];
            $recommendedInfoID = $data["recommendedInfoID"];
            $statusID = 1;
            $credentials = $data["credentials"];
            $source = $data['source'];

            // prepare the statement
            $statement = $this->_dbh->prepare($sql);

            // bind params
            $statement->bindParam(':adminLogin', $adminLogin, PDO::PARAM_STR);
            $statement->bindParam(':speciality', $speciality, PDO::PARAM_STR);
            $statement->bindParam(':office', $office, PDO::PARAM_STR);
            $statement->bindParam(':officeEmail', $officeEmail, PDO::PARAM_STR);
            $statement->bindParam(':officePhone', $officePhone, PDO::PARAM_STR);
            $statement->bindParam(':theraFname', $theraFname, PDO::PARAM_STR);
            $statement->bindParam(':theraLname', $theraLname, PDO::PARAM_STR);
            $statement->bindParam(':theraGender', $theraGender, PDO::PARAM_STR);
            $statement->bindParam(':interpreter', $interpreter, PDO::PARAM_STR);
            $statement->bindParam(':insurance', $insurance, PDO::PARAM_STR);
            $statement->bindParam(':fee', $fee, PDO::PARAM_STR);
            $statement->bindParam(':age', $age, PDO::PARAM_STR);
            $statement->bindParam(':countyOne', $countyOne, PDO::PARAM_STR);
            $statement->bindParam(':countyTwo', $countyTwo, PDO::PARAM_STR);
            $statement->bindParam(':countyThree', $countyThree, PDO::PARAM_STR);
            $statement->bindParam(':address', $address, PDO::PARAM_STR);
            $statement->bindParam(':city', $city, PDO::PARAM_STR);
            $statement->bindParam(':state', $state, PDO::PARAM_STR);
            $statement->bindParam(':zip', $zip, PDO::PARAM_STR);
            $statement->bindParam(':website', $website, PDO::PARAM_STR);
            $statement->bindParam(':serviceID', $serviceID, PDO::PARAM_STR);
//            $statement->bindParam(':recommendedInfoID', $recommendedInfoID, PDO::PARAM_STR);
            $statement->bindParam(':statusID', $statusID, PDO::PARAM_STR);
            $statement->bindParam(':credentials', $credentials, PDO::PARAM_STR);
//            $statement->bindParam(':source', $source, PDO::PARAM_STR);

            // Execute the statement
            $statement->execute();

          $batch = $batch + $statement->rowCount();
        }

        return $batch;
    }
}


