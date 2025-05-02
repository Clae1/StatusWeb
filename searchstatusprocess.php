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
                    //Check if 'statusPost' table exist on the database  
                    $query = "SELECT * FROM statusPost";
                    $result = mysqli_query($conn, $query); 

                    //If there is an error with the query result. Print an error message that no status or information exist on the table 
                    if(!$result)
                    {
                        echo "<p class=\"error_message\">No status found in the system. Please go to the post status page to post one.</p>";

                        echo "<table class=\"button_group\">";
                        echo "<tr>";
                        echo "<td><p><a href=\"index.html\" class=\"button\">Return to Home Page</a></p></td>";
                        echo "<td><p><a href=\"poststatusform.php\" class=\"button\">Return to Post Status page</a></p></td>";
                        echo "</tr>";
                        echo "</table>";
                        die;
                    }
                    
                    else 
                    {
                        $search = mysqli_real_escape_string($conn, $_GET["search"]);

                        //Pattern is used to check if the user input is empty 
                        $pattern = "/^$/"; 

                        //Pattern is used to check if user input only inclues alphanumericals, comma,
                        //period, exclamation and question mark
                        $pattern2 = "/^[a-zA-Z0-9,.?! ]+$/"; 

                        //check if the field is empty
                        if (preg_match($pattern, $search))
                        {
                            //error message is diplayed if the user input to the field is blank
                            echo "<p class=\"error_message\">Search box is blank, Please enter a keyword into search box!!!</p>";
                            echo "<table class=\"button_group\">";
                            echo "<tr>";
                            echo "<td><p><a href=\"index.html\" class=\"button\">Return to Home Page</a></p></td>";
                            echo "<td><p><a href=\"searchstatusform.html\" class=\"button\">Return to Search status page</a></p></td>";
                            echo "</tr>";
                            echo "</table>";
                            die();
                        }

                        //check if the field has the correct formatting using pattern 2 
                        if (!preg_match($pattern2, $search))
                        {
                            //Error message will appear if the user input does not include alphanumericals, comma, period, exclamation and question mark
                            echo "<p class=\"error_message\">The status must contain only alphanumericals, comma, period, exclamation and question mark</p>";
                            echo "<table class=\"button_group\">";
                            echo "<tr>";
                            echo "<td><p><a href=\"index.html\" class=\"button\">Return to Home Page</a></p></td>";
                            echo "<td><p><a href=\"searchstatusform.html\" class=\"button\">Return to Search status page</a></p></td>";
                            echo "</tr>";
                            echo "</table>";
                            die();
                        }

                        //Check if keyword is present in the st columns through the use of the wildcard operator at the beginning 
                        //and end of $search
                        $query = "SELECT * FROM statusPost WHERE st LIKE '%$search%'";
                        $result = mysqli_query($conn, $query);

                        //IF statement is used to check if $result has any matching information on the 'statusPost'
                        if(mysqli_num_rows($result) == 0)
                        {
                            //This error message will appear if the user input keyword cannot be found on the table
                            echo "<p class=\"error_message\">Status not found. Please use a different Keyword!!!</p>";
                            echo "<p class=\"post_home\"><a href=\"searchstatusform.html\" class=\"button\">Return to Search status page</a></p>";
                        }
                        
                        else
                        {
                            //Display the information 
                            //check that record has been retrieved from the table and echo the information that matches 
                            //the keyword provided by the user
                            while ($row = mysqli_fetch_assoc($result))
                            {
                                echo "<div class=\"search_info\">"
                                ."<p>Status code: ",$row["stcode"]
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

                            //clickable buttons that allow the user to return to the home page or search form page 
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




