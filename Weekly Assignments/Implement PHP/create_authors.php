<?php
$host='canary.simmons.edu';
$user='dillonk2';
$password='4001755';
$database='lis458olfa22_dillonk2_project';

$con=
mysqli_connect($host,$user,$password,$database)
	or die ("Couldn't connect to server");

$sql = "CREATE TABLE authors
(
author_id INT(6) NOT NULL AUTO_INCREMENT,
author_name varchar(80),
author_nationality varchar(40),
author_birth varchar(20),
author_death varchar(20),
constraint author_idDPK primary key(author_id)
)";

$result = mysqli_query($con, $sql)
  or die("Couldn't execute create");

echo "Table created successfully";

mysqli_close($con);

?>
