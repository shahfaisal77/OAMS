<?php 
error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';

?>
        <table border="1">
        <thead>
            <tr>
            <th>Roll No</th>
                        <th>Roll No</th>
                        <th>Full Name</th>
                        <th>Department</th>
                        <!-- <th>Semester</th> -->
                        <th>Course</th>
                        <th>Status</th>
                        <th>Date</th>
            </tr>
        </thead>

<?php 
$filename="Attendance list";
// $dateTaken = date("Y-m-d");
$dateTaken ='2022-12-28';

$cnt=1;			
$query = "SELECT * from students inner JOIN attendance on attendance.stat_id=students.st_id where  attendance.stat_date='$dateTaken'";

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
<td>'.$dept= $row['st_dept'].'</td> 
<td>'.$course= $row['course'].'</td> 
<td>'.$classArmName=$row['classArmName'].'</td>	
<td>'.$sessionName=$row['sessionName'].'</td>	 
<td>'.$status=$status.'</td>	 	
<td>'.$dateTimeTaken=$row['stat_date'].'</td>	 					
</tr>  
';

// header("Content-type: application/octet-stream");
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=".$filename."-report.xls");
header("Pragma: no-cache");
header("Expires: 0");
			$cnt++;
			}
	}
?>
</table>