<html>
<head>
    <title>CS143 - Project 1B - Search</title>
</head>
<body>
    <!-- Search for actors/movies -->
    Search for actors/movies
    <form action="./search.php" method="GET">
        Search:
        <input type="text" name="keyword" />
        <input type="submit" value="Search" />
    </form>
    <hr />

    <?php
    if (!isset($_GET["keyword"]) || $_GET["keyword"] === "")
        die("No keyword(s) entered.");

    $db = mysql_connect("localhost", "cs143", "");
    if (!$db)
        die("Unable to connect to database: " . mysql_error());

    $db_selected = mysql_select_db("CS143", $db);
    if (!$db_selected)
        die("Unable to select database: " . mysql_error());

    $keywords = explode(" ", $_GET["keyword"]);
    echo "You searched for \"" . $_GET["keyword"] . "\"";

    // Actors matching keywords
    $query = "SELECT * FROM Actor WHERE";
    for ($i = 0; $i < count($keywords) - 1; $i++)
    {
        $safe = mysql_real_escape_string($keywords[$i]);
        $query .= " (first LIKE '%" . $safe . "%' OR last LIKE '%" . $safe . "%') AND";
    }
    $safe = mysql_real_escape_string($keywords[count($keywords) - 1]);
    $query .= " (first LIKE '%" . $safe . "%' OR last LIKE '%" . $safe . "%')";
    $query .= " ORDER BY first";

    if (!$result = mysql_query($query))
        die("Error executing query: " . mysql_error());
    if (mysql_num_rows($result) === 0)
        echo "<h4>No matching actors found.</h4>\n";
    else
        echo "<h4>Found actors:</h4>\n";
    //echo "$query<br/>";

    while ($row = mysql_fetch_assoc($result))
    {
        $name = "$row[first] $row[last]";
        $aid = $row["id"];
        echo "<a href=\"./show_actor_info.php?aid=$aid\">$name</a>";
        echo "<br />\n";
    }
    mysql_free_result($result);

    // Movies matching keywords
    $query = "SELECT * FROM Movie WHERE";
    for ($i = 0; $i < count($keywords) - 1; $i++)
    {
        $safe = mysql_real_escape_string($keywords[$i]);
        $query .= " (title LIKE \"%" . $safe . "%\") AND";
    }
    $safe = mysql_real_escape_string($keywords[count($keywords) - 1]);
    $query .= " (title LIKE \"%" . $safe . "%\")";
    $query .= " ORDER BY title";

    if (!$result = mysql_query($query))
        die("Error executing query: " . mysql_error());
    if (mysql_num_rows($result) === 0)
        echo "<h4>No matching movies found.</h4>\n";
    else
        echo "<h4>Found movies:</h4>\n";
    //echo "$query<br/>";

    while ($row = mysql_fetch_assoc($result))
    {
        $title = $row["title"];
        $year = $row["year"];
        $mid = $row["id"];
        echo "<a href=\"./show_movie_info.php?mid=$mid\">$title ($year)</a>";
        echo "<br />\n";
    }
    mysql_free_result($result);
    mysql_close($db);
    ?>
</body>
</html>
