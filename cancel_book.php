<!---cancel_book.php : Delete the user selected event by userid--->
<?php
session_start();
require "includes/connect_db.php";//Included database

if (isset($_GET["id"])) {
    $eid = $_GET["id"];
    $uid = $_SESSION["user_id"];
    //Cancel the booked event
    $q =
        "DELETE FROM booked_events WHERE event_id = '" .
        $_GET["id"] .
        "' AND user_id = '" .
        $_SESSION["user_id"] .
        "' ";
    $r = $dbc->query($q);
    header("location:user_home.php");//Redircted to user_home.php page
}
?>