	<?php
	include("dbconnect.php");
	$dblink = Connection();
	$page = $_SERVER['PHP_SELF'];
	$sec = "5";

	$query = "SELECT * FROM sound_activation_logs ORDER BY timestamp ASC";

	if($result = mysqli_query($dblink, $query)){
		echo "Reading records successfully from sound_activation_logs <br>";
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($dblink);
	}
	?>

<html>
	<title>Sound Detection</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<style>
	body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
	.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
	.fa-anchor,.fa-coffee {font-size:200px}
	</style>
	
<body>
<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-green w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-green" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="index.html" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
	<a href="review_data_motion.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Motion</a>
	<a href="review_sound_activation.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Sound Activation</a>
	<a href="about_us.html" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">About Us</a>
  </div>
</div>  

	<!-- Header -->
	<header class="w3-container w3-green w3-center" style="padding:20px 16px">
	  <h1 class="w3-margin w3-jumbo">Sound Activation</h1>
	  <p class="w3-xlarge">Prepared by Tan Jing Khai and Reuben Tan</p>
	  
	</header>



		<!--Content-->
		<div class = "w3-center">
		   <h1>Arduino Sensors Data</h1>
		   <h3>Sound Activation Reading</h3>
		   <table border="1" cellspacing="1" cellpadding="1" class = "w3-table-all">
				<tr>
					<td>Timestamp</td><td>Status</td>
				</tr>
			  <?php 
				  if(mysqli_num_rows($result) > 0){
					 while($row = mysqli_fetch_assoc($result)) {
						printf("<tr>
									<td>%s</td><td>%s</td>
							   </tr>", 
						   $row["timestamp"], $row["status"]);
					 }
				  }
				  mysqli_close($dblink);
			  ?>
		   </table>
		</div>
   <!-- Footer -->
	<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
	  <div class="w3-xlarge w3-padding-32">
		<i class="fa fa-facebook-official w3-hover-opacity"></i>
		<i class="fa fa-instagram w3-hover-opacity"></i>
		<i class="fa fa-snapchat w3-hover-opacity"></i>
		<i class="fa fa-pinterest-p w3-hover-opacity"></i>
		<i class="fa fa-twitter w3-hover-opacity"></i>
		<i class="fa fa-linkedin w3-hover-opacity"></i>
	 </div>
	 <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
	</footer>

	<script>
	// Used to toggle the menu on small screens when clicking on the menu button
	function myFunction() {
		var x = document.getElementById("navDemo");
		if (x.className.indexOf("w3-show") == -1) {
			x.className += " w3-show";
		} else { 
			x.className = x.className.replace(" w3-show", "");
		}
	}
	</script>
</body>
</html>