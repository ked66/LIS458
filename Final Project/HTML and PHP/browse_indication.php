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
				<title>Browse Indications</title>
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

if ($_POST[browse_indication]=='all') {
	$sql="SELECT indications.indication_mesh_name as 'Indication',
	CONCAT (authors.author_name, ' (', authors.author_birth, '-', authors.author_death, ')') as 'Author',
	CONCAT(sources.source_title, ' (', sources.source_year, '), ', sources.source_pub_place, '. Written in ', sources.source_language) as 'Source',
	CONCAT(instances.instance_text, ' (', instances.instance_pgnumber, ')') as 'Instance'
	FROM indications
	LEFT JOIN instances on indications.indication_mesh_id = instances.indication_mesh_id
	LEFT JOIN sources on instances.source_id = sources.source_id
	LEFT JOIN sources_authors ON sources.source_id = sources_authors.source_id
	LEFT JOIN authors on sources_authors.author_id = authors.author_id
	ORDER BY Indication";
} else {
	$sql="SELECT indications.indication_mesh_name as 'Indication',
	CONCAT (authors.author_name, ' (', authors.author_birth, '-', authors.author_death, ')') as 'Author',
	CONCAT(sources.source_title, ' (', sources.source_year, '), ', sources.source_pub_place, '. Written in ', sources.source_language) as 'Source',
	CONCAT(instances.instance_text, ' (', instances.instance_pgnumber, ')') as 'Instance'
	FROM indications
	LEFT JOIN instances on indications.indication_mesh_id = instances.indication_mesh_id
	LEFT JOIN sources on instances.source_id = sources.source_id
	LEFT JOIN sources_authors ON sources.source_id = sources_authors.source_id
	LEFT JOIN authors on sources_authors.author_id = authors.author_id
	WHERE indication.indication_mesh_id = $_POST[browse_indication]
	ORDER BY Indication";
}

$result = mysqli_query($con, $sql);

$indication = "";
$source = "";

while($row = mysqli_fetch_array($result))
  {
		if ($row['Indication'] == $indication) {
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
			$indication = $row['Indication'];
			echo "<h2>".$row['Indication']."</h2>";
			echo "<p><a href='indication_page.php?indication=".str_replace(' ', '', $row['Indication'])."'>Read more about this Indication</a></p>";
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
