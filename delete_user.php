<!---delete_user.php: Delete the user by id (admin side) -->
<?php
require "includes/connect_db.php";//Included database

if (isset($_GET["id"])) {
    //Delete the user by id
    $q = "DELETE FROM users WHERE user_id = '" . $_GET["id"] . "' ";
    $r = $dbc->query($q);
    header("location:manage_users.php"); //Redircted to manage_users.php page
}
?>
