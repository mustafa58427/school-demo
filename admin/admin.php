<?php session_start(); ?>
<?php
	if(!isset($_SESSION['username'])) {
		header("location:index.php");
	}
?>
<?php include("admin-header.php"); ?>
<?php include("../security/connection.php"); ?>

			
    <div class="container">
    	<?php		
			
			echo "<br />";
			echo "<h2>Current Schools</h2><br />";
			
			$sql = "SELECT name FROM school";
			$result = $conn->query($sql);
			echo "<ul>";
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<li>School Name: " . $row["name"]. "</li><br />";
				}
			} else {
				echo "Sorry but there are currently no schools available at the moment, please try again another time";
			}
			echo "</ul>";
		?> 
    	
    </div>
    
<?php include("admin-footer.php"); ?>	