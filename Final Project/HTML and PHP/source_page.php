<?php
$host='canary.simmons.edu';
$user='dillonk2';
$password='4001755';
$database='lis458olfa22_dillonk2_project';

$con=
mysqli_connect($host,$user,$password,$database)
	or die ("Couldn't connect to server");

$sql = "SELECT DISTINCT	indications.indication_mesh_name as 'indication', herbs.herb_scientific_name as 'herb',
	sources.source_title as 'Title', sources.source_language, sources.source_pub_place,
	instances.instance_text as 'Instance'
  FROM sources
  LEFT JOIN instances ON sources.source_id = instances.source_id
  LEFT JOIN common_names ON instances.common_id = common_names.common_id
  LEFT JOIN herbs ON common_names.herb_id = herbs.herb_id
  LEFT JOIN indications ON instances.indication_mesh_id = indications.indication_mesh_id
  WHERE sources.source_id = '$_GET[source]'";

$result = mysqli_query($con, $sql);

$sql_authors = "SELECT DISTINCT sources.source_title as 'Title', sources.source_year, authors.author_name,
sources_authors.source_author_note, authors.author_birth, authors.author_death, authors.author_nationality
FROM sources
LEFT JOIN sources_authors ON sources.source_id = sources_authors.source_id
LEFT JOIN authors ON sources_authors.author_id = authors.author_id
WHERE sources.source_id = '$_GET[source]'";

$result_authors = mysqli_query($con, $sql_authors);

echo "<html>
  <head>
    <title>Source | ".$_GET[source]."</title>
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


$herb = "start";
$indication = "start";
$instance = "start";

$count = 0;

while($row = mysqli_fetch_array($result_authors)){
  if ($count == 0) {
    echo "<h1>".$row['Title']." (".$row['source_year'].")</h1>";
    echo "<h3>Author(s):</h3><ul>";
  }

  echo "<li><strong>".$row['source_author_note']."</strong> ".$row['author_name'];

  if ($row['author_birth'] == $row['author_death']){
      echo " (".$row['author_birth'].") <em>".$row['author_nationality']."</em></li>";
    } else {
      echo " (".$row['author_birth']."-".$row['author_death'].") <em>".$row['author_nationality']."</em></li>";
    }

  $count = $count + 1;
}

echo "</ul>";

$count = 0;

while($row = mysqli_fetch_array($result)){

  if ($count == 0) {
    echo "<h3>Place of Publication</h3><p>".$row['source_pub_place'];
    echo "<h3>Original Language of Publication</h3>".$row['source_language'];

    $count = $count + 1;
  }

  if ($row['herb'] != $herb and $row['herb'] != Null) {
      $herb = $row['herb'];
      echo "</ul><h2>".$row['herb']."</h2>";
    }

  if ($row['indication'] != $indication and $row['indication'] != Null){
      $indication = $row['indication'];
      echo "</ul><h3>".$row['indication']."</h3><ul>";
    }

  if ($row['Instance'] != $instance and $row['Instance'] != Null){
            echo "<li>".$row['Instance']."</li>";
        }
  }

  echo "</body></html>";

  mysqli_close($con);

  ?>
