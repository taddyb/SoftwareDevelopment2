
      <?php

    session_start();
        
    if(array_key_exists("id", $_COOKIE))
    {
        $_SESSION['id'] = $_COOKIE['id'];
    }

    if(array_key_exists("id", $_SESSION))
    {
       $debug = true;
        # connect to the MySql server    
        require( '../includes/connect_db.php' );
        # contains helper functions
        require( '../includes/helpers.php');
        
        # tests if user is posting information   
        if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
          $locationId = $_POST['location_id'] ;
          $descrip = $_POST['description'] ;
          $room = $_POST['room'] ;
          $owner = $_POST['owner'] ;
          $finder = $_POST['finder'] ;
          $status = $_POST['status'] ;
          $id = $_POST['id'];
          $vars = array($locationId, $descrip, $room, $owner, $finder, $status, $id);
        
          # create a query that updates the stuff table
          $query = 'update stuff set location_id ="' . $vars[0] . '", description="' . $vars[1] . '", room="' . $vars[2] . '", owner="' . $vars[3] . '", finder="' . $vars[4] . '", status="' . $vars[5] . '" where id=' . $vars[6];
          # execute the query
          $results = mysqli_query( $dbc , $query ) ;
          # show the query
          header("Location: admin2.php");

        }

      # Close the connection
        mysqli_close( $dbc ) ; 
    }
    else
    {
        header("Location: ../admin.php");
    }
        
      ?>