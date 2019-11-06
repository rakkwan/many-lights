<?php

require_once ('../../database.php');

if(!empty($_POST)) {

        //access DB
        $db = new Databases();

        echo json_encode($db->putAdminListingInfo($_POST));
}