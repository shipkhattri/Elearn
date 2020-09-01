<?php

    session_start();
    include("db_conn.php");
    if($_POST['email'])
    {
        $email=$_POST['email'];
        $sql="SELECT * FROM student WHERE email='$email' ";
        if($echk=mysqli_query($conn,$sql))
        {
            $ecount=mysqli_num_rows($echk);
            if($ecount!=0)
            {
                echo "Email already exists";
            }
        }
        else{
            echo "Error description:" . mysqli_error($conn);
        }
    }
    else if($_POST['temail'])
    {
        $email=$_POST['temail'];
        $sql="SELECT * FROM teacher WHERE email='$email' ";
        if($echk=mysqli_query($conn,$sql))
        {
            $ecount=mysqli_num_rows($echk);
            if($ecount!=0)
            {
                echo "Email already exists";
            }
        }
        else{
            echo "Error description:" . mysqli_error($conn);
        }
    }
?>