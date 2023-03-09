<?php

$page_roles= array('admin');

require_once 'login.php';
require_once 'checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

echo <<<_END
<form action="addUser.php" method="post"<pre>
	Username: <input type='text' name='username'></br></br>
	Forename: <input type='text' name='forename'></br></br>
	Surname: <input type='text' name='surname'></br></br>
	Password: <input type='text' name='password'></br></br>
	ID: <input type='text' name='id'></br></br>
	
	<input type="submit" name="ADD USER">
	</br></br>
	<a href="viewUser.php" >View all Books</a>
	<a href='logout.php'>Logout</a>
</pre></form>
_END;


if(isset($_POST['username']) &&
	isset($_POST['forename']) &&
	isset($_POST['surname']) &&
	isset($_POST['password']) &&
	isset($_POST['id'])) {
		$username=get_post($conn, 'username');
		$forename=get_post($conn, 'forename');
		$surname=get_post($conn, 'surname');
		$password=get_post($conn, 'password');
		$id=get_post($conn, 'id');
		
		$query="INSERT INTO usertable (username, forename, surname, password, id) VALUES ".
			"('$username','$forename','$surname','$password','$id')";
		$result=$conn->query($query);
		if(!$result) echo "INSERT failed: $query <br>" .
			$conn->error . "<br><br>";
	
	
}

$conn->close();

function get_post($conn, $var) {
	return $conn->real_escape_string($_POST[$var]);
}

?>