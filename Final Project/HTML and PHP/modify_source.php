<?php
$host='canary.simmons.edu';
$user='dillonk2';
$password='4001755';
$database='lis458olfa22_dillonk2_project';

$con=
mysqli_connect($host,$user,$password,$database)
	or die ("Couldn't connect to server");

$sql_getDefault = "SELECT source_title, source_pub_place, source_edition, source_year, source_language
FROM sources
WHERE sources.source_id = '$_POST[source]'";

$result_default = mysqli_query($con, $sql_getDefault);


echo "<html>
  <head>
    <title>Modify Source</title>
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
		</div>
					<h1>Modify a Source</h1>
					<form action='modify_source_execute.php' method='post'>";

while($row = mysqli_fetch_array($result_default))
  {
    echo "Source Title: <input type='text' name='source_title' value='".$row['source_title']."'/><br><br>
          Place of Publication: <input type='text' name='source_pub_place' value = '".$row['source_pub_place']."'/><br><br>
          Edition: <input type='text' name='source_edition' value='".$row['source_edition']."'/><br><br>
          Primary Language: <input type='text' name='source_language' value='".$row['source_language']."'/><br><br>
          Year of Publication (YYYY, if known): <input type='text' name='source_year' value='".$row['source_year']."'/><br><br>
          Internal Source ID (cannot be changed): <input type='text' name='source_id' value='".$_POST[source]."' readonly /><br><br>";
  }

echo "<input type='submit'/>
			</form>
		</body>
	</html>";

mysqli_close($con);
?>
