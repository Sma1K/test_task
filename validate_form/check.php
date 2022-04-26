<?php
session_start();
$mySql = new mysqli('localhost', 'devel', 'Yjdsq2021!', 'test');

//проверяем получение полей
if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['pass'])) {
    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
    $fio = filter_var($_POST['fio'], FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
} else {
    throw new Exception('Data from index.php is not found');
}

//проверка на уникальность логина
checkLogin($login, $mySql);

//проверка остальных полей
if (strlen($login) < 4 || strlen($login) > 55) {
    $_SESSION['message'] = 'Incorrect login lenght';
    header('Location: register.php');
    exit();
} else if (strlen($email) < 5 || strlen($email) > 55) {
    $_SESSION['message'] = 'Incorrect email lenght';
    header('Location: register.php');
    exit();
} else if (strlen($pass) < 5 || strlen($pass) > 55) {
    $_SESSION['message'] = 'Incorrect pass lenght';
    header('Location: register.php');
    exit();
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['message'] = 'Incorrect email format';
    header('Location: register.php');
    exit();
} else if (strlen($fio) < 2 || strlen($fio) > 55) {
    $_SESSION['message'] = 'Incorrect full name lenght';
    header('Location: register.php');
    exit();
}

$pass = md5($pass . "wwqrtts");

$mySql->query("INSERT INTO  `users` (`login`, `email`, `FIO`, `password`) VALUES ('$login', '$email', '$fio', '$pass')") or die($mySql->error);
$mySql->close();

$_SESSION['user'] = [
    "FIO" => $fio,
    "login" => $login,
    "email" => $email
];
header('Location: ../index.php');


//функция на проверку уникальности логина
function checkLogin($login, $mySql)
{
    $res = $mySql->query("SELECT * FROM `users` WHERE `login` = '$login'") or die($mySql->error);
    $user = $res->fetch_assoc();
    $mySql->close();

    if (count($user) > 0) {
        $_SESSION['message'] = 'Such login already exists';
        header('Location: register.php');
        exit();
    }
}
