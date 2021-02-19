  <!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <!-- <header class="main__header"> -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- <ul style="list-style-type:none;"> -->
                    <a style="float: left; padding-top: 10px; list-style-type:none;" href="index.html"><img src="Logo.png" width='180px' height="60px"></a>
                    <!-- </ul> -->
                </div>
                <div class="menuBar" id="myNavbar">
                    <ul class="menu nav navbar-right">
                        <?php
                            // if(isset($_SESSION['email'])){
                        ?>
                        <li><a href="home.php"><i class="glyphicon glyphicon-home"></i></span> Home</a></li>
                        <li><a href="enter_pgn.php"><i class="glyphicon glyphicon-saved"></i></span> Saved games</a></li>
                        <li><a href="settings.php"><span class="glyphicon glyphicon-cog"></span> Change Password</a></li>
                        <li><a href="about_us.php"><span class="glyphicon glyphicon-info-sign"></span> About Us</a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                        <?php
                            // }
                            // else{
                        ?>
                        <!-- <li><a href="sign_up.php"><span class="glyphicon glyphicon-user"></span> Sign up</a></li>
                        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        <li><a href="about_us.php"><span class="glyphicon glyphicon-info-sign"></span> About Us</a></li> -->
                        <?php
                            // }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    <!-- </header>    -->
    </body>
</html>
