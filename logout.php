<?php
ob_start();
session_start();

ob_flush();
session_destroy();


header('location: login.php');

?>