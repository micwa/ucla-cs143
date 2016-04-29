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

        $sql = $_GET["keyword"];
        if (!$result = mysql_query($sql))
            die("Error executing query: " . mysql_error());

        ?>
</body>
</html>
