<html>
<head>
    <title>CS 143 - Project 1A</title>
</head>

<body>
    <header>
        <h1>CS 143 Project 1A</h1>
    </header>

    <h3>By Michael Wang and Lauren Yeung</h3>
    <h6>The most beautiful webpage you'll ever find.</h6>
    <p>Please do not run complex queries on the server or else.</p>
    <p>
        <form action="" method="GET">
            <textarea name="query" cols="60" rows="8"><?php if (isset($_GET["query"])) echo htmlspecialchars($_GET["query"]);?></textarea><br />
            <input type="submit" value="Submit" />
        </form>

        <?php
        if (!isset($_GET["query"]) || $_GET["query"] === "")
            die("No query entered.");

        $db = mysql_connect("localhost", "cs143", "");
        if (!$db)
            die("Unable to connect to database: " . mysql_error());

        $db_selected = mysql_select_db("CS143", $db);
        if (!$db_selected)
            die("Unable to select database: " . mysql_error());

        $sql = $_GET["query"];
        if (!$result = mysql_query($sql))
            die("Error executing query: " . mysql_error());

        // Print table with results
        echo "<h3>Results from MySQL:</h3>\n";
        echo "<table border=1 cellspacing=1 cellpadding=2>\n";
        echo "<tr align=center>";
        for ($i = 0; $i < mysql_num_fields($result); $i++) {
            $field = mysql_fetch_field($result, $i);
            echo "<td><b>" . $field->name . "</b></td>";
        }
        echo "</tr>\n";

        while ($row = mysql_fetch_row($result)) {
            echo "<tr align=center>";
            for ($i = 0; $i < mysql_num_fields($result); $i++) {
                $val = $row[$i];
                if (is_null($val))
                    $val = "N/A";
                echo "<td>" . htmlspecialchars($val) . "</td>";
            }
            echo "</tr>\n";
        }    
        echo "</table>\n";
        mysql_free_result($result);
        mysql_close($db);
        ?>
    </p>
</body>
</html>
