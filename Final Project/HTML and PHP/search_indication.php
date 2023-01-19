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

$sql_getIndications = "SELECT indications.indication_mesh_name as 'indication'
FROM indications
WHERE LOWER(indications.indication_mesh_name)
LIKE CONCAT('%', LOWER('$_POST[indication_name]'), '%')";

$result = mysqli_query($con, $sql_getIndications);

while($row = mysqli_fetch_array($result)) {
	echo "<h2>".$row['indication']."</h2>";
	echo "<p><a href='indication_page.php?indication=".str_replace(' ', '', $row['indication'])."'>Read more about this Indication</a></p>";
}

echo "</body></html>";

mysqli_close($con);

?>
