<?php
    //подключение к бд, стоит вынести в отд. файл
    $host = 'localhost';  //  имя  хоста
    $db   = 'id13376305_database'; // имя бд
    $user = 'id13376305_marinaandmarie'; //имя пользователя
    $pass = 'Ghjcnj_Gfhjkm1'; //пароль к бд
    $charset = 'utf8'; //кодировка юникод (поддерживает кирилицу)
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        ];
    $pdo = new PDO($dsn, $user, $pass, $opt);
    if (!$pdo)
    {
        echo("Невозможно подключиться к базе данных. Код ошибки: " + mysqli_connect_error()); 
        exit; 
    }
    else
    {
    $email = $_POST["email"];
    $psw = $_POST["psw"];
    $state1 = $pdo->query("SELECT * FROM `Пользователь` WHERE `e-mail` = '".$email."'");
    $row1 = $state1->fetch(PDO::FETCH_ASSOC);
    if (isset($_GET['s']))
    {
        header("Location: https://golden-hands.000webhostapp.com/order.php?user=".$row1['слкод']);
    }
    else if ($psw == $row1['пароль'])
    {
    header("Location: https://golden-hands.000webhostapp.com/index.php?user=".$row1['слкод']);
    }
    else
    {
        header("Location: https://golden-hands.000webhostapp.com/user.php?err=1&user=".$_GET['user']);
    }
    }
?>