<!DOCTYPE html>
<html lang="en">
<head>
  <title>Limbo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style> 
input[type=text] {
    width: 130px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    padding: 12px 20px 12px 8px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
    width: 100%;
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
      <a class="navbar-brand" href="index.php">Limbo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="announcements.php">Announcements</a></li>
        <li ><a href="lost.php">Lost</a></li>
        <li><a href="found.php">Found</a></li>
        <li><a href="admin.php">Admin</a></li>
        <li><a href="#" class="active"><span class="glyphicon glyphicon-search">   </span>       Search Database</a></li>  
      </ul>
    </div>
  </div>
</nav>    
<body>
  <div class="container">
    <br>
    <br>
    <br>  
    <br>
    <hr>
    <h2>Lost an item? Search our entire database for it here!</h2>
    <hr>
    <div class="form-group" style="text-align:center">
      <form class="form-group"  action="search.php" method="post">
          <fieldset class="form-group">
            <input type="text" name="search" class="search" placeholder="Search...">
          </fieldset>      
          <input class="btn btn-success" type="submit" style="text-align:center" value="Submit!">
      </form>
    </div>
  
  <?php
    # Connect to MySQL server and the database
    require( 'includes/connect_db.php' );
    # contains helper functions
    require('includes/helpers.php');
    # checks if user is submitting information and one of the fields is empty   
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
      $search = $_POST['search'];
      $errors = array();
      # if else statements check if user inputs the correct information  
      if ( empty( $_POST[ 'search' ] ) )  { 
          $errors[] = 'search'; 
      } else    
          $search = trim( $_POST[ 'search' ] )  ; 

      # will print error message if $errors array is not empty  
      if( !empty( $errors ) ) {
        echo 'You did not search for anything' ;
        # inserts user input into the database if all fields are input
      } else { 
          search_database($dbc, $search);
          # Close the connection
          mysqli_close( $dbc );
      }
    }
      ?>
    </div>
</body>
</html>