<?php
include("dbconnect.php");
$dblink = Connection();

$query = "INSERT INTO sound_activation_logs(status) VALUES('".$_GET["sensor2"]."')";

if(mysqli_query($dblink, $query)){
	echo "New record created successfully";
} else {
	echo "Error: " . $query . "<br>" . mysqli_error($dblink);
}

mysqli_close($dblink);
?>