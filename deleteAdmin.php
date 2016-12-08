<?php


    session_start();
        
    if(array_key_exists("id", $_COOKIE))
    {
        $_SESSION['id'] = $_COOKIE['id'];
    }

    if(array_key_exists("id", $_SESSION))
    {
        # Connect to MySQL server and the database
        require( '../includes/connect_db.php' );
        # contains all the functions
        require('../includes/helpers.php');
    echo '<br><br><br>';
        # tests if user is submitting information and if array_key exists
        if (array_key_exists("username", $_POST) AND (array_key_exists("password", $_POST))) {
       		$username = $_POST['username'];
        	$password = $_POST['password'];    
      	    delete_admin($dbc, $username, $password);
        }
    }
    else
    {
        header("Location: ../admin.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Limbo</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  
    <style type="text/css">
            .container{
                text-align: inherit;
           
        }

                html { 
          background: url(images/lost.jpg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
        }

                body{
        
        }
    </style>
</head>
     <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">Limbo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../announcements.php">Announcements</a></li>
        <li><a href="../lost.php">Lost</a></li>
        <li><a href="../found.php">Found</a></li>
        <li><a href="..search.php">Search Database</a></li>  
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
              <li><a href="admin2.php">Admin Home</a></li>
            <li><a href="addAdmin.php">Insert Admin</a></li>
            <li><a href="updateAdmin.php">Update Admin</a></li>
             <li><a href="deleteAdmin.php">Delete Admin</a></li>
              <li class="active"><a href="../admin.php?logout=1"><span class="glyphicon glyphicon-log-out"></span>  Logout</a></li> 
          </ul>
        </li>
        <li><a href="../search.php" class="active"><span class="glyphicon glyphicon-search">   </span>       Search Database</a></li>
      </ul>
    </div>
  </div>
</nav>
<body>
    <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
     <div class="container">
     <h1>Fill out the Fields to Delete an Administrator</h1>
  			<hr>
    		<div class="form-group" style="text-align:center">
    			<form class="form-group"  action="deleteAdmin.php" method="POST">
                <fieldset class="form-group">
    		      <input class="form-control" type="text" name="username" placeholder="Username"><br><br>
                </fieldset>
                <fieldset class="form-group">
		        <input class="form-control" type="text" name="password" placeholder="Password"><br><br>   
                </fieldset>
    			   <input class="btn btn-success" type="submit" value="Submit!" style="text-align:center">
    			</form>
    		</div>
  			<hr>
         <button class="btn btn-info" style="text-align:center"><a href="admin2.php" >Back</a></button>
		  </div>
	  <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
</body>
</html>