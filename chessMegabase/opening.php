<?php
$con = mysqli_connect("localhost","root","","chess1","3307") or die(mysqli_error($con));
$fen = $_REQUEST['fen'];

$select_query = "SELECT * FROM opening WHERE fen='$fen'";
$select_query_result = mysqli_query($con , $select_query) or die(mysqli_error($con));

$row = mysqli_fetch_array($select_query_result);
echo json_encode($row['name']);
?>
