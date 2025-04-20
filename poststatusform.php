<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
<head>
    <title>Status Posting System</title>
</head>

<body>
	<h1>Status Posting System</h1>
	<form method="post" action="poststatusprocess.php">
		<p>	
            <label for="stcode"> Enter Status Code: </label>
			<input type="text" name="stcode" id="stcode" />
        </p>

        <p>	
            <label for="st"> Status: </label>
			<input type="text" name="st" id="st" />
        </p>

        <p>	
            <label for="share"> Share: </label>

			<input type="radio" name="share_post" id="uni" value="university" checked/>
            <label for="uni"> University </label>

            <input type="radio" name="share_post" id="class" value="class"/>
            <label for="class"> Class </label>

            <input type="radio" name="share_post" id="private" value="private"/>
            <label for="private"> Private </label>
        </p>

        <p>	
            <label for="date"> Date: </label>
			<input type="date" name="date" id="date" />
        </p>

        <p>	
            <label for="permision"> Permission: </label>

			<input type="checkbox" name="like" id="like" value="Like"/>
            <label for="like"> Allow Like</label>

            <input type="checkbox" name="comment" id="comment" value="Comment"/>
            <label for="comment"> Allow Comments</label>

            <input type="checkbox" name="share" id="allowshare" value="Share"/>
            <label for="allowshare"> Allow Share</label>
        </p>

        <p>
            <input type="submit" name="submit" value="Submit Form" />
            <br>
            <p><a href="index.html">Return to Home Page</a></p>
        </p>
	</form>
</body>
</html>