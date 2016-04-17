<html> 
	
	<head>
		<title>CS 143 - Project 1A</title>
  	</head>

 	<body>
 		<header>
 			<h1>CS 143 Project 1A</h1>
		</header>

 		<h2>By Michael Wang and Lauren Yeung</h2>
 		<h6> The most beautiful webpage you'll ever find.</h6>
 		<p> Please do not run complex queries on the server or else.</p>
 		<p>
 			<form action="" method="GET">
				<textarea name="query" cols="60" rows="8"></textarea><br />
				<input type="submit" value="Submit" />
			</form>
			<?php
				$db_connection = mysql_connect("localhost", "cs143", "");
				// if(!(isset($_GET["query"])) || $_GET["query"]===""){
				// 	die("No query.");
				// }

				// mysql_select_db("CS143", $db);
				// $param = $_GET['query'];
				// if(empty($param)){
				// 	echo "Please type in a query!";
				// }
				// else{
				// 	echo $param;
				// }
				if (!isset($_GET["query"]) || $_GET["query"] === "") {
				    die("No query entered.");
				}

				$db = mysql_connect("localhost", "cs143", "");
				if (!$db)
				    die("Unable to connect to database: " . mysql_error());

				$db_selected = mysql_select_db("CS143", $db);
				if (!$db_selected)
				    die("Unable to select database: " . mysql_error());

				$sql = $_GET["query"];
				if (!$result = mysql_query($sql))
				    die("Error executing query.");

				echo "<h4>Results:</h4>";
				$fields = array();
				echo "<table border=1 cellspacing=1 cellpadding=2><br/>";
				echo "<tr align=center>";
				 for($i=0; $i<mysql_num_fields($result); $i++){
				 	$field = mysql_fetch_field($result,$i);
				 	
				 	echo "<td><b>" . $field->name . "</b></td>";

					$fields[$i] = $field->name;
				}
				echo "</tr>";
				while ($row = mysql_fetch_assoc($result)){
					echo "<tr align=center>";
					for($j = 0; $j < count($fields); $j++){
						echo "<td>" . $row[$fields[$j]] . "</td>";
					}
					echo "</tr>\n";
					
				}	
				echo "</table>";
				mysql_free_result($result);
				mysql_close($db_connection);
			?>
		</p>
 	<!-- relative urls 
 	connect to db "CS143" with user "cs143" and empty pass -->

	 </body>

 </html>