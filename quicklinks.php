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
<body>
  <div class="container-fluid">
    <div class="row content">
      <div class="col-sm-3 sidenav">
        <ul class="nav nav-pills nav-stacked">
          <li style="font-size:150%"><a href="index.php">Limbo Landing Page</a></li>
          <li><a href="lost.php">Lost</a></li>
          <li><a href="found.php">Found</a></li>
          <li><a href="admin.php">Admin</a></li>
          <li class="active"><a href="quicklinks.php">Quick Links</a></li>
        </ul><br>
      </div> 
      <div class="col-sm-9">
        <hr>
        <h2>Quick Links to the table </h2>
        <p>The Quick Links page's purpose is to show the first few items that are in the database.</p>
        <br><br>
        <hr>
        <img src="puppy.jpg">
        <hr>
        <?php
          $debug = true;
          # Connect to MySQL server and the database
          require( 'includes/connect_db.php' ) ;
          # create a query 
  	      $query = 'SELECT id, description, room, owner, status FROM stuff';
        	# Execute the query
        	$results = mysqli_query( $dbc , $query ) ;
          # passes if query was succesful         
          if( $results ) {
            echo '<H1>A Quick List of Items</H1>' ;
            echo '<TABLE border="1">';
            echo '<TR>';
            echo '<TH>id</TH>';
            echo '<TH>description</TH>';
            echo '<TH>room</TH>';
            echo '<TH>owner</TH>';
            echo '<TH>status</TH>'; 
            echo '</TR>';
       
            # For each row result, generate a table row
            while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ) {
              # alink is a link to the quicklinks2 page
              $alink = '<A HREF=quicklinks2.php?id=' . $row['id'] . '>' . $row['id'] . '</A>' ;
              echo '<TR border: 1px solid black;>' ;
              echo '<TD ALIGN=right>' . $alink . '</TD>' ;
              echo '<TD>' . $row['description'] . '</TD>' ;
              echo '<TD>' . $row['room'] . '</TD>' ;
              echo '<TD>' . $row['owner'] . '</TD>' ;
              echo '<TD>' . $row['status'] . '</TD>' ;
              echo '</TR>' ;             
            }
       
            # End the table
            echo '</TABLE>';
       
            # Free up the results in memory
            mysqli_free_result( $results ) ;

            # displays an error message if query fails
          } else {
            echo '<p>' . mysqli_error( $dbc ) . '</p>' ; 
          }
        ?>    
      </div>
    </div>
  </div>
  <footer class="container-fluid">
    <p>This site was created by Taddyb,MoMan, and Eli</p>
  </footer>
</body>
</html>