<?php
    ob_start();
    session_start();
    include("db_conn.php");
    if(!isset($_SESSION['admin_email']) || !isset($_GET['id'])){
        header("location: admin_login.php");
    }
    $id=$_GET['id'];
    if (isset($_POST['submit']))
    {
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $addr=$_POST['address'];
        $pass=$_POST['password'];
        $cpass=$_POST['confirm_password'];
        $course='';
        if(!empty($_POST['course'])) {
    		foreach($_POST['course'] as $ids) {
    			$course.=$ids.', ';
    			}
		}
		
		$course= rtrim($course, ", ");
		
		if($course=='')
		{
            echo '<script type="text/javascript">
                   window.onload = function () 
                   { alert("Choose Course !");
                  }
                    </script>';
		}
		else{
        
        $sql="UPDATE teacher SET firstname='$fname', lastname='$lname', email='$email', password='$pass', phone='$phone', course='$course', address='$addr' WHERE id=$id";
     
        if(mysqli_query($conn,$sql))
        {
            echo '<script type="text/javascript">
                   window.onload = function () 
                   { alert("Successfully Updated.");
                  }
                    </script>';
                    header("location: admin_dashboard.php");
            }
            else
            {
                echo "Error description:" . mysqli_error($conn);
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<?php include('head_links.php'); ?>
</head>
<body>
    <?php include('header_admin.php'); ?>
    <br><br><br><br><br><br>
	<?php
			$query2 = "SELECT * FROM teacher where id=$id";

			$result2=mysqli_query($conn,$query2);
			 while($row2 = mysqli_fetch_array($result2)) 
			 {
		?>
			 <center>
				<div class="col-md-8 event-item">
				<br>
				<center><h3 style="font-weight:600px;">TEACHER UPDATE</h3></center>
				<br>	
					<form class="comment-form --contact" action="" method="POST" >						
							<div class="row">
								<div class="col-lg-6" >
								    <input type="text" name="fname" placeholder="Firstname" pattern="[A-Za-z ]{3,}" maxlength="50" title="Name must contain alphabets only." value="<?php echo $row2['firstname'] ?>" required>
								    <input type="text"  name="lname" placeholder="Lastname" pattern="[A-Za-z ]{3,}" maxlength="50" title="Name must contain alphabets only." value="<?php echo $row2['lastname'] ?>"required>
									<input type="email" name="email" id="email" onblur="checkMailStatus()" placeholder="Email" value="<?php echo $row2['email'] ?>" readonly></input>
            						<div style="text-align: left;"><b style="font-size:18px;">Courses: &nbsp;&nbsp;</b>
									<?php
    									$query = "SELECT * FROM course";
    
    									$result=mysqli_query($conn,$query);
    									 while($row = mysqli_fetch_array($result)) 
    									 {
    								?>
									<input type="checkbox" name="course[]" value="<?php echo $row['course_name'] ?>" style="width: 14px; height: 14px; "> <?php echo $row['course_name'] ?>&nbsp;&nbsp;
            					<?php } ?>
									</div>
									<br><br>
																				
								</div>
								<div class="col-lg-6">
                                    <input type="password" id="password" name="password" placeholder="Password" value="<?php echo $row2['password'] ?>" required>
									<input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="<?php echo $row2['password'] ?>" required>
									<input type="text" name="phone" value="<?php echo $row2['phone'] ?>" placeholder="Phone No" pattern="[\d*]{10,}" minlength="10" maxlength="10" required>
                                    <input type="text" name="address" value="<?php echo $row2['address'] ?>" placeholder="Address" minlength="5" maxlength="60" required>                                 
								</div>
								<div class="col-lg-12">
										<div class="text-center">
											<button class="site-btn" type="submit" id="submit" name="submit">Update</button>
										</div>
									</div>
							</div>
				</form>
					
			
				</div>
	</center>
	<?php } ?>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/main1.js"></script>		
</body>
</html>