<?php
    ob_start();
    session_start();
    include("db_conn.php");
    if(!isset($_SESSION['admin_email'])){
        header("location: admin_login.php");
    }
    if (isset($_POST['submit']))
    {
        $course=$_POST['course'];
       
        $sql="INSERT INTO `course`(`course_name`) VALUES ('$course')" ;
        $res = mysqli_query($conn,$sql);
    }
    	if(isset($_POST["submit_delete"]))
	{
    	if(!empty($_POST['checkbox'])) {
		foreach($_POST['checkbox'] as $id) {
			$sql1 = "DELETE FROM course WHERE id='$id' ";
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
        font-size: 22px;
        text-align: center;
        margin-top:25px;
        margin-bottom:50px;
        }
        th {
        background-color: #588c7e;
        color: white;
        font-size: 24px;
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
	<center>
				<div class="col-md-5 event-item">
				<br>
				<div style="text-align: center;">
				<center><h3 style="font-weight:600px;">Edit Course List</h3></center>
				<br>	
					<form class="comment-form --contact" action="" method="POST" >	
    					<input type="text" name="course" placeholder="Course Name" style="float:left; width:70%;" required>
        				<button class="my-btn" type="submit"  name="submit" style="float:right; width:28%; height:50px;"><i class="fa fa-plus-circle"></i> Add Course</button>		
					</form>
					 <form method="POST" action="" style="margin-top:80px; >
				        <div style="overflow-x:auto;">
				        <table>
                            <tr>
                                <th></th>
                                <th>Course Title</th>
                            </tr>   									
								 <?php
								$query = "SELECT * FROM course";

								$result=mysqli_query($conn,$query);
								 while($row = mysqli_fetch_array($result)) 
								 {
								?>
									 <tr>
									    <td><input type="checkbox" name="checkbox[]" value="<?php echo $row['id'] ?>" style="width: 14px; height: 14px;"></td>
									    <td><?php echo $row['course_name']; ?></td>
									 </tr>
							
								<?php } ?>	
								</table>
								</div>
								<center>
								        <button class="site-btn" name="submit_delete" style=" margin:10px;"><i class="fa fa-trash-o"></i> Delete Course</button>
								</center>
						</form>
				</div>
				</div>
	</center>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/main1.js"></script>		
</body>
</html>