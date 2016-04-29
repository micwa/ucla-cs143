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
        echo "MPAA Rating: N/A<br />\n";
    else
        echo "MPAA Rating: $row[rating]<br />\n";
    if (is_null($row[company]))
        echo "Company: N/A<br />\n";
    else
        echo "Company: $row[company]<br />\n";

    mysql_free_result($result);

    // MovieGenre info
    $query = "SELECT genre FROM MovieGenre
              INNER JOIN Movie ON MovieGenre.mid = Movie.id
              WHERE mid=" . $mid;
    if (!$result = mysql_query($query))
        die("Error executing query: " . mysql_error());
    echo "Genre: ";
    while ($row = mysql_fetch_assoc($result)
    {
        echo "$genre ;"
    }
    echo " <br />\n";

    echo "Genre: $genre <br />\n";
    mysql_free_result($result);

    //MovieActor info
    $queryMA = "SELECT aid, role FROM MovieActor
              INNER JOIN Movie ON MovieActor.mid = Movie.id
              WHERE mid=" . $mid;
    if (!$resultMA = mysql_query($queryMA))
        die("Error executing query: " . mysql_error());
    while ($rowMA = mysql_fetch_assoc($resultMA)){
        $aid = $rowMA["aid"];
        $role = $rowMA["role"];
        $queryA = "SELECT first,last FROM Actor WHERE id=" . $aid;
        if (!$resultA = mysql_query($queryA))
            die("Error executing query: " . mysql_error());
        $rowA = mysql_fetch_assoc($resultA);
        echo "$rowA[first] $rowA[last] act as '$role'";
    }


    mysql_free_result($resultMA);
    mysql_free_result($resultA);



       
   

    mysql_free_result($result);
    mysql_close($db);
    ?>
</body>
</html>
