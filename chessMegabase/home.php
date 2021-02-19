<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="style.css">

<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
</head>
<body style="background-color: black;">
  <header class="main__header">
    <!-- <div class="container"> -->
      <?php include"includes/header.php" ?>
    <!-- </div> -->
  </header>

<div class="container">



	<div class="row" style="padding-top: 120px;">
        <div class="col-lg-3" style="padding-top: 20px; ">
            <a href="opening1.php" class="btn btn-sq hv">
              <span class="glyphicon glyphicon-book icon-style"></span><br>
              Openings
            </a>
        </div>
        <div class="col-lg-3" style="padding-top: 20px;">
          <a href="player.php" class="btn btn-sq hv">
            <i class="fa fa-users icon-style"></i><br>
            Players
          </a>
      </div>
      <div class="col-lg-3" style="padding-top: 20px;">
        <a href="position.php" class="btn btn-sq hv">
          <i class="fas fa-chess-knight icon-style"></i><br>
          Positions
        </a>
    </div>
    <div class="col-lg-3" style="padding-top: 20px;">
      <a href="enter_pgn.php?path=0" class="btn btn-sq hv" >
        <i class="fa fa-save icon-style"></i><br>
        Upload Game
      </a>
  </div>
  </div>


</div>
</body>
</html>
