<?php
$con = mysqli_connect("localhost","root","","chess1","3307") or die(mysqli_error($con));
// $x = $_POST['strhist'];
// //$x = mysqli_real_escape_string($con,$x);
// // var_dump($x);
// // echo $x;
// // echo gettype($x);
// //$y = explode(',',$x);
// //print_r $y[1];

// $asd =  (explode(",",$x));
// // echo $asd[1];
// foreach($asd as $w){
//     $w = str_replace("plus","+",$w);
//     $w = str_replace("hash","#",$w);
//     $w = str_replace("z","=",$w);
//     echo $w."<br>";
// }


// $history1 = $_POST['history1'];

// $history1 = json_decode($json, true);



$moves = $_REQUEST['h'];
$fen = $_REQUEST['f'];
$result_id = $_REQUEST['res'];
$game_name = $_REQUEST['game_name'];
$game_date = $_REQUEST['game_date'];
// $x = json_encode($m);
// foreach($m as $w){
//     echo $w;
// }
//$y = json_encode($f);
// foreach($f as $fen){
//     $update_query = "UPDATE user_game SET fenstr='$fen' WHERE gid=4";
//     $update_query_result = mysqli_query($con , $update_query) or die(mysqli_error($con));
// }

$insert_user_game_query = "INSERT INTO user_game (user_id,name,result_id,gameDate) VALUES (1,'$game_name','$result_id','$game_date')";
$insert_user_game_query_result = mysqli_query($con , $insert_user_game_query) or die(mysqli_error($con));

$user_game_id = mysqli_insert_id($con);

$i = count($moves);

for($j = 0; $j < $i; $j++){
    $insert_query = "INSERT INTO user_moves VALUES ('$user_game_id','$moves[$j]','$fen[$j]')";
    $insert_query_result = mysqli_query($con , $insert_query) or die(mysqli_error($con));

    $select_op_query = "SELECT id FROM opening WHERE fen='$fen[$j]'";
    $select_op_query_result = mysqli_query($con,$select_op_query) or die(mysqli_error($con));
    $total_rows = mysqli_num_rows($select_op_query_result);
    if($total_rows != 0){
        $row_op = mysqli_fetch_array($select_op_query_result);
        $opening_id = $row_op['id'];
    }


    // echo $m[$j];
    // echo $f[$j];

}

$update_user_game_query = "UPDATE user_game SET opening_id='$opening_id' WHERE id='$user_game_id'";
$update_user_game_query_result = mysqli_query($con , $update_user_game_query) or die(mysqli_error($con));


?>

<!-- ALTER TABLE `user_game` ADD FOREIGN KEY (`result_id`) REFERENCES `result`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `user_game` ADD FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; -->
<!-- CREATE TABLE `chess2`.`user_game` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `user_id` INT(11) NOT NULL , `result_id` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
 -->
<!-- ALTER TABLE `user_moves` ADD FOREIGN KEY (`user_game_id`) REFERENCES `user_game`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; -->
<!-- CREATE TABLE `chess2`.`user_moves` ( `user_game_id` INT(11) NOT NULL , `notation` VARCHAR(10) NOT NULL , `fen` VARCHAR(255) NOT NULL ) ENGINE = InnoDB;
 -->
