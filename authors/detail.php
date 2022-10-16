<?php
  session_start();
  $authorID='';
  $authorName='';
  $fh = fopen('../data/authors.csv', 'r');
  while(($line=fgetcsv($fh, 0, ",")) !== FALSE){
    if(strlen($line[0])>0) {
      $authorID=$line[0];
      if($authorID==$_GET['authorID']){
        $_SESSION['authorRef'] = $authorID; // to pull ID of author for quotes
        //store the author
        $authorName = $line[1];
      } // close author search by authorID
    } // close check if row is empty
  } // close while loop
  fclose($fh);
?>

<h2><a href="../quotes/create.php?authorID=<?=$_SESSION['authorRef']?>">Add a quote</a></h2>
<h2><a href="modify.php?authorID=<?=$_SESSION['authorRef']?>">modify author</a></h2>
<h2><a href="delete.php?authorID=<?=$_SESSION['authorRef']?>">delete author</a></h2>
<hr />
<h1>Author/Source: <?=$authorName?></h1>
<p> Quotes: </p>
<!-- Need to add functionality to list all quotes by author
  Thought: add an href link to a quotes index filtered on author passed in query string

-->


<!-- // < ? php
#check for index of the author
#read the file
#if the index of the author matches to the index of the author in the quotes.csv file then print that quote
  // $fh = fopen('../data/quotes.csv', 'r');
  // $line_counter = 0;
  // while($line=fgets($fh)){
  //   if($line_counter==$_GET['index'] && $line_counter== $_SESSION['authorLineNumber']){//if index of author matches the index on this page
  //     $line=trim($line);
  //     $line=explode(';', $line);
  //     if($line[1]==trim($_SESSION['authorLineNumber'])){
  //       echo $line;
  //     }
  //   }
  //   $line_counter++;
  // }
  // fclose($fh);
  ?> -->
