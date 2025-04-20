<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
    <head>
        <title>Status Posting System</title>
    </head>

    <body>
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
                    echo "<p><a href=\"poststatusform.php\">Return to Post Status page</a></p>";
                    echo "<p><a href=\"index.html\">Return to Home Page</a></p>";
                    die;
                }
            }
        ?>
        <h1>Table has been successfully been deleted!!!</h1>
        <h2><a href=index.html>Return to Home page</a></h2>

    </body>
</html>