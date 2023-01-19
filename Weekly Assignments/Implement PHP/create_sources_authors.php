<?php
$host='canary.simmons.edu';
$user='dillonk2';
$password='4001755';
$database='lis458olfa22_dillonk2_project';

$con=
mysqli_connect($host,$user,$password,$database)
	or die ("Couldn't connect to server");

$sql = "CREATE TABLE sources_authors
(
author_id INT(6) NOT NULL,
source_id INT(6) NOT NULL,
CONSTRAINT PK_sources_authors PRIMARY KEY (author_id, source_id),
FOREIGN KEY (author_id) REFERENCES authors(author_id),
FOREIGN KEY (source_id) REFERENCES sources(source_id)
)";

$result = mysqli_query($con, $sql)
  or die("Couldn't execute create");

echo "Table created successfully";

mysqli_close($con);

?>
