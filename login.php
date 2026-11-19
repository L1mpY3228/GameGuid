<?php
session_start();

if(!empty($_POST['submit'])){
    // Защита от SQL-инъекций
    $login = mysqli_real_escape_string($connect, $_POST['Name']);
    $password = $_POST['Password'];
    
    // Исправленный SQL-запрос с подготовленными выражениями (лучший вариант)
    $query = "SELECT * FROM register WHERE login = ?";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "s", $login);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    
    if(mysqli_num_rows($result) == 1){
        $user = mysqli_fetch_assoc($result);
        
        // Проверка пароля (предполагая, что пароли хешированы в базе)
        if(password_verify($password, $user['password'])){
            $_SESSION['login'] = $user;
            header("Location: indexVHOD.html");
            exit();
        }
    }
    
    // Если аутентификация не удалась
    header("Location: indexVHOD.html");
    exit();
}