<?php
    ob_start();
    session_start();
    include("db_conn.php");
    if(!isset($_SESSION['temail'])){
        header("location: teacher_login.php");
   }
    if (isset($_POST['submit']))
    {
        $file=$_FILES['csvfile']['tmp_name'];
        $handle=fopen($file,"r");
        $i=0;
        $table=$_POST['course'];
        
        $sql="DROP TABLE IF EXISTS $table ";
        mysqli_query($conn,$sql);
        
        $q="CREATE TABLE $table (email VARCHAR(50), firstname VARCHAR(50), lastname VARCHAR(50), link VARCHAR(1000))";
                //echo $q,"<br>";
        mysqli_query($conn,$q);
        while(($cont=fgetcsv($handle,1000,","))!==false)
        {
            //$table=rtrim($_FILES['csvfile']['name'],".csv");
            
            $q="INSERT INTO $table(email,firstname,lastname,link) VALUES('$cont[0]','$cont[1]','$cont[2]','$cont[3]')";    
            //echo $q,"<br>";
            mysqli_query($conn,$q);
        }
    }
    if (isset($_POST['download']))
    {
        $course=$_POST['course'];
      
        $query = "SELECT email,firstname,lastname from student WHERE course='$course' ";  
        $result = mysqli_query($conn, $query);
          $users = array();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $users[] = $row;
                }
            }
          
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename='.$course.'.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('email','firstname','lastname')); 
        
        if (count($users) > 0) {
            foreach ($users as $row) {
                fputcsv($output, $row);
            }
        }
        fclose($output); 
    }
      
?>
<html>
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
        <center>
        <div class="card col-md-7">
			<div class="card-body">
			    <br>
				<center><h3 style="font-weight:600px;">CREATE LIVE SESSION</h3></center>
				<br>
        <form class="comment-form col-md-10" method="POST" action="" enctype="multipart/form-data">
            
            <b>Step 1: </b> Choose your Course: <br><br>
            <select id="cl" name="course" required>
                <option value="" selected disabled>Select Course</option>
				<?php
				    $id=$_SESSION['tid'];
					$query = "SELECT * FROM teacher WHERE id='$id' ";

					$result=mysqli_query($conn,$query);
					$row = mysqli_fetch_array($result);
					$str=explode(", ",$row['course']);
					 foreach ($str as $val) 
					 {
					     
				?>
				<option value="<?php echo $val; ?>" style="width: 14px; height: 14px; "> <?php echo $val; ?></option>
			<?php } ?>
			</select>
			<br><hr><br>
					<b>Step 2: </b>Download Student list <br><br><button name="download" onclick="Export()" class="site-btn"><i class="fa fa-download" aria-hidden="true"></i> Download</button><br><br><hr><br>
					<b>Step 3: </b>Upload Invitations file <br><br> <input type="file" name="csvfile" >
            <button type="submit" name="submit" class="site-btn"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
            
        </form>
        </div>
        </div>
        </center>
        
       
<br><br><br><br><br><br>
<!-- Footer -->

	<footer class="footer" id="footer">
		<div class="container">
			<div class="row">

				<!-- About -->
				<div class="col-lg-3 footer_col">
					<div class="footer_about">
						<div class="logo_container">
							<a href="#">
								<div class="logo_content d-flex flex-row align-items-end justify-content-start">
									<div class="logo_img"><img src="images/logo.png" alt=""></div>
									<div class="logo_text">learn</div>
								</div>
							</a>
						</div>
						<div class="footer_about_text">
							<p>Maecenas rutrum viverra sapien sed fermentum. Morbi tempor odio eget lacus tempus pulvinar.</p>
						</div>
						<div class="footer_social">
							<ul>
								<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							</ul>
						</div>
						<div class="copyright" hidden><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
					</div>
				</div>

				<div class="col-lg-3 footer_col">
					<div class="footer_links">
						<div class="footer_title">Quick menu</div>
						<ul class="footer_list">
							<li><a href="index.html">Home</a></li>
							<li><a href="about.html">About us</a></li>
							<li><a href="#">Testimonials</a></li>
							<li><a href="#">Services</a></li>
							<li><a href="contact.html">Contact</a></li>
							<li><a href="#">Facts</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-3 footer_col">
					<div class="footer_links">
						<div class="footer_title">Useful Links</div>
						<ul class="footer_list">
							<li><a href="courses.html">Courses</a></li>
							<li><a href="#">Events</a></li>
							<li><a href="news.html">News</a></li>
							<li><a href="#">Teachers</a></li>
							<li><a href="#">Links</a></li>
							<li><a href="#">FAQ</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-3 footer_col">
					<div class="footer_contact">
						<div class="footer_title">Contact Us</div>
						<div class="footer_contact_info">
							<div class="footer_contact_item">
								<div class="footer_contact_title">Address:</div>
								<div class="footer_contact_line">1481 Creekside Lane Avila Beach, CA 93424</div>
							</div>
							<div class="footer_contact_item">
								<div class="footer_contact_title">Phone:</div>
								<div class="footer_contact_line">+53 345 7953 32453</div>
							</div>
							<div class="footer_contact_item">
								<div class="footer_contact_title">Email:</div>
								<div class="footer_contact_line">yourmail@gmail.com</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>
 <script>
        function Export()
        {   
            var e = document.getElementById("cl");
            var strUser = e.options[e.selectedIndex].value;
            
            window.open("process.php?class="+strUser);
            
        }
    </script>
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