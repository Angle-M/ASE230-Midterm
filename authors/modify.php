<?php
  session_start();
  // move pointer to matching record in related csv file
  $ID_in=$_GET['authorID'];
  $NM_in=stripslashes(trim($_GET['authorNm']));
  $index=$_GET['index'];
  $authorID='';
  $author_data='';

  if(count($_POST)>0){
    if(!isset($_GET['index'])){
      die('Please choose an author/source to modify');
    }
    if(file_exists('../data/authors.csv')){
      $line_counter=1;
      $new_file_content = '';
      $fh= fopen('../data/authors.csv','r');
      while($line=fgets($fh)){
        if($line_counter==$_GET['index']) $new_file_content.=$_POST['name'].PHP_EOL;
        else $new_file_content.=$line;
        $line_counter++;
      } // close while loop
      fclose($fh);
    file_put_contents('../data/authors.csv', $new_file_content);
    echo '<h2>You have successfully modified the author</h2>
    <hr />
    <h3><a href="index.php">Go back to index </a></h3>';

    } // close if file exists
  }//close if statement checking $_POST is empty
  else{
    $fh= fopen('../data/authors.csv','r');
    $line_counter=1;
    while($line=fgets($fh)){
      if($line_counter == $_GET['index']){
        $author_data=$line;
      }
      $line_counter++;
    }
  }


 ?>
 <a href="index.php">Go back to index </a>
       <form method="post">
         Enter your modification <br />
         <input type="text" name="name" value="<?=$ID_in.','.$NM_in?>"/><br />
         <button type="submit" >Modify author</button>

       </form>
