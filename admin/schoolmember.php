<?php session_start(); ?>
<?php if(!isset($_SESSION['username'])) { header("location:index.php"); } ?>
<?php include("admin-header.php"); ?>
<?php include("../security/connection.php"); ?>

    <div class="container">
    	<h2>School Members</h2>
        <br /> <br /><br /> 
                     
        <form action="schoolmember.php" method="post">                
                <div class="form-group row">
                    <label for="example-email-input" class="col-2 col-form-label">Schools</label>
                    <div class="col-10">
                        <select class="form-control" name="schoolselection">
                            <option>Please select school</option>
                            
                            <?php
                                $sql = "SELECT DISTINCT name, id FROM school";
                                $result = $conn->query($sql);
                    
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) { ?>
                                        <option value='<?php echo $row["id"]; ?>'>
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
                
                 <button type="submit" value="View" name="add" class="btn btn-primary">Submit</button>
            </form>
            
            <?php
            	if(isset($_POST['add'])) {					
									
					$schoolid = mysqli_real_escape_string($conn, $_POST['schoolselection']);					
					
					$sql = "SELECT member_id,school_id FROM schoolmember WHERE school_id = '$schoolid'";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							$memberid = $row['member_id'];
						}
					}
					
					if(isset($memberid)) {
						$sql = "SELECT firstname, lastname, email FROM member WHERE id = '$memberid'";
						$result = $conn->query($sql);
						
						if ($result->num_rows > 0) {
							echo "<h3>School Members</h3>";
							echo "<ol>";
							// output data of each row
							while($row = $result->fetch_assoc()) {
								echo "<li>" . $row["firstname"]. " " . $row['lastname'] . "</li><br />";
							}
							echo "</ol>";
						} 					
					} else {
						echo "<br /><b>Sorry but there are currently no members available at this school</b>";
					}	
				}
			?>
    
    </div>
    
<?php include("admin-footer.php"); ?>	