<?php # DISPLAY SHOPPING CART PAGE.
# Access session.
session_start() ;
# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Cart' ;
include('head_out.php');


# Check if form has been submitted for update.
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
  # Update changed quantity field values.
  foreach ( $_POST['qty'] as $item_id => $item_qty )
  {
    # Ensure values are integers.
    $id = (int) $item_id;
    $qty = (int) $item_qty;

    # Change quantity or delete if zero.
    if ( $qty == 0 ) { unset ($_SESSION['cart'][$id]); } 
    elseif ( $qty > 0 ) { $_SESSION['cart'][$id]['quantity'] = $qty; }
  }
}

# Initialize grand total variable.
$total = 0; 

# Display the cart if not empty.
if (!empty($_SESSION['cart']))
{
  # Connect to the database.
  require ('connect_db.php');
  
  # Retrieve all items in the cart from the 'products' database table.
  $q = "SELECT * FROM products WHERE item_id IN (";
  foreach ($_SESSION['cart'] as $id => $value) { $q .= $id . ','; }
  $q = substr( $q, 0, -1 ) . ') ORDER BY item_id ASC';
  $r = mysqli_query ($link, $q);

  # Display body section with a form and a table.
  echo '<div class="container">
		
			<p>Your Order <a href="index.php"> Continue Shopping ></a></p>
				<table class="table">
				<form action="cart.php" method="post">
				<thead>
				<tr>
				<th>Item</th>
				<th></th>
				<th>Description</th>
				<th>Quantity</th>
				<th>Total</th>
				</thead>
				<tbody>';
  while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC))
  {
    # Calculate sub-totals and grand total.
    $subtotal = $_SESSION['cart'][$row['item_id']]['quantity'] * $_SESSION['cart'][$row['item_id']]['price'];
    $total += $subtotal;
	
	echo'<tr><td><img src='. $row['item_img'].'></td>';

    # Display the row/s:
    echo "<td></td><td>{$row['item_name']}</td> 
    <td>
	<div class=\"col-xs-2\">
	<input class=\"form-control\"  name=\"qty[{$row['item_id']}]\" value=\"{$_SESSION['cart'][$row['item_id']]['quantity']}\"></td>
    <td>£ ".number_format ($subtotal, 2)."</td></tr>";
  }
  
   # Close the database connection.
  mysqli_close($link); 
  
  # Display the total.
  echo '<tr><td colspan="6"><a href="checkout.php?total='.$total.'" class="btn btn-primary btn-block"" role="button"> PAY NOW</a></td></tr>
		<tr><td colspan="6"><input type="submit" name="submit" class="btn btn-primary btn-block" role="button" value="UPDATE CART">  <td  style="text-align:right"></td></tr>
		<tr><td colspan="6"><a href="index.php" class="btn btn-primary btn-block" role="button"> CONTINUE SHOPPING </a></td></tr>
  </form>';
}
else
# Or display a message. 
{ echo '<p>Your cart is currently empty.</p>' ; }


?>