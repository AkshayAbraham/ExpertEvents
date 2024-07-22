<!---delete_event.php : Delete an event by event id--->
<?php
require "includes/connect_db.php";

if (isset($_GET["id"])) {
    $q = "DELETE FROM events WHERE event_id = '" . $_GET["id"] . "' ";
    $r = $dbc->query($q);
    header("location:admin_home.php");
}
?>
