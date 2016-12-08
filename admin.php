<?php

session_start();
include('includes/connect_db.php');
    $error = "";    

    if (array_key_exists("logout", $_GET)) {
        
        unset($_SESSION);
        session_destroy();
        setcookie("id", "", time() - 60*60);
        $_COOKIE["id"] = ""; 
        header("Location: index.php");
        
    } else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id']))
    {
        
        header("Location: admin/admin2.php");
    }
 
    if(array_key_exists("submit", $_POST))
    {
       
        
        if(!$_POST['username'])
        {
            $error .= "A username is required!";
        }
        if(!$_POST['password'])
        {
            $error .= "A password is required!";
        }
        if($error != "")
        {
            $error = "<p>There were error(s) in your log-in attempt:  </p>".$error;
        }
        else
        {
            $temp = md5($_POST['password']);
            $query = "select user_id, username, pass from users where username='".stripslashes(mysqli_real_escape_string($dbc, $_POST['username']))."' and pass='".stripslashes(mysqli_real_escape_string($dbc, $temp))."';";
            
            $result = mysqli_query($dbc, $query);
            
            $row = mysqli_fetch_array($result);
            
            if(isset($row))
            {
                
               

                    $_SESSION['id'] = md5($row['username']);

                    if (isset($_POST['stayLoggedIn']))
                    {
                        if($_POST['stayLoggedIn'] == 1)
                           {
                             setcookie('id', md5($row['username']), time() + 60*60*24*365);
                           }
                        

                    } 
                    
               
               header("Location: /admin/admin2.php");
                
                
            }
            else
            {
                $error= "Incorrect username/password";
            }
        }
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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   
    
  
    <style type="text/css">
            .container{
            text-align: center;
            width: 400px;
        }

                html { 
          background: url(images/lost.jpg) no-repeat center center fixed; 
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
    <nav class="navbar navbar-default navbar-fixed-top">
  <div>
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
          <li class="active"><a href="admin.php">Admin</a></li>
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
      <br>
      <br>
      <br>
      <h1>Admin Login</h1>
      <br>
      <br>
      
            <div id="error"><?php echo $error; ?></div>
            <form method ="POST">
                
               <fieldset class="form-group">
                 <input class="form-control" type="text" name="username" placeholder="Username"><br>
                </fieldset>
                
                <fieldset class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Password"><br>
                </fieldset>
                <br>
                <br>
                <br>
               <div class="checkbox">
                   <label>
                       <input class="checkbox" type="checkbox" name="stayLoggedIn" value=1> Stay Logged In
                   </label>
                </div>
                
                <br>
                <fieldset class="form-group">
                    <input class="btn btn-success" type="submit" name="submit" value="Log In!">
                </fieldset>

            </form>
    </div>

  </body>


    

</html>