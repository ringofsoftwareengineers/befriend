<?php

session_start();
include './functions.php';
if (isset($_SESSION['is_admin_logged_in'])) {

    header("location: adminhome.php");
} else {
    header("location: login.php");
}
        

