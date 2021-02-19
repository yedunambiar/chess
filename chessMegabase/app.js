$(function() {
	var cfg = {
	  draggable: true,
	  pieceTheme: 'img/chesspieces/wikipedia/{piece}.png',
	  position: 'start'
	};
	var board = ChessBoard('board5', cfg);
	var game = new Chess();



	<?php
		$select_query = "SELECT * FROM chess_moves WHERE game_id = 1";
	  $select_query_result = mysqli_query($con,$select_query) or die(mysqli_error($con));
	  ?>





	// 1. Load a PGN into the game
	let pgn_game,move_no,x;
	move_no=2;

	//pgn_game = '1.f3';
	pgn_game = '';
	<?php while($row = mysqli_fetch_array($select_query_result)){ ?>
	pgn_game = pgn_game + '<?php echo $row['moves']; ?>' + ' ';
	<?php } ?>
		game.load_pgn(pgn_game);
		//$('#pgn5').html(pgn_game);
		

		
	// 2. Get the full move history


	  var history = game.history();
		game.reset();
		var i = 0;
	// 3. If Next button clicked, move forward one
	  $('#nextBtn5').on('click', function() {
	  game.move(history[i]);
	  board.position(game.fen());
	  $('#pgn5').html(game.pgn());
	  i += 1;
	  if (i > history.length) {
		i = history.length;
	  }
		});
	// 4. If Prev button clicked, move backward one
	  $('#prevBtn5').on('click', function() {
	  game.undo();
	  board.position(game.fen());
	  $('#pgn5').html(game.pgn());
	  i -= 1;
	  if (i < 0) {
		i = 0;
	  }
	});
	// 5. If Start button clicked, go to start position
	$('#startPositionBtn5').on('click', function() {
	  game.reset();
	  board.start();
	  $('#pgn5').html(game.pgn());
	  i = 0;
	});
	// 6. If End button clicked, go to end position
	$('#endPositionBtn5').on('click', function() {
	  game.load_pgn(pgn_game);
	  board.position(game.fen());
	  $('#pgn5').html(game.pgn());
	  i = history.length;
	});



	$('#resumePositionBtn5').on('click', function() {
	  board.position(game.fen());
	  $('#pgn5').html(game.pgn())
	});



	$('#flipBoardBtn5').on('click', board.flip);
	$('#startBtn').on('click', board.start);
	$('#clearBtn').on('click', board.clear);




  });

