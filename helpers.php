<?php
$debug = true;
 
# function inserts item into stuff table in the limbo database
# takes user input as arguments
function insert_record($dbc, $finder, $description, $building, $room, $lost_found = '') {
  # create a query to select id where name in locations is equal to the building the user entered
  $location_query = 'SELECT id FROM locations where locations.name = "'. $building .'"';
  # execute the query
  $location_results = mysqli_query( $dbc , $location_query );
  # test to if what user entered is in the database    
  if ((mysqli_num_rows( $location_results ) == 0)) {    
       echo 'That is not a location on Campus';
  } else { 
      # fetch the results of the query and put them in an array
      $location_id = mysqli_fetch_array( $location_results , MYSQLI_ASSOC );
      if ($lost_found == "lost") {
        # create an insert query  
        $query = 'INSERT INTO stuff(location_id, description, create_date,update_date, room, owner, finder, status) VALUES ( '.$location_id['id'].'  , "' . $description . '" , now(),  now(),  ' . $room . ',  "none",  "none", "lost")' ; 
        # execute the query
        $results = mysqli_query($dbc,$query);
        # show the stuff stable
        if ($results) 
            display_lost_found_items($dbc, "lost");
        else
            echo '<p>' . mysqli_error( $dbc ) . '</p>' ;
      } else {
             # create an insert query
            $query = 'INSERT INTO stuff(location_id, description, create_date,update_date, room, owner, finder, status) VALUES ( '.$location_id['id'].'  , "' . $description . '" , now(),  now(),  ' . $room . ',  "none",  "'.$finder.'", "found")' ; 
            # execute the query
            $results = mysqli_query($dbc,$query);
            # show the stuff stable
            if ($results) 
                display_lost_found_items($dbc, "found");
            else
                echo '<p>' . mysqli_error( $dbc ) . '</p>' ;
     }
  }

}

# Shows the all the records from stuff table in limbo database
function show_limbo_records($dbc) {
	# Create a query to get all columns from stuff ordered by the date it was created
	$query = 'SELECT * FROM stuff ORDER BY create_date DESC' ;
 
	# Execute the query
	$results = mysqli_query( $dbc , $query );
 
    # tests if the query was successfull  
    if( $results )
    {
      echo '<H1>Stuff</H1>' ;
      echo '<TABLE border="1">';
      echo '<TR>';
      echo '<TH>id</TH>';
      echo '<TH>location_id</TH>';
      echo '<TH>description</TH>';
      echo '<TH>create_date</TH>';
      echo '<TH>update_date</TH>';
      echo '<TH>room</TH>';
      echo '<TH>owner</TH>';
      echo '<TH>finder</TH>';
      echo '<TH>status</TH>';
      echo '</TR>';
 
      # For each row result, generate a table row
      # look up column name in the array
      while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
      {
        echo '<TR border: 1px solid black;>' ;
        echo '<TD>' . $row['id'] . '</TD>' ;
        echo '<TD>' . $row['location_id'] . '</TD>' ;
        echo '<TD>' . $row['description'] . '</TD>' ;
        echo '<TD>' . $row['create_date'] . '</TD>' ;
        echo '<TD>' . $row['update_date'] . '</TD>' ;
        echo '<TD>' . $row['room'] . '</TD>' ;
        echo '<TD>' . $row['owner'] . '</TD>' ;
        echo '<TD>' . $row['finder'] . '</TD>' ;
        echo '<TD>' . $row['status'] . '</TD>' ;  
        echo '</TR>' ;
      }
 
      # End the table
      echo '</TABLE>';
 
      # Free up the results in memory
      mysqli_free_result( $results ) ;
    }
    # error gets printed if query to database failed
    else
      echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
}


