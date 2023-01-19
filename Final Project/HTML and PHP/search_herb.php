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

$sql_getHerbs = "SELECT herbs.herb_scientific_name as 'science', common_names.common_name as 'common'
FROM herbs
LEFT JOIN common_names
ON herbs.herb_id = common_names.herb_id
WHERE LOWER(herbs.herb_scientific_name) LIKE CONCAT('%', LOWER('$_POST[herb_name]'), '%')
UNION ALL
SELECT herbs.herb_scientific_name as 'science', common_names.common_name as 'common'
FROM herbs
RIGHT JOIN common_names
ON herbs.herb_id = common_names.herb_id
WHERE LOWER(common_names.common_name) LIKE CONCAT('%', LOWER('$_POST[herb_name]'), '%')";

$result = mysqli_query($con, $sql_getHerbs);

$scientific = "";

while($row = mysqli_fetch_array($result)) {
  if ($scientific == $row['science']) {
    echo " ".$row['common'].",";
  } else {
    $scientific = $row['science'];
    if ($scientific != "") {
      echo ")</h2>";
    }
    echo "<h2>".$row['science']." (".$row['common'].",";

  }
}

echo ")</h2>";

echo "</body></html>";

mysqli_close($con);

?>
