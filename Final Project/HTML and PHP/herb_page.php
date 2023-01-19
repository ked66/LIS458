<?php
$host='canary.simmons.edu';
$user='dillonk2';
$password='4001755';
$database='lis458olfa22_dillonk2_project';

$con=
mysqli_connect($host,$user,$password,$database)
	or die ("Couldn't connect to server");

$sql = "SELECT DISTINCT	indications.indication_mesh_name as 'indication', herbs.herb_scientific_name as 'herb', nccih_info.nccih_text as 'text',
  nccih_info.nccih_link as 'link',
	CONCAT(sources.source_title, ' - ', sources.source_year) as 'Source',
	instances.instance_text as 'Instance'
  FROM herbs
  LEFT JOIN nccih_info ON herbs.herb_id = nccih_info.herb_id
  LEFT JOIN indications ON nccih_info.indication_mesh_id = indications.indication_mesh_id
  LEFT JOIN instances ON indications.indication_mesh_id = instances.indication_mesh_id
  LEFT JOIN common_names ON herbs.herb_id = common_names.herb_id
  LEFT JOIN sources ON instances.source_id = sources.source_id
  WHERE replace(herbs.herb_scientific_name, ' ', '') = '$_GET[herb]'
  UNION
  SELECT DISTINCT indications.indication_mesh_name as 'indication', herbs.herb_scientific_name as 'herb', nccih_info.nccih_text as 'text',
    nccih_info.nccih_link as 'link',
  	CONCAT(sources.source_title, ' - ', sources.source_year) as 'Source',
  	instances.instance_text as 'Instance'
  FROM herbs
  LEFT JOIN common_names ON herbs.herb_id = common_names.herb_id
  LEFT JOIN instances ON common_names.common_id = instances.common_id
  LEFT JOIN indications ON instances.indication_mesh_id = indications.indication_mesh_id
  LEFT JOIN nccih_info ON instances.indication_mesh_id = nccih_info.indication_mesh_id
  LEFT JOIN sources ON instances.source_id = sources.source_id
  WHERE replace(herbs.herb_scientific_name, ' ', '') = '$_GET[herb]'";

$result = mysqli_query($con, $sql);


echo "<html>
  <head>
    <title>".$_GET[herb]."</title>
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


$indication = "start";

$count = 0;

while($row = mysqli_fetch_array($result)){
  if ($count == 0) {
    echo "<h1>".$row['herb']."</h1>";
    $count = $count + 1;
  }

  if ($indication != $row['indication'] and $row['indication'] != Null){
    $herb = $row['indication'];
    echo "<h2>".$row['indication']."</h2>";

    if ($row['text']){
      echo "<h3>What does the NCCIH say about ".$row['herb']." and ".$row['indication']."?</h3>";
      echo "<p>".$row['text']."<a href='".$row['link']."'> Read more.</a></p>";
    } else {
      echo "<h3>The NCCIH website does not have any information about ".$row['herb']." and ".$row['indication'].".</h3>";
    }

    if ($row['Instance']){
      echo "<h3>When has ".$row['herb']." been used for ".$row['indication']."?</h3>";
      echo "<p>".$row['Instance']." (".$row['Source'].")</p>";
    } else {
      echo "<h3>No historical uses of ".$row['herb']." for ".$row['indication']." are currently recorded in the database.</h3>";
    }

  } elseif ($indication == $row['indication']) {
      echo "<p>".$row['Instance']." (".$row['Source'].")</p>";

  }
}

  echo "</body></html>";

  mysqli_close($con);

  ?>
