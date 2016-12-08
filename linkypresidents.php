<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Style-Type" content="text/css" /> 
    <title>vipresidents.php</title>
    <link href="/library/skin/tool_base.css" type="text/css" rel="stylesheet" media="all" />
    <link href="/library/skin/morpheus-default/tool.css" type="text/css" rel="stylesheet" media="all" />
    <script type="text/javascript" language="JavaScript" src="/library/js/headscripts.js"></script>
    <style>body { padding: 5px !important; }</style>
  </head>
  <body>
<!--
This PHP script was modified based on result.php in McGrath (2012).
It demonstrates how to ...
  1) Connect to MySQL.
  2) Write a complex query.
  3) Format the results into an HTML table.
  4) Update MySQL with form input.
By Ron Coleman
-->
<!DOCTYPE html>
<html>   
    
<?php
# Connect to MySQL server and the database
require( 'includes/connect_db.php' ) ;
 
# Includes these helper functions
require( 'includes/helpers.php' ) ;
       
 
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    $num = $_POST['number'] ;
 
    $fname = $_POST['fname'] ;
    
    $lname = $_POST['lname'] ;
     $errors = array();
} else if ($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
    if(isset($_GET['id']))
        show_record($dbc, $_GET['id']);
}
 
# Check for a name & email address.
  
if ( empty( $_POST[ 'number' ] ) || !is_numeric($_POST[ 'number' ]) || intval($_POST[ 'number' ]) <= 0)  { 
    $errors[] = 'number' ; 
} else {   
    $num = trim( $_POST[ 'number' ] )  ; 
}
 
  
if ( empty( $_POST[ 'fname' ] )  || is_numeric($_POST[ 'fname' ]) ) { 
    $errors[] = 'fname' ; 
} else { 
    $fname = trim( $_POST[ 'fname' ] )  ; 
}
    
if ( empty( $_POST[ 'lname' ] ) || is_numeric($_POST[ 'lname' ])) { 
    $errors[] = 'lname'; 
} else { 
    $lname = trim( $_POST[ 'lname' ] )  ; 
}    
 
  
# Report result.
  
if( !empty( $errors ) )
  {
    
echo 'Error! Please enter   ' ;
    
foreach ( $errors as $msg ) { echo " - $msg " ; }
  }  
  
else { 
    echo "Success! Thanks " ; 
     $result = insert_record($dbc, $num, $fname, $lname);
}
    
    
/*if(!valid_name($num) && !valid_name($fname) && !valid_name($lname))
    echo '<p style="color:red;font-size:16px;">Please enter number, first name, and last name</p>';
else if (!valid_name($fname))
    echo '<p style="color:red;font-size:16px;">Please complete the first name</p>';
else if (!valid_name($lname))
    echo '<p style="color:red;font-size:16px;">Please complete the last name</p>';
else if (!valid_name($num))
    echo '<p style="color:red;font-size:16px;">Please enter a number</p>';
else 
    $result = insert_record($dbc, $num, $fname, $lname);*/
 
# Show the records
show_link_records($dbc);
   
 
# Close the connection
mysqli_close( $dbc ) ;
?>
 
<!-- Get inputs from the user. -->
<form action="linkypresidents.php" method="POST">
<table>
  <tr>
    <td>Number:</td><td><input type="text" value="<?php if (isset($_POST['number'])) echo $_POST['number']; ?>" name="number"></td>
  </tr>
  <tr>
    <td>First Name:</td><td><input type="text" name="fname" value="<?php if (isset($_POST['fname'])) echo $_POST['lname']; ?>"></td>
  </tr>
  <tr>
    <td>Last Name:</td><td><input type="text" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>" name="lname"></td>
  </tr>    
</table>
<p><input type="submit" ></p>
</form>
</html>
  </body>
</html>
 
