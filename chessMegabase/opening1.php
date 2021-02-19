<?php
require 'includes/common.php';
// if (isset($_SESSION['email'])) {
//     header('home_page.php');
// }

$select_query = "SELECT * FROM opening";
$select_query_result = mysqli_query($con , $select_query) or die(mysqli_error($con));

$row = mysqli_fetch_array($select_query_result);
// echo json_encode($row['name']);
$i = 1;
$fen_str='';

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <!-- <link href="css/style.css" rel="stylesheet"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chessboard-js/1.0.0/chessboard-1.0.0.min.js" type="text/javascript"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/chessboard-js/1.0.0/chessboard-1.0.0.min.css" rel="stylesheet"></link>
        <style>
        body{
          background-color: black;
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
    <body style="background-color: black;">
      <?php include'includes/header.php' ?>
        <div class="container-fluid">
            <h1 style="text-align: center; color:#FFF;">Search Openings</h1>
        </div>
        <div class="container my-10">
        <div class="col-xs-6">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/chess.js/0.10.2/chess.js"></script>
	            <div class="chessboard" id="board1" style="margin: 0 auto; width: 400px; padding-top: 60px;"></div>
                <div style="margin: 5px auto; width: 400px;">
                    <p id="headers1"></p>

                    <p id="pgn1"></p>

                    <input type="button" id="startPositionBtn1" value="|<" />
                    <input type="button" id="prevBtn1" value="<" />
                    <input type="button" id="nextBtn1" value=">" />
                    <input type="button" id="endPositionBtn1" value=">|" />
                    <input type="button" id="resumePositionBtn1" value="Resume Position" />
                    <input type="button" id="flipBoardBtn1" value="Flip Board" />
                    <button id="startBtn1">Start Position</button>
                    <button id="clearBtn1">Clear Board</button>
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
                            <th>Opening</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while($row = mysqli_fetch_array($select_query_result)){

                        $fen_str=$row["fen"]
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['name']; ?></td>

                            <td><?php echo "<a href='search_fen.php?fenstr=".$fen_str."' style='border: 1px solid  rgb(73, 139, 120); border-style: outset; ' class='btn upload-btn'>Search Game</a>"; ?></td>
                        </tr>


                    <?php
                            $i += 1;
                            }
                     ?>
                    </tbody>
                </table>
            </div>
        </div>

    </body>
</html>
