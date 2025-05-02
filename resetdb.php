<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
    <head>
        <title>Status Posting System</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="style.css" type="text/css" /> 
    </head>

    <body>
        <div class="reset_container">
            <h1>Reset Database</h1>
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
                    //Delete the 'statusPost' table from the database using 'DROP TABLE'
                    $query = mysqli_real_escape_string($conn,"DROP TABLE statusPost");
                    $result = mysqli_query($conn, $query); 

                    //This error message occurs if the user tries to delete a table that does not currently exist
                    if(!$result)
                    {
                        echo "<h2>There is no table in the database</h2>";

                        echo "<table class=\"button_group\">";
                        echo "<tr>";
                        echo "<td><p><a href=\"index.html\" class=\"button\">Return to Home Page</a></p></td>";
                        echo "<td><p><a href=\"poststatusform.php\" class=\"button\">Return to Post Status page</a></p></td>";
                        echo "</tr>";
                        echo "</table>";
                        die;
                    }
                }
            ?>

            <!-- Message of to confirm to user that the table has been deleted, and a button is used to direct the user to the home page -->
            <h1>Table has been deleted successfully!!!</h1>
            <h2 class="post_home"><a href=index.html class="button">Return to Home page</a></h2>
        </div>
    </body>
</html>