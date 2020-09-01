<?php
    ob_start();
    session_start();
    include("db_conn.php");
    if(!isset($_SESSION['admin_email'])){
        header("location: admin_login.php");
    }
    $id = $_GET['id']; 
	  
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Demo</title>
		<?php include('head_links.php'); ?>
</head>

<body>
<?php include('header_admin.php'); ?>
    <br><br><br><br><br><br>
	<div class="container">	
	<div class="row">
	    <?php 
           	$query = "SELECT * FROM student WHERE id=$id";
    		$result=mysqli_query($conn,$query);
    		while($row = mysqli_fetch_assoc($result))	
    		{
    		    $name=$row['firstname'].' '.$row['lastname'];
		?>
	<div class="col-md-12 event-item" style="margin-top:30px;margin-bottom:0px;">
					<div class="row">
					    <div class="col-lg-4" style="margin-bottom:30px;">
					        <!--<button class="site-btn" onclick="location.href='admin_dashboard.php';" style=" margin-bottom:15px; width:100%; background:#eee; color:#444;><i class="fa fa-arrow-left"></i> &nbsp;&nbsp;Back to Dashboard</button>-->
								<div class="card">
									<div class="card-body">
									    <center><img src="<?php echo $row['photo']; ?>" width="250" height="250" style="border-radius: 50%;"  /></center>
								        <br>
										<center><h3 style="margin-bottom:15px;"><?php echo $name; ?></h3></center>
										
										    <p style="font-size: 16px; font-style: italic; margin-bottom:4px;"><b>Course:</b>&nbsp; <?php echo $row['course']; ?></p>
										    <p style="font-size: 16px; font-style: italic; margin-bottom:4px;"><b>DOB:</b>&nbsp; <?php echo $row['DOB']; ?></p>
											<p style="font-size: 16px; font-style: italic; margin-bottom:4px;"><b>E-mail:</b>&nbsp; <?php echo $row['email']; ?></p>
											<p style="font-size: 16px; font-style: italic; margin-bottom:4px;"><b>Phone no:</b>&nbsp; <?php echo $row['phone_no']; ?></p>
											<p style="font-size: 16px; font-style: italic; margin-bottom:4px;"><b>Alternate Phone no:</b>&nbsp; <?php echo $row['phone_no2']; ?></p>
											<p style="font-size: 16px; font-style: italic; margin-bottom:4px;"><b>Telegram:</b>&nbsp; <?php echo $row['telegram_no']; ?></p>
											<p style="font-size: 16px; font-style: italic; margin-bottom:4px;"><b>Address:</b>&nbsp; <?php echo $row['address']; ?></p>
											<p style="font-size: 16px; font-style: italic; margin-bottom:4px;"><b>Highest Qualification:</b>&nbsp; <?php echo $row['higest_qualification']; ?></p>
											<p style="font-size: 16px; font-style: italic; margin-bottom:4px;"><b>Work Experiance:</b>&nbsp; <?php echo $row['work_exp']; ?></p>
										
									
									</div>
								</div>
							</div>
							<div class="col-lg-8">
								<div class="row">
								    <div class="col-lg-12" style="margin-bottom:30px;">
        								<div class="card">
        									<div class="card-header" style="text-align:center;">
        										<b style="font-size: 22px; " >Payment Details</b>
        									</div>
        									<div class="card-body">
        									 <center>
        									 <p style="font-size: 16px; font-style: italic; margin-bottom:4px;"><b>Payment Phone No:</b>&nbsp; <?php echo $row['payment_ph_no']; ?></p>
        									 <p style="font-size: 16px; font-style: italic; margin-bottom:4px;"><b>Payment Date:</b>&nbsp; <?php echo $row['payment_date']; ?></p>
        									<img src="<?php echo $row['payment_ss']; ?>" style="width=100%; height:350px;" /></center>
        									</div>
        								</div>
        							</div>
        							<div class="col-lg-12" style="margin-bottom:30px;">
        								<div class="card">
        									<div class="card-header" style="text-align:center;">
        										<b style="font-size: 22px; " >ID proof</b>
        									</div>
        									<div class="card-body">
        									<center><img src="<?php echo $row['id_proof']; ?>"style="width=100%; height:350px;"" /></center>
        									</div>
        								</div>
        							</div>
								</div>
				        	</div>
					   </div>
			     </div>
    <?php } ?>
			 </div>
    </div>
    <br><br><br><br><br><br>
    
<?php include('footer.php'); ?>

</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/video-js/video.min.js"></script>
<script src="plugins/video-js/Youtube.min.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/custom.js"></script>
</body>

</html>