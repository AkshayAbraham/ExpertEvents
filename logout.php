<!---logout.php: Logout from all pages-->
<?php 
session_start();
include ('includes/header.html');

if($_SESSION['user_id']){
    $_SESSION = array();
    session_destroy(); // Destroy the session and logout from the site
    header("location:index.php");
}
include("includes/footer.html")
?>