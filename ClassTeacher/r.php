<?php
 
error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';


if(isset($_POST['view'])  ){

    $admissionNumber =  $_POST['roll'];
    $type =  $_POST['type'];

    $course=$_POST['classId'];
    $_SESSION['sub_id']=$course;



    $q="select subject_name from subject where sub_id='$course'";
    $re = mysqli_query($conn,$q);
    while ($row = mysqli_fetch_assoc($re)) {
     
      $sname= $row["subject_name"];
    }

    
    if($type == "1"){ //All Attendance


            ?>
        <table border="1">
        <thead>
            <tr>
            <th>#</th>
                        <th>Roll No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Department</th>
                        <th>Semester</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Date</th>
            </tr>
        </thead>
        <?php 
            $filename="Attendance list";
            $dateTaken = date("Y-m-d");


            $cnt=1;			
           
             $query = "SELECT * from students inner JOIN attendance on attendance.st_id=students.st_id where  sub_id=$course order by stat_date asc";

            $ret = mysqli_query($conn,$query)or die("not");


            if(mysqli_num_rows($ret) > 0 )
            {
            while ($row=mysqli_fetch_array($ret)) 
            { 
                
                if($row['st_status'] == '1'){$status = "Present"; $colour="#00FF00";}else{$status = "Absent";$colour="#FF0000";}

            echo '  
            <tr>  
            <td>'.$cnt.'</td> 
            <td>'.$roll= $row['st_id'].'</td> 
            <td>'.$firstName= $row['st_name'].'</td> 
            <td>'.$LastName= $row['st_lname'].'</td> 
            <td>'.$dept= $row['st_dept'].'</td> 
            <td>'.$semt= $row['st_sem'].'</td> 
            <td>'.$course= $sname.'</td> 

            <td>'.$status=$status.'</td>	 	
            <td>'.$dateTimeTaken=$row['stat_date'].'</td>	 					
            </tr>  
            ';


            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=".$filename."-report.xls");
            header("Pragma: no-cache");
            header("Expires: 0");
                        $cnt++;
                        }
                }
            ?> 
            </table>
                



            <?php }?>

<?php
    if($type == "2")
    {
        ?>
        


    
        <table border="1">
        <thead>
            <tr>
            <th>#</th>
                        <th>Roll No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Department</th>
                        <th>Semester</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Date</th>
            </tr>
        </thead>
        <?php 
            $filename="Attendance list";
            $dateTaken = date("Y-m-d");


            $cnt=1;			
          
             $singleDate =  $_POST['singleDate'];
             

             $query = "SELECT * from students inner JOIN attendance on attendance.st_id=students.st_id where  sub_id=$course and attendance.stat_date='$singleDate' order by stat_date asc";


            $ret = mysqli_query($conn,$query)or die("not");


            if(mysqli_num_rows($ret) > 0 )
            {
            while ($row=mysqli_fetch_array($ret)) 
            { 
                
                if($row['st_status'] == '1'){$status = "Present"; $colour="#00FF00";}else{$status = "Absent";$colour="#FF0000";}

            echo '  
            <tr>  
            <td>'.$cnt.'</td> 
            <td>'.$roll= $row['st_id'].'</td> 
            <td>'.$firstName= $row['st_name'].'</td> 
            <td>'.$LastName= $row['st_lname'].'</td> 
            <td>'.$dept= $row['st_dept'].'</td> 
            <td>'.$semt= $row['st_sem'].'</td> 
            <td>'.$course= $sname.'</td> 

            <td>'.$status=$status.'</td>	 	
            <td>'.$dateTimeTaken=$row['stat_date'].'</td>	 					
            </tr>  
            ';


            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=".$filename."-report.xls");
            header("Pragma: no-cache");
            header("Expires: 0");
                        $cnt++;
                        }
                }
            ?> 
            </table>
   
   
   
   
   <?php
}
?>

<?php
    if($type == "3")
    {
        ?>

<table border="1">
        <thead>
            <tr>
            <th>#</th>
                        <th>Roll No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Department</th>
                        <th>Semester</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Date</th>
            </tr>
        </thead>
        <?php 
            $filename="Attendance list";
            $dateTaken = date("Y-m-d");


            $cnt=1;			
      
            $fromDate =  $_POST['fromDate'];
            $toDate =  $_POST['toDate'];
          
            $query = "SELECT * from students inner JOIN attendance on attendance.st_id=students.st_id where  sub_id=$course and  
              attendance.stat_date between '$fromDate' and '$toDate' order by stat_date asc";


            $ret = mysqli_query($conn,$query)or die("not");


            if(mysqli_num_rows($ret) > 0 )
            {
            while ($row=mysqli_fetch_array($ret)) 
            { 
                
                if($row['st_status'] == '1'){$status = "Present"; $colour="#00FF00";}else{$status = "Absent";$colour="#FF0000";}

            echo '  
            <tr>  
            <td>'.$cnt.'</td> 
            <td>'.$roll= $row['st_id'].'</td> 
            <td>'.$firstName= $row['st_name'].'</td> 
            <td>'.$LastName= $row['st_lname'].'</td> 
            <td>'.$dept= $row['st_dept'].'</td> 
            <td>'.$semt= $row['st_sem'].'</td> 
            <td>'.$course= $sname.'</td> 

            <td>'.$status=$status.'</td>	 	
            <td>'.$dateTimeTaken=$row['stat_date'].'</td>	 					
            </tr>  
            ';


            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=".$filename."-report.xls");
            header("Pragma: no-cache");
            header("Expires: 0");
                        $cnt++;
                        }
                        echo "<script type = \"text/javascript\">
                        window.location = (\"report.php\")
                        </script>"; 
               }
             
           else {
   
               echo "<script >
               alert('No Record Found !')
                </script>"; 
                echo "<script type = \"text/javascript\">
                window.location = (\"report.php\")
                </script>"; 
           }
            ?> 
            </table>
   


<?php
}
?>



<?php
}
?>







<?php

if(isset($_POST['sview']) ){

$admissionNumber =  $_POST['roll'];
$type =  $_POST['type'];

$course=$_POST['classId'];
$_SESSION['sub_id']=$course;




$q="select subject_name from subject where sub_id='$course'";
$re = mysqli_query($conn,$q);
while ($row = mysqli_fetch_assoc($re)) {
 
  $sname= $row["subject_name"];
}


if($type == "1"){ //All Attendance
       
    echo $course;
       
   
        $query = "SELECT * from students inner JOIN attendance on attendance.st_id=students.st_id where  
        students.st_id='$admissionNumber' and sub_id='$course' order by stat_date asc";
            

}

        


if($type == "2")
{
   
    



        $filename="Attendance list";
        $dateTaken = date("Y-m-d");


        $cnt=1;			
      
         $singleDate =  $_POST['singleDate'];
         
         $query = "SELECT * from students inner JOIN attendance on attendance.st_id=students.st_id where 
         students.st_id='$admissionNumber' and attendance.stat_date='$singleDate'  and sub_id='$course' order by stat_date asc";

        //  $query = "SELECT * from students inner JOIN attendance on attendance.st_id=students.st_id where  sub_id=$course and attendance.stat_date='$singleDate'";






}



if($type == "3")
{
   
        $fromDate =  $_POST['fromDate'];
        $toDate =  $_POST['toDate'];
        $query = "SELECT * from students inner JOIN attendance on attendance.st_id=students.st_id where 
        students.st_id='$admissionNumber' and attendance.stat_date between '$fromDate' and '$toDate'  and sub_id='$course' order by stat_date asc";

        
}
?>





<table border="1">
    <thead>
        <tr>
        <th>#</th>
                    <th>Roll No</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Department</th>
                    <th>Semester</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Date</th>
        </tr>
    </thead>
    <?php 
        $filename="Attendance list";
        $dateTaken = date("Y-m-d");


        $cnt=1;			
       
        //  $query = "SELECT * from students inner JOIN attendance on attendance.st_id=students.st_id where  sub_id=$course ";


        $ret = mysqli_query($conn,$query)or die("not");


        if(mysqli_num_rows($ret) > 0 )
        {
        while ($row=mysqli_fetch_array($ret)) 
        { 
            
            if($row['st_status'] == '1'){$status = "Present"; $colour="#00FF00";}else{$status = "Absent";$colour="#FF0000";}

        echo '  
        <tr>  
        <td>'.$cnt.'</td> 
        <td>'.$roll= $row['st_id'].'</td> 
        <td>'.$firstName= $row['st_name'].'</td> 
        <td>'.$LastName= $row['st_lname'].'</td> 
        <td>'.$dept= $row['st_dept'].'</td> 
        <td>'.$semt= $row['st_sem'].'</td> 
        <td>'.$course= $sname.'</td> 

        <td>'.$status=$status.'</td>	 	
        <td>'.$dateTimeTaken=$row['stat_date'].'</td>	 					
        </tr>  
        ';


        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".$filename."-report.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
                    $cnt++;
                    }
                    echo "<script type = \"text/javascript\">
                    window.location = (\"report.php\")
                    </script>"; 
           }
         
       else {

           echo "<script >
           alert('No Record Found !')
            </script>"; 
            echo "<script type = \"text/javascript\">
            window.location = (\"report.php\")
            </script>"; 
       }
        ?> 
        </table>

        

<?php

}

?>