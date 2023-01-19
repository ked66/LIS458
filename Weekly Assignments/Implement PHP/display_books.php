<?php
$host='canary.simmons.edu';
$user='dillonk2';
$password='4001755';
$database='lis458olfa22_dillonk2_1';

$con=
mysqli_connect($host,$user,$password,$database)
	or die ("Couldn't connect to server");

$result = mysqli_query($con,"SELECT * FROM books");

echo "<h1>Books I Have Read This Year:</h1>
<table border='1'>
<tr>
<th>Title</th>
<th>Author</th>
<th>Year</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['books_booktitle'] . "</td>";
  echo "<td>" . $row['books_author'] . "</td>";
  echo "<td>" . $row['books_year'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

mysqli_close($con);
?>
