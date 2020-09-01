<?php
    ob_start();
    include("db_conn.php");
        $class=$_GET['class'];
        $table=$class;
      
        $query = "SELECT email,firstname,lastname from student WHERE course='$class' ";  
        $result = mysqli_query($conn, $query);
          $users = array();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $users[] = $row;
                }
            }
          
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename='.$table.'.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('email','firstname','lastname')); 
        
        if (count($users) > 0) {
            foreach ($users as $row) {
                fputcsv($output, $row);
            }
        }
        fclose($output); 
   
    
?>