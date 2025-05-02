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
            // Using require_once to check if the setting.php document has been included 
            require_once('../../files/setting.php');

            //Connecting to phpMyAdmin
            $conn = mysqli_connect(
                $host,
                $user,
                $pswd,
                $dbnm
            );

            // Checks if connection is successful
            if (!$conn) {
                // Error message to indicate to user that the connection was not successful 
                echo "<p>Database connection failure</p>";
            } 
            else 
            {
                //Pattern1 initialized with a regular expression which checks if the field is empty
                $pattern1 = "/^$/";

                //This IF statement is used to check if any of the fields are empty
                //IF condition is true, an error message is displayed to indicate to the user that these fields cannot be blank 
                if ( preg_match($pattern1, $_POST["stcode"]) || preg_match($pattern1,$_POST["st"]) || preg_match($pattern1, $_POST["date"])) {
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

                //First field status code 
                $stcode = mysqli_real_escape_string($conn,$_POST["stcode"]);

                //This regular expression is used to check if the status code field is in the correct format 
                //It will check the user input whether their input has: Capital S followed by a number sequence with a length of 4 
                $pattern2 = "/^S\d{4}$/";
            
                //Check if the status code is formatted correctly. If condition is false, print an error message that the  
                //inputted text is in the Wrong format
                if (!preg_match($pattern2, $stcode)) {
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


                //Second Field status 
                $st = mysqli_real_escape_string($conn, $_POST["st"]);

                //Regular expression is used to restrict the users input to only alphanumericals, comma, period, exclamation and 
                //question mark
                $pattern3 = "/^[a-zA-Z0-9,.?! ]+$/";
            
                //IF statement will check if the inputted text includes the correct format.
                //If not, an error message is displayed to tell user that the status in the wrong format 
                if (!preg_match($pattern3, $st)) {
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


                //Third Field share info 
                //Check if "share_post" is set or is not null 
                if (isset($_POST["share_post"])) {
                    $share = mysqli_real_escape_string($conn, $_POST["share_post"]);
                }

                //Fourth Field date
                $date = mysqli_real_escape_string($conn, $_POST["date"]);

                //Separate the "date" string to differnt variables 
                $date_check = explode("-", $date);
                $year = $date_check[0];
                $month = $date_check[1];
                $day = $date_check[2];

                //Check if the date is in the correct format. If there is an error show an error message 
                if (!checkdate($month, $day, $year)) {
                    echo "<p class=\"error_message\">Date is in the incorrect format!!! <br> Please Check your inputted date</p>";

                    echo "<table class=\"button_group\">";
                    echo "<tr>";
                    echo "<td><p><a href=\"index.html\" class=\"button\">Return to Home Page</a></p></td>";
                    echo "<td><p><a href=\"poststatusform.php\" class=\"button\">Return to Post Status page</a></p></td>";
                    echo "</tr>";
                    echo "</table>";
                    die();
                }

                //Fifth Field permission information 
                if (isset($_POST["like"]) || isset($_POST["comment"]) || isset($_POST["share"])) {
                    $perm1 = mysqli_real_escape_string($conn, $_POST["like"]);
                    $perm2 = mysqli_real_escape_string($conn, $_POST["comment"]);
                    $perm3 = mysqli_real_escape_string($conn, $_POST["share"]);

                    //Combine the variables into a one variable
                    $perm = $perm1 . " " . $perm2 . " " . $perm3;
                }


                // Set up the SQL command to add the data into the table
                $query = "INSERT INTO statusPost (stcode, st, share, date, perm) VALUES ('$stcode', '$st','$share', '$date', '$perm')";

                // executes the query
                $result = mysqli_query($conn, $query);

                // checks if the execution was successful. Print an error message if the status code already exist in the table
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
                    echo "<p class=\"post_home\"><a href=\"index.html\" class=\"button\">Return to Home Page</a></p>";
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