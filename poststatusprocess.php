<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <title>Status Posting System</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body>
    <div class="content">
        <h1>Status Posting System</h1>
        <?php
            // sql info or use include 'file.inc'
            require_once('../../files/setting.php');

            // The @ operator suppresses the display of any error messages
            // mysqli_connect returns false if connection failed, otherwise a connection value
            $conn = mysqli_connect(
                $host,
                $user,
                $pswd,
                $dbnm
            );

            // Checks if connection is successful
            if (!$conn) {
                // Displays an error message
                echo "<p>Database connection failure</p>";
            } 
            else 
            {
                //Get data from the form 
                //Check if status code, status or date are null
                if (!isset($_POST["stcode"]) || !isset($_POST["st"]) || !isset($_POST["date"])) {
                    echo "<p class=\"error_message\">Status Code, Status and Date must not be left blank!!!"
                        . "<br>"
                        . "Please fill in the specified fields</p>";

                    echo "<table class=\"button_group\">";
                    echo "<tr>";
                    echo "<td><p><a href=\"index.html\" class=\"button\">Return to Home Page</a></p></td>";
                    echo "<td><p><a href=\"poststatusform.php\" class=\"button\">Return to Post Status page</a></p></td>";
                    echo "</tr>";
                    echo "</table>";
                    die();
                }

                //First field
                $stcode = $_POST["stcode"];
                $pattern = "/^S\d{4}$/";

                //debugging 
                // echo "<p>$stcode</p>";
            
                //Check if the field is formatted correctly 
                if (!preg_match($pattern, $stcode)) {
                    echo "<p class=\"error_message\">Status Code is in the wrong format!!! 
                                    <br> The Status code must start with a Uppercase letter 'S' followed by four digits
                                    <br> Example: \"S0002\"</p>";

                    echo "<table class=\"button_group\">";
                    echo "<tr>";
                    echo "<td><p><a href=\"index.html\" class=\"button\">Return to Home Page</a></p></td>";
                    echo "<td><p><a href=\"poststatusform.php\" class=\"button\">Return to Post Status page</a></p></td>";
                    echo "</tr>";
                    echo "</table>";
                    die();
                }


                //Second Field
                $st = $_POST["st"];
                $pattern = "/^[a-zA-Z0-9,.?! ]+$/";

                //debugging
                // echo "<p>$st</p>";
            
                //Check if the field is formatted correctly 
                if (!preg_match($pattern, $st)) {
                    echo "<p class=\"error_message\">Status is in the wrong format!!!"
                        . "<br>"
                        . "The status must contain only alphanumericals, comma, period, exclamation and question mark</p>";

                    echo "<table class=\"button_group\">";
                    echo "<tr>";
                    echo "<td><p><a href=\"index.html\" class=\"button\">Return to Home Page</a></p></td>";
                    echo "<td><p><a href=\"poststatusform.php\" class=\"button\">Return to Post Status page</a></p></td>";
                    echo "</tr>";
                    echo "</table>";
                    die();
                }


                //Third Field
                //Check if "share_post" is set or is not null 
                if (isset($_POST["share_post"])) {
                    $share = $_POST["share_post"];

                    //debugging
                    // echo "<p>$share</p>";
                }


                //Fourth Field 
                $date = $_POST["date"];

                //Separate the "date" string to differnt variables 
                $date_check = explode("-", $date);
                $year = $date_check[0];
                $month = $date_check[1];
                $day = $date_check[2];

                //Check if the date is in the correct format 
                if (!checkdate($month, $day, $year)) {
                    //Error message if function is false
                    echo "<p class=\"error_message\">Date is in the incorrect format!!! <br> Please Check your inputted date</p>";

                    echo "<table class=\"button_group\">";
                    echo "<tr>";
                    echo "<td><p><a href=\"index.html\" class=\"button\">Return to Home Page</a></p></td>";
                    echo "<td><p><a href=\"poststatusform.php\" class=\"button\">Return to Post Status page</a></p></td>";
                    echo "</tr>";
                    echo "</table>";
                    die();
                }

                //debugging 
                // echo "<p>$date</p>";
            

                //Fifth Field (Comprised of different fields)
                if (isset($_POST["like"]) || isset($_POST["comment"]) || isset($_POST["share"])) {
                    $perm1 = $_POST["like"];
                    $perm2 = $_POST["comment"];
                    $perm3 = $_POST["share"];
                    $perm = $perm1 . " " . $perm2 . " " . $perm3;

                    //debugging 
                    // echo "<p>$perm1</p>";
                    // echo "<p>$perm2</p>";
                    // echo "<p>$perm3</p>";
                    // echo "<p>$perm</p>";
                }


                // Set up the SQL command to add the data into the table
                $query = "INSERT INTO statusPost (stcode, st, share, date, perm) VALUES ('$stcode', '$st','$share', '$date', '$perm')";

                // executes the query
                $result = mysqli_query($conn, $query);

                // checks if the execution was successful
                if (!$result) {
                    echo "<p class=\"error_message\">Something is wrong with Status Code!!!"
                        . "<br>"
                        . "Sorry this Status code already exist. Please enter a unique code!!!</p>";

                    echo "<table class=\"button_group\">";
                    echo "<tr>";
                    echo "<td><p><a href=\"index.html\" class=\"button\">Return to Home Page</a></p></td>";
                    echo "<td><p><a href=\"poststatusform.php\" class=\"button\">Return to Post Status page</a></p></td>";
                    echo "</tr>";
                    echo "</table>";
                } else {
                    echo "<h1>!!!Your Status has been successfully been posted !!!</h1>";
                    echo "<p><a href=\"index.html\" class=\"button\">Return to Home Page</a></p>";
                }

                // Frees up the memory, after using the result pointer
                mysqli_free_result($result);
            }
            // close the database connection
            mysqli_close($conn);
            // if successful database connection
        ?>
    </div>
</body>
</htm>