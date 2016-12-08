<!--
This PHP script front-ends linkyprints.php with a login page.
Originally created By Ron Coleman.
Revision history: 
Morgan Stippa, Tadd Bindas, Elijah Johnson 11/16/16
RC  07-Nov-13   Created.
-->
<!DOCTYPE html>
<html>
<?php
# Connect to MySQL server and the database
require( 'includes/connect_db.php' ) ;

# Connect to MySQL server and the database
require( 'includes/presidents_login_tools.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {

	$lname = $_POST['lname'] ;

    

    $pid = validate($lname) ;

    if($pid == -1)
      echo '<P style=color:red>Login failed please try again.</P>' ;

    else
      load('linkypresidents.php', $pid);
}
?>
<!-- Get inputs from the user. -->
<h1>Presidents login</h1>
<form action="presidents_login.php" method="POST">
<table>
<tr>
<td>Name:</td><td><input type="text" name="lname"></td>
</tr>
</table>
Remember Me: <input type="checkbox" name="rememberme" value="1">
<br>
<p><input type="submit" ></p>
</form>
</html>