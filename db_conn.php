<?php
	$conn=mysqli_connect("localhost:3306","sriramacademy","Xsvi51#0","Tringle_sriramacademy");
	if ($conn->connect_error)
	{
	    die("Connection failed: " . $conn->connect_error);
    }
		
	$connect = new PDO("mysql:host=localhost:3306;dbname=Tringle_sriramacademy;charset=utf8mb4", "sriramacademy", "Xsvi51#0");
?>