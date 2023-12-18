<?php
error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 
<link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<!-- Bootstrap core JavaScript-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Page level plugin JavaScript--><script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
<style type="text/css">
        .Basic {
	background-color: #f8f9fa;
	padding: 14px;
	border-radius: 4px;
	margin-left: 120px;
	margin-right: 120px;
	margin-bottom: 10px;
	margin-top: 14px;
	
}
    </style>
<div class="Basic">
  <h5 style="text-align: center;"> Attendance Count </h5>
  <hr>
  <?php
  $sql="SELECT * FROM attendance where stat_id=226111 and st_status=1";
  $sql1="SELECT * FROM attendance where stat_id=226111 and st_status=0";


if ($result=mysqli_query($conn,$sql))
{
    $rowcount=mysqli_num_rows($result);
    if ($result1=mysqli_query($conn,$sql1))
    {
        $rowcount1=mysqli_num_rows($result1);

                    $dataPoints = array( 

                        array("y" => $rowcount,"label" => "Present" ),
                        array("y" => $rowcount1,"label" => "Absent" ),
                       
                        );
                
  } 
}
?>

<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<?php 
 $sql="SELECT * FROM attendance where stat_id=226111";
  $sql1="SELECT * FROM attendance where stat_id=226111 and st_status=1";
  
  if ($result=mysqli_query($conn,$sql))
{
  $rowcount=mysqli_num_rows($result);
if ($result1=mysqli_query($conn,$sql1))
{
  $rowcount1=mysqli_num_rows($result1);
  $percentage = ($rowcount1/$rowcount)*100;
  ?>
<br>
<h6> Overall attendance percentage : <?php print($percentage); } }?> %</h6>
<?php
// $sql="SELECT * FROM attendance where email='$email' and attendance='present'";
$sql="SELECT * FROM attendance where stat_id=226111 and st_status=1";

  if ($result=mysqli_query($conn,$sql))
{
  $rowcount=mysqli_num_rows($result);
  ?>
<h6> Total Presents : <?php print($rowcount); }?> </h6>
<?php
// $sql="SELECT * FROM attendance where email='$email' and attendance='absent'";
$sql="SELECT * FROM attendance where stat_id=226111 and st_status=0";

  if ($result=mysqli_query($conn,$sql))
{
  $rowcount=mysqli_num_rows($result);
  ?>
<h6> Total Absents : <?php print($rowcount); }?> </h6>

</div>

<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  title:{
    text: "Graphical display of user attendance"
  },
  axisY: {
    title: "Attendance Chart",
    includeZero: true,
    prefix: "",
    suffix:  ""
  },
  data: [{
    type: "bar",
    yValueFormatString: "#,##0d",
    indexLabel: "{y}",
    indexLabelPlacement: "inside",
    indexLabelFontWeight: "bolder",
    indexLabelFontColor: "white",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}
</script>
</body>
</html>