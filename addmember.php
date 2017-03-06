<?php include("includes/header.php"); ?>
<?php include("security/connection.php"); ?>
		
    <div class="container">
    	
            <h2>Add Member</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="form-group row">
                  <label for="example-text-input" class="col-2 col-form-label">First Name</label>
                  <div class="col-10">
                    <input class="form-control" type="text" value="Artisanal" id="firstname" name="firstname">
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="example-text-input" class="col-2 col-form-label">Last Name</label>
                  <div class="col-10">
                    <input class="form-control" type="text" value="Kale" id="lastname" name="lastname">
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="example-email-input" class="col-2 col-form-label">Email</label>
                  <div class="col-10">
                    <input class="form-control" type="email" value="bootstrap@example.com" id="example" name="email">
                  </div>
                </div>
                
                <div class="form-group row">
                    <label for="example-email-input" class="col-2 col-form-label">School</label>
                    <div class="col-10">
                        <select class="form-control" name="schoolselection">
                            <option>Please select school</option>
                            
                            <?php
                                $sql = "SELECT DISTINCT id, name FROM school";
                                $result = $conn->query($sql);
                    
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) { ?>
                                        <option value="<?php echo $row['id']; ?>">
                                            <?php echo $row["name"]; ?>
                                        </option>
                                    <?php }
                                } else {
                                    echo "Sorry but there are currently no schools available at the moment, please try again another time";
                                }
                            ?>                        
                        </select>
                    </div>
                </div>               
                
                 <button type="submit" name="add" class="btn btn-primary">Submit</button>
            </form>
            
            
            <?php
				//Execute only when submit button is clicked
				if(isset($_POST['add'])) {
					if(isset($_POST['firstname']) && !empty($_POST['firstname']) && isset($_POST['lastname']) && !empty($_POST['lastname'])) {
						
						$schoolid = mysqli_real_escape_string($conn, $_POST['schoolselection']);
						$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
						$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
						$email = mysqli_real_escape_string($conn, $_POST['email']);
						
						/***** test if member exists ***/				
						$sql = "SELECT * FROM member WHERE firstname = '$firstname' AND lastname = '$lastname'";							
						$result = $conn->query($sql);
						$memberid = $conn->insert_id;					
						if ($result->num_rows > 0) {						
							while($row = $result->fetch_assoc()) {
								$memberid = $row['id'];
							}		
						} else {
							
							//member does not exist
							$sql = "INSERT INTO member(firstname, lastname, email) VALUES ('{$firstname}', '{$lastname}', '{$email}')";							
							if ($conn->query($sql) === FALSE) {
								echo "Error: " . $sql . "<br>" . $conn->error;
							}
							
							$memberid = $conn->insert_id;						
						}
						
						$sql = "SELECT * FROM schoolmember WHERE member_id = '$memberid' AND school_id = '$schoolid'";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							echo "<br /><b>You are already registered for this school, please register for a different schoool, thank you </b><br />";
						} else {
							$sql = "INSERT INTO schoolmember(member_id, school_id) VALUES ('$memberid', '$schoolid')";					
							if ($conn->query($sql) === FALSE) {
								echo "<br /><b>Please ensure you have selected a school </b><br />";
							} else {
								echo "<h3>You have been added, " . $firstname . " " . $lastname . " thank you</h3>";
							}						
						}
					} else {
						echo "<br /><b>Please ensure that fields are not left empty"; 
					}
				}
			?>

    </div>
    
<?php include("includes/footer.php"); ?>	