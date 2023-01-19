<?php
$host='canary.simmons.edu';
$user='dillonk2';
$password='4001755';
$database='lis458olfa22_dillonk2_project';

$con=
mysqli_connect($host,$user,$password,$database)
	or die ("Couldn't connect to server");

$sql="INSERT INTO sources (source_title, source_pub_place, source_edition, source_language, source_year)
VALUES
('$_POST[source_title]','$_POST[source_pub_place]','$_POST[source_edition]', '$_POST[source_language]', '$_POST[source_year]')";

mysqli_query($con,$sql)
  or die('Error: ' . mysqli_error());

$new_source_id = mysqli_insert_id($con);

$sql_2="INSERT INTO sources_authors (author_id, source_id)
VALUES
('$_POST[author]',".$new_source_id.")";

mysqli_query($con,$sql_2)
  or die('Error: ' . mysqli_error());

echo "1 record added";

mysqli_close($con);
?>
