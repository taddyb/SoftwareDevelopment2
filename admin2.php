<?php
    session_start();
        
    if(array_key_exists("id", $_COOKIE))
    {
        $_SESSION['id'] = $_COOKIE['id'];
    }

    if(array_key_exists("id", $_SESSION))
    {
        //nothing
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
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<style type="text/css">
            .container{
            text-align: center;
            padding-left: 40px !important;
                padding-right: 40px !important;
                padding: 20px;
                background-color: white;
                border-radius: 25px;
        }

                html { 
          background: url(../images/found.jpg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
        }

                body{
        background: none;
        }
    </style>
</head>
<body style="background: none">
     <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="../index.php">Limbo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../announcements.php">Announcements</a></li>
        <li><a href="../lost,php">Lost</a></li>
        <li><a href="../found.php">Found</a></li>
        <li class="dropdown active">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
              <li><a href="admin2.php">Admin Home</a></li>
            <li><a href="addAdmin.php">Insert Admin</a></li>
            <li><a href="updateAdmin.php">Update Admin</a></li>
             <li><a href="deleteAdmin.php">Delete Admin</a></li>
              <li><a href="../admin.php?logout=1"><span class="glyphicon glyphicon-log-out"></span>  Logout</a></li> 
          </ul>
        </li>
        <li><a href="../search.php" class="active"><span class="glyphicon glyphicon-search">   </span>       Search Database</a></li> 
      </ul>
    </div>
  </div>
</nav>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        
        <div class="row content">
            
            <div>
                
                <h2>Admin Page</h2>
                <hr>
                <h4>Here is the full table of items. More Administrator functions are under the admin tab in the navbar.</h4>
                
            </div>
            <?php
                    require( '../includes/connect_db.php' );
                    # contains helper functions
                    require('../includes/helpers.php');
                    show_limbo_records_admin($dbc);  
            ?>  
    </div>
    </div>	
   
</body>
</html>