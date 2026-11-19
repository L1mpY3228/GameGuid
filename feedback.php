<?php  
require_once("connect.php");
session_start();

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email']; 
$text = $_POST['text'];

$errors = [];

if (empty($name) || empty($phone) || empty($email) || empty($text)) { 
  $errors[] = "Заполните все поля!";
} else {
  $result = mysqli_query($connect, "SELECT * FROM `feedback` WHERE `text`='$text'");
  $data_num_rows = mysqli_num_rows($result);

  if ($data_num_rows > 0) {
    $errors[] = "Данный отзыв уже существует!";
  }
  
  if (empty($errors)) {
    mysqli_query($connect, "INSERT INTO feedback (`name`, `phone`, `email`, `text`) VALUES ('$name', '$phone', '$email', '$text')");
    header('Location: indexVHOD.html');
    exit();
  } else {
    header('Location: error.html');
    $_SESSION['errors'] = $errors;
    exit();
  }
}
?>