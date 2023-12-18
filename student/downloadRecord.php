<?php 
error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';

?>
        <table border="1">
        <thead>
            <tr>
            <th>Roll No</th>
                        <th>Full Name</th>
                        <th>Department</th>
                        <th>Semester</th>
                        <th>Course</th>
                        <th>Status</th>
                        <th>Date</th>
            </tr>
        </thead>

<?php 
$filename="Attendance list";
// $dateTaken = date("Y-m-d");
$fromDate=$_SESSION=['fromDate'];
$toDate=$_SESSION['toDate'];
$cnt=1;			
$t= $_SESSION['type'];
echo $_SESSION['type'];
if($t==3){
    $query =  "SELECT * from students inner JOIN attendance on attendance.stat_id=students.st_id where 
    students.st_id='$admissionNumber' and attendance.stat_date between '$fromDate' and '$toDate'";
$ret = mysqli_query($conn,$query)or die("not");


}
else{
    echo $_SESSION['userId'];
$query = "SELECT * from students inner JOIN attendance on attendance.stat_id=students.st_id where    students.st_id='$_SESSION[userId]'";
$ret = mysqli_query($conn,$query)or die("not is");
if(mysqli_num_rows($ret) > 0 )
{
while ($row=mysqli_fetch_array($ret)) 
{ 
    
    if($row['st_status'] == '1'){$status = "Present"; $colour="#00FF00";}else{$status = "Absent";$colour="#FF0000";}

echo '  
<tr>  
<td>'.$cnt.'</td> 
<td>'.$firstName= $row['st_name'].'</td> 
<td>'.$lastName= $row['st_dept'].'</td> 

<td>'.$admissionNumber= $row['st_id'].'</td> 
<td>'.$className= $row['course'].'</td> 

<td>'.$status=$status.'</td>	 	
<td>'.$dateTimeTaken=$row['stat_date'].'</td>	 					
</tr>  
';

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$filename."-report.xls");
header("Pragma: no-cache");
header("Expires: 0");
			$cnt++;
			}
	}
}



?>
</table>