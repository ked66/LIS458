<?php
$host='canary.simmons.edu';
$user='dillonk2';
$password='4001755';
$database='lis458olfa22_dillonk2_1';

$con=
mysqli_connect($host,$user,$password,$database)
	or die ("Couldn't connect to server");

$sql = "CREATE TABLE books
(
books_booktitle varchar(255),
books_author varchar(255),
books_year char(4),
books_id INT(11) NOT NULL AUTO_INCREMENT,
constraint books_idDPK primary key(books_id)
)";

$result = mysqli_query($con, $sql)
  or die("Couldn't execute create");

echo "Table created successfully";

mysqli_close($con);

?>
