<?php
    ob_start();
    session_start();
    include("db_conn.php");
    if(!isset($_SESSION['email'])){
        header("location: student_login.php");
   }
        $link="";
        $name="";
        $email = $_SESSION['email']; 
	    $course = $_SESSION['course'];
	    $tname = $course;
	    $sql = "SELECT * FROM $tname WHERE email='$email' ";
	    $res = mysqli_query($conn,$sql);

        if($res)
        {
           if($row=mysqli_fetch_assoc($res)){
    	        $link=$row['link'];
    	    }
        }
        // else
        // {
        //      $link=$tname;
        // }
	    
	    
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Demo</title>
		<?php include('head_links.php'); ?>
</head>

<body>
	<header class="header">
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<div class="logo_container">
								<a href="#">
									<div class="logo_content d-flex flex-row align-items-end justify-content-start">
										<div class="logo_img"><img src="images/logo.png" alt=""></div>
										<div class="logo_text">learn</div>
									</div>
								</a>
							</div>
							<nav class="main_nav_contaner ml-auto">
								<ul class="main_nav">
									<li><a href="logout.php">Logout</a></li>
								</ul>

								<!-- Hamburger -->

								<div class="hamburger menu_mm">
									<i class="fa fa-bars menu_mm" aria-hidden="true"></i>
								</div>
							</nav>

						</div>
					</div>
				</div>
			</div>
		</div>
		</header>
			<!-- Menu -->

	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>

		<nav class="menu_nav">
			<ul class="menu_mm">
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</nav>
		<div class="menu_extra">
			<div class="menu_phone"><span class="menu_title">phone:</span>(009) 35475 6688933 32</div>
			<div class="menu_phone"><span class="menu_title">email:</span>email@gmail.com</div>
		</div>
	</div>
    
    <br><br><br><br><br><br>
	<div class="container">	
	<div class="row">
	    <?php 
           	$query = "SELECT * FROM student WHERE email='$email' ";
    		$result=mysqli_query($conn,$query);
    		while($row = mysqli_fetch_assoc($result))	
    		{
    		    $name=$row['firstname'].' '.$row['lastname'];
		?>
	<div class="col-md-12 event-item" style="margin-top:30px;margin-bottom:0px;">
					<div class="row">
					    <div class="col-lg-4" style="margin-bottom:30px;">
								<div class="card">
									<div class="card-body">
									    <center><img src="<?php echo $row['photo']; ?>" width="250" height="250" style="border-radius: 50%;"  /></center>
								        <br>
										<center><h3 style="margin-bottom:10px;"><?php echo $name; ?></h3></center>
										<center><p style="font-size: 16px; "><?php echo $row['DOB']; ?></p></center>
										<center>
											<p style="font-size: 16px; font-style: italic; margin-bottom:4px;"><i class="fa fa-envelope"></i>&nbsp; <?php echo $row['email']; ?></p>
											<p style="font-size: 16px; font-style: italic; margin-bottom:4px;"><i class="fa fa-phone"></i>&nbsp; <?php echo $row['phone_no']; ?></p>
											<p style="font-size: 16px; font-style: italic; margin-bottom:4px;"><i class="fa fa-location-arrow"></i>&nbsp; <?php echo $row['address']; ?></p>
										    <p style="font-size: 16px; font-style: italic; margin-bottom:4px;"><i class="fa fa-book"></i>&nbsp; <?php echo $row['course']; ?></p>
										</center>
										<br>
									
									</div>
								</div>
							</div>
							<div class="col-lg-8">
								<div class="row">
								    <div class="col-lg-12" style="margin-bottom:30px;">
        								<div class="card">
        									<div class="card-header" style="text-align:center;">
        										<b style="font-size: 22px; " >Schedule</b>
        									</div>
        									<div class="card-body">
        										<p style="font-size: 18px; font-style: italic;"> <?php echo $row['about']; ?></p>
        									</div>
        								</div>
        							</div>
        							<div class="col-lg-12" style="margin-bottom:30px;">
										<form class="comment-form --contact" action="try.php" target="_blank" method="POST">
                					        <div class="col-lg-12">
                								<input type="text" name="license" value="<?php echo substr($link, 24, 11); ?>" hidden>
                							</div>
                							<div class="col-lg-12">
                								<input type="text" name="link" value="<?php echo substr($link, -7); ?>" hidden>
                							</div>
                							<div class="col-lg-12">
                								<input type="text" name="name" value="<?php echo $name; ?>" hidden>
                							</div>
                						<?php
                						    if($link!="")
                						    {
                						?>
                							<div class="col-lg-12">
                								<div class="text-center">
                									<button class="site-btn" type="submit" id="submit" name="submit">JOIN CLASS</button>
                								</div>
                							</div>
                						<?php } ?>
                					    </form>	
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