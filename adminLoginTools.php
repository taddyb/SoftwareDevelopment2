<?php
  # Includes these helper functions
  require( 'includes/helpers.php' ) ;

  # Loads admin2.php.
  function load( $page = 'admin2.php', $uid = -1) {
    # Begin URL with protocol, domain, and current directory.
    $url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;

    # Remove trailing slashes then append page name to URL and the print id.
    $url = rtrim( $url, '/\\' ) ;
    $url .= '/' . $page . '?id=' . $uid;

    # Execute redirect then quit.
    session_start( );

    header( "Location: $url" ) ;

    exit() ;
  }

  # Validates the admins username.
  # Returns -1 if validate fails, and >= 0 if it succeeds
  # which is the primary key id.
  function validate($name = '', $pass = '') {
    global $dbc;

    if(empty($name))
      return -1 ;
    
     if(empty($pass))
      return -1 ;

    # create a query that selects user_id, username, pass from users where username and pass are equal to what the user input
    $query = 'SELECT user_id, username, pass FROM users WHERE username="' . $name . '" and pass= "' . $pass . '"';

    # Execute the query
    $results = mysqli_query( $dbc, $query ) ;

    # If we get no rows, the login failed
    if (mysqli_num_rows( $results ) == 0 )
      return -1 ;

    # We have at least one row, so get the first one and return it
    $row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;

    $pid = $row [ 'user_id' ] ;

    # returns the integer value of $pid
    return intval($pid) ;
  }
?>