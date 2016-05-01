<html>
<head>
    <title>CS143 - Project 1B - Add movie/actor relation</title>
    <link href="./bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    $mid = $_POST["mid"];
    $aid = $_POST["aid"];
    $role = $_POST["role"];

    if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($mid) && !empty($aid) && !empty($role))
    {
        $db = mysql_connect("localhost", "cs143", "");
        if (!$db)
            die("Unable to connect to database: " . mysql_error());

        $db_selected = mysql_select_db("CS143", $db);
        if (!$db_selected)
            die("Unable to select database: " . mysql_error());

        // Insert into MovieActor
        $mid = (int) $mid;
        $aid = (int) $aid;
        $query = "INSERT INTO MovieActor (mid, aid, role) VALUES (";
        $query .= "$mid, $aid, ";
        $query .= "'" . mysql_real_escape_string($role) . "')";
        if (!$result = mysql_query($query))
            die("Error executing query: " . mysql_error());

        mysql_close($db);

        echo "Added actor with id=$aid (role of \"$role\") to movie with id=$mid.\n";
        echo "<hr />\n";
    }
    else if ($_SERVER["REQUEST_METHOD"] === "POST")
    {
        echo "No role specified.\n";
        echo "<hr />\n";
    }
    ?>

    Add an actor's role in a movie:<br /><br />
    <form action="./add_movie_actor.php" method="POST">
        <?php
        $db = mysql_connect("localhost", "cs143", "");
        if (!$db)
            die("Unable to connect to database: " . mysql_error());

        $db_selected = mysql_select_db("CS143", $db);
        if (!$db_selected)
            die("Unable to select database: " . mysql_error());

        // All movies
        $query = "SELECT * FROM Movie ORDER BY title ASC";
        if (!$result = mysql_query($query))
            die("Error executing query: " . mysql_error());

        echo "Movie: <select name=\"mid\">\n";
        while ($row = mysql_fetch_assoc($result)) {
            $title = $row["title"];
            $year = $row["year"];
            $mid = $row["id"];
            echo "<option value=\"$mid\">$title ($year)</option>\n";
        }    
        echo "</select><br />\n";
        mysql_free_result($result);

        // All actors
        $query = "SELECT * FROM Actor ORDER BY last ASC";
        if (!$result = mysql_query($query))
            die("Error executing query: " . mysql_error());

        echo "Actor: <select name=\"aid\">\n";
        while ($row = mysql_fetch_assoc($result)) {
            $name = "$row[last], $row[first]";
            $aid = $row["id"];
            echo "<option value=\"$aid\">$name</option>\n";
        }    
        echo "</select><br />\n";

        mysql_free_result($result);
        mysql_close($db);
        ?>
        Role: <input type="text" name="role" maxlength="50"/><br />
        <input type="submit" value="Add relation" />
    </form>
</body>
</html>
