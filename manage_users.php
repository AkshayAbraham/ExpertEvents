<!---manage_users.php : List/Delete all the users in admin side--->
<?php
session_start();
if (isset($_SESSION["user_id"])) {
    //If session variable contains user_id then home_header.html will execute for header part otherwise header.html will execute
    include "includes/home_header.html";
} else {
    include "includes/header.html";
}
require "includes/connect_db.php"; //Included database
$q = "SELECT * FROM users WHERE role = 3 OR role = 2"; //List all the users except the admin role 3 for users and 2 for employees
$r = $dbc->query($q);
$rowcount = $r->num_rows;
if ($rowcount == 0) {
    echo "<h2>No user(s) available.</h2>";
} else {
    echo '<h2>Users List</h2><table>
        <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email Id</th>
        <th></th>
        </tr>';
    $i = 0;
    while ($row = mysqli_fetch_array($r)) {
        // List all the user details in front end in the form of a table
        echo '<tr>
            <td>' .
            $row["first_name"] .
            '</td>
            <td>' .
            $row["last_name"] .
            '</td>
            <td>' .
            $row["email"] .
            '</td>
            <td><a class="btn btn-danger deleteUser" href="#popup-box?id=' .
            $row["user_id"] .
            '">Delete</a></td>
            </tr>        
            </div>
                <div id="popup-box?id=' .
            $row["user_id"] .
            '" class="modal">
                <div class="content">
                <h4 style="color: green;">
                    Confirmation!
                </h4>
                <b>
                    <p>Are you sure you want to delete?</p>
                </b>
                <a class="btn btn-danger delete" href="delete_user.php?id=' .
            $row["user_id"] .
            '">Delete</a>
                <a href="#" class="box-close">×</a>
                </div>
            </div>';
        $i++;
    }
    echo "</table>";
}
?>
<?php include "includes/footer.html"; //Included footer part ?>
