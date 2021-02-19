<?php
$pgn = $_POST['pgn'];
// echo $pgn;
// echo nl2br("\n\n\n");
// $moves_match = array();
//preg_match('/^\[[Site|Date|Event|White|Black|Result]+\s\"(.*)\"\]\s\[[Site|Date|Event|White|Black|Result]+\s\"(.*)\"\]\s\[[Site|Date|Event|White|Black|Result]+\s\"(.*)\"\]\s\[[Site|Date|Event|White|Black|Result]+\s\"(.*)\"\]\s\[[Site|Date|Event|White|Black|Result]+\s\"(.*)\"\]\s\[[Site|Date|Event|White|Black|Result]+\s\"(1-0|0-1|1\/2-1\/2)\"\]/',$pgn,$matches);

// echo "<h2>Loading.......please wait</h2>";
// ([0-9]+\.\s.*)
preg_match_all('/(?:[PNBRQK]?[a-h]?[1-8]?x?[a-h][1-8](?:\=[PNBRQK])?|O(-O){1,2})[\+#]?(\s*[\!\?]+)?/',$pgn,$moves_match);
//\[Result\s\"(1-0|0-1|1\/2-1\/2)\"\]
// echo $moves_match[1]."<br>";
preg_match('/\[Result\s\"(1-0|0-1|1\/2-1\/2)\"\]/',$pgn,$res_match);

//\[White\s\"([a-zA-Z0-9]+)\"\]
preg_match('/\[White\s\"(.*)\"\]/',$pgn,$white_match);
//\[Black\s\"([a-zA-Z0-9]+)\"\]
preg_match('/\[Black\s\"(.*)\"\]/',$pgn,$black_match);
//\[Date\s\"([0-9]{4}-[0-9]{2}-[0-9]{2})\"\]
preg_match('/\[Date\s\"([0-9]{4}-?\.?[0-9]{2}-?\.?[0-9]{2})\"\]/',$pgn,$date_match);
$move_str = "";
foreach($moves_match[0] as $mov){
    $move_str = $move_str." ".$mov." ";
    // echo $mov." ";
}

// echo $move_str;
// echo $moves_match[1];

$game_name = $white_match[1]." vs ".$black_match[1];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Chess board</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chessboard-js/1.0.0/chessboard-1.0.0.min.js" type="text/javascript"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/chessboard-js/1.0.0/chessboard-1.0.0.min.css" rel="stylesheet"></link>
	<style type="text/css">
		.chessboard img {
  			padding: 0px;
  			background: transparent;
  			border: 0px;
		}
	</style>
