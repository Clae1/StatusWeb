<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
    <head>
        <title>Status Posting System</title>
    </head>

    <body>
        <h1>Status Posting System</h1>
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
                    //Check if the database exist 
                    $query = "SELECT * FROM statusPost";
                    $result = mysqli_query($conn, $query); 

                    //Create the database 
                    if(!$result)
                    {
                        $query1 = "CREATE TABLE `statusPost` (
                            `stcode` VARCHAR(5) NOT NULL,
                            `st` VARCHAR(200) NOT NULL,
                            `share` VARCHAR(50),
                            `date` DATE NOT NULL,
                            `perm` VARCHAR(100),
                            PRIMARY KEY(`stcode`)
                        );";
                        $result = mysqli_query($conn, $query1); 
                        
                        //check if command was successuful 
                        if (!$result)
                        {
                            echo "<p>Something is wrong with ",	$query1, "</p>";
                            echo "<p>MySQL Error: ", mysqli_error($conn), "</p>";
                        }  
                    }

                    else 
                    {
                        //Get data from the form 
                        //Check if status code, status or date are null
                        if (!isset($_POST["stcode"]) || !isset($_POST["st"]) || !isset($_POST["date"]))
                        {
                           echo "<p>Status Code, Status and Date must not be left blank!!!</p>";
                           echo "<p>Please fill in the specified fields</p>";
                           echo "<p><a href=\"index.html\">Return to Home Page</a></p>";
                           echo "<p><a href=\"poststatusform.php\">Return to Post Statu page</a></p>";
                           die();
                        }

                        //First field
                        $stcode = $_POST["stcode"];
                        echo "<p>$stcode</p>";
                        $pattern = "/^S\d{4}$/";

                        //Check if the field is formatted correctly 
                        if (!preg_match($pattern, $stcode))
                        {
                            echo "<p>Status Code is in the wrong format!!!</p>";
                            echo "<p>The Status code must start with a Uppercase letter 'S' followed by four digits</p>";
                            echo "<p>Example: \"S0002\"</p>";

                            echo "<p><a href=\"index.html\">Return to Home Page</a></p>";
                            echo "<p><a href=\"poststatusform.php\">Return to Post Statu page</a></p>";
                        }


                        //Second Field
                        $st = $_POST["st"];
                        echo "<p>$st</p>";
                        $pattern = "/^[a-zA-Z0-9,.?! ]+$/";

                        //Check if the field is formatted correctly 
                        if (!preg_match($pattern, $st))
                        {
                            echo "<p>Status is in the wrong format!!!</p>";
                            echo "<p>The status must contain alphanumericals, comma, period, exclamation and question mark</p>";
                            echo "<p><a href=\"index.html\">Return to Home Page</a></p>";
                            echo "<p><a href=\"poststatusform.php\">Return to Post Statu page</a></p>";
                        }


                        //Third Field
                        if(isset($_POST["share_post"]))
                        {
                            $share = $_POST["share_post"];
                            echo "<p>$share</p>";
                        }
                        

                        //Fourth Field 
                        $date = $_POST["date"];
                        echo "<p>$date</p>";
                    
                        //Fifth Field
                        if(isset($_POST["permission"]))
                        {
                            $perm = $_POST["permission"];
                            echo "<p>$perm[0]</p>";
                            echo "<p>$perm[1]</p>";
                            echo "<p>$perm[2]</p>";
                            echo "it worked";
                        }
                        else
                        {
                            echo "error";
                        }
                        
                        echo "</table>";
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




