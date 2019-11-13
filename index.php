<?php
# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'User Account' ;

include('head_out.php');

# Open database connection.
require ( 'connect_db.php' ) ;

# Retrieve items from 'shop products' database table.
$q = "SELECT * FROM products" ;
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{
  # Display body section.
  echo '';
  while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
  {
    echo '<div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
				<a href="#"><img class="card-img-top" src='. $row['item_img'].'></a>
				<div class="card-body">
				 <h4 class="card-title">'. $row['item_name'] . '</a></h4>
				 <h5>&pound' . $row['item_price'] . '</h5>
				 <p class="card-text">' . $row['item_desc'] . '</p>
			</div>
            <div class="card-footer">
			  <a href="added.php?id='.$row['item_id'].'">Add To Cart</a></td>
			</div>
		  </div>
		 </div>
		 ';
  }

  
  # Close database connection.
  mysqli_close( $link ) ; 
}
# Or display message.
else { echo '<p>There are currently no items in this shop.</p>' ; }

?>