# function lets an admin user update a record in the stuff table
function update_limbo($dbc, $id) {
  # create a query to select everything from stuff where id is equal to the id the user selected
  $query = 'SELECT * from stuff WHERE id= ' . $id ;
	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
  
  # tests if query was successful  
  if($results) {
    # generate a input box for each row  
    if ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC )) {
      echo  '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
      echo'<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';
      echo'<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';

      echo '<form action="updateData.php" method="post">';
      echo '  <fieldset class="form-group">';
      echo '<input type="hidden" value='.$row['id']. ' name="id">';
      echo '  </fieldset>';
      echo '<p>';
        echo '  <fieldset class="form-group">';
      echo '<label for="location_id">Location ID: </label>';
      echo '<input class="form-control" type="int" name ="location_id" id="location_id" value='.$row['location_id']. '>';
        echo '  </fieldset>';
      echo '</p>';
      echo '<p>';
    echo '  <fieldset class="form-group">';
      echo '<label for="decription">Description:     </label>';
      echo '<input class="form-control" type="text" name ="description" id="description" value='.$row['description']. '>';
      echo '  </fieldset>';
        echo '</p>';
      echo '<p>';
        echo '  <fieldset class="form-group">';
      echo '<label for="room">Room:     </label>';
      echo '<input class="form-control" type="text" name ="room" id="room" value='.$row['room']. '>';
      echo '  </fieldset>';
        echo '</p>';
      echo '<p>';
    echo '  <fieldset class="form-group">';
      echo '<label for="owner">Owner:    </label>';
      echo '<input class="form-control" type="text" name ="owner" id="owner" value='.$row['owner']. '>';
      echo '  </fieldset>';
        echo '</p>';
      echo '<p>';
        echo '  <fieldset class="form-group">';
      echo '<label for="finder">Finder:    </label>';
      echo '<input class="form-control" type="text" name ="finder" id="finder" value='.$row['finder']. '>';
      echo '  </fieldset>';
        echo '</p>';
      echo '<p>';
        echo '  <fieldset class="form-group">';
      echo '<label for="status">Status:    </label>';
      echo '<input class="form-control" type="text" name ="status" id="status" value='.$row['status']. '>';
      echo '  </fieldset>';
        echo '</p>';
      echo '<input class="btn btn-success" input type="submit" value="Submit">';
      echo '</form>';
      
      # Free up the results in memory
      mysqli_free_result( $results ) ;
    } 

  # prints error if query fails
  } else
    echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
}


function update_admin($dbc, $id) {
    # create a query to select everything from users where id is equal to the id the user selected
    $query = 'SELECT * from users WHERE user_id = ' . $id ;
    # Execute the query
	$results = mysqli_query( $dbc , $query ) ;
  
  # tests if query was successful  
  if($results) {
    # generate a input box for each row  
    if ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC )) {
      echo  '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
      echo'<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';
      echo'<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';

      echo '<form action="updateAdminData.php" method="post">';
      echo '  <fieldset class="form-group">';
      echo '<input class="form-control" input type="hidden" value='.$row['user_id']. ' name="user_id">';
      echo '  </fieldset>';
      echo '<p>';
      echo '  <fieldset class="form-group">';
      echo '<label for="username">Username: </label>';
      echo '<input class="form-control" input type="text" name ="username" id="username" value='.$row['username']. '>';
      echo '  </fieldset>';
      echo '</p>';
      echo '<p>';
      echo '  <fieldset class="form-group">';
      echo '<label for="first_name">First Name: </label>';
      echo '<input class="form-control" input type="text" name ="first_name" id="first_name" value='.$row['first_name']. '>';
      echo '  </fieldset>';
      echo '</p>';
      echo '<p>';
      echo '  <fieldset class="form-group">';
      echo '<label for="last_name">Last Name: </label>';
      echo '<input class="form-control" input type="text" name ="last_name" id="last_name" value='.$row['last_name']. '>';
      echo '  </fieldset>';
      echo '</p>';
      echo '<p>';
      echo '  <fieldset class="form-group">';
      echo '<label for="email">Email: </label>';
      echo '<input class="form-control" input type="text" name ="email" id="email" value='.$row['email']. '>';
      echo '  </fieldset>';
      echo '</p>';
      echo '<p>';
      echo '  <fieldset class="form-group">';
      echo '<label for="pass">Password (once saved it will be hashed): </label>';
      echo '<input class="form-control" input type="text" name ="pass" id="pass" value='.$row['pass']. '>';
      echo '  </fieldset>';
      echo '</p>';
      echo '<input class="btn btn-success" type="submit" value="submit">';
      echo '</form>';
      
      # Free up the results in memory
      mysqli_free_result( $results ) ;
    } 

  # prints error if query fails
  } else
    echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
}

