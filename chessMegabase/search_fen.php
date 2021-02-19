<?php
$con = mysqli_connect("localhost","root","","chess1","3307") or die(mysqli_error($con));
session_start();


$fen_str = $_GET["fenstr"];
$fen_len = strlen($fen_str);


//search fen in moves table
$select_fen_query = "SELECT * FROM move WHERE substr(fen,1,'$fen_len')='$fen_str'";
$select_fen_query_result = mysqli_query($con,$select_fen_query) or die(mysqli_error($con));



$total_rows = mysqli_num_rows($select_fen_query_result);
if($total_rows == 0){
    echo "<script>alert('No game found')</script>";
    echo ("<script>location.href='opening1.php'</script>");
}
else{

    $i = 1;
    //echo "Total games: ",$total_rows;
    $select_op_query = "SELECT * FROM opening WHERE substr(fen,1,'$fen_len')='$fen_str'";
    $select_op_query_result = mysqli_query($con,$select_op_query) or die(mysqli_error($con));
    $row_op = mysqli_fetch_array($select_op_query_result);


?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="css/style.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chessboard-js/1.0.0/chessboard-1.0.0.min.js" type="text/javascript"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/chessboard-js/1.0.0/chessboard-1.0.0.min.css" rel="stylesheet"></link>
        <style>
        body{
          background-color: #000;
        }
        .scrollbar {
            position: relative;
            height: 500px;
            overflow: auto;
        }
        .table-wrapper-scroll-y {
            display: block;
        }
        </style>
    </head>
    <body>
      <?php include'includes/header.php' ?>
        <div class="container">
        <div class="col-xs-6">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/chess.js/0.10.2/chess.js"></script>
                <!-- <p><b><?php echo $row_op['name']; ?> </b> </p> -->
	            <div class="chessboard" id="board1" style="margin: 0 auto; width: 532px; padding-top: 5px;"></div>
                <div style="margin: 5px auto; width: 532px;">
                    <p id="headers1"></p>

                    <p id="pgn1"></p>

                    <center>
                      <button class="btn upload-btn" type="button" id="startPositionBtn1"><span class="glyphicon glyphicon-backward"></span></button>
                      <button class="btn upload-btn" type="button" id="prevBtn1"><span class="glyphicon glyphicon-chevron-left"></span></button>
                      <button class="btn upload-btn" type="button" id="nextBtn1"><span class="glyphicon glyphicon-chevron-right"></span></button>
                      <button class="btn upload-btn" type="button" id="endPositionBtn1"><span class="glyphicon glyphicon-forward"></span></button>
                      <!-- <input type="button" id="resumePositionBtn1" value="Resume Position" /> -->
                      <button class="btn upload-btn" type="button" id="flipBoardBtn1"><span class="glyphicon glyphicon-retweet"></button>

                    </center>


                    <!-- <input type="button" id="startPositionBtn1" value="|<" />
                    <input type="button" id="prevBtn1" value="<" />
                    <input type="button" id="nextBtn1" value=">" />
                    <input type="button" id="endPositionBtn1" value=">|" />
                    <input type="button" id="resumePositionBtn1" value="Resume Position" />
                    <input type="button" id="flipBoardBtn1" value="Flip Board" />
                    <button id="startBtn1">Start Position</button>
                    <button id="clearBtn1">Clear Board</button> -->
                </div>
                <script type="text/javascript">
                    $(function() {



                    //////////////BOARD1
                    var cfg1 = {
                        //boardTheme: chess24_board_theme
                        //draggable: true,
                        dropOffBoard: 'snapback',
                        pieceTheme: 'img/chesspieces/wikipedia/{piece}.png',
                        position: 'start',
                        //sparePieces: true
                    };
                    var board1 = ChessBoard('board1', cfg1);
                });
                </script>
            </div>
            <div class="col-xs-6">
                <table class="table table-striped scrollbar table-wrapper-scroll-y">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>Players</th>
                            <th>Event</th>
                            <th>Site</th>
                            <th>Result</th>
                            <th>Opening</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while($row = mysqli_fetch_array($select_fen_query_result)) {

                    $gameid = $row['game_id'];


                    //getting all ids and tags from game table
                  $select_game_query = "SELECT game.id,game.gameDate,p1.name as white_player,p2.name as black_player,event.name as ename,site.name as sname,result.description,result.notation,game.opening_id,opening.name as oname FROM game INNER JOIN player p1 ON game.player1=p1.id INNER JOIN player p2 ON game.player2=p2.id INNER JOIN event ON game.event_id=event.id INNER JOIN site ON game.site_id= site.id INNER JOIN result ON game.result_id=result.id INNER JOIN opening ON game.opening_id=opening.id WHERE game.id='$gameid'";
                    $select_game_query_result = mysqli_query($con,$select_game_query) or die(mysqli_error($con));
                    $row_game = mysqli_fetch_array($select_game_query_result);
                    ?>

                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row_game['white_player']; ?> VS <?php echo $row_game['black_player']; ?></td>
                            <td><?php echo $row_game['ename']; ?></td>
                            <td><?php echo $row_game['sname']; ?></td>
                            <td><?php echo $row_game['notation']; ?></td>
                            <td><?php echo $row_game['oname']; ?></td>
                            <td><?php echo "<a href='watch_game.php?game_id=".$row_game['id']."&fenstr=".$fen_str."' style='border: 1px solid  rgb(73, 139, 120); border-style: outset; ' class='btn upload-btn'>Watch Game</a>"; ?></td>
                        </tr>

                    <!--<p><b>Game:</b> <?php //echo $i; ?></p>
                    <p><b>White player name:</b> <?php //echo $row_game['white_player']; ?></p>
                    <p><b>Black player name:</b> <?php //echo $row_game['black_player']; ?></p>
                    <p><b>Event:</b> <?php //echo $row_game['ename']; ?></p>
                    <p><b>Site:</b> <?php //echo $row_game['sname']; ?></p>
                    <p><b>Date:</b> <?php //echo $row_game['game_date']; ?></p>

                    <p><b>Result:</b> <?php //echo $row_game['notation']; ?></p>
                    <p><?php //echo $row_game['description']; ?></p>
                    <br>
                    <hr style="border-color: black;">-->

                    <?php
                            $i += 1;
                            }
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </body>
</html>
