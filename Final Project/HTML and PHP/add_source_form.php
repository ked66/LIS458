<?php
$host='canary.simmons.edu';
$user='dillonk2';
$password='4001755';
$database='lis458olfa22_dillonk2_project';

$con=
mysqli_connect($host,$user,$password,$database)
	or die ("Couldn't connect to server");

$sql_getAuthors = "SELECT author_id, CONCAT (author_name, ' (', author_birth, '-', author_death, ')') as 'Author'
FROM authors";

$result_authors = mysqli_query($con, $sql_getAuthors);

echo "<html>
	<head>
		<title>Add Source</title>
		<link rel='stylesheet' href='style.css'>
	</head>
	<body>
		<div class='topnav'>
			<a href='index.html'>Home</a>
			<a href='browse.php'>Browse</a>
			<a href='search.php'>Search</a>
			<div class='dropdown'>
				<button href='#add' class='dropbtn'>Update
					<i class='fa fa-caret-down'></i>
				</button>
				<div class='drop-content'>
					<a href='add_author_form.html'>Add Author</a>
					<a href='add_source_form.php'>Add Source</a>
					<a href='modify_source_form.php'>Modify Source</a>
					<a href='delete_source_form.php'>Delete Source</a>
				</div>
			</div>
		</div>
					<h1>Add a Source</h1>
					<form action='add_source.php' method='post'>";

echo "Source Title: <input type='text' name='source_title'/><br><br>
			Place of Publication: <input type='text' name='source_pub_place'/><br><br>
			Edition: <input type='text' name='source_edition'/><br><br>
			Primary Language: <input type='text' name='source_language'/><br><br>
			Year of Publication (YYYY, if known): <input type='text' name='source_year'/><br><br>";


echo "<label for='author'>Select Source Author: </label>
<select id='author' name='author'>";

while($row = mysqli_fetch_array($result_authors))
  {
		echo "<option value=".$row['author_id'].">".$row['Author']."</option>";
	}

echo "</select>";

echo "<input type='submit'/>
			</form>
		</body>
	</html>";

mysqli_close($con);
?>
