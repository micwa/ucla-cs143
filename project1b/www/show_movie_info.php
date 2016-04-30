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
    if (is_null($row["rating"]))
        echo "MPAA Rating: N/A<br />\n";
    else
        echo "MPAA Rating: $row[rating]<br />\n";
    if (is_null($row["company"]))
        echo "Company: N/A<br />\n";
    else
        echo "Company: $row[company]<br />\n";
    mysql_free_result($result);

    $query = "SELECT * FROM MovieDirector
    INNER JOIN Director ON Director.id = MovieDirector.did
    WHERE mid=" . $mid;
    if (!$result = mysql_query($query))
        die("Error executing query: " . mysql_error());
    $directors = "Director: ";
    for ($i = 0; $i < mysql_num_rows($result) - 1; $i++)
    {
        $row = mysql_fetch_assoc($result);
        $name = "$row[first] $row[last]";
        $directors .= "$name, ";
    }
    $row = mysql_fetch_assoc($result);
    $name = "$row[first] $row[last]";
    $directors .= "$name<br />\n";
    echo "$directors";
    mysql_free_result($result);


    // MovieGenre info
    $query = "SELECT genre FROM MovieGenre
              WHERE mid=" . $mid;
    if (!$result = mysql_query($query))
        die("Error executing query: " . mysql_error());
    $genres = "Genre: ";
     for ($i = 0; $i < mysql_num_rows($result) - 1; $i++)
    {
        $row = mysql_fetch_assoc($result);
        $genres .= "$row[genre], ";
    }
    $row = mysql_fetch_assoc($result);
    $genres .= "$row[genre]";
    echo "$genres<br /> \n";
    mysql_free_result($result);

    //MovieActor info
    $queryMA = "SELECT aid, role, first, last FROM MovieActor
              INNER JOIN Actor ON MovieActor.aid = Actor.id
              WHERE mid=" . $mid;
    if (!$resultMA = mysql_query($queryMA))
        die("Error executing query: " . mysql_error());
    echo "<h4>Cast:</h4>\n";
    echo "<table border=1 cellspacing=1 cellpadding=2>\n";
    echo "<tr align=center>";
    echo "<td><b>Actor </b></td>";
    echo "<td><b>Role</b></td>";
    echo "</tr>\n";
    while ($row = mysql_fetch_assoc($resultMA)) {
        echo "<tr align=center>";
        $aid = "$row[aid]";
        $name = "$row[first] $row[last]";
        $role = $row["role"];
        echo "<td><a href=\"./show_actor_info.php?aid=$aid\">$name</a></td>";
        echo "<td>$role</td>";
        echo "</tr>\n";
    }    
    echo "</table>\n";
    mysql_free_result($resultMA);
    echo "<hr> \n";
    mysql_close($db);
    ?>
</body>
</html>
