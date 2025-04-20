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
                    //Check if the Main database exist 
                    $query = "SELECT * FROM statusPost";
                    $result = mysqli_query($conn, $query); 

                    //Create the Main database 
                    if(!$result)
                    {
                        $query1 = "CREATE TABLE `statusPost` (
                            `stcode` VARCHAR(5) NOT NULL,
                            `st` VARCHAR(500) NOT NULL,
                            `share` VARCHAR(50),
                            `date` DATE NOT NULL,
                            `perm` VARCHAR(200),
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
                        $pattern = "/^S\d{4}$/";

                        //debugging 
                        // echo "<p>$stcode</p>";
                       
                        //Check if the field is formatted correctly 
                        if (!preg_match($pattern, $stcode))
                        {
                            echo "<p>Status Code is in the wrong format!!!</p>";
                            echo "<p>The Status code must start with a Uppercase letter 'S' followed by four digits</p>";
                            echo "<p>Example: \"S0002\"</p>";

                            echo "<p><a href=\"index.html\">Return to Home Page</a></p>";
                            echo "<p><a href=\"poststatusform.php\">Return to Post Statu page</a></p>";
                            die();
                        }


                        //Second Field
                        $st = $_POST["st"];
                        $pattern = "/^[a-zA-Z0-9,.?! ]+$/";

                        //debugging
                        // echo "<p>$st</p>";

                        //Check if the field is formatted correctly 
                        if (!preg_match($pattern, $st))
                        {
                            echo "<p>Status is in the wrong format!!!</p>";
                            echo "<p>The status must contain only alphanumericals, comma, period, exclamation and question mark</p>";
                            echo "<p><a href=\"index.html\">Return to Home Page</a></p>";
                            echo "<p><a href=\"poststatusform.php\">Return to Post Status page</a></p>";
                            die();
                        }


                        //Third Field
                        //Check if "share_post" is set or is not null 
                        if(isset($_POST["share_post"]))
                        {
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
                        if (!checkdate($month, $day, $year))
                        {
                            //Error message if function is false
                            echo "<p>Date is in the incorrect format!!! <br> Please Check your inputted date</p>";
                            die();
                        }

                        //debugging 
                        // echo "<p>$date</p>";


                        //Fifth Field (Comprised of different fields)
                        if(isset($_POST["like"]) || isset( $_POST["comment"]) || isset( $_POST["share"]))
                        {
                            $perm1 = $_POST["like"];
                            $perm2 = $_POST["comment"];
                            $perm3 = $_POST["share"];
                            $perm = $perm1." ".$perm2." ".$perm3;

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
                        if(!$result) 
                        {
                            echo "<p>Something is wrong with ",	$query, "</p>";
                            echo "<p>MySQL Error: ", mysqli_error($conn), "</p>";
                        } 
  
                        else
                        {
                            echo "<h1>!!!Your Post has been successfully been processed!!!</h1>";
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




