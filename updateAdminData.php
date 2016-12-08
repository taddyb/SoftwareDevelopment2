
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
          $username = $_POST['username'] ;
          $first_name = $_POST['first_name'] ; 
          $last_name = $_POST['last_name'] ;
          $email = $_POST['email'];
          $pass = $_POST['pass'];
          $user_id = $_POST['user_id'];    
          $vars = array($username, $first_name, $last_name, $email, $pass, $user_id);
          
            
          # create a query that updates the user table
          $query = 'update users set username ="' . $vars[0] . '", first_name="' . $vars[1] . '", last_name="' . $vars[2] . '", email="' . $vars[3] . '", pass="' . md5($vars[4]) . '" where user_id= '.$vars[5];
          # execute the query
          $results = mysqli_query( $dbc , $query );
          if ($results) {    
            header("Location: updateAdmin.php");
          } else
               echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
        }
        }
        else
        {
            header("Location: ../admin.php");
        }

        ?>
