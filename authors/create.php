<?php
  session_start();
  // check that submission box is not empty
  $error = '';
  $fileLineCount = 0;
  $found = 'empty';
  $authorID = '';
  $message = '';
  if(count($_POST)>0){
    $tempName=stripslashes(trim($_POST['name']));
    if(file_exists('../data/authors.csv')) {
      $fh = fopen('../data/authors.csv', 'r');
      while(($line = fgetcsv($fh, ",")) !== FALSE){
        $fileLineCount += 1;
        $testMatch =stripslashes(trim($line[1]));
        if($tempName == $testMatch){
          $found = 'found';
          $authorID = $line[0];
          $message = $_POST['name'].' is already in the list labeled: '.$authorID;
        } // end if match found
        // else {
        //   $found = 'no';
        //   $message = $_POST['name'].' is not in our list.';
        // } // this else statement facilitates duplicates

      } // end while loop
      fclose($fh);

      if($found == 'empty'){
        $fileLineCount += 1;
        $spaces = str_repeat("0",(5 - strlen($fileLineCount)));
        $authorID = 'A'.$spaces.$fileLineCount;
        $author_ra = $authorID.",".$_POST['name']; //test theory about PHP_EOL
        $fh = fopen('../data/authors.csv', 'a');
        fputcsv($fh, explode(',',$author_ra));
        fclose($fh);
        $message = $_POST['name'].' added with label: '.$authorID;
        // trying to stop quotation marks around author's name, no luck
      }
      if(strlen($message)>0) echo $message;
    }
    // end file exists check
  }
  // end post value is not 0
  if(strlen($error)>0) echo $error;



 ?>

 <h5 class="card-title">Create Author</h5>
   <form method="post">
     <h6 class="card-subtitle mb-2 text-muted">Enter Author's Name</h6>
     <p class="card-text"><input type="text" name="name" class="form-control form-control-lg" placeholder="Authors Name"/></p>
     <button type="submit" class="btn btn-success">Add author</button><br /><br />

     <a href="index.php" class="btn btn-primary" role="button">Go back to index </a>
   </form>

   <!--   -->
