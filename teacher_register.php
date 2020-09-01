<?php
    ob_start();
    session_start();
    include("db_conn.php");
    if(!isset($_SESSION['admin_email'])){
        header("location: admin_login.php");
    }
    if (isset($_POST['submit']))
    {
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $addr=$_POST['address'];
        $id_proof=$_POST['id_proof'];
        $pass=$_POST['password'];
        $cpass=$_POST['confirm_password'];
        $course='';
        if(!empty($_POST['course'])) {
		foreach($_POST['course'] as $id) {
			$course.=$id.', ';
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
        
        $sql="INSERT INTO `teacher`(`firstname`, `lastname`, `email`, `password`, `phone`, `course`, `id_proof`, `address`, `enabled`) 
        VALUES ('$fname', '$lname', '$email','$pass','$phone','$course','$id_proof','$addr',1)" ;
        if(mysqli_query($conn,$sql))
        {
            echo '<script type="text/javascript">
               window.onload = function () 
               { alert("Successfully Registered.");
              }
                </script>';
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
	<script type="text/javascript">
        function checkMailStatus(){
        var temail=$("#email").val();
        $.ajax({
            type:'post',
                url:'checkMail.php',
                data:{temail: temail},
                success:function(msg){
                if(msg=="Email already exists"){
                    alert(msg);  
                    document.getElementById('email').value = '';
                    }
                }
         });
        }
    </script>
</head>
<body>
    <?php include('header_admin.php'); ?>
    <br><br><br><br><br><br>
    <center>
				<div class="col-md-8 event-item">
				<br>
				<center><h3 style="font-weight:600px;">TEACHER REGISTRATION</h3></center>
				<br>	
				
					<form class="comment-form --contact" action="" method="POST" >						
							<div class="row">
								<div class="col-lg-6">
								    <input type="text" name="fname" pattern="[A-Za-z ]{3,}" maxlength="50" title="Name must contain alphabets only." placeholder="Firstname" required>
								    <input type="text"  name="lname" pattern="[A-Za-z ]{3,}" maxlength="50" title="Name must contain alphabets only." placeholder="Lastname" required>
									<input type="email" name="email" id="email"  onblur="checkMailStatus()" placeholder="Email" required></input>
									<div  style="text-align: left;"><b style="font-size:18px;">Courses: &nbsp;&nbsp;</b>
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
                                    <input type="password" id="password" name="password" placeholder="Password" required>
									<input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
									<input type="text" name="phone" placeholder="Phone No" pattern="[\d*]{10,}" minlength="10" maxlength="10" required>
                                    <input type="text" name="address" placeholder="Address" minlength="5" maxlength="60" required>                                 
								</div>
								<div class="col-lg-12">
										<div class="text-center">
											<button class="site-btn" type="submit" id="submit" name="submit">REGISTER</button>
										</div>
									</div>
							</div>
					</form>
					
			
				</div>
	</center>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/main1.js"></script>		
</body>
</html>