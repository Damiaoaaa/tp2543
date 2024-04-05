<?php
 
session_start();
 
if (isset($_SESSION['record_id']))
  $myid = $_SESSION['record_id'];
else
  $myid = "";

include "db.php";
 
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
    $stmt = $conn->prepare("SELECT * FROM myguestbook");
    $stmt->execute();
    
    $result = $stmt->fetchAll();
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
    try{
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $stmt = $conn->prepare("SELECT MAX(id) FROM myguestbook");
      $stmt->execute();
      $myid = $stmt->fetchColumn();
    }catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
 
$conn = null;
?>
<!DOCTYPE html>
<html>
<head>
  <title>My Guestbook</title>
</head>
<body>
 
<ol>
<?php
foreach($result as $row) {
  echo "<li>";
  echo "Name : ".$row["user"]."<br>";
  echo "Email : ".$row["email"]."<br>";
  //echo "How did you find me? : ".$row["question"]."<br>";
  //echo "Guest likes my : ".$row["front"].$row["form"].$row["userinterface"]."<br>";
  echo "Date : ".$row["postdate"]."<br>";
  echo "Time : ".$row["posttime"]."<br>";
  echo "Comments : ".$row["comment"]."<br>";
  if (($row["id"] == $myid) && ($row["picture"] == "")) {
    echo '<form action="upload.php" method="post" enctype="multipart/form-data">';
    echo "<input type='file' name='fileToUpload' id='fileToUpload' required>";
    echo "<input type='submit' value='Upload Image' name='submit'>";
    echo "";
    echo "</form>";
  }
  if ($row["picture"] != "") {
    echo '<img src="'.$row["picture"].'"><br>';
  }
  echo "Action : <a href=edit.php?id=".$row["id"].">Edit</a> / <a href=delete.php?id=".$row["id"].">Delete</a>";
  echo "</li>";
  echo "<hr>";
}
?>
</ol>
 
</body>
</html>