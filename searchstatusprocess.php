<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
    <head>
        <title>Status Posting System</title>
    </head>

    <body>
        <h1>Status information</h1>
        <div class="content">
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

                    //Create the Main database 
                    if(!$result)
                    {
                        echo "<p>No status found in the system. Please go to the post status page to post one.</p>";
                        echo "<p><a href=\"index.html\">Return to Home Page</a></p>";
                        echo "<p><a href=\"poststatusform.php\">Return to Post Statu page</a></p>";
                        die;
                    }
                    
                    else 
                    {
                        $search = $_POST["search"];
                        $pattern = "/^$/";
                        $pattern2 = "/^[a-zA-Z0-9,.?! ]+$/";

                        //check if the field is empty
                        if (preg_match($pattern, $search))
                        {
                            //error message
                            echo "<p><a href=\"index.html\">Return to Home Page</a></p>";
                            echo "<p><a href=\"searchstatusform.html\">Return to Search status page</a></p>";
                            die("<p>Search box is blank, Please enter a keyword into search box!!!</p>");
                        }

                        //check if the field has correct formatting 
                        if (!preg_match($pattern2, $search))
                        {
                            //error message
                            echo "<p><a href=\"index.html\">Return to Home Page</a></p>";
                            echo "<p><a href=\"searchstatusform.html\">Return to Search status page</a></p>";
                            die("<p>The status must contain only alphanumericals, comma, period, exclamation and question mark</p>");
                        }

                        //Check if keyword is present in the st columns 
                        $query = "SELECT * FROM statusPost WHERE st LIKE '$search%'";
                        $result = mysqli_query($conn, $query);

                        if(!$result)
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
                                echo "<p>Status code:",$row["stcode"]."<br> Status: ",$row["st"],"</p>"
                                ."<p>Share: ",$row["share"]
                                ."<br>"
                                ."Date Posted: ",$row["date"]
                                ."<br>"
                                ."Permission: ",$row["perm"]
                                ."</p>"
                                ."<hr>";
                                
                            }
                            echo "<p><a href=\"searchstatusform.html\">Search for another post</a></p>";
                            echo "<p><a href=\"index.html\">Return to Home Page</a></p>";
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




