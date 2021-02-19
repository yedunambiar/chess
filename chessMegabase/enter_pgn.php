<?php
$con = mysqli_connect("localhost","root","","chess1","3307") or die(mysqli_error($con));

if(isset($_GET['path'])){
	$path = $_GET['path'];
}
else{
    $path = 1;
}
$select_user_game_query = "SELECT * FROM user_game WHERE user_id=1";
$select_user_game_query_result = mysqli_query($con,$select_user_game_query) or die(mysqli_error($con));
$total_rows = mysqli_num_rows($select_user_game_query_result);
//$total_rows = 0;


// $path  = 0;


?>
<!DOCTYPE html>
<html>
<head>
	<title>Chess board</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chessboard-js/1.0.0/chessboard-1.0.0.min.js" type="text/javascript"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/chessboard-js/1.0.0/chessboard-1.0.0.min.css" rel="stylesheet"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <style type="text/css">
		.chessboard img {
  			padding: 0px;
  			background: transparent;
  			border: 0px;
        }
        .scrollbar {
            position: relative;
            height: 400px;
            overflow: auto;
        }
        .table-wrapper-scroll-y {
            display: block;
        }
	</style>
</head>
<body style="background-color: black;">
	<?php include'includes/header.php' ?>
<div class="container" style="padding-top: 20px">
            <div class="col-xs-6">
                <!-- <div class="row" style="padding-left: 15px; padding-right: 15px;">
                    <div class="col-xs-4" style="text-align: left">
                        <p><b>White Player<?php //echo $row_watch_game['white_player']; ?></b></p>
                    </div>
                    <div class="col-xs-4" style="text-align: center">
                        <p><b>Result<?php //echo $row_watch_game['notation']; ?></b></p>
                    </div>
                    <div class="col-xs-4" style="text-align: right">
                        <p><b>Black Player<?php //echo $row_watch_game['black_player']; ?></b></p>
                    </div>
                </div>
                <div class="row" style="padding-left: 15px; padding-right: 15px;">
                    <div class="col-xs-6" style="text-align: left">
                        <p>Event Name<?php //echo $row_watch_game['ename']; ?></p>
                    </div>
                    <div class="col-xs-6" style="text-align: right">
                        <p>Site Name<?php //echo $row_watch_game['sname']; ?></p>
                    </div>
                </div> -->
                <div class="row">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/chess.js/0.10.2/chess.js"></script>
                    <div class="chessboard" id="board1" style="margin: 0 auto; width: 532px; padding-top: 5px;"></div>
                    <center>
                    <div style="margin: 5px auto; width: 532px;">
                        <p id="headers1"></p>

                        <!--<p id="pgn1"></p>-->
                        <?php if(isset($_GET['user_game_id'])){ ?>
                        <button class="btn upload-btn" type="button" id="startPositionBtn1"><span class="glyphicon glyphicon-backward"></span></button>
                        <button class="btn upload-btn" type="button" id="prevBtn1"><span class="glyphicon glyphicon-chevron-left"></span></button>
                        <button class="btn upload-btn" type="button" id="nextBtn1"><span class="glyphicon glyphicon-chevron-right"></span></button>
                        <button class="btn upload-btn" type="button" id="endPositionBtn1"><span class="glyphicon glyphicon-forward"></span></button>
                        <!-- <input type="button" id="resumePositionBtn1" value="Resume Position" /> -->
                        <button class="btn upload-btn" type="button" id="flipBoardBtn1"><span class="glyphicon glyphicon-retweet"></button>
                        <!-- <button id="startBtn1">Start Position</button>
                        <button id="clearBtn1">Clear Board</button> -->
                        <?php

                            $user_watch_game_id = $_GET['user_game_id'];

                            $select_moves_query = "SELECT * FROM user_moves WHERE user_game_id='$user_watch_game_id'";
                            $select_moves_query_result = mysqli_query($con,$select_moves_query) or die(mysqli_error($con));

                            } ?>
                        <!--<p id="fen1"></p>-->
                    </div>
                    </center>
                    <?php
                        // $select_moves_query = "SELECT * FROM moves WHERE game_id='$game_id'";
                        // $select_moves_query_result = mysqli_query($con,$select_moves_query) or die(mysqli_error($con));


                    ?>
                    <script type="text/javascript">
                        $(function() {



                        //////////////BOARD1
                        var cfg1 = {
							//boardTheme: chess24_board_theme

                            <?php if(!isset($_GET['user_game_id'])){ ?>
                            draggable: false,
                            <?php }
                            else if(isset($_GET['user_game_id'])){ ?>
                            draggable: true,
                            <?php } ?>
                            dropOffBoard: 'snapback',
                            pieceTheme: 'img/chesspieces/wikipedia/{piece}.png',
                            position: 'start',
                            //sparePieces: true
                        };
                        var board1 = ChessBoard('board1', cfg1);

                        var game1 = new Chess();
                        var pgn_game='';



                        // 1. Load a PGN into the game
                        <?php
                        if(isset($_GET['user_game_id'])){
                            while($row_moves = mysqli_fetch_array($select_moves_query_result)){ ?>
                                pgn_game = pgn_game + ' ' + '<?php echo $row_moves["notation"]; ?>' ;
                        <?php }
                        }
                        ?>
                            game1.load_pgn(pgn_game);
                            headers = game1.header();
                            //$('#pgn5').html(pgn.header);
                            $('#headers1').html(headers.Event)
                            // console.log(pgn_game)

                        // 2. Get the full move history
                            var history1 = game1.history();
                            game1.reset();
                            var i = 0;



                        // 3. If Next button clicked, move forward one
                            $('#nextBtn1').on('click', function() {

                                var textarea = document.getElementById('pgn1');
                                textarea.scrollTop = textarea.scrollHeight;
                            game1.move(history1[i]);
                            board1.position(game1.fen());
                            $('#pgn1').html(game1.pgn())
                            $('#fen1').html(game1.fen())
                            i += 1;
                            if (i > history1.length) {
                            i = history1.length;
                            }
                            if(game1.game_over()){
                                $('#pgn1').html(game1.pgn() +'\n<?php //echo $row_watch_game['description']; ?>')
                            }
                            });


                        // 4. If Prev button clicked, move backward one
                            $('#prevBtn1').on('click', function() {
                            game1.undo();
                            board1.position(game1.fen());
                            $('#pgn1').html(game1.pgn())
                            i -= 1;
                            if (i < 0) {
                            i = 0;
                            }
                        });



                        // 5. If Start button clicked, go to start position
                        $('#startPositionBtn1').on('click', function() {
                            game1.reset();
                            board1.start();
                            $('#pgn1').html(game1.pgn())
                            i = 0;
                        });



                        // 6. If End button clicked, go to end position
                        $('#endPositionBtn1').on('click', function() {
                            game1.load_pgn(pgn_game);
                            board1.position(game1.fen());
                            $('#pgn1').html(game1.pgn() +'\n<?php //echo $row_watch_game['description']; ?>')
                            i = history1.length;
                        });



                        $('#resumePositionBtn1').on('click', function() {
                            board1.position(game1.fen());
                            $('#pgn1').html(game1.pgn())
                        });



                        $('#flipBoardBtn1').on('click', board1.flip)
                        $('#startBtn1').on('click', board1.start)
                        $('#clearBtn1').on('click', board1.clear)
                    });
                    </script>
                </div>
			</div>

            <div class="col-xs-6">
			<?php if($total_rows != 0){ ?>
                <table class="table table-hover scrollbar table-wrapper-scroll-y">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sr.No.</th>
                            <th>Players</th>
                            <th>Opening</th>
							<th>Result</th>
							<th>Date</th>
                            <th>Watch Game</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($total_rows !=0){

                        //while($row = mysqli_fetch_array($select_user_game_query_result))



                        $i = 1;
                    while($row = mysqli_fetch_array($select_user_game_query_result)){

                        $user_game_id = $row['id'];


                    //getting all ids and tags from game table
                    $select_game_query = "SELECT user_game.opening_id,opening.name as oname,user_game.id,user_game.name,user_game.gameDate,result.description,result.notation FROM user_game INNER JOIN result ON user_game.result_id=result.id INNER JOIN opening ON user_game.opening_id=opening.id WHERE user_game.id='$user_game_id'";
	                $select_game_query_result = mysqli_query($con,$select_game_query) or die(mysqli_error($con));
	                $row_game = mysqli_fetch_array($select_game_query_result);






                    // $p1_id = $row2['player1'];
                    // $p2_id = $row2['player2'];
                    // $r_id = $row2['result_id'];
                    // $e_id = $row2['event_id'];
                    // $s_id = $row2['site_id'];



                    // //getting white player
                    // $select_p1_query = "SELECT * FROM player WHERE id='$p1_id'";
                    // $select_p1_query_result = mysqli_query($con,$select_p1_query) or die(mysqli_error($con));
                    // $row_player1 = mysqli_fetch_array($select_p1_query_result);


                    // //getting black player
                    // $select_p2_query = "SELECT * FROM player WHERE id='$p2_id'";
                    // $select_p2_query_result = mysqli_query($con,$select_p2_query) or die(mysqli_error($con));
                    // $row_player2 = mysqli_fetch_array($select_p2_query_result);



                    // $select_res_query = "SELECT * FROM result WHERE id='$r_id'";
                    // $select_res_query_result = mysqli_query($con,$select_res_query) or die(mysqli_error($con));
                    // $row_result = mysqli_fetch_array($select_res_query_result);

                    // $select_event_query = "SELECT * FROM event WHERE eid='$e_id'";
                    // $select_event_query_result = mysqli_query($con,$select_event_query) or die(mysqli_error($con));
                    // $row_event = mysqli_fetch_array($select_event_query_result);

                    // $select_site_query = "SELECT * FROM site WHERE sid='$s_id'";
                    // $select_site_query_result = mysqli_query($con,$select_site_query) or die(mysqli_error($con));
                    // $row_site = mysqli_fetch_array($select_site_query_result);
                    ?>

                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row_game['name']; ?><?php //echo $row_game['black_player']; ?></td>
                            <td><?php echo $row_game['oname']; ?></td>
                            <td><?php echo $row_game['notation']; ?></td>
                            <td><?php echo $row_game['gameDate']; ?></td>
                            <td><?php echo "<a href='enter_pgn.php?user_game_id=".$user_game_id."'class='btn upload-btn'>W</a>"; ?></td>
                            <td><?php echo "<a href='delete_game.php?user_game_id=".$user_game_id."'class='btn btn-lg upload-btn'><i class='fa fa-trash trash'></i></span></a>"; ?></td>
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
					<?php } ?>

				<?php if($path == 0){ ?>
				<form action="pgn_submit.php" method="post" id="pgn">
				<textarea name="pgn" cols="50" style="width: 540px; resize: none; height: 120px; overflow-y: visible; border-color: black; background-color: rgb(210,210,210);" required></textarea>
				<button type="submit" name="submit" class="btn btn-lg btn-block upload-btn">Submit</button>
				</form>
				<?php }
				else if($path == 1 && !isset($_GET['user_game_id'])){
				?>
				<a href="enter_pgn.php?path=0" class="btn btn-lg btn-block upload-btn"><span class="glyphicon glyphicon-plus-sign"></span>  Upload new game</a>
                <?php }

                if(isset($_GET['user_game_id'])){
                ?>
                <div style="padding-top: 20px;">
                <textarea id="pgn1" name="w3review" cols="50" style="border-radius: 5px;width: 540px; resize: none; height: 80px; overflow-y: visible; border-color: black; background-color: rgb(210,210,210);" disabled></textarea>
                </div>
                <?php } ?>

            </div>
</body>
</html>
