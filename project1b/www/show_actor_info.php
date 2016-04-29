<html>
<head>
    <title>CS143 - Project 1B - Show actor info</title>
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
    if (!isset($_GET["aid"]) || $_GET["aid"] === "")
        die("No actor entered.");

    $db = mysql_connect("localhost", "cs143", "");
    if (!$db)
        die("Unable to connect to database: " . mysql_error());

    $db_selected = mysql_select_db("CS143", $db);
    if (!$db_selected)
        die("Unable to select database: " . mysql_error());

    $aid = (int) $_GET["aid"];

    // Actor info
    $query = "SELECT * FROM Actor WHERE id=" . $aid;
    if (!$result = mysql_query($query))
        die("Error executing query: " . mysql_error());
    if (mysql_num_rows($result) != 1)
        die("No actor/actress with aid=$aid found.");

    $row = mysql_fetch_assoc($result);
    echo "<h3> $row[first] $row[last]</h3>\n";
    echo "Sex: $row[sex]<br />\n";
    echo "Date of birth: $row[dob]<br />\n";
    if (is_null($row["dod"]))
        echo "Date of death: N/A<br />\n";
    else
        echo "Date of death: $row[dod]<br />\n";

    mysql_free_result($result);

    // MovieActor info
    $query = "SELECT mid, role, title FROM MovieActor
              INNER JOIN Movie ON MovieActor.mid = Movie.id
              WHERE aid=" . $aid;
    if (!$result = mysql_query($query))
        die("Error executing query: " . mysql_error());

    echo "<h4>Has acted in:</h4>\n";
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
