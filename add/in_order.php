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
            $state1 = $pdo->query('SELECT `кодПользователя` as `key` FROM `Пользователь` WHERE `слкод` = "'.$_GET['user'].'"');
            $row1 = $state1->fetch(PDO::FETCH_ASSOC);
                $state = $pdo->query("SELECT `кодЗаказа` FROM `Заказ` WHERE `кодСтатуса` = 1 AND `кодПользователя` = ".$row1['key']);
                $row = $state->fetch(PDO::FETCH_ASSOC);
    $state0 = $pdo->query('SELECT * FROM `ЗаказыИТовары` WHERE `кодВида` = '.$_GET['red_id'].' AND `кодЗаказа` = '.$row['кодЗаказа']);
    $row0 = $state0->fetch(PDO::FETCH_ASSOC);
    if (empty($row0))
    {

        $state = $pdo->query("INSERT INTO `ЗаказыИТовары`(`кодВида`, `кодЗаказа`, `количество`) VALUES (".$_GET['red_id'].", (SELECT MAX(`кодЗаказа`) FROM `Заказ` WHERE `кодСтатуса` = 1 AND `кодПользователя` = ".$row1['key']."), 1)");
    }
    else
    {
        $state = $pdo->query("SELECT MAX(`кодЗаказа`) FROM `Заказ` WHERE `кодСтатуса` = 1 AND `кодПользователя` = ".$row1['key']);
            $row = $state->fetch(PDO::FETCH_ASSOC);
        $i = $row0['количество'] + 1;
        $state = $pdo->query("UPDATE `ЗаказыИТовары` SET `количество`= ".$i." WHERE `код`=".$row0['код']);
    }
    $state1 = $pdo->query('SELECT * FROM `Вид` WHERE `кодВида` = '.$_GET['red_id']);
    $row1 = $state1->fetch(PDO::FETCH_ASSOC);
    header("Location: https://golden-hands.000webhostapp.com/goods.php?add=1&red_id=".$row1['кодТовара']."&user=".$_GET['user']);
?>