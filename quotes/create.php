<?php
  session_start();
  // possible entries
  // 1. directed from author detail page with authorID in query string
  // 2. directed from quotes index to add a new quote
  //    -adding new quote requires author match or creation first
  //    -both author interactions will result in authorID in query string
  // In the following format,
  // quote match to prevent dups has low probability of effectiveness
  $authorRef=$_SESSION['authorRef'];
  //echo $authorRef;
  $error = '';
  $fileLineCount = 0;
  $found = 'empty';
  $quoteID = '';
  $authorID = '';
  $message = '';
  if(count($_POST)>0){
    $tempQuote=stripslashes(trim($_POST['quote']));
    if(file_exists('../data/quotes.csv')) {
      $fh = fopen('../data/quotes.csv', 'r');
      while(($line = fgetcsv($fh, ",")) !== FALSE){
        $fileLineCount += 1;
        if(isset($line[2])){ // to avoid Undefined offset error
          $testMatch=stripslashes(trim($line[2]));
          if($tempQuote == $testMatch){
            $found = 'found';
            $quoteID = $line[0];
            $message = $_POST['quote'].' is already in the list labeled: '.$quoteID;
          }
        }
        else {
          echo 'line[2] not set for row '.$fileLineCount;
        }

      } // end while loop
      fclose($fh);

      if($found == 'empty'){
        $fileLineCount += 1;
        $spaces = str_repeat("0",(5 - strlen($fileLineCount)));
        $quoteID = 'Q'.$spaces.$fileLineCount;
        $quote_ra = $quoteID.",".$authorRef.",".$_POST['quote'];
        $fh = fopen('../data/quotes.csv', 'a');
        fputcsv($fh, explode(',',$quote_ra));
        fclose($fh);
        $message = 'Quote added with label: '.$quoteID;
        // trying to stop quotation marks around author's name, no luck
      }
      if(strlen($message)>0) echo $message;
    }
    // end file exists check
  }
  // end post value is not 0
  if(strlen($error)>0) echo $error;



  ?>
  <form method="post">
    Enter your quote.  <br />
    <input type="text" name="quote" placeholder="quote"/><br />
    <button type="submit" >Add to the collection</button>
  </form>

  <!-- Need to add redirects following sucessful add
    Also need to clean up user display of debugging echoes
  -->
