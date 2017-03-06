<?php include("includes/header.php"); ?>
<?php include("security/connection.php"); ?>
<?php include("createtables.php"); ?>


    <div class="container">
    
    	
    
    	<?php			
			$sql = "SELECT DISTINCT name FROM school";
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				echo "<h3>Here are a list of the schools we currently have</h3>";
				echo "<ul>";
				// output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<li>" . $row["name"]. "</li><br />";
				}
				echo "</ul>";
			} else {
				echo "Sorry but there are currently no schools available at the moment, please try again another time";
			}
			
		?> 
        
        <br /><br /><br />
        <h3>We are always updating so keep checking</h3>
    </div>
    
<?php include("includes/footer.php"); ?>	