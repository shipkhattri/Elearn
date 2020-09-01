<?php
    ob_start();
    session_start();
    include("db_conn.php");
    if(isset($_SESSION['temail'])){
        header("location: teacher_dashboard.php");
   }
    if (isset($_POST['submit']))
    {
        $email=$_POST['email'];
        $pass=$_POST['password'];
      
         $query = "SELECT * FROM teacher WHERE email = :email";
         $statement = $connect->prepare($query);
         $statement->execute(
            array(
              ':email' => $_POST["email"]
             )
          );
          
          $count = $statement->rowCount();
         if($count > 0)
         {
          $result = $statement->fetchAll();
            foreach($result as $row)
            {
              if($_POST["password"]== $row["password"])
              {
                    if($row['enabled']=='1')
                    {
                       $_SESSION['tid']=$row['id'];
                        $_SESSION['temail']=$row['email'];
                        $_SESSION['tcourse']=$row['course'];
                        header("location: teacher_dashboard.php");
                    }
                    else{
                        echo '<script type="text/javascript">
    	                  window.onload = function () 
    	                  { alert("Account disabled by admin"); }
	                  </script>';
                    }
              }
              else
              {
                echo '<script type="text/javascript">
    	                  window.onload = function () 
    	                  { alert("Invalid password"); }
	                  </script>';
              }
            }
         }
         else
         {
            echo '<script type="text/javascript">
                        window.onload = function () 
                        { alert("Invalid email"); }
                  </script>';
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
<?php include('header.php'); ?>
<br><br><br><br><br><br><br><br><br>
	<!-- Courses section -->
	<section class="contact-page spad pt-0">
		<div class="container">
			<div class="row">
				<div class="col-md-4 event-item">
				</div>				
				<div class="col-md-4 event-item">
				<br><br>
					<div class="card">
						<div class="card-body">
							<br>
							<center><h3 style="font-weight:600px;">EDUCATOR LOGIN</h3></center>
							<br>
							<form class="comment-form --contact" action="" method="POST">
								<div class="row">
									<div class="col-lg-12">
										<input type="text" name="email" id="email" placeholder="Email" required>
									</div>
									<div class="col-lg-12">
										<input type="password" name="password" id="password" placeholder="Password" required>
										<p class="text-danger" style="float:right;"><?php echo $message; ?></p>
									</div>		
									
									<div class="col-lg-12">
										<div class="text-center">
											<button class="site-btn" type="submit" id="submit" name="submit">SUBMIT</button>
										</div>
									</div>
								</div>
							</form>	<br>
		                    <p>Are you a Student ? <a href="student_login.php">click here</a> </p>
						</div>		
					</div>		
				</div>		
			</div>
		</div>
	</section>
	<?php include('footer.php'); ?>
</body>
</html>