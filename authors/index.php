<!-- Need to mirror index under quotes folder that shows Quotes list attributed to author/source -->

<h2><a href="create.php">Add a new author</a><hr /></h2>


<?php
  session_start();
  // we wnat the index to read the authors.csv every time to pick up changes
  //if the user is logged in, give them a sign out option
  if (isset($_SESSION['logged'])){ 
    echo '<h4><a href="../Auth/signout.php"> Sign Out</a>';
  }

  $error = '';
  $count_rows = 0;
  if(file_exists('../data/authors.csv')){

    $fh = fopen('../data/authors.csv', 'r'); //open authors page in read mode
    $index=0;
    $authorID = '';
    $author_name = '';
    while(($line=fgetcsv($fh, 0, ",")) !== FALSE){
      if(strlen($line[0])>0) {
        $authorID=$line[0];
        $author_name=$line[1];
        $index += 1;
        // links to page, but has browser repeat search on the linked page
        // changed modify.php for code testing
        //if the user is logged in then allow them to modify and delete
        
        echo '<h1><a href="detail.php?index='.$index.'&authorID='.$authorID.'">'.trim($author_name).'</a>
        (<a href="detail.php?index='.$index.'&authorID='.$authorID.'&authorNm='.$author_name.'">view author</a>)';
        if(isset($_SESSION['logged'])){
          echo '(<a href="modify.php?index='.$index.'&authorID='.$authorID.'&authorNm='.$author_name.'">modify author</a>)
          (<a href="delete.php?index='.$index.'&authorID='.$authorID.'&authorNm='.$author_name.'">delete author</a>)</h1>';

        }
      } else {
        $index++; // this should maintain an index that doesn't skip empty lines
      }

      // $error = 'there are no authors in our index';
      // break;


    } //read line by line
    fclose($fh); //close file
  } else {
    $error = 'no such file';
}

if (strlen($error)>1) echo $error;
if ($index == 0) echo 'There are no authors in the database. Please add an author.';
?>
