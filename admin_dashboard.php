<?php
    ob_start();
    session_start();
    include("db_conn.php");
    if(!isset($_SESSION['admin_email'])){
        header("location: admin_login.php");
    }
	if(isset($_POST["submit1"]))
	{
    	if(!empty($_POST['checkbox'])) {
		foreach($_POST['checkbox'] as $id) {
			$sql1 = "UPDATE student SET approved='1' WHERE id='$id' ";
			$result=mysqli_query($conn,$sql1);
			}
		}
	}
	if(isset($_POST["submit2"]))
	{
    	if(!empty($_POST['checkbox'])) {
		foreach($_POST['checkbox'] as $id) {
			$sql1 = "DELETE FROM student WHERE id='$id' ";
			$result=mysqli_query($conn,$sql1);
			}
		}
	}
	if(isset($_POST["submit_enable"]))
	{
    	if(!empty($_POST['checkbox'])) {
		foreach($_POST['checkbox'] as $id) {
			$sql1 = "UPDATE student SET enabled='1' WHERE id='$id' ";
			$result=mysqli_query($conn,$sql1);
			}
		}
	}
	if(isset($_POST["submit_disable"]))
	{
    	if(!empty($_POST['checkbox'])) {
		foreach($_POST['checkbox'] as $id) {
			$sql1 = "UPDATE student SET enabled='0' WHERE id='$id' ";
			$result=mysqli_query($conn,$sql1);
			}
		}
	}
		if(isset($_POST["submit_enable_t"]))
	{
    	if(!empty($_POST['checkbox'])) {
		foreach($_POST['checkbox'] as $id) {
			$sql1 = "UPDATE teacher SET enabled='1' WHERE id='$id' ";
			$result=mysqli_query($conn,$sql1);
			}
		}
	}
	if(isset($_POST["submit_disable_t"]))
	{
    	if(!empty($_POST['checkbox'])) {
		foreach($_POST['checkbox'] as $id) {
			$sql1 = "UPDATE teacher SET enabled='0' WHERE id='$id' ";
			$result=mysqli_query($conn,$sql1);
			}
		}
	}
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<?php include('head_links.php'); ?>
	<style>
        table {
        border-collapse: collapse;
        width: 100%;
        color: #588c7e;
        font-family: monospace;
        white-space: nowrap; 
        font-size: 18px;
        text-align: left;
        margin-top:25px;
        margin-bottom:50px;
        }
        th {
        background-color: #588c7e;
        color: white;
        font-size: 20px;
        border-left: 1px solid #fff;
        border-right: 1px solid #fff;
        padding-left:8px;
        }
        td{
             border-left: 1px solid #fff;
        border-right: 1px solid #fff;
        padding-left:8px;
        }
        tr:nth-child(even) {background-color: #f2f2f2}
    </style>
</head>
<body>
    	<?php include('header_admin.php'); ?>
    <br><br><br><br><br><br>
		<div class="container">	
			<div class="col-lg-12 post-list">				
		
				 <center>
                    <button class="tablink my-tab-btn-enable" onclick="openCity(event,'1')">New Registrations</button>
                    <button class="tablink my-tab-btn" onclick="openCity(event,'2')">Students</button>
                    <button class="tablink my-tab-btn" onclick="openCity(event,'3')">Educators</button>
                </center>
                  
                  <div id="1" class="c">
                     <form method="POST" action="" >
                								        <div style="overflow-x:auto;">
                								        <table>
                                                            <tr>
                                                                <th></th>
                                                                <th>Name</th>
                                                                <th>Course</th>
                                                                <th>DOB</th>
                                                                <th>Telegram</th>
                                                                <th>Qualification</th>
                                                                <th>Payment</th>
                                                                
                                                            </tr>   									
                            									 <?php
                            									$query = "SELECT * FROM student";
                            
                            									$result=mysqli_query($conn,$query);
                            									 while($row = mysqli_fetch_array($result)) 
                            									 {
                            										if($row['approved']==0)
                            										{
                            									?>
                													<tr>
                													    <td><input type="checkbox" name="checkbox[]" value="<?php echo $row['id'] ?>" style="width: 14px; height: 14px;"></td>
                													    <td ><a href="student_view.php?id=<?php echo $row['id'] ?>"><?php echo $row['firstname']." ".$row['lastname']; ?></a></td>
                													    <td><?php echo $row['course']; ?></td>
                													    <td><?php echo $row['DOB']; ?></td>
                													    <td><?php echo $row['telegram_no']; ?></td>
                													    <td><?php echo $row['highest_qualification']; ?></td>
                													    <td><?php echo $row['payment_date']; ?></td>
                													    </tr>
                											
                            									<?php }} ?>	
                            									</table>
                            									</div>
                        										<center>
                        										        <button class="site-btn" name="submit1" style=" margin:10px;"><i class="fa fa-save"></i> Approve</button>
                        										        <button class="site-btn" name="submit2" style=" margin:10px;"><i class="fa fa-trash-o"></i> Reject</button>
                        										</center>
                										</form>
                  </div>
                
                <div id="2" class="c" style="display:none">
                    <form method="POST" action="" >
							        <div style="overflow-x:auto;">
							        <table>
                                        <tr>
                                            <th></th>
                                            <th>Name</th>
                                            <th></th>
                                            <th>Course</th>
                                            <th>DOB</th>
                                            <th>Telegram</th>
                                            <th>Qualification</th>
                                            <th>Payment</th>
                                            
                                        </tr>   									
        									 <?php
        									$query = "SELECT * FROM student";
        
        									$result=mysqli_query($conn,$query);
        									 while($row = mysqli_fetch_array($result)) 
        									 {
        										if($row['approved']==1)
        										{
        									?>
												<tr>
												    <td><input type="checkbox" name="checkbox[]" value="<?php echo $row['id'] ?>" style="width: 14px; height: 14px;"></td>
												    <td ><a href="student_view.php?id=<?php echo $row['id'] ?>"><?php echo $row['firstname']." ".$row['lastname']; ?></a></td>
                									<td><?php if($row['enabled']=='1'){ echo '<div style="color: #00e007;"><i class="fa fa-check-circle"></i></div>';} else{ echo '<div style="color: #ff0000;"><i class="fa fa-times-circle"></i></div>';}?></td>
												    <td><?php echo $row['course']; ?></td>
												    <td><?php echo $row['DOB']; ?></td>
												    <td><?php echo $row['telegram_no']; ?></td>
												    <td><?php echo $row['highest_qualification']; ?></td>
												    <td><?php echo $row['payment_date']; ?></td>
												    </tr>
										
        									<?php }} ?>	
        									</table>
        									</div>
    										<center>
    										        <button class="site-btn" name="submit_enable" style=" margin:10px;"><i class="fa fa-check-circle"></i> Enable</button>
    										        <button class="site-btn" name="submit_disable" style=" margin:10px;"><i class="fa fa-times-circle"></i> Disable</button>
    										</center>
									</form>
                </div>

                <div id="3" class="c" style="display:none">
                    <form method="POST" action="" >
							        <div style="overflow-x:auto;">
							        <table>
                                        <tr>
                                            <th></th>
                                            <th>Name</th>
                                            <th></th>
                                            <th>Course</th>
                                            <th>Phone</th>
                                            <th>E-mail</th>
                                            
                                        </tr>   									
        									 <?php
        									$query = "SELECT * FROM teacher";
        
        									$result=mysqli_query($conn,$query);
        									 while($row = mysqli_fetch_array($result)) 
        									 {
        									?>
												<tr>
												    <td><input type="checkbox" name="checkbox[]" value="<?php echo $row['id'] ?>" style="width: 14px; height: 14px;"></td>
												    <td ><a href="teacher_edit.php?id=<?php echo $row['id'] ?>"><?php echo $row['firstname']." ".$row['lastname']; ?></a></td>
                									<td><?php if($row['enabled']=='1'){ echo '<div style="color: #00e007;"><i class="fa fa-check-circle"></i></div>';} else{ echo '<div style="color: #ff0000;"><i class="fa fa-times-circle"></i></div>';}?></td>
												    <td><?php echo $row['course']; ?></td>
												    <td><?php echo $row['phone']; ?></td>
												    <td><?php echo $row['email']; ?></td>
												    </tr>
										
        									<?php } ?>	
        									</table>
        									</div>
    										<center>
    										        <button class="site-btn" name="submit_enable_t" style=" margin:10px;"><i class="fa fa-check-circle"></i> Enable</button>
    										        <button class="site-btn" name="submit_disable_t" style=" margin:10px;"><i class="fa fa-times-circle"></i> Disable</button>
    										</center>
									</form>
                </div>
            </div>
		</div>
<br><br><br><br>


	<?php include('footer.php'); ?>
<script>
function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("c");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace("-enable", "");
  }
  document.getElementById(cityName).style.display = "block";
   evt.currentTarget.className += "-enable";
}
</script>
</body>
</html>