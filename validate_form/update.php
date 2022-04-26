<?php
session_start();
$mySql = new mysqli('localhost', 'devel', 'Yjdsq2021!', 'test');

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

$session_login = $_SESSION['user']['login'];
$session_fio = $_SESSION['user']['FIO'];

//проверяем корректность полей/получения данных
if (!isset($_POST['fio']) || !isset($_POST['pass']) || trim($_POST['pass']) == "") {
    $_SESSION['message'] = 'Fill all fields';
    header('Location: ../profile.php');
    exit();
}


$fio = filter_var(trim($_POST['fio']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);

$pass = md5($pass . "wwqrtts");

//получаем нужного юзера
$res = $mySql->query("SELECT * FROM `users` WHERE `login` = '$session_login' AND `FIO` = '$session_fio'") or die($mySql->error);
$user = $res->fetch_assoc();

//обновляем
if (count($user) > 0) {
    $userId = $user['id'];
    $mySql->query("UPDATE `users` SET `FIO` = '$fio', `password` = '$pass' WHERE `id` = '$userId';") or die($mySql->error);
    $mySql->close();

    //var_dump(trim($_POST['pass']) != "");
    $_SESSION['message'] = 'Successful update';
    $_SESSION['user']['FIO'] = $fio;
    header('Location: ../profile.php');
} else {
    $_SESSION['message'] = 'Error occured';
    header('Location: ../profile.php');
}
