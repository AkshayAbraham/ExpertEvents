<!---add_event.php: Add/Edit an event -->
<?php
session_start();
if (isset($_SESSION["user_id"])) {
    //If session variable contains user_id then home_header.html will execute for header part otherwise header.html will execute
    include "includes/home_header.html";
} else {
    include "includes/header.html";
}
require "includes/connect_db.php"; //Included database connection

if (isset($_GET["id"])) {
    //Select details of an event by id for updating the event details
    $q = "SELECT * FROM events WHERE event_id = '" . $_GET["id"] . "' ";
    $r = $dbc->query($q);
    $row = mysqli_fetch_array($r);
    $title = $row["title"];
    $location = $row["location"];
    $description = $row["description"];
    $eventDate = $row["event_date"];
    $eventId = $row["event_id"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Check all the validations
    $errors = [];
    if (
        empty($_POST["title"]) || // Check empty field validations
        empty($_POST["location"]) ||
        empty($_POST["date"]) ||
        empty($_POST["description"])
    ) {
        $errors[] = "fields required.";
        echo ' <div class="alert alert-danger 
            alert-dismissible fade show" role="alert"> 
            <strong>Error!</strong> All fields are required.
            <button type="button" class="close" 
            data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span> 
            </button> 
            </div> ';
    }
    if (!empty($_POST["title"])) {
        $tit = $dbc->real_escape_string(trim($_POST["title"]));
    }
    if (!empty($_POST["location"])) {
        $loc = $dbc->real_escape_string(trim($_POST["location"]));
    }
    if (!empty($_POST["date"])) {
        $dat = $dbc->real_escape_string(trim($_POST["date"]));
    }
    if (!empty($_POST["description"])) {
        $des = $dbc->real_escape_string(trim($_POST["description"]));
    }

    if (empty($errors)) {
        if (isset($_GET["id"])) {
            // Update the event details query
            $q = "UPDATE events SET title = '$tit',location = '$loc',description ='$des',event_date ='$dat' WHERE event_id = $eventId ";
            $r = $dbc->query($q);
            if ($r) {
                echo ' <div class="alert alert-success 
                alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Event is updated successfully. 
                <button type="button" class="close"
                    data-dismiss="alert" aria-label="Close"> 
                    <span aria-hidden="true">×</span> 
                </button> 
            </div> ';
            }
        } else {
            // Add the event details query
            echo '<script>alert("Test12")</script>';
            echo "<script>alert(" . $a . ")</script>";
            $q = "INSERT INTO events (title, location, description, event_date) 
                VALUES ('$tit', '$loc', '$des', '$dat' )";
            $r = $dbc->query($q);
            if ($r) {
                echo ' <div class="alert alert-success 
                alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Event is added successfully. 
                <button type="button" class="close"
                    data-dismiss="alert" aria-label="Close"> 
                    <span aria-hidden="true">×</span> 
                </button> 
            </div> ';
            }
            unset($_POST["first_name"]);
            unset($_POST["last_name"]);
            unset($_POST["email"]);
            unset($_POST["pass1"]);
            unset($_POST["pass2"]);
        }
        header("location:admin_home.php");
    }
}
?>
<!---HTML code for add/edit event -->
<div class="row" style="display:inline-block;margin-left:400px;">
    <form action="<?php if (isset($_GET["id"])) {
        echo "add_event.php?id=" . $eventId;
    } else {
        echo "add_event.php";
    } ?>" method="post">
        <h2><b class="indexP"><?php if (isset($_GET["id"])) {
            echo "Edit Event";
        } else {
            echo "Add Event";
        } ?></b></h2>
        <label>Title</label>
        <input type="text" class="inputFormat" name="title" size="20" value="<?php
        if (isset($_POST["title"])) {
            echo $_POST["title"];
        }
        if (isset($_GET["id"])) {
            echo $title;
        }
        ?>" placeholder="title"> 
        <label>Location</label>
        <input type="text" class="inputFormat" name="location" size="20" value="<?php
        if (isset($_POST["location"])) {
            echo $_POST["location"];
        }
        if (isset($_GET["id"])) {
            echo $location;
        }
        ?>" placeholder="location">
        <label>Date & Time</label>
        <input type="datetime-local" class="inputFormat" name="date" size="50" value="<?php
        if (isset($_POST["date"])) {
            echo $_POST["date"];
        }
        if (isset($_GET["id"])) {
            echo $eventDate;
        }
        ?>">
        <label>Description</label>
        <textarea id="description" class="inputFormat" name="description"><?php
        if (isset($_POST["pass1"])) {
            echo $_POST["pass1"];
        }
        if (isset($_GET["id"])) {
            echo $description;
        }
        ?></textarea>
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-success saveProfile submitBtn">Submit</button>
        </div>
    </form>
</div>
<?php include "includes/footer.html"; //Included footer part
?>