# displays all columns for a single record
function show_limbo_record($dbc, $id) {
	# Create a query to select all columns from stuff where id is equal to the one clicked on by user
	$query = 'SELECT * FROM stuff WHERE id = ' . $id;
 
	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
    
    # tests if query was successful  
    if( $results ) {
      echo '<H1>Stuff</H1>' ;
      echo '<TABLE border="1">';
      echo '<TR>';
      echo '<TH>id</TH>';
      echo '<TH>location_id</TH>';
      echo '<TH>description</TH>';
      echo '<TH>create_date</TH>';
      echo '<TH>update_date</TH>';
      echo '<TH>room</TH>';
      echo '<TH>owner</TH>';
      echo '<TH>finder</TH>';
      echo '<TH>status</TH>';
      echo '</TR>';
 
      # For each row result, generate a table row
      while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
      {
        echo '<TR border: 1px solid black;>' ;
        echo '<TD>' . $row['id'] . '</TD>' ;
        echo '<TD>' . $row['location_id'] . '</TD>' ;
        echo '<TD>' . $row['description'] . '</TD>' ;
        echo '<TD>' . $row['create_date'] . '</TD>' ;
        echo '<TD>' . $row['update_date'] . '</TD>' ;
        echo '<TD>' . $row['room'] . '</TD>' ;
        echo '<TD>' . $row['owner'] . '</TD>' ;
        echo '<TD>' . $row['finder'] . '</TD>' ;
        echo '<TD>' . $row['status'] . '</TD>' ;  
        echo '</TR>' ;
      }
 
      # End the table
      echo '</TABLE>';
 
      # Free up the results in memory
      mysqli_free_result( $results ) ;
    }
    # displays an error message if query failed
    else
      echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
}

# displays all the rows from the stuff table
function show_limbo_records_admin($dbc) {
	# Create a query to select all columns from the stuff table
	$query = 'SELECT * FROM stuff ORDER BY create_date DESC' ;
	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
 
  # tests if the query was successful  
  if( $results ) {
       echo  '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
      echo'<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';
      echo'<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';
      
  
    echo '<H1>Stuff</H1>' ;
    echo '<TABLE style="text-align:center" cellpadding="10" class="table table-hover table-bordered">';
    echo '<TR class ="table-active">';
    echo '<TH>id</TH>';
    echo '<TH>location_id</TH>';
    echo '<TH>description</TH>';
    echo '<TH>create_date</TH>';
    echo '<TH>update_date</TH>';
    echo '<TH>room</TH>';
    echo '<TH>owner</TH>';
    echo '<TH>finder</TH>';
    echo '<TH>status</TH>';
    echo '<TH>edit</TH>';
    echo '<TH>delete row?</TH>';
    echo '</TR>';

    # For each row result, generate a table row
    while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ) {
      echo '<TR>' ;
      echo '<TD>' . $row['id'] . '</A></TD>' ;
      echo '<TD>' . $row['location_id'] . '</TD>' ;
      echo '<TD>' . $row['description'] . '</TD>' ;
      echo '<TD>' . $row['create_date'] . '</TD>' ;
      echo '<TD>' . $row['update_date'] . '</TD>' ;
      echo '<TD>' . $row['room'] . '</TD>' ;
      echo '<TD>' . $row['owner'] . '</TD>' ;
      echo '<TD>' . $row['finder'] . '</TD>' ;
      echo '<TD>' . $row['status'] . '</TD>' ; 
      echo'<TD style ="text-align:center"><A HREF=updateLimboRow.php?id=' . $row['id'] . '>Edit</A></TD>';
      echo'<TD style ="text-align:center"><A HREF=deleteLimboRow.php?id=' . $row['id'] . '>X</A></TD>';
      echo '</TR>' ;
    }

    # End the table
    echo '</TABLE>';
      echo '</div>';
    # Free up the results in memory
    mysqli_free_result( $results ) ;
  }
  # displays an error if query fails
  else
    echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
}

