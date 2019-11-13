<?php
# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Reservation' ;
include ( 'includes/head_cart.php' ) ;

# Open database connection.
require ( 'connect_db.php' ) ;

    $order_id=$_GET['order_id'];
    // sql to delete a record
    $sql = "DELETE FROM orders WHERE order_id='".$order_id."'";
 if ($link->query($sql) === TRUE) {
       header("Location: orders.php");
    } else {
        echo "Error deleting record: " . $link->error;
    }



mysqli_close($link);
?>
