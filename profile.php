<!---profile.php : To Show/Update/Delete the profile details--->
<?php
session_start();
if (isset($_SESSION["user_id"])) {
    //If session variable contains user_id then home_header.html will execute for header part otherwise header.html will execute
    if ($_SESSION["role"] == 1) {
        include "includes/home_header.html";
    } else {
        include "includes/user_home_header.html";
    }
} else {
    include "includes/header.html";
}
require "includes/connect_db.php"; //included database
if (isset($_SESSION["user_id"])) {
    //Get all the details of the user by id and stored in local variables
    $q = "SELECT * FROM users WHERE user_id = '" . $_SESSION["user_id"] . "' ";
    $r = $dbc->query($q);
    $row = mysqli_fetch_array($r);
    $fname = $row["first_name"];
    $lname = $row["last_name"];
    $email = $row["email"];
    $pass = $row["pass"];
    $user = $row["user_id"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    //Check all the validations
    if (
        empty($_POST["first_name"]) || //Check the empty fields
        empty($_POST["last_name"]) ||
        empty($_POST["email"]) ||
        empty($_POST["pass1"])
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
    if (!empty($_POST["first_name"])) {
        $fn = $dbc->real_escape_string(trim($_POST["first_name"]));
    }
    if (!empty($_POST["last_name"])) {
        $ln = $dbc->real_escape_string(trim($_POST["last_name"]));
    }
    if (!empty($_POST["pass1"])) {
        $p = $dbc->real_escape_string(trim($_POST["pass1"]));
    }

    if (!empty($_POST["email"])) {
        if (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
            //Check the email format
            $errors[] = "Invalid email format";
            echo ' <div class="alert alert-danger 
            alert-dismissible fade show" role="alert"> 
            <strong>Error!</strong> Invalid email format.
            <button type="button" class="close" 
            data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span> 
            </button> 
            </div> ';
        } else {
            $e = $dbc->real_escape_string(trim($_POST["email"]));
        }
    }

    if (empty($errors) && $e == $email) {
        //Check the emailid with database for avoid duplicate email
        //Updated details saved to database
        $q = "UPDATE users SET first_name = '$fn',last_name = '$ln',email ='$e',pass = SHA1('$p') WHERE user_id = $user ";
        $r = $dbc->query($q);
        if ($r) {
            echo ' <div class="alert alert-success 
                alert-dismissible fade show" role="alert">
                <strong>Success!</strong> User Details has been updated successfully. 
                <button type="button" class="close"
                    data-dismiss="alert" aria-label="Close"> 
                    <span aria-hidden="true">×</span> 
                </button> 
            </div> ';
        }
        //Clear all the variables
        unset($_POST["first_name"]);
        unset($_POST["last_name"]);
        unset($_POST["email"]);
        unset($_POST["pass1"]);
        header("location:profile.php");
    }
}
?>
<!---HTML Code for Profile Page -->
<div class="row" style="display:inline-block;margin-left:400px;">
    <form action="profile.php" method="post">
        <h2><b class="indexP"> Profile Details</b></h2>
        <!---<input id="image" type="file" name="profile_photo" placeholder="Photo" required="" capture>-->
        <input type="text" class="inputFormat" name="first_name" size="20" value="<?php
        if (isset($_POST["first_name"])) {
            echo $_POST["first_name"];
        }
        if (isset($_SESSION["user_id"])) {
            echo $fname;
        }
        ?>" placeholder="First Name"> 
        <input type="text" class="inputFormat" name="last_name" size="20" value="<?php
        if (isset($_POST["last_name"])) {
            echo $_POST["last_name"];
        }
        if (isset($_SESSION["user_id"])) {
            echo $lname;
        }
        ?>" placeholder="Last Name">
        <input type="text" class="inputFormat" name="email" size="50" value="<?php
        if (isset($_POST["email"])) {
            echo $_POST["email"];
        }
        if (isset($_SESSION["user_id"])) {
            echo $email;
        }
        ?>" placeholder="Email Id">
        <input type="password" class="inputFormat" name="pass1" size="20" value="<?php
        if (isset($_POST["pass1"])) {
            echo $_POST["pass1"];
        }
        if (isset($_SESSION["user_id"])) {
            echo $pass;
        }
        ?>" placeholder="Password">
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-success saveProfile submitBtn" style="margin-bottom:65px;">Save</button>
        </div>    
    </form>
</div>
<?php include "includes/footer.html"; //Included footer part
?>