# displays all the rows from the user table
function show_admin_records($dbc) {
	# Create a query to select all columns from the users table
	$query = 'SELECT * FROM users ORDER BY reg_date DESC';
	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
 
  # tests if the query was successful  
  if( $results ) {
     echo  '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
      echo'<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';
      echo'<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>'; 
    echo '<div class ="container">';
    echo '<TABLE style="text-align:center" cellpadding="10" class="table table-hover table-bordered">';
    echo '<TR class ="table-active">';
    echo '<TH>user_id</TH>';
    echo '<TH>username</TH>';
    echo '<TH>first_name</TH>';
    echo '<TH>last_name</TH>';
    echo '<TH>email</TH>';
    echo '<TH>Password</TH>';
    echo '<TH>Register Date</TH>';
    echo '</TR>';

    # For each row result, generate a table row
    while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ) {
      echo '<TR>' ;
      echo '<TD><A HREF=editAdmin.php?id=' . $row['user_id'] . '>' . $row['user_id'] . '</A></TD>' ;
      echo '<TD>' . $row['username'] . '</TD>' ;
      echo '<TD>' . $row['first_name'] . '</TD>' ;
      echo '<TD>' . $row['last_name'] . '</TD>' ;
      echo '<TD>' . $row['email'] . '</TD>' ;
      echo '<TD>' . $row['pass'] . '</TD>' ;
      echo '<TD>' . $row['reg_date'] . '</TD>' ;
      echo '</TR>' ;
    }

    # End the table
    echo '</TABLE>';
      echo '</div>';

    # Free up the results in memory
    mysqli_free_result( $results ) ;
  }
  # displays an error if query fails
  else
    echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
}



# function adds an admin to the database    
function add_admin($dbc, $fname, $lname, $email, $username, $password) {
  # create a query that inserts pass, username, first_name, last_name, email, and reg_date into users table
  $insert_query = 'INSERT INTO users(username, first_name, last_name, email, pass, reg_date) VALUES("' .  stripslashes(mysqli_real_escape_string($dbc, $username)) . '", "' . stripslashes(mysqli_real_escape_string($dbc, $fname)) . '", "' . stripslashes(mysqli_real_escape_string($dbc, $lname)) . '", "' . stripslashes(mysqli_real_escape_string($dbc, $email)) . '", "' . md5(stripslashes(mysqli_real_escape_string($dbc, $password))). '", now());';
  # execute the query
  $insert_results = mysqli_query( $dbc , $insert_query);
  # tests if query was successful
  if ($insert_results) {
    echo  '<div style="text-align:center"> <label>' . $fname . ' successfully added </label></div>';
  } else 
      echo  '<div style="text-align:center"><label> Admin not added</label></div>';
}
 
# displays lost and found items 
function display_lost_found_items($dbc, $status='') {
    # Create a query to get all columns from stuff ordered by the date it was created
        $query = 'SELECT * FROM stuff where status = "'.$status.'" ORDER BY create_date DESC' ;

        # Execute the query
        $results = mysqli_query( $dbc , $query );

    # tests if the query was successfull
    if( $results )
    {
      echo  '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
      echo'<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';
      echo'<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';
      echo '<div class="container">';
      echo '<TABLE style="text-align:center" cellpadding="1" class="table table-bordered">';
      echo '<TR class="table-active>';
      echo '<H1>'.$status.' items</H1>' ;
      echo '<TABLE border="1" align="center">';
      echo '<TR>';
      echo '<TH></TH>';
      echo '<TH>description</TH>';
      echo '</TR>';

      # For each row result, generate a table row
      # look up column name in the array
      while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
      {
        if ($status == "lost") {
            $alink = '<A HREF=lost.php?id=' . $row['id'] . '>See more information</A>' ;
            echo '<TR border: 1px solid black;>' ;
            echo '<TD style="text-align:center">'.$alink.'</TD>';
            echo '<TD> '. $row['description'] . '</TD>' ;
            echo '</TR>' ;
        } else {
            $alink = '<A HREF=found.php?id=' . $row['id'] . '>See more information</A>' ;
            echo '<TR border: 1px solid black;>' ;
            echo '<TD>'.$alink.'</TD>';
            echo '<TD> '. $row['description'] . '</TD>' ;
            echo '</TR>' ;
        }
      }

      # End the table
      echo '</TABLE>';
      echo '</div>';
      # Free up the results in memory
      mysqli_free_result( $results ) ;
    }
    # error gets printed if query to database failed
    else
      echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
}

