<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: index.php');
}

$fio = $_SESSION['user']['FIO'];
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <!-- Профиль -->
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <h1>Update info (<?= $fio ?>)</h1>
                <form action="validate_form/update.php" method="post">
                    <input type="text" class="form-control" name="fio" id="fio" value="<?= $fio ?>" placeholder="full name"><br>
                    <input type="password" class="form-control" name="pass" id="pass" placeholder="password"><br>
                    <button class="btn btn-success">Update</button>
                    <a href="validate_form/exit.php" class="btn btn-danger">Выход</a>
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo '<p class="text-danger"> ' . $_SESSION['message'] . ' </p>';
                    }
                    unset($_SESSION['message']);
                    ?>
                </form>      
            </div>
        </div>
    </div>

</body>
</html>
