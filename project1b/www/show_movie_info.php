<html>
<head>
    <title>CS143 - Project 1B - Show movie info</title>
</head>
<body>
    <p>Temporary body for show_movie_info.php</p>

    <hr />
    <!-- Search for actors/movies -->
    Search for actors/movies
    <form action="./search.php" method="GET">
        Search:
        <input type="text" name="keyword" />
        <input type="submit" value="Search" />
    </form>
     <?php
        if (!isset($_GET["keyword"]) || $_GET["keyword"] === "")
            die("No query entered.");

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
            die("No actor/actress with mid=$mid found.");

        $row = mysql_fetch_assoc($result);
        echo "<h3> $row[title]</h3>\n";
        echo "Year: $row[sex]<br />\n";
        echo "Rating: $row[rating]<br />\n";
        echo "Company: $row[r]]company<br />\n";
        if (is_null($row[dod]))
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
