<?php
    $con = mysqli_connect("localhost","root","","chess1","3307") or die(mysqli_error($con));
	session_start();





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
	<link rel="icon" href="data:;base64,=">
	<style type="text/css">
  body{
    background-color: #000;
  }
		.chessboard img {
  			padding: 0px;
  			background: transparent;
  			border: 0px;
		}
	</style>
</head>
<body>





	<script src="https://cdnjs.cloudflare.com/ajax/libs/chess.js/0.10.2/chess.js"></script>
	<?php include'includes/header.php' ?>
	<div style="margin: 5px auto; width: 400px;">
		<!-- <p id="headers1"></p>

		<p id="pgn1"></p>

		<input type="button" id="startPositionBtn1" value="|<" />
		<input type="button" id="prevBtn1" value="<" />
		<input type="button" id="nextBtn1" value=">" />
		<input type="button" id="endPositionBtn1" value=">|" />
		<input type="button" id="resumePositionBtn1" value="Resume Position" />
		<input type="button" id="flipBoardBtn1" value="Flip Board" />
		<button id="startBtn1">Start Position</button>
		<button id="clearBtn1">Clear Board</button>
		<p id="fen1"></p> -->

		<p id="op"></p>
		<div class=" row chessboard" id="board2" style="margin: 0 auto; width: 500px; padding-top: 60px;">
		</div>

		<div class="row" style="padding-left: 80px;">
		<p id="movepgn"></p>

		<input type="button" id="startPositionBtn2" value="|<" />
		<input type="button" id="prevBtn2" value="<" />
		<input type="button" id="nextBtn2" value=">" />
		<input type="button" id="endPositionBtn2" value=">|" />
		<input type="button" id="resumePositionBtn2" value="Resume Position" />
		<input type="button" id="flipBoardBtn2" value="Flip Board" />
		<button id="startBtn2">Start Position</button>
		<button id="clearBtn2">Clear Board</button>
		<button id="get_fenBtn2">Search FEN String</button>
		<!-- <p id="fen"></p> -->
		</div>






		<!-- <div class="chessboard" id="board3" style="margin: 0 auto; width: 400px; padding-top: 60px;">
		</div>

		<p id="position_fen"></p>

		<input type="button" id="startPositionBtn3" value="|<" />
		<input type="button" id="prevBtn3" value="<" />
		<input type="button" id="nextBtn3" value=">" />
		<input type="button" id="endPositionBtn3" value=">|" />
		<input type="button" id="resumePositionBtn3" value="Resume Position" />
		<input type="button" id="flipBoardBtn3" value="Flip Board" />
		<button id="startBtn3">Start Position</button>
		<button id="clearBtn3">Clear Board</button>
		<button id="get_fenBtn3">Get FEN String</button> -->

	</div>
	<script type="text/javascript">
		$(function() {



		//////////////BOARD1
	//   var cfg1 = {
	//   	//boardTheme: chess24_board_theme
	//   	draggable: true,
	//   	dropOffBoard: 'snapback',
	//     pieceTheme: 'img/chesspieces/wikipedia/{piece}.png',
	//     position: 'start',
	//     //sparePieces: true
	//   };
	//   var board1 = ChessBoard('board1', cfg1);

	//   var game1 = new Chess();




	//   // 1. Load a PGN into the game
	//   var pgn_game = '';
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


    // 	game1.move(history1[i]);
	// 	board1.position(game1.fen());
	// 	$('#pgn1').html(game1.pgn())
	// 	$('#fen1').html(game1.fen())
    // 	i += 1;
    // 	if (i > history1.length) {
    //   	i = history1.length;
    // 	}
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
















		//////////////////BOARD 2





	  var cfg2 = {
	  	//boardTheme: chess24_board_theme
	  	draggable: true,
	  	dropOffBoard: 'snapback',
	    pieceTheme: 'img/chesspieces/wikipedia/{piece}.png',
	    onDrop: onDrop,
	    onSnapEnd: onSnapEnd,
	    position: 'start',
	    //sparePieces: true
	  };


	  var board2 = ChessBoard('board2',cfg2);
	  var game2 = new Chess();
	  var history2 = game2.history();
	  game2.reset();
	  var j = 0;

	  var y;



	  $('#nextBtn2').on('click', function() {


    	//game2.move(history2[j]);
		board2.position(game2.fen());
		$('#movepgn').html(game2.pgn())
    	j += 1;
    	if (j > history2.length) {
      	j = history2.length;
    	}
  		});


	  // 4. If Prev button clicked, move backward one
	    $('#prevBtn2').on('click', function() {
	    game2.undo();
		board2.position(game2.fen());
		//$('#movepgn').html(game2.pgn())
	    j -= 1;
	    if (j < 0) {
	      j = 0;
	    }
	  });



	  // 5. If Start button clicked, go to start position
	  $('#startPositionBtn2').on('click', function() {
	    game2.reset();
		board2.start();
		$('#movepgn').html(game2.pgn())
	    j = 0;
	  });



	  // 6. If End button clicked, go to end position
	  /*$('#endPositionBtn2').on('click', function() {
	    game2.load_pgn(pgn_game);
		board2.position(game2.fen());
		$('#movepgn').html(game2.pgn())
	    i = history2.length;
	  });*/



	  /*$('#resumePositionBtn2').on('click', function() {
		board2.position(game2.fen());
		$('#movepgn').html(game2.pgn())
	  });*/



	  $('#flipBoardBtn2').on('click', board2.flip)
	  $('#startBtn2').on('click', board2.start)
	  $('#clearBtn2').on('click', board2.clear)

	  $('#get_fenBtn2').on('click',function(){


		var fen_str = game2.fen();
		//console.log(fen_str);
		//document.cookie="fen_str="+fen_str;
		window.location.href="search_fen.php?fenstr="+fen_str;


		});















	  //console.log(game.moves());


	function onDrop (source, target) {
	  // see if the move is legal
	  var move = game2.move({
	    from: source,
	    to: target,
	    promotion: 'q' // NOTE: always promote to a queen for example simplicity
	  })

	  var y;
	  // illegal move
	  if (move === null && source != target) {
      var audio = new Audio('audio/illegal.mp3')
      audio.play();
      return 'snapback'
    }
    if(source != target){
    checkSound();
    }
	  $('#movepgn').html(game2.pgn())
	  $('#fen').html(game2.fen())

	  $.ajax({
        type: 'POST',
        url: "opening.php",
        data: ({fen: game2.fen()}),
        success: function (data) {
            y=data;
		}
    	});
		$('#op').html(y)

	  //updateStatus()
	}



	function onSnapEnd () {
	  board2.position(game2.fen())///for castling
	}




	function checkSound(){
    var done = false;
    if( game2.in_check() ){
      var audio = new Audio('audio/move-check.mp3')
      audio.play();
      done = true;
    }
    if( game2.in_checkmate() || game2.in_draw() || game2.in_stalemate() || game2.in_threefold_repetition() || game2.insufficient_material() ){
      var audio = new Audio('audio/game-end.mp3')
      audio.play();
      done = true;
    }
    k = game2.history().length-1;
    if(game2.history()[k].includes('x')){
      var audio = new Audio('audio/capture.mp3')
      audio.play();
      done=true;
    }
    if(game2.history()[k].includes('=')){
      var audio = new Audio('audio/promote.mp3')
      audio.play();
      done=true;
    }
    if(game2.history()[k].includes('O')){
      var audio = new Audio('audio/castle.mp3')
      audio.play();
      done=true;
    }
    if(done == false && k%2 ==0){
      var audio = new Audio('audio/move-self.mp3')
      audio.play();
    }
    if(done == false && k%2 == 1){
      var audio = new Audio('audio/move-opponent.mp3')
      audio.play();
    }
    done = false;

  }








	/////////////BOARD 3





	// var cfg3 = {
	//   	//boardTheme: chess24_board_theme
	//   	draggable: true,
	//   	dropOffBoard: 'trash',
	//     pieceTheme: 'img/chesspieces/wikipedia/{piece}.png',
	//     //onDrop: onDrop3,
	//     //onSnapEnd: onSnapEnd3,
	//     //position: 'start',
	//     sparePieces: true
	//   };


	//   var board3 = ChessBoard('board3',cfg3);
	//   var game3 = new Chess();
	//   //var history3 = game3.history();
	//   game3.reset();
	//   //var j = 0;

	//   //var y;



	//   /*$('#nextBtn2').on('click', function() {


    // 	game2.move(history2[j]);
	// 	board2.position(game2.fen());
	// 	$('#movepgn').html(game2.pgn())
    // 	j += 1;
    // 	if (j > history2.length) {
    //   	j = history2.length;
    // 	}
  	// 	});


	//   // 4. If Prev button clicked, move backward one
	//     $('#prevBtn2').on('click', function() {
	//     game2.undo();
	// 	board2.position(game2.fen());
	// 	//$('#movepgn').html(game2.pgn())
	//     j -= 1;
	//     if (j < 0) {
	//       j = 0;
	//     }
	//   });



	//   // 5. If Start button clicked, go to start position
	//   $('#startPositionBtn2').on('click', function() {
	//     game2.reset();
	// 	board2.start();
	// 	$('#movepgn').html(game2.pgn())
	//     j = 0;
	//   });



	//   // 6. If End button clicked, go to end position
	//   /*$('#endPositionBtn2').on('click', function() {
	//     game2.load_pgn(pgn_game);
	// 	board2.position(game2.fen());
	// 	$('#movepgn').html(game2.pgn())
	//     i = history2.length;
	//   });*/



	//   /*$('#resumePositionBtn2').on('click', function() {
	// 	board2.position(game2.fen());
	// 	$('#movepgn').html(game2.pgn())
	//   });*/



	//   $('#flipBoardBtn3').on('click', board3.flip)
	//   $('#startBtn3').on('click', board3.start)
	//   $('#clearBtn3').on('click', board3.clear)
	//   $('#get_fenBtn3').on('click',function(){

	//   	var fen_str = board3.fen();
	// 	//console.log(fen_str);
	// 	//document.cookie="fen_str="+fen_str;
	// 	window.location.href="search_fen.php?fenstr="+fen_str;

	//   });















	  //console.log(game.moves());












/*function updateStatus () {
  var status = ''

  var moveColor = 'White'
  if (game1.turn() === 'b') {
    moveColor = 'Black'
  }

  // checkmate?
  if (game1.in_checkmate()) {
    status = 'Game over, ' + moveColor + ' is in checkmate.'
  }

  // draw?
  else if (game1.in_draw()) {
    status = 'Game over, drawn position'
  }

  // game still on
  else {
    status = moveColor + ' to move'

    // check?
    if (game1.in_check()) {
      status += ', ' + moveColor + ' is in check'
    }
  }
  var x = game1.pgn()
  $('#movepgn').html(x)
  }


updateStatus()*/


});


	</script>





</body>
</html>
