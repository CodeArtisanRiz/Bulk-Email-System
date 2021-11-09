<?php

//import.php

if(isset($_POST["student_name"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=bulk_db", "root", "");
 $username = "user";
 $student_name = $_POST["student_name"];
 $student_phone = $_POST["student_phone"];
 for($count = 0; $count < count($student_name); $count++)
 {
  $query .= "
  INSERT INTO recipients(username, name, email) 
  VALUES ('".$username."','".$student_name[$count]."', '".$student_phone[$count]."');
  
  ";
 }
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>