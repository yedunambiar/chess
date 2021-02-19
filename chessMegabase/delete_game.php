<?php
$con = mysqli_connect("localhost","root","","chess1","3307") or die(mysqli_error($con));
$user_game_id = $_GET['user_game_id'];

$delete_game_query = "DELETE FROM user_game WHERE id='$user_game_id'";
$delete_game_query_result = mysqli_query($con , $delete_game_query) or die(mysqli_error($con));

header('location: enter_pgn.php');
?>
