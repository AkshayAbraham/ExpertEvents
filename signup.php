<!---Signup.php : Add details of a new user --->
<?php
include "includes/header.html"; //included header part
require "includes/connect_db.php"; //included database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    //Check all the validations
    if (
        empty($_POST["first_name"]) ||
        empty($_POST["last_name"]) ||
        empty($_POST["email"]) ||
        empty($_POST["pass1"]) ||
        empty($_POST["pass2"])
    ) {
        //Check the empty fields
        $errors[] = "fields required.";
        echo '<div class="alert alert-danger 
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
        if ($_POST["pass1"] != $_POST["pass2"]) {
            //Check the password mismatch
            $errors[] = "Passwords do not match.";
            echo ' <div class="alert alert-danger 
                alert-dismissible fade show" role="alert"> 
                <strong>Error!</strong> Passwords do not match.
                <button type="button" class="close" 
                data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span> 
                </button> 
                </div> ';
        } else {
            $p = $dbc->real_escape_string(trim($_POST["pass1"]));
        }
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

    if (empty($errors)) {
        //Check the emailid with database for avoid duplicate email
        $q = "SELECT user_id FROM users WHERE email='$e'";
        $r = $dbc->query($q);
        $rowcount = $r->num_rows;
        if ($rowcount != 0) {
            $errors[] =
                'Email address already registered. <a href="login.php">Login</a>';
            echo ' <div class="alert alert-danger 
                alert-dismissible fade show" role="alert"> 
                <strong>Error!</strong> Email address already registered.
                <button type="button" class="close" 
                data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span> 
                </button> 
                </div> ';
        }
    }
    if (empty($errors)) {
        /*Store the user details into the database */
        $q = "INSERT INTO users (first_name, last_name, email, pass, reg_date,role) 
                    VALUES ('$fn', '$ln', '$e', SHA1('$p'), NOW(), 3 )";
        $r = $dbc->query($q);
        if ($r) {
            echo '<div class="alert alert-success 
                alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your account is 
                now created and you can login. 
                <button type="button" class="close"
                data-dismiss="alert" aria-label="Close"> 
                <span aria-hidden="true">×</span> 
                </button></div> ';
            unset($_POST["first_name"]);
            unset($_POST["last_name"]);
            unset($_POST["email"]);
            unset($_POST["pass1"]);
            unset($_POST["pass2"]);
        }
    }
}
?>
<!---HTML Code for SignUp Page -->
<div class="card cardSignUpImg" style="
    float: left;
    background-color: transparent;
">
    <img src="img/signup.png" alt="Avatar" style="width:100%">
  
</div>
<div class="card cardSignUp">
    <form action="signup.php" method="post" class="signUpFrm">
        <h1><b class="indexP">Welcome</b></h1>
        <div style="padding-left:140px;">
            <label>First name</label>
            <input type="text" class="inputFormat" name="first_name" size="20" value="<?php if (
                isset($_POST["first_name"])
            ) {
                echo $_POST["first_name"];
            } ?>" placeholder="First Name"> 
            <label>Last name</label>
            <input type="text" class="inputFormat" name="last_name" size="20" value="<?php if (
                isset($_POST["last_name"])
            ) {
                echo $_POST["last_name"];
            } ?>" placeholder="Last Name">
            <label>Email</label>
            <input type="text" class="inputFormat"  name="email" size="50" value="<?php if (
                isset($_POST["email"])
            ) {
                echo $_POST["email"];
            } ?>" placeholder="Email Id">
            <label>Password</label>
            <input type="password" class="inputFormat"  name="pass1" size="20" value="<?php if (
                isset($_POST["pass1"])
            ) {
                echo $_POST["pass1"];
            } ?>" placeholder="Password">
            <label>Confirm Password</label>
            <input type="password" class="inputFormat" name="pass2" size="20" value="<?php if (
                isset($_POST["pass2"])
            ) {
                echo $_POST["pass2"];
            } ?>" placeholder="Confirm Password">
            <div class="form-group">
                <button class="submitBtn" type="submit" name="submit"><b>SignUp</b></button>
            </div>
            <p class="accountCls">Already have an account? <a href="login.php">Login</a>.</p>
        </div>
    </form>
</div>
<?php // Included footer part

include "includes/footer.html";
?>
