<?php

$page_roles= array('admin');

require_once  'login.php';
require_once 'checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


if(isset($_POST['delete']))
{
	$id = $_POST['id'];

	$query = "DELETE FROM usertable WHERE id='$id' ";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	header("Location: viewUser.php");
	
}


?>