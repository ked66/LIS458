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
				<title>Browse Herbs</title>
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

if ($_POST[browse_herb]=='all') {
	$sql="SELECT herbs.herb_scientific_name as 'Herb',
	CONCAT (authors.author_name, ' (', authors.author_birth, '-', authors.author_death, ')') as 'Author',
	CONCAT(sources.source_title, ' (', sources.source_year, '), ', sources.source_pub_place, '. Written in ', sources.source_language) as 'Source',
	CONCAT(instances.instance_text, ' (', instances.instance_pgnumber, ')') as 'Instance'
	FROM herbs
	LEFT JOIN common_names on herbs.herb_id = common_names.herb_id
	LEFT JOIN instances on common_names.common_id = instances.common_id
	LEFT JOIN sources on instances.source_id = sources.source_id
	LEFT JOIN sources_authors ON sources.source_id = sources_authors.source_id
	LEFT JOIN authors on sources_authors.author_id = authors.author_id
	ORDER BY Herb";
} else {
	$sql="SELECT herbs.herb_scientific_name as 'Herb',
	CONCAT (authors.author_name, ' (', authors.author_birth, '-', authors.author_death, ')') as 'Author',
	CONCAT(sources.source_title, ' (', sources.source_year, '), ', sources.source_pub_place, '. Written in ', sources.source_language) as 'Source',
	CONCAT(instances.instance_text, ' (', instances.instance_pgnumber, ')') as 'Instance'
	FROM herbs
	LEFT JOIN common_names on herbs.herb_id = common_names.herb_id
	LEFT JOIN instances on common_names.common_id = instances.common_id
	LEFT JOIN sources on instances.source_id = sources.source_id
	LEFT JOIN sources_authors ON sources.source_id = sources_authors.source_id
	LEFT JOIN authors on sources_authors.author_id = authors.author_id
	WHERE herb.herb_id = $_POST[browse_herb]
	ORDER BY Author";
}

$result = mysqli_query($con, $sql);

$herb = "";
$source = "";

while($row = mysqli_fetch_array($result))
  {
		if ($row['Herb'] == $herb) {
			if ($row['Source'] == $source){
				echo "<p>".$row['Instance']."</p>";
			} else {
				$source = $row['Source'];
				echo "<h3>".$row['Source'];
				if ($row['Author']){
					echo " by ".$row['Author'];
				}
				echo "</h3>";
				echo "<p>".$row['Instance']."</p>";
			}

		} else {
			$herb = $row['Herb'];
			echo "<h2>".$row['Herb']."</h2>";
			echo "<p><a href='herb_page.php?herb=".str_replace(' ', '', $row['Herb'])."'>Read more about this Herb</a></p>";
			$source = $row['Source'];
			echo "<h3>".$row['Source'];
			if ($row['Author']){
				echo " by ".$row['Author'];
			}
			echo "</h3>";
			echo "<p>".$row['Instance']."</p>";
		}
	}

echo "</body></html>";

mysqli_close($con);

?>
