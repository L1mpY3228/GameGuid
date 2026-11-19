<?php  
require_once("connect.php");
session_start();

$login = $_POST['Name'];
$password = $_POST['Password'];
$passrepeat = $_POST['Passrepeat']; 
$email = $_POST['Email'];

$errors = [];

if (empty($login) || empty($password) || empty($passrepeat) || empty($email)) { 
  $errors[] = "Заполните все поля!";
} 
else if ($password != $passrepeat)
{
  $errors[] = "Повторный пароль не совпадает с паролем, проверить правильность написания!";
} else {
  $result = mysqli_query($connect, "SELECT * FROM `register` WHERE `Name`='$login' OR `email`='$email'");
  $data_num_rows = mysqli_num_rows($result);

  if ($data_num_rows > 0) {
    $errors[] = "Данный аккаунт уже существует!";
  }
  
  if (empty($errors)) {
    mysqli_query($connect, "INSERT INTO register (`Name`, `Email`, `Password`) VALUES ('$login', '$email', '$password')");
    header('Location: indexVHOD.html');
    exit();
  } else {
    header('Location: login.html');
    $_SESSION['errors'] = $errors;
    exit();
  }
}
?>