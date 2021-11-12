<?php

//import.php

if(isset($_POST["user_name"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=bulk_db", "root", "");
 $username = "user";
 $user_name = $_POST["user_name"];
 $user_email = $_POST["user_email"];
 for($count = 0; $count < count($user_name); $count++)
 {
  $query .= "
  INSERT INTO recipients(username, name, email) 
  VALUES ('".$username."','".$user_name[$count]."', '".$user_email[$count]."');
  
  ";
 }
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>