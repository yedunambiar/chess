<?php
$con = mysqli_connect("localhost","root","","chess1","3307") or die(mysqli_error($con));
session_start();

$id_1 ='';
$id_2 ='';

$id_1 = $_GET["id_1"];
$id_2 = $_GET["id_2"];

if($id_1 != '' && $id_2 == ''){

  $select_player_query = " SELECT * FROM game WHERE game.player1 = '$id_1' or game.player2 = '$id_1' ";

  $select_player_query_result = mysqli_query($con,$select_player_query) or die(mysqli_error($con));


}

if($id_1 != '' && $id_2 != ''){
  $select_player_query = " SELECT * FROM game WHERE game.player1 = '$id_1' and game.player2 = '$id_2' ";

  $select_player_query_result = mysqli_query($con,$select_player_query) or die(mysqli_error($con));


}

$game_id = $_GET["game_id"];
//search game_id in moves table
$select_play_query = "SELECT * FROM move WHERE move.game_id='$game_id'";
$select_play_query_result = mysqli_query($con,$select_play_query) or die(mysqli_error($con));

$total_rows = mysqli_num_rows($select_play_query_result);
if($total_rows == 0){
    echo "<script>alert('No game found')</script>";
    echo ("<script>location.href='player.php'</script>");
}
else{

    $i = 1;
    //echo "Total games: ",$total_rows;

    $select_watch_game_query = "SELECT game.id,game.gameDate,p1.name as white_player,p2.name as black_player,event.name,site.name,result.description,result.notation FROM game INNER JOIN player p1 ON game.player1=p1.id INNER JOIN player p2 ON game.player2=p2.id INNER JOIN event ON game.event_id=event.id INNER JOIN site ON game.site_id=site.id INNER JOIN result ON game.result_id=result.id WHERE game.id='$game_id'";
    $select_watch_game_query_result = mysqli_query($con,$select_watch_game_query) or die(mysqli_error($con));
    $row_watch_game = mysqli_fetch_array($select_watch_game_query_result);


?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chessboard-js/1.0.0/chessboard-1.0.0.min.js" type="text/javascript"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/chessboard-js/1.0.0/chessboard-1.0.0.min.css" rel="stylesheet"></link>
        <link rel="icon" href="data:;base64,=">
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
        <div class="container" style="padding-top: 20px">
            <div class="col-xs-6">
                <div class="row" style="padding-left: 15px; padding-right: 15px;">
                    <div class="col-xs-4" style="text-align: left">
                        <p><b><?php echo $row_watch_game['white_player']; ?></b></p>
                    </div>
                    <div class="col-xs-4" style="text-align: center">
                        <p><b><?php echo $row_watch_game['notation']; ?></b></p>
                    </div>
                    <div class="col-xs-4" style="text-align: right">
                        <p><b><?php echo $row_watch_game['black_player']; ?></b></p>
                    </div>
                </div>
                <div class="row" style="padding-left: 15px; padding-right: 15px;">
                    <div class="col-xs-6" style="text-align: left">
                        <p><?php echo $row_watch_game['name']; ?></p>
                    </div>
                    <div class="col-xs-6" style="text-align: right">
                        <p><?php echo $row_watch_game['name']; ?></p>
                    </div>
                </div>
                <div class="row">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/chess.js/0.10.2/chess.js"></script>
                    <div class="chessboard" id="board1" style="margin: 0 auto; width: 532px; padding-top: 5px;"></div>
                    <div style="margin: 5px auto; width: 532px;">
                        <p id="headers1"></p>

                        <!--<p id="pgn1"></p>-->
                        <!-- <input type="button" id="startPositionBtn1" value="|<" />
                        <input type="button" id="prevBtn1" value="<" />
                        <input type="button" id="nextBtn1" value=">" />
                        <input type="button" id="endPositionBtn1" value=">|" />
                        <input type="button" id="resumePositionBtn1" value="Resume Position" />
                        <input type="button" id="flipBoardBtn1" value="Flip Board" />
                        <button id="startBtn1">Start Position</button>
                        <button id="clearBtn1">Clear Board</button> -->
                        <center>
                          <button class="btn upload-btn" type="button" id="startPositionBtn1"><span class="glyphicon glyphicon-backward"></span></button>
                          <button class="btn upload-btn" type="button" id="prevBtn1"><span class="glyphicon glyphicon-chevron-left"></span></button>
                          <button class="btn upload-btn" type="button" id="nextBtn1"><span class="glyphicon glyphicon-chevron-right"></span></button>
                          <button class="btn upload-btn" type="button" id="endPositionBtn1"><span class="glyphicon glyphicon-forward"></span></button>
                          <!-- <input type="button" id="resumePositionBtn1" value="Resume Position" /> -->
                          <button class="btn upload-btn" type="button" id="flipBoardBtn1"><span class="glyphicon glyphicon-retweet"></button>

                        </center>
                        <!-- <button id="startBtn1">Start Position</button>
                        <button id="clearBtn1">Clear Board</button> -->
                        <!--<p id="fen1"></p>-->
                    </div>
                    <?php
                        $select_moves_query = "SELECT * FROM move WHERE game_id='$game_id'";
                        $select_moves_query_result = mysqli_query($con,$select_moves_query) or die(mysqli_error($con));


                    ?>
                    <script type="text/javascript">
                        $(function() {



                        //////////////BOARD1
                        var cfg1 = {
                            //boardTheme: chess24_board_theme
                            draggable: true,
                            dropOffBoard: 'snapback',
                            pieceTheme: 'img/chesspieces/wikipedia/{piece}.png',
                            position: 'start',
                            //sparePieces: true
                        };
                        var board1 = ChessBoard('board1', cfg1);

                        var game1 = new Chess();
                        var pgn_game='';
                        pgn_array = [];



                        // 1. Load a PGN into the game
                        <?php while($row_moves = mysqli_fetch_array($select_moves_query_result)){ ?>
                            pgn_game = pgn_game + ' ' + '<?php echo $row_moves["notation"]; ?>' ;
                            pgn_array.push('<?php echo $row_moves["notation"]; ?>');
                        <?php }?>
                            game1.load_pgn(pgn_game);
                            headers = game1.header();
                            //$('#pgn5').html(pgn.header);
                            $('#headers1').html(headers.Event)
                            console.log(pgn_game)

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
                            if (i < history1.length) {
                                checkSound(i);
                                i += 1;
                            }
                            if (i > history1.length) {
                            i = history1.length;
                            }
                            if(game1.game_over()){
                                $('#pgn1').html(game1.pgn() +'\n<?php echo $row_watch_game['description']; ?>')
                            }
                            });


                        // 4. If Prev button clicked, move backward one
                            $('#prevBtn1').on('click', function() {
                            game1.undo();
                            board1.position(game1.fen());
                            $('#pgn1').html(game1.pgn())
                            if (i > 0) {
                                checkSound(i);
                            }
                            i -= 1;
                            if (i < 0) {
                            i = 0;
                            }
                        });





                        document.addEventListener("keydown",function(event){
                            if (event.key == "ArrowLeft") {
                          game1.undo();
                          board1.position(game1.fen());
                          $('#pgn1').html(game1.pgn())
                          if (i > 0) {
                                checkSound(i);
                            }
                          i -= 1;
                          if (i < 0) {
                          i = 0;
                          }
                        }

                        });

                        document.addEventListener("keydown",function(event){
                        if (event.key == "ArrowRight") {
                          var textarea = document.getElementById('pgn1');
                          textarea.scrollTop = textarea.scrollHeight;
                          game1.move(history1[i]);
                          board1.position(game1.fen());
                          $('#pgn1').html(game1.pgn())
                          $('#fen1').html(game1.fen())
                          if (i < history1.length) {
                          checkSound(i);
                          i += 1;
                          }

                          if (i > history1.length) {
                          i = history1.length;
                          }
                          if(game1.game_over()){
                              $('#pgn1').html(game1.pgn() +'\n<?php echo $row_watch_game['description']; ?>')
                          }
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
                            $('#pgn1').html(game1.pgn() +'\n<?php echo $row_watch_game['description']; ?>')
                            i = history1.length;
                            checkSound(i);
                        });



                        $('#resumePositionBtn1').on('click', function() {
                            board1.position(game1.fen());
                            $('#pgn1').html(game1.pgn())
                        });



                        $('#flipBoardBtn1').on('click', board1.flip)
                        $('#startBtn1').on('click', board1.start)
                        $('#clearBtn1').on('click', board1.clear)


                        var done = false;
                    function checkSound(i){
                      console.log(i);
                      console.log(game1.history()[i]);
                      // console.log(done);
                      // console.log(pgn_array[i]);
                      if(game1.in_check()){
                        var audio = new Audio('audio/move-check.mp3')
                        audio.play();
                        done=true;
                      }
                      if( game1.in_checkmate() || game1.in_draw() || game1.in_stalemate() || game1.in_threefold_repetition() || game1.insufficient_material() ){
                        var audio = new Audio('audio/game-end.mp3')
                        audio.play();
                        done=true;
                      }
                      if(i<pgn_array.length && pgn_array[i].includes('x')){
                        var audio = new Audio('audio/capture.mp3')
                        audio.play();
                        done=true;
                      }
                      if(i<pgn_array.length && pgn_array[i].includes('=')){
                        var audio = new Audio('audio/promote.mp3')
                        audio.play();
                        done=true;
                      }
                      if(i<pgn_array.length && pgn_array[i].includes('O')){
                        var audio = new Audio('audio/castle.mp3')
                        audio.play();
                        done=true;
                      }
                      if(done == false && i%2 ==0){
                        var audio = new Audio('audio/move-self.mp3')
                        audio.play();
                      }
                      if(done == false && i%2 == 1){
                        var audio = new Audio('audio/move-opponent.mp3')
                        audio.play();
                      }
                      done = false;



                    }



                    });
                    </script>
                </div>
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
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while($row = mysqli_fetch_array($select_player_query_result)) {


                      $gameid = $row['id'];

                      $select_game_query = "SELECT game.id,game.gameDate,p1.name as white_player,p2.name as black_player,event.name as ename,site.name as sname,result.description,result.notation,game.opening_id,opening.name as oname FROM game INNER JOIN player p1 ON game.player1=p1.id INNER JOIN player p2 ON game.player2=p2.id INNER JOIN event ON game.event_id=event.id INNER JOIN site ON game.site_id= site.id INNER JOIN result ON game.result_id=result.id INNER JOIN opening ON game.opening_id=opening.id WHERE game.id= '$gameid' ";

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

                            <td><?php echo "<a href=' watch_game_player.php?game_id=".$row_game['id']."&id_1=".$id_1."&id_2=".$id_2." ' style='border: 1px solid  rgb(73, 139, 120); border-style: outset; ' class='btn upload-btn'>Watch Game</a>"; ?></td>
                        </tr>

                    <?php
                            $i += 1;
                          } }
                     ?>
                    </tbody>
                </table>
                <textarea id="pgn1" name="w3review" cols="50" style="width: 540px; resize: none; height: 80px; overflow-y: visible; border-color: black; background-color: rgb(210,210,210);" disabled></textarea>
            </div>
        </div>

    </body>
</html>
