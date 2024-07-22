<!---book_event.php : Book the events by userid--->
<?php
session_start();
require "includes/connect_db.php";//Included databases

if (isset($_GET["id"])) {
    $eid = $_GET["id"];
    $uid = $_SESSION["user_id"];
    // Added a field into book_events table when confirm booking
    $q = "INSERT INTO booked_events(event_id, user_id) 
                VALUES ('$eid', '$uid')";
    $r = $dbc->query($q);
    header("location:user_home.php");//Redircted to user_home.php page
}
?>
