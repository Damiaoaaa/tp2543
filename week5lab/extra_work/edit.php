<?php
 
if (isset($_GET['id'])) {
 
  include "db.php";
 
  try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
      $stmt = $conn->prepare("SELECT * FROM myguestbook WHERE id = :record_id");
      $stmt->bindParam(':record_id', $id, PDO::PARAM_INT);
      $id = $_GET['id'];
 
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
 
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
 
<!DOCTYPE html>
<html>
<head>
  <title>My Guestbook</title>
</head>
 
<body>
 
<form method="post" action="update.php">
  Nama :
  <input type="text" name="name" size="40" required value="<?php echo $result["user"]; ?>">
  <br>
  Email :
  <input type="text" name="email" size="25" required value="<?php echo $result["email"]; ?>">
  <br>
  How did you find me?
    <select name="find" required <?php echo $result["find"]; ?>>
      <option value="From a friend">From a friend</option>
      <option value="I googled you">I googled you</option>
      <option value="Just surfed on in">Just surfed on in</option>
      <option value="From your Facebook">From your Facebook</option>
      <option value="I clicked an ads">I clicked an ads</option>
    </select>
  <br>
  I like your :
  <br>
  <input type="radio" name="l_you" value="Front page" <?php echo $result["l_you"]; ?> checked>Front page
  <br>
  <input type="radio" name="l_you" value="Form" <?php echo $result["l_you"]; ?>>Form
  <br>
  <input type="radio" name="l_you" value="User interface" <?php echo $result["l_you"]; ?>>User interface
  <br>
  Comments :<br>
  <textarea name="comment" cols="30" rows="8" required><?php echo $result["comment"]; ?></textarea>
  <br>
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
  <input type="submit" name="edit_form" value="Modify Comment">
  <input type="reset">
  <br>
</form>
 
</body>
</html>