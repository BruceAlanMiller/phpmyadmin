<?php # DISPLAY COMPLETE LOGGED OUT PAGE.
# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Goodbye' ;
include ( 'head_login.php' ) ;

# Clear existing variables.
$_SESSION = array() ;
  
# Destroy the session.
session_destroy() ;

# Display body section.
echo '<div class="container">
		<p class="display-3">Goodbye!</p>
		<p class="display-3">Thank you for visiting.</p>
	 </div>';

?>