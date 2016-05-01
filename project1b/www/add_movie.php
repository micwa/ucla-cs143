<html>
<head>
	<title>CS143 - Project 1B - Add movie</title>
    <link href="./bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color:#add8e6">
<div class="container">
    <?php
    $title = $_POST["title"];
    $did = $_POST["did"];
    $year = $_POST["year"];
    $rating = $_POST["rating"];
    $company = $_POST["company"];
    $imdb = $_POST["imdb"];
    $rot = $_POST["rot"];
    $tickets = $_POST["tickets"];
    $income = $_POST["income"];

    if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($title) && !empty($year))
    {
        $db = mysql_connect("localhost", "cs143", "");
        if (!$db)
            die("Unable to connect database: " . mysql_error());

        $db_selected = mysql_select_db("CS143", $db);
        if (!$db_selected)
            die("Unable to select databse: " . mysql_error());

        $id = (int) $id;
        $title = "'" . mysql_real_escape_string($title) . "'";
        $did = (int) $did;
        $year = (int) $year;
        if (!empty($rating))
            $rating = "'" . mysql_real_escape_string($rating) . "'";
        else
            $rating = "NULL";
        if (!empty($company))
            $company = "'" . mysql_real_escape_string($company) . "'";
        else
            $company= "NULL";
        if (!empty($imdb))
            $imdb = (int) $imdb;
        else
            $imdb = "NULL";
        if (!empty($rot))
            $rot = (int) $rot;
        else
            $rot = "NULL";
        if (!empty($tickets))
            $tickets = (int) $tickets;
        else
            $tickets = "NULL";
        if (!empty($income))
            $income = (int) $income;
        else
            $income = "NULL";

        // Get id
        $query = "SELECT id FROM MaxMovieID";
        if (!$result = mysql_query($query))
            die("Error executing query: ". mysql_error());
        $row = mysql_fetch_assoc($result);
        $old_id = $row["id"];
        $id = $old_id + 1;
        mysql_free_result($result);

        // START TRANSACTION
        mysql_query("START TRANSACTION");
        $commit = true;
        $query = "UPDATE MaxMovieID SET id=$id WHERE id=$old_id";
        if (!$result = mysql_query($query))
            $commit = false;

        // Insert Movie
        $query = "INSERT INTO Movie (id, title, year, rating, company) VALUES (";
        $query .= "$id, $title, $year, $rating, $company)";
        if (!$result = mysql_query($query))
            $commit = false;

        // Insert MovieGenre
        $genreOptions = ["Action", "Adult", "Adventure", "Animation", "Comedy", "Crime",
            "Documentary", "Drama", "Family", "Fantasy", "Horror", "Musical",
            "Mystery", "Romance", "Sci-Fi", "Short", "Thriller", "War", "Western"];
        for ($i = 0; $i < count($genreOptions); $i++)
        {
            $genre = $genreOptions[$i];
            if (isset($_POST["genre_" . $genre]))
            {
                $query = "INSERT INTO MovieGenre (mid,genre) VALUES (";
                $query .= "$id, '$genre')";
                if (!$result = mysql_query($query))
                    $commit = false;
            } 
        }

        // Insert MovieRating
        $query = "INSERT INTO MovieRating (mid, imdb, rot) VALUES (";
        $query .= "$id, $imdb, $rot)";
        if (!$result = mysql_query($query))
            $commit = false;

        // Insert Sales
        $query = "INSERT INTO Sales (mid, ticketsSold, totalIncome) VALUES (";
        $query .= "$id, $tickets, $income)";
        if (!$result = mysql_query($query))
            $commit = false;

        // COMMIT/ROLLBACK TRANSACTION
        if ($commit)
        {
            echo "Added a movie to the database.\n";
            echo "<hr />\n";
            mysql_query("COMMIT");
        } 
        else
        {
            echo "Error adding a movie to the database.";
            echo "<hr />\n";
            mysql_query("ROLLBACK");
        }
        mysql_close($db);
    }
    else if ($_SERVER["REQUEST_METHOD"] === "POST")
    {
        echo "Must input at least a title and year.\n";
        echo "<hr/>\n";
    }
    ?>
    <p>Add new movie:</p>
    <form action="" method="POST">			
        Title: <input type="text" name="title" maxlength="20"><br/>
        Year: <input type="text" name="year" maxlength="4"><br/>
        Company: <input type="text" name="company" maxlength="50"><br/>
        <br/>
        MPAA Rating: <select name="rating">
            <option value="G">G</option>
            <option value="NC-17">NC-17</option>
            <option value="PG">PG</option>
            <option value="PG-13">PG-13</option>
            <option value="R">R</option>
            <option value="surrendere">surrendere</option>
        </select><br/>
        Genre: 
        <input type="checkbox" name="genre_Action" value="Action">Action</input>
        <input type="checkbox" name="genre_Adult" value="Adult">Adult</input>
        <input type="checkbox" name="genre_Adventure" value="Adventure">Adventure</input>
        <input type="checkbox" name="genre_Animation" value="Animation">Animation</input>
        <input type="checkbox" name="genre_Comedy" value="Comedy">Comedy</input>
        <input type="checkbox" name="genre_Crime" value="Crime">Crime</input>
        <input type="checkbox" name="genre_Documentary" value="Documentary">Documentary</input>
        <input type="checkbox" name="genre_Drama" value="Drama">Drama</input>
        <input type="checkbox" name="genre_Family" value="Family">Family</input>
        <input type="checkbox" name="genre_Fantasy" value="Fantasy">Fantasy</input>
        <input type="checkbox" name="genre_Horror" value="Horror">Horror</input>
        <input type="checkbox" name="genre_Musical" value="Musical">Musical</input>
        <input type="checkbox" name="genre_Mystery" value="Mystery">Mystery</input>
        <input type="checkbox" name="genre_Romance" value="Romance">Romance</input>
        <input type="checkbox" name="genre_Sci-Fi" value="Sci-Fi">Sci-Fi</input>
        <input type="checkbox" name="genre_Short" value="Short">Short</input>
        <input type="checkbox" name="genre_Thriller" value="Thriller">Thriller</input>
        <input type="checkbox" name="genre_War" value="War">War</input>
        <input type="checkbox" name="genre_Western" value="Western">Western</input>
        <br/><br/>
        (Optional)<br/>
        IMDB Rating: <input type="text" name="imdb" maxlength="3"><br/>
        Rotten Tomatoes Rating: <input type="text" name="rot" maxlength="3"><br/>
        Tickets Sold: <input type="text" name="tickets" maxlength="11"><br/>
        Total Income: <input type="text" name="income" maxlength="11"><br/>
        <br/>
        <input type="submit" value="Add movie"/>
    </form>
</div>
</body>
</html>
