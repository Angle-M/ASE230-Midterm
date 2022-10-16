<?php
    function readCSVFile($fileName){//assuming we type in '' with the fileName
        $fh = fopen($fileName, 'r');
    }

    function readOneElementOfCSVFile($fileName) {
        $fh = fopen($fileName, 'r');
        readCSVFile($fileName);
        $index=0;
        while($line=fgets($fh)){
        if(strlen(trim($line))>0) {
            echo ($index.trim($line));
            $index++;
        }

        } //read line by line
        fclose($fh); //close file
    }

    function addElementToCSVFile($filePath){
        /*if(count($_POST)>0){
            //make sure name is not already in the file
              $error ='';
              if(file_exists($filePath)){
                $fh = fopen($filePath, 'r'); //open file  in read mode
                while($line=fgets($fh)){
                  if($_POST['name'] == trim($line)){
                    $error='The author already exists';
                  }
                }
                fclose($fh); //close file
              }

              if(strlen($error)>0) echo $error;
              else{
                // Add the name to the csv file
                $fh = fopen($filePath, 'a');
                fputs($fh,$_POST['name'].PHP_EOL);//php_eol = new line
                fclose($fh);
                exit();
              }
        } // closes if*/
    }

    function modifyElementOfCSVFile(){

    }

    function emptyElementOfCSVFile(){

    }

    function deleteElementOfCSVFile(){

    }
