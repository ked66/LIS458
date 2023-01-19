<?php
$host='canary.simmons.edu';
$user='dillonk2';
$password='4001755';
$database='lis458olfa22_dillonk2_project';

$con=
mysqli_connect($host,$user,$password,$database)
	or die ("Couldn't connect to server");

echo "<html>
  <head>
    <title>Advanced Search</title>
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
    <h1>Advanced Search</h1>
    <h2>Search by Author</h2>";

    $sql_getNationalities = "SELECT DISTINCT author_nationality,
		replace(author_nationality, ' ', '') as author_space
    FROM authors";

    $result_nationalities = mysqli_query($con, $sql_getNationalities);

    echo "<form action='search_author.php' method='post'>
          <label for='author_name'>Name contains: </label>
          <input type='text' id='author_name' name='author_name'><br>
          <label for='author_nationality'>Limit by Nationality: </label>
          <select id='author_nationality' name='author_nationality'>
            <option value='all'>All</option>";

            while($row = mysqli_fetch_array($result_nationalities))
                      {
                    		echo "<option value=".$row['author_space'].">".$row['author_nationality']."</option>";
                    	}

            echo "</select>
                  <br><input type='submit'/>
                  </form>";


    echo "<h2>Search by Source</h2>";

    $sql_getPublication = "SELECT DISTINCT source_pub_place,
		replace(source_pub_place, ' ', '') as source_pub_space
    FROM sources";
    $result_publication = mysqli_query($con, $sql_getPublication);

    $sql_getLang = "SELECT DISTINCT source_language,
		replace(source_language, ' ', '') as source_lang_space
    FROM sources";
    $result_lang = mysqli_query($con, $sql_getLang);

    echo "<form action='search_source.php' method='post'>
          <label for='source_title'>Title contains: </label>
          <input type='text' id='source_title' name='source_title'><br>
          <label for='source_pub'>Limit by Place of Publication: </label>
          <select id='source_pub' name='source_pub'>
            <option value='all'>All</option>";

            while($row = mysqli_fetch_array($result_publication))
                      {
                    		echo "<option value=".$row['source_pub_space'].">".$row['source_pub_place']."</option>";
                    	}

            echo "</select>
            <br><label for='source_lang'>Limit by Original Language: </label>
            <select id='source_lang' name='source_lang'>
            <option value='all'>All</option>";

            while($row = mysqli_fetch_array($result_lang))
                      {
                        echo "<option value=".$row['source_lang_space'].">".$row['source_language']."</option>";
                      }

                  echo "<br><input type='submit'/>
                  </form>";



    echo "<h2>Search by Herb</h2>
            <form action='search_herb.php' method='post'>
                  <label for='herb_name'>Herb name contains: </label>
                  <input type='text' id='herb_name' name='herb_name'><br>
                  <input type='submit'/>
            </form>";



    ## Herb name contains (will search latin and common names)

    echo "<h2>Search by Indication</h2>
            <form action='search_indication.php' method='post'>
                  <label for='indication_name'>Indication name contains: </label>
                  <input type='text' id='indication_name' name='indication_name'><br>
                  <input type='submit'/>
            </form>
            </body>
            </html>";

mysqli_close($con);

?>
