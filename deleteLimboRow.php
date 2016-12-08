      <?php

        session_start();

        if(array_key_exists("id", $_COOKIE))
        {
            $_SESSION['id'] = $_COOKIE['id'];
        }

        if(array_key_exists("id", $_SESSION))
        {
            $debug = true; 
            # connect to the mysql server
            require( '../includes/connect_db.php' );
            # contains helper functions
            require( '../includes/helpers.php');

            # tests if user is posting information      
            if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
              $descrip = $_POST['description'];
              $room = $_POST['room'];
              $owner = $_POST['owner'];
              $status = $_POST['status'];
              $errors = array();
              # tests if user is getting information
            } else if ($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
                 if (array_key_exists("id", $_GET)) {
                     # create a query that deletes a record from the stuff table where id is equal to the one the user selected
                    $_GET['id'];
                    $query = 'delete from stuff where id =' . $_GET['id'] . ';';
                    # Execute the query
                    $results = mysqli_query( $dbc , $query ) ;
                    # show the record
                    header("Location: admin2.php");   
                }

       
            }

       
        # Close the connection
        mysqli_close( $dbc ) ; 
        }
        else
        {
            header("Location: ../admin.php");
        }
        
      ?>