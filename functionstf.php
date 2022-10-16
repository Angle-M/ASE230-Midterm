<?php
session_start();
  function get_authorID($term, $filename){
    $fh=fopen($filename, 'r');
    $term=$term;
    $LineCount=0;
    $ID='';
    $found='null';
    $message='';
    $authorID='';
    while(($line=fgetcsv($fh, 0, ",")) !== FALSE) {
      $LineCount += 1;
      if(trim($term) == trim($line[1])){
        $found = 'found';
        $authorID = $line[0];
        fclose($fh);
        // return $authorID
        // break;
      } else {
        $found = 'no';
      }
    } fclose($fh);

    if($found == 'no'){
      $LineCount += 1;
      // current format of unique ID is a followed by 5 digits
      // the end digit(s) represent the current row count +1 of the authorsv2.csv
      $spaces = str_repeat("0",(5 - strlen($LineCount))); # scope inside this block only
      $authorID = 'A'.$spaces.$LineCount;
      $author_ra = ($authorID.",".$term); # scope inside this block only
      $fh = fopen($filename, 'a');
      fputcsv($fh, explode(',',$author_ra));
      fclose($fh);
    }

  return $authorID;
  }





 ?>
