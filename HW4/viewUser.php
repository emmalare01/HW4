<?php

$page_roles= array('admin','user');

require_once 'login.php';
require_once  'checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

echo <<<_END
	<pre>
	<a href="addUser.php">Add User</a>
	<a href='logout.php'>Logout</a>
		
_END;

$query="SELECT * FROM usertable";
$result=$conn->query($query);
if(!$result) die ($conn->error);

$rows=$result->num_rows;
for($j=0; $j<$rows; $j++) {
	$result->data_seek($j);
	$row=$result->fetch_array(MYSQLI_BOTH);
	
	echo <<<_END
	<pre>
		ID $row[id];
		Username $row[username];
		Forename$row[forename];
		Surname $row[surname];
		Password $row[password];
	</pre>
	<form action="deleteUser.php" method="post">
	<input type="hidden" name="delete" value="yes">
	<input type="hidden" name="id" value="$row[id]">
	<input type="submit" value="DELETE RECORD">
	</form>
_END;
}

$result->close();
$conn->close();

function get_post($conn, $var) {
	return $conn->real_escape_string($_POST[$var]);
}



?>