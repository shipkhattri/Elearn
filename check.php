<?php
    session_start();
    include("db_conn.php");
    if (isset($_POST['submit']))
    {
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
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
        
        $sql="INSERT INTO `student`(`firstname`, `lastname`, `email`, `password`, `course`, `telegram_no`, `phone_no`,
        `phone_no2`, `address`, `id_proof`, `DOB`, `photo`, `highest_qualification`, `work_exp`, `payment_ph_no`, `payment_ss`, `payment_date`) 
        VALUES('$fname', '$lname', '$email','$pass','$course','$telegram_no','$phone','$phone2','$addr','$t3','$dob','$t1','$hq','$we',
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