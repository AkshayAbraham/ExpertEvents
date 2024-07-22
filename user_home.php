<!---user_home.php : List all the upcoming events and booked events--->
<?php
session_start();
if (isset($_SESSION["user_id"])) {//If session variable contains user_id then home_header.html will execute for header part otherwise header.html will execute
    include "includes/user_home_header.html";
} else {
    include "includes/header.html";
}
$uid = $_SESSION["user_id"];
require "includes/connect_db.php";//Included database
$q = "SELECT * FROM events WHERE event_date >= NOW()";    //Get all the events from the events table
$r = $dbc->query($q);
$rowcount = $r->num_rows;
if ($rowcount == 0) {
    echo '<div class="adminHome">
            <h1><b class="indexP">Explore</b></h1> 
        </div> <div class="card">
            <div class="container">
                <p>No Upcoming Event(s).</p> 
            </div>
        </div> ';
} else {
    echo '<div class="adminHome">
            <h1><b class="indexP">Explore</b></h1> 
        </div>';
    $i = 0;
    while ($row = mysqli_fetch_array($r)) {
        $eid = $row["event_id"];
        $q = "SELECT * FROM booked_events WHERE event_id = $eid AND user_id = $uid"; // Select all the events by user id and list the data in front end
        $ri = $dbc->query($q);
        $rowcount = $ri->num_rows;
        if ($rowcount == 0) {
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
                    <a class="btn btn-danger contactUsMainImg bookEvent" href="#popup-box?id=' .
                    $row["event_id"] .
                    '">Book</a>
                </div>
            </div><div id="popup-box?id=' .
            $row["event_id"] .
            '" class="modal">
                <div class="content">
                <h4 style="color: green;">
                Confirmation!
                </h4>
                <b>
                <p>Are you sure you want to book this event?</p>
                </b>
                <a class="btn btn-danger delete" href="book_event.php?id=' .
            $row["event_id"] .
            '">Book Event</a>
                <a href="#" 
               class="box-close">
                ×
                </a>
            </div>
            </div>';
        }else {
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
                    <a class="btn btn-danger contactUsMainImg bookEvent" href="#popup-box?id=' .
                    $row["event_id"] .
                    '">Cancel</a>
                </div>
            </div><div id="popup-box?id=' .
            $row["event_id"] .
            '" class="modal">
                <div class="content">
                <h4 style="color: green;">
                Confirmation!
                </h4>
                <b>
                <p>Are you sure you want to cancel the booking?</p>
                </b>
                <a class="btn btn-danger delete" href="cancel_book.php?id=' .
            $row["event_id"] .
            '">Ok</a>
                <a href="#" 
               class="box-close">
                ×
                </a>
            </div>
            </div>';
        }
        $i++;
    }
}
include "includes/footer.html";//Included footer part
?>
