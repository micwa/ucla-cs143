<html>
<head>
    <title>CS143 - Project 1B - Show movie info</title>
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
    if (!isset($_GET["mid"]) || $_GET["mid"] === "")
        die("No movie entered.");

    $db = mysql_connect("localhost", "cs143", "");
    if (!$db)
        die("Unable to connect to database: " . mysql_error());

    $db_selected = mysql_select_db("CS143", $db);
    if (!$db_selected)
        die("Unable to select database: " . mysql_error());

    $mid = (int) $_GET["mid"];

    $query = "SELECT * FROM Movie WHERE id=" . $mid;
    if (!$result = mysql_query($query))
        die("Error executing query: " . mysql_error());
    if (mysql_num_rows($result) != 1)
        die("No movie with mid=$mid found.");

    $row = mysql_fetch_assoc($result);
    echo "<h3> $row[title]</h3>\n";
    if (is_null($row[rating]))
        echo "MPAA rating: N/A<br />\n";
    else
        echo "MPAA rating: $row[rating]<br />\n";
    if (is_null($row[company]))
        echo "Company: N/A<br />\n";
    else
        echo "Company: $row[company]<br />\n";

    mysql_free_result($result);

    // MovieActor info
    $query = "SELECT genre FROM MovieGenre
              INNER JOIN Movie ON MovieGenre.mid = Movie.id
              WHERE mid=" . $mid;
    if (!$result = mysql_query($query))
        die("Error executing query: " . mysql_error());

    echo "<table border=1 cellspacing=1 cellpadding=2>\n";
    echo "<tr align=center>";
    echo "<td><b>Movie</b></td>";
    echo "<td><b>Role</b></td>";
    echo "</tr>\n";
    while ($row = mysql_fetch_assoc($result)) {
        echo "<tr align=center>";
        $mid = $row["mid"];
        $role = $row["role"];
        $title = $row["title"];
        echo "<td><a href=\"./show_movie_info.php?mid=$mid\">$title</a></td>";
        echo "<td>$role</td>";
        echo "</tr>\n";
    }    
    echo "</table>\n";

    mysql_free_result($result);
    mysql_close($db);
    ?>
</body>
</html>
