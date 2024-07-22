<!---admin_home.php : List all the events and add/edit/delete events--->
<?php
session_start();
if (isset($_SESSION["user_id"])) { //If session variable contains user_id then home_header.html will execute for header part otherwise header.html will execute
    include "includes/home_header.html";
} else {
    include "includes/header.html";
}
require "includes/connect_db.php";//Included database
$q = "SELECT * FROM events ORDER BY event_date DESC"; //Get all the events from the events table
$r = $dbc->query($q);
$rowcount = $r->num_rows;
if ($rowcount == 0) {
    echo '<div class="adminHome">
            <a class="btn btn-info addEvent" href="add_event.php">Add New Event</a>
            <h1><b class="indexP">Manage Events</b></h1>  
        </div> 
        <div class="card">
            <div class="container">
                <p>No Event(s) added.</p> 
            </div>
        </div> ';
} else {
    echo '<div class="adminHome">
            <a class="btn btn-info addEvent" href="add_event.php">Add New Event</a>
            <h1><b class="indexP">Manage Events</b></h1>    
        </div>';
    $i = 0;
    while ($row = mysqli_fetch_array($r)) { // list all the events using loop
        echo '<div class="column exploreUsColumn">
                <div class="card cardFont">
                    <img src="img/wedding2.jpg" alt="Unable to load">
                    <p class="exploreClass"><b>' .
                    $row["title"] .'</b></p>
                    <p class="explorePara">' .
                    $row["description"] .
                    '</p>
                    <p class="explorePara"><img src="img/calendar.png" class="userHomeImg" alt="Unable to load">' .
                    $row["event_date"] .
                    '</p>
                    <p class="explorePara"><img src="img/location.png" class="userHomeImg" alt="Unable to load">' .
                    $row["location"] .
                    '</p>
                    <a class="btn btn-success editEvent contactUsMainImg" href="add_event.php?id=' .
                    $row["event_id"] .
                    '">Edit</a>
                    <a class="btn btn-danger deleteEvent contactUsMainImg" href="#popup-box?id=' .
                    $row["event_id"] .
                    '">Delete</a>
                </div>
            </div><div id="popup-box?id=' .
            $row["event_id"] .
            '" class="modal">
            <div class="content">
                <h4 style="color: green;">
                    Confirmation!
                </h4>
                <b>
                    <p>Are you sure you want to delete?</p>
                </b>
                <a class="btn btn-danger delete" href="delete_event.php?id=' .
            $row["event_id"] .
            '">Delete</a>
                <a href="#" 
                   class="box-close">
                    ×
                </a>
            </div>
        </div>';
        $i++;
    }
}
include "includes/footer.html"; //Included footer part
?>