</head>
    <body>
      <?php include'includes/header.php' ?>
        <div class="container">

        <center>
            <h1>Loading,...please wait.</h1><br>
            <img src="loading.gif" alt="">
        </center>
        <!-- <div id="loading"><div>Loading, Please wait...</div></div>
        <script>$(document).ajaxStart(function () {

            $("#loading").fadeIn();

                }).ajaxStop(function () {

                $("#loading").fadeOut();

                $(document).foundation();

            });</script> -->
            <!-- <div class=" row chessboard" id="board1" style="margin: 0 auto; width: 500px; padding-top: 60px;">
            </div>

            <div class="row" style="padding-left: 80px;">
            <p id="pgn1"></p>

            <input type="button" id="startPositionBtn1" value="|<" />
            <input type="button" id="prevBtn1" value="<" />
            <input type="button" id="nextBtn1" value=">" />
            <input type="button" id="endPositionBtn1" value=">|" />
            <input type="button" id="resumePositionBtn1" value="Resume Position" />
            <input type="button" id="flipBoardBtn1" value="Flip Board" />
            <button id="startBtn1">Start Position</button>
            <button id="clearBtn1">Clear Board</button>
            <button id="get_fenBtn2">Search FEN String</button> -->
            <!-- <p id="fen"></p> -->
		    </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/chess.js/0.10.2/chess.js"></script>
            <script type="text/javascript">
                // var g = new Chess();
                // var pgn_game = '';
                // console.log(pgn_game);
                // g.load_pgn(pgn_game);
                // hist = g.history();
                // g.reset();
                // console.log(g.pgn());
                // console.log(hist);
                // x=g.pgn();
                // y = x.header
                // console.log(x);
                // console.log(y);
                // console.log(g.pgn());

                var game1 = new Chess();
                var fen_arr=[];
                var all = [];
                var result = '<?php echo $res_match[1]; ?>';
                var result_id;
                // console.log('<?php //echo $move_str; ?>');
                var pgn_game = '<?php echo $move_str; ?>';
                var game_name = '<?php echo $game_name; ?>';
                var game_date = '<?php echo $date_match[1]; ?>';


                	game1.load_pgn(pgn_game);
                  var history1 = game1.history();
                  game1.reset();
                  ///str_hist = JSON.stringify(history1);
                //   console.log(history1);
                  for(x in history1){

                    // if(history1[x].includes("+")){
                    //     history1[x] = history1[x].replace(/\+/, "plus");
                    // }
                    // if(history1[x].includes("#")){
                    //     history1[x] = history1[x].replace(/\#/, "hash");
                    // }
                    // if(history1[x].includes("=")){
                    //     history1[x] = history1[x].replace(/\=/, "equal");
                    // }




                    // history1[x] = history1[x].replace(/\+/, "plus");
                    // history1[x] = history1[x].replace(/\#/, "hash");
                    // history1[x] = history1[x].replace(/\=/, "z");




                    game1.move(history1[x])

                    //console.log(x);
                    //console.log(history1[x]);
                    fen_arr.push(game1.fen());
                    //console.log(game1.fen());

                    all[history1[x]] = game1.fen();
                    // console.log(all)



                    }
                    //console.log(fen_arr);
                    //console.log(all);
                    //document.writeln(all)
                    //console.log(history1);
                //   window.location.href="arr.php?strhist="+(history1);

                if(result == '1-0'){
                    if(game1.in_checkmate()){
                        result_id = 0;
                        // console.log("white wins by checkmate");
                        // console.log(result);
                    }
                    else{
                        result_id = 2
                        // console.log("black resign")
                        // console.log(history1[history1.length - 1].charAt(history1[history1.length - 1].length -1))
                        // console.log(history1[history1.length - 1]);
                        // console.log(result);
                    }
                }
			    else if(result == '0-1'){
                    if(game1.in_checkmate()){
                        result_id = 1;
                        // console.log("black wins by checkmate");
                        // console.log(result);
                    }
                    else{
                        result_id = 3;
                        // console.log("white resign");
                        // console.log(result);
                    }
                }
                else if(game1.in_stalemate()){
                    result_id = 4;
                    // console.log("stalemate");
                }
                else if(game1.insufficient_material()){
                    result_id = 5;
                    // console.log("insufficient material");
                }
                else if(game1.in_threefold_repetition()){
                    result_id = 6;
                    // console.log("3fold rep");
                }
                else if(game1.in_draw()){
                    result_id = 7;
                    // console.log("50moves");
                }
                else{
                    result_id = 8;
                    // console.log("agreement");
                }



                // var arr = new Array(1,2,3,4);
                $.ajax({
                    type: 'POST',
                    url: "arr.php",
                    data: ({h: history1,f: fen_arr,res: result_id,game_name: game_name,game_date: game_date}),
                    success: function (data) {
                        window.location.href="enter_pgn.php";
                    }
                });

                    <?php //echo "<script>window.location.href='arr.php?strhist='+".urlencode(."history1".)";</script>';" ?>

                // $(function() {



                // ////////////BOARD1
                //   var cfg1 = {
                //   	//boardTheme: chess24_board_theme
                //   	draggable: true,
                //   	dropOffBoard: 'snapback',
                //     pieceTheme: 'img/chesspieces/wikipedia/{piece}.png',
                //     position: 'start',
                //     //sparePieces: true
                //   };
                //   var board1 = ChessBoard('board1', cfg1);






                //   // 1. Load a PGN into the game
                //   var pgn_game = '<?php //echo $moves_match[1]; ?>';
                // 	game1.load_pgn(pgn_game);
                // 	headers = game1.header();
                // 	  //$('#pgn5').html(pgn.header);
                // 	  $('#headers1').html(headers.Event)
                // 	  //console.log(headers)

                //   // 2. Get the full move history
                //     var history1 = game1.history();
                // 	game1.reset();
                // 	var i = 0;



                //   // 3. If Next button clicked, move forward one
                //     $('#nextBtn1').on('click', function() {


                // 	//game1.move(history1[i]);
                //     //for(x in history1){
                //     //console.log(history1[x]);
                //     //game1.move(history1[x])

                //     //console.log(game1.fen());
                //     // fen_arr.push(game1.fen());
                //     // }
                //     // console.log(fen_arr);

                //     // str_hist = JSON.stringify(history1);
                //     // console.log(str_hist);
                //     //$.post('/test.php', {elements: elements})

                // 	// board1.position(game1.fen());
                // 	// $('#pgn1').html(game1.pgn())
                // 	// $('#fen1').html(game1.fen())
                // 	// i += 1;
                // 	// if (i > history1.length) {
                //   	// i = history1.length;
                // 	// }
                // 	});


                //   // 4. If Prev button clicked, move backward one
                //     $('#prevBtn1').on('click', function() {
                //     game1.undo();
                // 	board1.position(game1.fen());
                // 	$('#pgn1').html(game1.pgn())
                //     i -= 1;
                //     if (i < 0) {
                //       i = 0;
                //     }
                //   });



                //   // 5. If Start button clicked, go to start position
                //   $('#startPositionBtn1').on('click', function() {
                //     game1.reset();
                // 	board1.start();
                // 	$('#pgn1').html(game1.pgn())
                //     i = 0;
                //   });



                //   // 6. If End button clicked, go to end position
                //   $('#endPositionBtn1').on('click', function() {
                //     game1.load_pgn(pgn_game);
                // 	board1.position(game1.fen());
                // 	$('#pgn1').html(game1.pgn())
                //     i = history1.length;
                //   });



                //   $('#resumePositionBtn1').on('click', function() {
                // 	board1.position(game1.fen());
                // 	$('#pgn1').html(game1.pgn())
                //   });



                //   $('#flipBoardBtn1').on('click', board1.flip)
                //   $('#startBtn1').on('click', board1.start)
                //   $('#clearBtn1').on('click', board1.clear)
                // });
            </script>
        </div>
    </body>
</html>
