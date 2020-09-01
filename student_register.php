<?php
    session_start();
    include("db_conn.php");
    if (isset($_POST['submit']))
    {
        $email=$_POST['email'];
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $telegram_no=$_POST['telegram_no'];
        $phone=$_POST['phone'];
        $phone2=$_POST['phone2'];
        $addr=$_POST['address'];
        $dob=$_POST['dob'];
        $hq=$_POST['hq'];
        $we=$_POST['we'];
        $payment_ph_no=$_POST['payment_ph_no'];
        $payment_date=$_POST['payment_date'];
        $pass=$_POST['password'];
        $cpass=$_POST['confirm_password'];
        $course=$_POST['course'];
        
//         if(!empty($_POST['course'])) {
// 		foreach($_POST['course'] as $id) {
// 			$course.=$id.', ';
// 			}
// 		}
// 		$course= rtrim($course, ", ");

        $t1 = "images/profile/".time().'.png';
		$photo= $_FILES['photo']['name'];
		$t2 = "images/payment/".time().'.png';
		$photo= $_FILES['payment_ss']['name'];
		$t3 = "images/id_proof/".time().'.png';
		$photo= $_FILES['id_proof']['name'];
        
        $sql="INSERT INTO `student`(`enabled`, `firstname`, `lastname`, `email`, `password`, `course`, `telegram_no`, `phone_no`,
        `phone_no2`, `address`, `id_proof`, `DOB`, `photo`, `highest_qualification`, `work_exp`, `payment_ph_no`, `payment_ss`, `payment_date`) 
        VALUES('1', '$fname', '$lname', '$email','$pass','$course','$telegram_no','$phone','$phone2','$addr','$t3','$dob','$t1','$hq','$we',
        '$payment_ph_no','$t2','$payment_date')" ;
        if(mysqli_query($conn,$sql))
        {
            move_uploaded_file($_FILES['photo']['tmp_name'],$t1);
            move_uploaded_file($_FILES['payment_ss']['tmp_name'],$t2);
            move_uploaded_file($_FILES['id_proof']['tmp_name'],$t3);
            
            echo '<script type="text/javascript">
                   window.onload = function () 
                   { alert("Successfully Registered. Login here.");
                    window.location= "student_login.php"; }
                    </script>';
            }
            else
            {
                echo "Error description:" . mysqli_error($conn);
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
        var email=$("#email").val();
        $.ajax({
            type:'post',
                url:'checkMail.php',
                data:{email: email},
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
    <?php include('header.php'); ?>
    <br><br><br><br><br><br><br><br><br>

			<center>
				<div class="col-md-8 event-item" style="text-align: center;">
				<br>
				<center><h3 style="font-weight:600px;">STUDENT REGISTRATION</h3></center>
				<br>	
					<form class="comment-form --contact" action="" method="POST" enctype="multipart/form-data">						
							<div class="row">
								<div class="col-lg-6">
								    <input type="text" name="fname" placeholder="Firstname" pattern="[A-Za-z ]{3,}" maxlength="50" title="Name must contain alphabets only." required>
                                    <input type="text"  name="lname" placeholder="Lastname" pattern="[A-Za-z ]{3,}" maxlength="50" title="Name must contain alphabets only." required>
									<input type="email" name="email" id="email" onblur="checkMailStatus()" placeholder="Email" required></input>
									<input name="dob" id="dob" placeholder="Date of Birth" class="textbox-n" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                                    <input type="text"  name="telegram_no" placeholder="Telegram No" pattern="[\d*]{10,}" minlength="10" maxlength="10" required>
									<input type="text" name="phone" placeholder="Phone No" pattern="[\d*]{10,}" minlength="10" maxlength="10" required>
                                    <input type="text"  name="phone2" placeholder="Another Phone No" pattern="[\d*]{10,}" minlength="10" maxlength="10">
									<input type="text" name="address" placeholder="Address" minlength="5" maxlength="60" required>
									<select name="course" required> 
									<option value="" selected disabled>Select your course</option>
									<?php
    									$query = "SELECT * FROM course";
    
    									$result=mysqli_query($conn,$query);
    									 while($row = mysqli_fetch_array($result)) 
    									 {
    								?>
									<option value="<?php echo $row['course_name'] ?>" ><?php echo $row['course_name'] ?></option>
            					<?php } ?>
									</select>
																				
								</div>
								<div class="col-lg-6">
								    <input type="password" id="password" name="password" minlength="6" placeholder="Password" required>
								    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required> 
								    <input type="text" name="hq" placeholder="Highest Qualification" required>
								    <input type="text" name="we" placeholder="Work Experience">
                                    <input name="id_proof" placeholder="ID Proof(Adhar ID, Voter ID, PAN ID, DL)" class="textbox-n" type="text" onfocus="(this.type='file')" required>
                                    <input type="text"  name="payment_ph_no" placeholder="Payment Phone No"  pattern="[\d*]{10,}" maxlength="10" required>
                                    <input name="payment_date" placeholder="Payment Date" class="textbox-n" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" required>
									<input accept="image/*" name="payment_ss" class="textbox-n" type="text" onfocus="(this.type='file')"  placeholder="Payment Screenshot" required>
									<input accept="image/*" name="photo" class="textbox-n" type="text" onfocus="(this.type='file')"  placeholder="Profile photo" required>
								</div>
								<div class="col-lg-12">
										<div class="text-center">
											<button class="site-btn" type="submit" id="submit" name="submit">REGISTER</button>
										</div>
									</div>
							</div>
					</form>
					<br><p class="text-center">Are you already registered ? <a href="student_login.php">Login here</a> </p>
				
				</div>
				</center>
	
		<br><br>
<?php include('footer.php'); ?>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/main1.js"></script>
</body>
</html>