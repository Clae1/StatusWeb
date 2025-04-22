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
                if (!$conn) 
                {
                    // Displays an error message
                    echo "<p>Database connection failure</p>";
                } 

                else 
                {
                    //Dropping the Main table
                    $query = "DROP TABLE statusPost";
                    $result = mysqli_query($conn, $query); 

                    //error message 
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
            <h1>Table has been deleted successfully!!!</h1>
            <h2><a href=index.html class="button">Return to Home page</a></h2>
        </div>
    </body>
</html>