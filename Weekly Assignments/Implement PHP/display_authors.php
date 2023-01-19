<?php
$host='canary.simmons.edu';
$user='dillonk2';
$password='4001755';
$database='lis458olfa22_dillonk2_project';

$con=
mysqli_connect($host,$user,$password,$database)
	or die ("Couldn't connect to server");

$result = mysqli_query($con,"SELECT * FROM authors");

echo "<h1>Available Authors:</h1>
<table border='1'>
<tr>
<th>Author Name</th>
<th>Nationality</th>
<th>Date of Birth</th>
<th>Date of Death</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['author_name'] . "</td>";
  echo "<td>" . $row['author_nationality'] . "</td>";
  echo "<td>" . $row['author_birth'] . "</td>";
  echo "<td>" . $row['author_death'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

mysqli_close($con);
?>
