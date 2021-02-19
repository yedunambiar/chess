<?php
$con = mysqli_connect("localhost","root","","chess1","3307") or die(mysqli_error($con));
session_start();

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
        input[type=text]{
          color: #FFF;
          background-color: #000;

        }
        </style>

        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
            $('.search-box input[type="text"]').on("keyup input", function(){
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if(inputVal.length){
                    $.get("backend-search.php", {term: inputVal}).done(function(data){
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } else{
                    resultDropdown.empty();
                }
            });

            // Set search input value on click of result item
            $(document).on("click", ".result p", function(){
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
        });
        </script>

    </head>
    <body style="background-color: #000; color: #FFF;">
        <?php include'includes/header.php' ?>
        <div class="container">
          <center>
            <h1 style="text-align: center; color:#FFF;">Search Players</h1>
          </center>
        <div class="col-xs-6">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/chess.js/0.10.2/chess.js"></script>

	            <div class="chessboard" id="board1" style="margin: 0 auto; width: 500px; padding-top: 10px;"></div>
                <div style="margin: 5px auto; width: 500px;">

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
                        // boardTheme: chess24_board_theme
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
            <div class="col-xs-6" >

                <form action="player_fetch.php" method="post" >

                  <div class="row">

                    <div class="col-xs-6 search-box">
                      <input type="text" id="p1" name="p1" placeholder="player1" autocomplete="off" ><br>
                        <div class="result"></div>
                    </div>


                    <div class="col-xs-6 search-box">
                      <input type="text" id="p2" name="p2" placeholder="player2" autocomplete="off"><br>
                        <div class="result"></div>
                    </div>

                  </div>

                  <button class="btn upload-btn" type="submit">Search</button>

                </form>
            </div>
        </div>

    </body>
</html>
