<?php
$host='canary.simmons.edu';
$user='dillonk2';
$password='4001755';
$database='lis458olfa22_dillonk2_1';

$con=
mysqli_connect($host,$user,$password,$database)
	or die ("Couldn't connect to server");

$sql="INSERT INTO books (books_booktitle, books_author, books_year)
VALUES
('$_POST[title]','$_POST[author]','$_POST[year]')";

mysqli_query($con,$sql)
  or die('Error: ' . mysqli_error());

echo "1 record added";

mysqli_close($con);
?>
