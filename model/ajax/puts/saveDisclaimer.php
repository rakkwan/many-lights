<?php
/**
 * Created by PhpStorm.
 * User: samantha
 * Date: 2019-11-17
 * Time: 14:09
 */

session_start();


if ($_POST) {
    $_SESSION['approve'] = $_POST['approve'];
}