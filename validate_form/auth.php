<?php

session_start();
$mySql = new mysqli('localhost', 'devel', 'Yjdsq2021!', 'test');

//получем данные для авторизации
if (isset($_POST['login']) && isset($_POST['pass'])) {
    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
} else {
    throw new Exception('Data from index.php is not found');
}

$pass = md5($pass . "wwqrtts");
//узнаем есть ли такой юзер
$res = $mySql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$pass'") or die($mySql->error);
$user = $res->fetch_assoc();
$mySql->close();

//забиваем сессию данными
if (count($user) > 0) {
    $_SESSION['user'] = [
        "FIO" => $user['FIO'],
        "login" => $user['login'],
        "email" => $user['email'],
    ];

    header('Location: ../index.php');
} else {
    $_SESSION['message'] = 'Incorrect login or password';
    header('Location: ../index.php');
}

