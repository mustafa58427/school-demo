<?php session_start(); ?>
<?php if(!isset($_SESSION['username'])) { header("location:index.php"); } ?>
<?php include("admin-header.php"); ?>
<?php include("../security/connection.php"); ?>

<?php 
	/* sql to create table 
	$sql = "CREATE TABLE IF NOT EXISTS school (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	name VARCHAR(40) NOT NULL,
	reg_date TIMESTAMP
	)";
	
	
	if (!$conn->query($sql) === TRUE) {
		echo "Error creating table: " . $conn->error . "<br />";
	}*/
?>
		
    <div class="container">
    	<h2>Add School</h2>
    	<form action="addschool.php" method="post">
            <div class="form-group row">
              <label for="example-text-input" class="col-2 col-form-label">School Name</label>
              <div class="col-10">
                <input class="form-control" type="text" value="Artisanal kale" id="schoolname" name="schoolname">
              </div>
            </div>
           
            
             <button type="submit" name="add" class="btn btn-primary">Submit</button>
        </form>
        
        <?php
			if(isset($_POST['add'])) {	
				$schoolname = mysqli_real_escape_string($conn, $_POST['schoolname']);
				$sql = "INSERT INTO school(name) VALUES ('{$schoolname}')";
						
				if ($conn->query($sql) === FALSE) {
					echo "<br /> Sorry there was a problem, <b>" . $conn->error . "</b><br>";
				} else {
					echo "<br /><br />Your school " . $schoolname . " has been added";	
				}
			}
		?>

    </div>
    
<?php include("admin-footer.php"); ?>	