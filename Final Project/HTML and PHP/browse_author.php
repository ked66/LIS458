<?php
$host='canary.simmons.edu';
$user='dillonk2';
$password='4001755';
$database='lis458olfa22_dillonk2_project';

$con=
mysqli_connect($host,$user,$password,$database)
	or die ("Couldn't connect to server");

echo "<html>
			<head>
				<title>Browse Authors</title>
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
				</div>";

if ($_POST[browse_author]=='all') {
	$sql="SELECT CONCAT (authors.author_name, ' (', authors.author_birth, '-', authors.author_death, ')') as 'Author',
	CONCAT(sources.source_title, ' (', sources.source_year, '), ', sources.source_pub_place, '. Written in ', sources.source_language) as 'Source'
	FROM authors
	LEFT JOIN sources_authors ON authors.author_id = sources_authors.author_id
	LEFT JOIN sources on sources_authors.source_id = sources.source_id
	ORDER BY Author";
} else {
	$sql="SELECT CONCAT (authors.author_name, ' (', authors.author_birth, '-', authors.author_death, ')') as 'Author',
	CONCAT(sources.source_title, ' (', sources.source_year, '), ', sources.source_pub_place, '. Written in ', sources.source_language) as 'Source'
	FROM authors
	LEFT JOIN sources_authors ON authors.author_id = sources_authors.author_id
	LEFT JOIN sources on sources_authors.source_id = sources.source_id
	WHERE authors.author_id = '$_POST[browse_author]'
	ORDER BY Author";
}

$result = mysqli_query($con, $sql);

$author = "";

while($row = mysqli_fetch_array($result))
  {
		if ($row['Author'] == $author) {
			echo "<p>".$row['Source']."</p>";
		} else {
			$author = $row['Author'];
			echo "<h2>".$row['Author']."</h2>
						<p>".$row['Source']."</p>";
		}
	}

echo "</body></html>";

mysqli_close($con);

?>
