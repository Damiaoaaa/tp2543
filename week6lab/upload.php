<?php
 
session_start();
 
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
  $target_dir = "picture/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }
 
  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
 
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
 
  // Allow certain file formats
  if($imageFileType != "png" && $imageFileType != "gif" ) {
    echo "Sorry, only PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
 
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       try{
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $stmt = $conn->prepare("SELECT MAX(id) FROM myguestbook");
      $stmt->execute();
      $myid = $stmt->fetchColumn();
    }catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }

        //include "db.php";

        try {
          //$myid = intval($_POST['myid']);
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("UPDATE myguestbook SET picture= :picture WHERE id = :myid");

    //$stmt = $conn->prepare("UPDATE myguestbook SET user = :name, email = :email, comment = :comment, picture= :picture WHERE id = :record_id");

    //$stmt->bindParam(':name', $name, PDO::PARAM_STR);
    //$stmt->bindParam(':email', $email, PDO::PARAM_STR);
    //$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);


    $stmt->bindParam(':myid', $myid, PDO::PARAM_INT);
    $stmt->bindParam(':picture', $target_file, PDO::PARAM_STR);
    

    //$name = $_POST['name'];
    //$email = $_POST['email'];
    //$comment = $_POST['comment'];
       
  
 
    $stmt->execute();
     
    header("Location:list.php");

      }
      catch(PDOException $e)
      {
          echo "Error: " . $e->getMessage();
      }
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}
?>







