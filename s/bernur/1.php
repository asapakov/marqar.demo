<?php
	$servername = "localhost";
	$username = "u_markhar";
	$password = "a5Ylua76";
	$dbname = "markhar";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	// echo "Connected successfully";


	$sql = "SELECT id, parent_user_id, first_name, last_name FROM user ORDER BY id ASC LIMIT 10";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  $arr = "{id: 0},";
	  while($row = $result->fetch_assoc()) {
	    // echo "id: " . $row["id"]. " - Name: " . $row["first_name"]. " " . $row["last_name"]. "<br>"; 
	    $arr = $arr . "{id: " . $row["id"] . ", parentId: " . $row["parent_user_id"] . ", text: '22'},";  
	  }
	} else {
	  echo "0 results";
	}
	$conn->close(); 
	echo $arr;
?>