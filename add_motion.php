<?php
include("dbconnect.php");
$dblink = Connection();

$query = "INSERT INTO motion_logs(motion) VALUES('".$_GET["sensor1"]."')";

if(mysqli_query($dblink, $query)){
	echo "New record created successfully";
} else {
	echo "Error: " . $query . "<br>" . mysqli_error($dblink);
}

mysqli_close($dblink);
?>