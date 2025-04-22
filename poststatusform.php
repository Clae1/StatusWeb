<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
    <head>
        <title>Status Posting System</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="style.css" type="text/css" /> 
    </head>

    <body class="postform_container">
        <h1>Status Posting System</h1>
        <div class="postform">
            <form method="post" action="poststatusprocess.php">
                <table class="post_table">
                    <tr>
                        <td class="post_info"><label for="stcode"> Enter Status Code: </label></td>
                        <td class="post_info_input">
                            <input type="text" name="stcode" id="stcode" placeholder="Enter status code here..."/>
                        </td>
                    </tr>

                    <tr>
                        <td class="post_info"><label for="st"> Status: </label></td>
                        <td>
                            <input type="text" name="st" id="st" placeholder="Enter status here..."/>
                        </td>
                    </tr>

                    <tr>
                        <td class="post_info"><label for="share"> Share: </label></td>
                        <td>
                            <input type="radio" name="share_post" id="uni" value="university" checked/>
                            <label for="uni" class="post_radio"> University </label>

                            <input type="radio" name="share_post" id="class" value="class"/>
                            <label for="class" class="post_radio"> Class </label>

                            <input type="radio" name="share_post" id="private" value="private"/>
                            <label for="private" class="post_radio"> Private </label>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="post_info"><label for="date"> Date: </label></td>
                        <td>
                            <input type="date" name="date" id="date" />
                        </td>
                    </tr>

                    <tr>
                        <td class="post_info"><label for="permision"> Permission: </label></td>
                        <td>
                            <input type="checkbox" name="like" id="like" value="Like"/>
                            <label for="like" class="post_checkbox"> Allow Like</label>

                            <input type="checkbox" name="comment" id="comment" value="Comment"/>
                            <label for="comment" class="post_checkbox"> Allow Comments</label>

                            <input type="checkbox" name="share" id="allowshare" value="Share"/>
                            <label for="allowshare" class="post_checkbox"> Allow Share</label>
                        </td>
                    </tr>
                </table>
                <input type="submit" value="Submit Form" />
                <p class="post_home"><a href="index.html" class="button">Return to Home Page</a></p>
            </form>
        </div>;
    </body>
</html>