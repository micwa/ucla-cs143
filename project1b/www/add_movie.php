<html>
<head>
	<title>CS143 - Project 1B - Add movie</title>
</head>
<body>
	<?php
	$id = $_POST["id"];
	$title = $_POST["title"];
	$year = $_POST["year"];
	$rating = $_POST["rating"];
	$company = $_POST["company"];

	?>


	
	Add new movie: <br/>
	<form action="" method="GET">			
		Title : <input type="text" name="title" maxlength="20"><br/>
		Compnay: <input type="text" name="company" maxlength="50"><br/>
		Year : <input type="text" name="year" maxlength="4"><br/>	<!-- Todo: validation-->	
		MPAA Rating : <select name="mpaarating">
		<option value="G">G</option>
		<option value="NC-17">NC-17</option>
		<option value="PG">PG</option>
		<option value="PG-13">PG-13</option>
		<option value="R">R</option>
		<option value="surrendere">surrendere</option>
	</select>
	<br/>
	Genre : 
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
	
	<br/>
	
	<input type="submit" value="Add it!!"/>
</form>
<hr/>

</body>
</html>
