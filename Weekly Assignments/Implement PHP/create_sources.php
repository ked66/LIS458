<?php
$host='canary.simmons.edu';
$user='dillonk2';
$password='4001755';
$database='lis458olfa22_dillonk2_project';

$con=
mysqli_connect($host,$user,$password,$database)
	or die ("Couldn't connect to server");

$sql = "CREATE TABLE sources
(
source_id INT(6) NOT NULL AUTO_INCREMENT,
source_title varchar(255),
source_pub_place varchar(80),
source_edition varchar(20),
source_language varchar(20),
source_year varchar(20),
constraint author_idDPK primary key(source_id)
)";

$result = mysqli_query($con, $sql)
  or die("Couldn't execute create");

echo "Table created successfully";

mysqli_close($con);

?>
