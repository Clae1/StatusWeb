<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
    <head>
        <title>Status Posting System</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>

    <body>
        <div class="content">
        <h1>Status information</h1>
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
                    //Check if the Main database exist 
                    $query = "SELECT * FROM statusPost";
                    $result = mysqli_query($conn, $query); 

                    //If there is an error with the query result. Print an error message that no status or information exist on the table 
                    if(!$result)
                    {
                        echo "<p class=\"error_message\">No status found in the system. Please go to the post status page to post one.</p>";

                        echo "<table class=\"button_group\">";
                        echo "<tr>";
                        echo "<td><p><a href=\"index.html\">Return to Home Page</a></p></td>";
                        echo "<td><p><a href=\"poststatusform.php\" class=\"button\">Return to Post Status page</a></p></td>";
                        echo "</tr>";
                        echo "</table>";
                        die;
                    }
                    
                    else 
                    {
                        $search = mysqli_real_escape_string($conn, $_GET["search"]);
                        $pattern = "/^$/";
                        $pattern2 = "/^[a-zA-Z0-9,.?! ]+$/";

                        //check if the field is empty
                        if (preg_match($pattern, $search))
                        {
                            //error message
                            echo "<p class=\"error_message\">Search box is blank, Please enter a keyword into search box!!!</p>";
                            echo "<table class=\"button_group\">";
                            echo "<tr>";
                            echo "<td><p><a href=\"index.html\" class=\"button\">Return to Home Page</a></p></td>";
                            echo "<td><p><a href=\"searchstatusform.html\" class=\"button\">Return to Search status page</a></p></td>";
                            echo "</tr>";
                            echo "</table>";
                            die();
                        }

                        //check if the field has correct formatting 
                        if (!preg_match($pattern2, $search))
                        {
                            //error message
                            echo "<p class=\"error_message\">The status must contain only alphanumericals, comma, period, exclamation and question mark</p>";
                            echo "<table class=\"button_group\">";
                            echo "<tr>";
                            echo "<td><p><a href=\"index.html\" class=\"button\">Return to Home Page</a></p></td>";
                            echo "<td><p><a href=\"searchstatusform.html\" class=\"button\">Return to Search status page</a></p></td>";
                            echo "</tr>";
                            echo "</table>";
                            die();
                        }

                        //Check if keyword is present in the st columns 
                        $query = "SELECT * FROM statusPost WHERE st LIKE '$search%'";
                        $result = mysqli_query($conn, $query);

                        if(mysqli_num_rows($result) == 0)
                        {
                            echo "<p>Status not found. Please use a different Keyword!!!</p>";
                            echo "<p><a href=\"searchstatusform.html\">Return to Search status page</a></p>";
                        }
                        
                        else
                        {
                            //Display the information 
                            //check that record has been retrieved from the table 
                            while ($row = mysqli_fetch_assoc($result))
                            {
                                echo "<div class=\"search_info\">"
                                ."<p>Status code:",$row["stcode"]
                                ."<br>"
                                ."Status: ",$row["st"]
                                ."<br>" 
                                ."Share: ",$row["share"]
                                ."<br>"
                                ."Date Posted: ",$row["date"]
                                ."<br>"
                                ."Permission: ",$row["perm"]
                                ."</p>"
                                ."</div>"
                                ."<hr>";
                                
                            }
                            echo "<table class=\"button_group\">";
                            echo "<tr>";
                            echo "<td><p><a href=\"index.html\" class=\"button\">Return to Home Page</a></p></td>";
                            echo "<td><p><a href=\"searchstatusform.html\" class=\"button\">Return to Search status page</a></p></td>";
                            echo "</tr>";
                            echo "</table>";
                        }
                        
                        // Frees up the memory, after using the result pointer
                        mysqli_free_result($result);
                    } 
                    // close the database connection
                    mysqli_close($conn);
                } 
                // if successful database connection
            ?>
        </div>
    </body>
</html>




