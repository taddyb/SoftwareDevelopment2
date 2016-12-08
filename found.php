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
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 914px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;}
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
        <li><a href="lost.php">Lost</a></li>
        <li class="active"><a href="#">Found</a></li>
        <li><a href="admin.php">Admin</a></li>
        <li><a href="search.php" class="active"><span class="glyphicon glyphicon-search">   </span>       Search Database</a></li>   
      </ul>
    </div>
  </div>
</nav>    
<body>
    <div class="container">
        <br>
        <br>
        <br>
        <h1>Found Items</h1>
        <hr>
        <h2>Found an item? Add it here!</h2>
        <hr>
        <div class="form-group" style="text-align:center">
            <form class="form-group"  action="found.php" method="post">
              <fieldset class="form-group">
                <input class="form-control" type="text" name="finder" placeholder="Your Name"><br><br>
              </fieldset>
              <fieldset class="form-group">
                <input class="form-control" type="text" name="description" placeholder="Item Description"><br><br> 
              </fieldset>
              <fieldset class="form-group">
                <input class="form-control" type="text" name="building" placeholder="Building Found In"><br><br>
              </fieldset>
              <fieldset class="form-group">
                <input class="form-control" type="text" name="room" placeholder="Room Found in"><br><br>
              </fieldset>      
              <input class="btn btn-success" type="submit" style="text-align:center" value="Submit!">
            </form>
        </div>  
    </div> 

      <?php
        # Connect to MySQL server and the database
        require( 'includes/connect_db.php' );
        #contains helper functions
        require('includes/helpers.php');
        # checks if user is submitting information and one of the fields is not empty    
        if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
          $finder = $_POST['finder'];
          $description = $_POST['description'];    
          $building = $_POST['building'];
          $room = $_POST['room'];
          $errors = array();
          $found = 'found';  
            
          # if else statements check if user inputs the correct information       
          if ( empty( $_POST[ 'room' ] ) || !is_numeric($_POST[ 'room' ]) || intval($_POST[ 'room' ]) <= 0)  { 
            $errors[] = 'Room' ; 
          } else    
              $room = trim( $_POST[ 'room' ] )  ; 

          if ( empty( $_POST[ 'finder' ] )  || is_numeric($_POST[ 'finder' ]) ) { 
            $errors[] = 'Name' ; 
          } else  
              $finder = trim( $_POST[ 'finder' ] )  ; 

          if ( empty( $_POST[ 'description' ] ) || is_numeric($_POST[ 'description' ])) { 
            $errors[] = 'Item Description'; 
          } else 
              $description = trim( $_POST[ 'description' ] ); 
          
           if ( empty( $_POST[ 'building' ] ) || is_numeric($_POST[ 'building' ])) { 
            $errors[] = 'Building'; 
          } else 
              $building = trim( $_POST[ 'building' ] ); 

          # will print error message if $errors array is not empty
          if( !empty( $errors ) ) {  
            echo 'Invalid   ' ;  
            foreach ( $errors as $msg ) { echo " $msg, " ; }
            # inserts user input into the database if all fields are input
          } else { 
              insert_record($dbc, $finder, $description, $building, $room, $found);
              # Close the connection
              mysqli_close( $dbc );
          }
        } else if ($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
            if(isset($_GET['id']))
                display_lost_found_item($dbc, $_GET['id'], "found");
               
        }      
       
      ?>
    </div>
  </div>      

</body>
</html>