<html>
<head>
    <title>CS143 - Project 1B - Add movie/director relation</title>
</head>
<body>
    <?php
    $mid = $_POST["mid"];
    $did = $_POST["did"];

    if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($mid) && !empty($did))
    {
        $db = mysql_connect("localhost", "cs143", "");
        if (!$db)
            die("Unable to connect to database: " . mysql_error());

        $db_selected = mysql_select_db("CS143", $db);
        if (!$db_selected)
            die("Unable to select database: " . mysql_error());

        // Insert into MovieActor
        $mid = (int) $mid;
        $did = (int) $did;
        $query = "INSERT INTO MovieDirector (mid, did) VALUES (";
        $query .= "$mid, $did)";
        if (!$result = mysql_query($query))
            die("Error executing query: " . mysql_error());

        mysql_close($db);

        echo "Added director with id=$did to movie with id=$mid.\n";
        echo "<hr />\n";
    }
    ?>

    Add a director to a movie:<br /><br />
    <form action="./add_movie_director.php" method="POST">
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

        // All directors
        $query = "SELECT * FROM Director ORDER BY last ASC";
        if (!$result = mysql_query($query))
            die("Error executing query: " . mysql_error());

        echo "Director: <select name=\"did\">\n";
        while ($row = mysql_fetch_assoc($result)) {
            $name = "$row[last], $row[first]";
            $aid = $row["id"];
            echo "<option value=\"$aid\">$name</option>\n";
        }    
        echo "</select><br />\n";

        mysql_free_result($result);
        mysql_close($db);
        ?>
        <input type="submit" value="Add relation" />
    </form>
</body>
</html>
