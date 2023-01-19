<?php
$host='canary.simmons.edu';
$user='dillonk2';
$password='4001755';
$database='lis458olfa22_dillonk2_project';

$con=
mysqli_connect($host,$user,$password,$database)
	or die ("Couldn't connect to server");

$sql_getAuthors = "SELECT author_id, CONCAT (author_name, ' (', author_birth, '-', author_death, ')') as 'Author'
FROM authors";

$result_authors = mysqli_query($con, $sql_getAuthors);

echo "<html>
  <head>
    <title>Browse</title>
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
    <h1>Browse</h1>
    <h2>By Author</h2>
      <p>Select an author to see available sources they wrote. <br>
         Select 'all' to see all authors, with the sources they wrote, listed alphabetically.
      </p>
			<!-- The purpose of this query is to see all available sources written by a single author.
			This serves as a sort of bibliography for the rest of the website, and will eventually
			serve as an entry point to click through sources to see individual herb uses -->";

echo "<form action='browse_author.php' method='post'>
      <label for='browse_author'>Select Author: </label>
      <select id='browse_author' name='browse_author'>
        <option value='all'>All</option>";

while($row = mysqli_fetch_array($result_authors))
          {
        		echo "<option value=".$row['author_id'].">".$row['Author']."</option>";
        	}

echo "</select>
      <input type='submit'/>
      </form>";

$sql_getHerbs = "SELECT herb_id, herb_scientific_name as 'Herb'
			FROM herbs";

$result_herbs = mysqli_query($con, $sql_getHerbs);


echo "<h2>By Herb</h2>
      <p>Select a herb to see all associated list instances.</p>
			<p>Or select 'all' to see all herbs, listed alphabetically by Latin Name.</p>";

			echo "<form action='browse_herb.php' method='post'>
			      <label for='browse_herb'>Select Herb: </label>
			      <select id='browse_herb' name='browse_herb'>
			        <option value='all'>All</option>";

			while($row = mysqli_fetch_array($result_herbs))
			          {
			        		echo "<option value=".$row['herb_id'].">".$row['Herb']."</option>";
			        	}

			echo "</select>
			      <input type='submit'/>
			      </form>";

$sql_getHerbs = "SELECT indication_mesh_id, indication_mesh_name as 'Indication'
			FROM indications";

$result_herbs = mysqli_query($con, $sql_getHerbs);


echo "<h2>By Medical Indication</h2>
      <p>Select an indication to see all associated instances.</p>
			<p>Or select 'all' to see all indications, listed alphabetically.</p>";

			echo "<form action='browse_indication.php' method='post'>
			      <label for='browse_indication'>Select Indication: </label>
			      <select id='browse_indication' name='browse_indication'>
			        <option value='all'>All</option>";

			while($row = mysqli_fetch_array($result_herbs))
			          {
			        		echo "<option value=".$row['indication_mesh_id'].">".$row['Indication']."</option>";
			        	}

			echo "</select>
			      <input type='submit'/>
			      </form>";

echo "</body></html>";

mysqli_close($con);

?>
