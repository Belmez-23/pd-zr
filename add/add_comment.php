<?php
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
    $select = $_GET["select"];
    $area = $_GET['area'];
    $state1 = $pdo->query('SELECT `кодПользователя` as `key` FROM `Пользователь` WHERE `слкод` = "'.$_GET['us'].'"');
    $row1 = $state1->fetch(PDO::FETCH_ASSOC);
    $state2 = $pdo->query('INSERT INTO `Отзывы`(`кодПользователя`, `кодВида`, `датаОтзыва`, `общаяОценка`, `отзыв`) VALUES ('.$row1['key'].', '.$_GET['select'].', "'.date("o")."-".date("m").'-'.date("j").'", '.$_GET['rating'].', "'.$_GET['area'].'" )');
    $state3 = $pdo->query('SELECT `кодТовара` as `key` FROM `Вид` WHERE `кодВида` = '.$_GET['select']);
    $row3 = $state3->fetch(PDO::FETCH_ASSOC);
    header("Location: https://golden-hands.000webhostapp.com/goods.php?add=1&red_id=".$row3['key']."&user=".$_GET['us']);
?>
