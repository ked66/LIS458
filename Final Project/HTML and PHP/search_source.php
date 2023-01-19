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
					<title>Search Results</title>
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

if ($_POST[source_pub]=='all'){
  if ($_POST[source_lang] == 'all'){
    $sql_getSources = "SELECT CONCAT(sources.source_title, ' (', sources.source_year, '), ', sources.source_pub_place, '. Written in ', sources.source_language) as 'Source',
		sources.source_id
      FROM sources
      WHERE LOWER(sources.source_title) LIKE CONCAT('%', LOWER('$_POST[source_title]'), '%')";
  } else {
    $sql_getSources = "SELECT CONCAT(sources.source_title, ' (', sources.source_year, '), ', sources.source_pub_place, '. Written in ', sources.source_language) as 'Source',
		sources.source_id
      FROM sources
      WHERE LOWER(sources.source_title) LIKE CONCAT('%', LOWER('$_POST[source_title]'), '%')
      AND replace(sources.source_language, ' ', '') = '$_POST[source_lang]'";
  }
} else {
  if ($_POST[source_lang] == 'all'){
    $sql_getSources = "SELECT CONCAT(sources.source_title, ' (', sources.source_year, '), ', sources.source_pub_place, '. Written in ', sources.source_language) as 'Source',
		sources.source_id
      FROM sources
      WHERE LOWER(sources.source_title) LIKE CONCAT('%', LOWER('$_POST[source_title]'), '%')
      AND replace(sources.source_pub_place, ' ', '') = '$_POST[source_pub]'";
  } else {
    $sql_getSources = "SELECT CONCAT(sources.source_title, ' (', sources.source_year, '), ', sources.source_pub_place, '. Written in ', sources.source_language) as 'Source',
		sources.source_id
      FROM sources
      WHERE LOWER(sources.source_title) LIKE CONCAT('%', LOWER('$_POST[source_title]'), '%')
      AND replace(sources.source_pub_place, ' ', '') = '$_POST[source_pub]'
      AND replace(sources.source_language, ' ', '') = '$_POST[source_lang]'";
  }
}

$result = mysqli_query($con, $sql_getSources);

while($row = mysqli_fetch_array($result)) {
	echo "<h2>".$row['Source']."</h2>";
	echo "<p><a href = 'source_page.php?source=".$row['source_id']."'>Learn more about this source.</a></p>";
}

echo "</body></html>";

mysqli_close($con);

?>
