<!---login.php: Login page-->
<?php
include "includes/header.html"; //Included header part
require "includes/connect_db.php"; //Included database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    //Check all validations
    if (empty($_POST["email"]) || empty($_POST["password"])) {
        //Check empty values
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

    if (!empty($_POST["password"])) {
        $p = $dbc->real_escape_string(trim($_POST["password"]));
    }

    if (!empty($_POST["email"])) {
        if (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
            // Check email formats
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
        $q = "SELECT user_id,role FROM users WHERE email='$e' AND pass=SHA1('$p')";
        $r = $dbc->query($q);
        $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
        $rowcount = $r->num_rows;
        if ($rowcount == 0) {
            $errors[] = "Enter a registered email id and password";
            echo ' <div class="alert alert-danger 
            alert-dismissible fade show" role="alert"> 
            <strong>Error!</strong> Enter a registered email id and password.
            <button type="button" class="close" 
            data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span> 
            </button> 
            </div> ';
        } else {
            session_start();
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["role"] = $row["role"];
            if ($_SESSION["role"] == 1) {
                header("location:admin_home.php");
            } else {
                header("location:user_home.php");
            }
        }
    }
}
?>

<div class="card cardSignUpImg" style="
    float: left;
    background-color: transparent;
">
    <img src="img/login.png" alt="Avatar" style="width:100%">  
</div>
<div class="card cardSignUp">
    <form action="login.php" method="post">
        <h1><b class="indexP">Welcome back</b></h1>
        <h6 class="indexP" style="text-align:center;">Please enter your details</h6>
        <div style="padding-left:140px;margin-top:60px;">
            <label>Email</label>
            <input type="text" class="inputFormat" name="email" placeholder="Email Id" value="<?php if (
                isset($_POST["email"])
            ) {
                echo $_POST["email"];
            } ?>">
            <label>Password</label>
            <input type="password" class="inputFormat" name="password" placeholder="Password" required value="<?php if (
                isset($_POST["password"])
            ) {
                echo $_POST["password"];
            } ?>"> 
            <div class="form-group">
                <button class="submitBtn" type="submit" name="submit"><b>Login</b></button>
            </div>
            <p class="accountCls">Don't have an account? <a href="signup.php">SignUp</a>.</p>
        </div>
    </form>
</div>
<?php include "includes/footer.html"; //Included footer part
?>
