<?php

$sourceName= "localhost";
$userName="root";
$password="root";
$dbName="phpforms";


// to connect to db
$connection=new mysqli($sourceName,$userName,$password,$dbName);

if($connection -> connect_error){
    die("Connection Failed: ". $connection -> connect_error);
}
echo "Connection Sucessfull!";

//variables with input field values
$nameDB=$_REQUEST["name"];
$emailDB=$_REQUEST["email"];
$websiteDB = $_REQUEST["website"];
$messageDB = $_REQUEST["message"];
$skillDB = implode(", ", $_REQUEST["skill"]);
$departmentDB = $_REQUEST["department"];
$genderDB = $_REQUEST["gender"];

//query to insert data
$query="INSERT INTO recruits (name,email,website,comments,skills,department,gender)
VALUES('$nameDB','$emailDB','$websiteDB','$messageDB','$skillDB','$departmentDB','$genderDB') ";



if(!empty($nameDB) && !empty($emailDB) && !empty($websiteDB) && !empty($messageDB) //insert data only if all fields are validated
&& !empty($skillDB) && !empty($departmentDB) && !empty($genderDB) ){
    if($connection -> query($query)== true){
        echo "<br>New Record added successfully" ;  
        $nameDB=$emailDB=$websiteDB=$messageDB=$skillDB=$departmentDB=$genderDB=""; //to prevent duplicates

    }
    else{
        echo "Error: " .$query. "<br>" . $connection -> error;
    }
}

$connection -> close();