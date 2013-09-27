<?php 
session_start();
include('constants.php');

if(!isset($_SESSION['username']) || $_SESSION['username'] != "admin")
{
	header('Location: '.loginUrl);
}
?>