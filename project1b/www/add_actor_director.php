<html>
<head>
    <title>CS143 - Project 1B - Add actor/director</title>
</head>
<body>
    <?php
    $first = $_POST["first"];
    $last = $_POST["last"];
    $dob = $_POST["dob"];
    $dod = $_POST["dod"];
    $identity = $_POST["identity"];
    $sex = $_POST["sex"];

    if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($first) && !empty($last) && !empty($dob))
    {
        $db = mysql_connect("localhost", "cs143", "");
        if (!$db)
            die("Unable to connect to database: " . mysql_error());

        $db_selected = mysql_select_db("CS143", $db);
        if (!$db_selected)
            die("Unable to select database: " . mysql_error());

        // Set up variables
        $first = "'" . mysql_real_escape_string($first). "'";
        $last = "'" . mysql_real_escape_string($last) . "'";
        $sex = "'" . mysql_real_escape_string($sex) . "'";
        $dob = "'" . mysql_real_escape_string($dob) . "'";
        if (!empty($dod))
            $dod = "'" . mysql_real_escape_string($dod) . "'";
        else
            $dod = "NULL";

        // Get id
        $query = "SELECT id FROM MaxPersonID";
        if (!$result = mysql_query($query))
            die("Error executing query: " . mysql_error());

        $row = mysql_fetch_assoc($result);
        $old_id = $row["id"];
        $id = $old_id + 1;
        mysql_free_result($result);

        // START TRANSACTION
        mysql_query("START TRANSACTION");
        $commit = true;

        // Insert new max person id
        $query = "UPDATE MaxPersonID SET id=$id WHERE id=$old_id";
        if (!$result = mysql_query($query))
            $commit = false;

        if ($identity === "Actor")
        {
            // Insert into Actor
            $query = "INSERT INTO Actor (id, last, first, sex, dob, dod) VALUES (";
            $query .= "$id, $last, $first, $sex, $dob, $dod)";
            if (!$result = mysql_query($query))
                $commit = false;
        }
        else
        {
            // Insert into Director
            $query = "INSERT INTO Director (id, last, first, dob, dod) VALUES (";
            $query .= "$id, $last, $first, $dob, $dod)";
            if (!$result = mysql_query($query))
                $commit = false;
        }

        // COMMIT/ROLLBACK TRANSACTION
        if ($commit)
        {
            echo "Added $first $last (id=$id) to the database.\n";
            echo "<hr />\n";
            mysql_query("COMMIT");
        }
        else
        {
            echo "Error adding $first $last to the database.";
            echo "<hr />\n";
            mysql_query("ROLLBACK");
        }

        mysql_close($db);
    }
    else if ($_SERVER["REQUEST_METHOD"] === "POST")
    {
        echo "Must input at least a first name, last name, and date of birth.\n";
        echo "<hr />\n";
    }
    ?>
    <p>Add a new actor/director:</p>
    <form action="./add_actor_director.php" method="POST">
        Identity: <input type="radio" name="identity" value="Actor" checked="true">Actor
        <input type="radio" name="identity" value="Director">Director<br />
        <hr />
        First Name: <input type="text" name="first" maxlength="20"><br />
        Last Name:  <input type="text" name="last" maxlength="20"><br />
        Sex: <input type="radio" name="sex" value="Male" checked="true">Male
        <input type="radio" name="sex" value="Female">Female<br />
        Date of Birth:  <input type="text" name="dob"><br />
        Date of Death:  <input type="text" name="dod"><br />
        <input type="submit" value="Add person"/>
    </form>
</body>
</html>
