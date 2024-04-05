<?php
 
if (isset($_POST['add_form'])) {
 
  include "db.php";
 
  try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
      // Prepare the SQL statement
      $stmt = $conn->prepare("INSERT INTO myguestbook(user, email, postdate, posttime, comment, find, l_you) VALUES (:user, :email, :pdate, :ptime, :comment, :find, :l_you)");
     
      // Bind the parameters
      $stmt->bindParam(':user', $name, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':pdate', $postdate, PDO::PARAM_STR);
      $stmt->bindParam(':ptime', $posttime, PDO::PARAM_STR);
      $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
      $stmt->bindParam(':find', $find, PDO::PARAM_STR);
      $stmt->bindParam(':l_you', $l_you, PDO::PARAM_STR);
       
       $name=$_POST['name'];
       $email=$_POST['email'];
       $postdate=date("Y-m-d",time());
       $posttime=date("H:i:s",time());
       $comment=$_POST['comment'];
       $find=$_POST['find'];
       $l_you=$_POST['l_you'];
      // Give value to the variables
     
    $stmt->execute();
 
      echo "New records created successfully";
      }
 
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
 
    $conn = null;
  }
else {
  echo "Error: You have execute a wrong PHP. Please contact the web administrator.";
  die();
}
 
 ?>
