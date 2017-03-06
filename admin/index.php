<?php session_start(); ?>
<?php if(isset($_SESSION['username'])) { header("location:admin.php"); } ?>
<?php include("../security/connection.php"); ?>

<?php
	/* sql to create table */
	

	$sql = "CREATE TABLE IF NOT EXISTS admin (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	username VARCHAR(30) NOT NULL UNIQUE,
	password VARCHAR(30) NOT NULL UNIQUE
	)";	
	
	if (!$conn->query($sql) === TRUE) {
		echo "Error creating table: " . $conn->error . "<br />";
	}
	
	$sql = "INSERT INTO admin (username, password) VALUES ('admin', 'password')";
	
	if (!$conn->query($sql) === TRUE) {
		//echo "Error creating table: " . $conn->error . "<br />";
	}
	
	

?>




<!DOCTYPE html>
	
<html lang="en">
	
	<head>
		<title>Mustafa Mohammed</title>
		<meta charset="utf-8">		
		<meta name="viewport" content="width=device-width, initial-scale=1">				
		
		<link rel="stylesheet" type="text/css" href="css/admin-style.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		
		
		<link href='http://fonts.googleapis.com/css?family=Lato:400,700,900,300' rel='stylesheet' type='text/css'>
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic" rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,600,700,900' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	</head>
	
	<body style="background-color:#000;">
		<div id="wrapper">
			<div class="container">
            
            	<div id="holder">                
                    <header>
                        <div class="jumbotron-fluid" id="banner">
                            <h2 class="display-2">Admin</h2>
                        </div>
                    </header>
                    
                    
                    <form action="index.php" method="post">
                        <div class="form-group row">
                          <label for="example-text-input" class="col-2 col-form-label">Username</label>
                          <div class="col-10">
                            <input class="form-control" type="text" value="admin" id="username" name="username">
                          </div>
                        </div>
                        
                        <div class="form-group row">
                          <label for="example-password-input" class="col-2 col-form-label">Password</label>
                          <div class="col-10">
                            <input class="form-control" type="password" id="pass" name="pass">
                          </div>
                        </div>
                        
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        <a href="../" class="btn btn-primary" role="button">Home Page</a>
                        
                    </form><br />
                    
                    <?php
						if(isset($_POST['submit'])) {
							$username = mysqli_real_escape_string($conn, $_POST['username']);
							$pass = mysqli_real_escape_string($conn, $_POST['pass']);
							$sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$pass'";
							$result = $conn->query($sql);
							
							if ($result->num_rows > 0) {
								$_SESSION['username'] = $_POST['username'];
								header("Location:admin.php");
							} else {
								echo "Sorry, Your username/password was incorrect";
							}		
						}
					?>
                </div>
        
            </div>
    
        </div><!-- end of wrapper -->
		
		<?php if(isset($conn)) { $conn->close(); } ?>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
</html>