# displays one lost or found item
function display_lost_found_item($dbc, $id, $status='') {
   # Create a query to get all columns from stuff ordered by the date it was created
        $query = 'SELECT * FROM stuff where id = '.$id;

        # Execute the query
        $results = mysqli_query( $dbc , $query );

    echo '<br><br><br>';

    # tests if the query was successfull
    if( $results )
    {
      echo  '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
      echo'<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';
      echo'<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';
      echo '<div class="container">';
      echo '<TABLE style="text-align:center" cellpadding="1" class="table table-bordered">';
      echo '<TR class="table-active>';
      echo '<H1>'.$status.' items</H1>' ;
      echo '<TABLE border="1" align="center">';
      echo '<TR>';
      echo '<TH>Description</TH>';
      echo '<TH>Date Created</TH>';
      echo '<TH>Date Updated</TH>'; 
      echo '<TH>Status</TH>';
      echo '</TR>';

      # For each row result, generate a table row
      # look up column name in the array
      while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
      {
        echo '<TR border: 1px solid black;>' ;
        echo '<TD>' . $row['description'] . '</TD>' ;
        echo '<TD>' . $row['create_date'] . '</TD>' ;
        echo '<TD>' . $row['update_date'] . '</TD>' ; 
        echo '<TD>' . $row['status'] . '</TD>';
        echo '</TR>' ;
      }

      # End the table
      echo '</TABLE>';
      echo '</div>';     
      if ($status == "found")
        display_lost_found_items($dbc, "found");
      else
        display_lost_found_items($dbc,"lost");

      # Free up the results in memory
      mysqli_free_result( $results ) ;
    }
    # error gets printed if query to database failed
    else
      echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
}

# deletes an admin from the database
function delete_admin($dbc, $username, $password) {       
  # create a query that selects username and pass from users table that are equal to the ones the user input
  $select_query = 'Select username, pass from users where username = "' . $username . '" and pass = "' . md5($password) .'"; ';
  # execute the query
    $row = mysqli_fetch_array(mysqli_query($dbc, $select_query));
  # tests if query was successful
  if (isset($row)) {
    # tests if there is a username and password that are equal to the ones the user input
    if ($username == $row['username'] && md5($password) == $row['pass']) {
      # create a query that delets a record from the users table
      $delete_query = 'DELETE from users where username = "' . $username . '"';
      # execute the query
      $delete_admin = mysqli_query($dbc, $delete_query);
      # tests if the query was successful
      if ($delete_admin) {
        echo  '<div style="text-align:center"> <label>' . $username . ' successfully deleted </label></div>';      
      } else 
            echo  '<div style="text-align:center"><label>Username and/or password do not exist</label></div>';
      # displays a message if there are no matching username and password      
    } else 
      echo  '<div style="text-align:center"><label>Username and/or password do not exist</label></div>';
  }
}

# searches the database for an item
 function search_database($dbc, $item) {
    #create a select query
    $select_query = 'Select * from stuff where description LIKE "%'.$item.'%"';
    # execute the query
    $results = mysqli_query($dbc, $select_query);

    if ((mysqli_num_rows( $results ) == 0))
       echo 'Sorry, could not find an item';
    else {
       echo  '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
      echo'<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';
      echo'<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';
      echo '<div class="container">';
      echo '<TABLE style="text-align:center" cellpadding="1" class="table table-bordered">';
      echo '<TR class="table-active>';
      echo '<TABLE border="1" align="center">';
      echo '<TR>';
      echo '<TH>Description</TH>';
      echo '<TH>Added to the database</TH>';
      echo '</TR>';

      # For each row result, generate a table row
      # look up column name in the array
      while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
      {
              echo '<TR>' ;
              echo '<TD>' . $row['description'] . '</TD>' ;
              echo '<TD>' . $row['create_date'] . '</TD>' ;
              echo '</TR>' ;
      }

      # End the table
      echo '</TABLE>';
      echo '</div>';
      # Free up the results in memory
      mysqli_free_result( $results ) ;
     

    }
 }

?>

 
