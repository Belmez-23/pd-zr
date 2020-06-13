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
    $state0 = $pdo->query('SELECT * FROM `ЗаказыИТовары` WHERE `код` = '.$_GET['red_id']);
    $row0 = $state0->fetch(PDO::FETCH_ASSOC);
    if ($_GET['z'] == 1)
    {
        $state1 = $pdo->query('SELECT * FROM `Вид` WHERE `кодВида` = '.$row0['кодВида']);
        $row1 = $state1->fetch(PDO::FETCH_ASSOC);
        if($row1['остаток']>$row0['количество'])
        {
            $i = $row0['количество'] + 1;
            $state = $pdo->query("UPDATE `ЗаказыИТовары` SET `количество`= ".$i." WHERE `код` = ".$_GET['red_id']);
        }
    }
    else
    {
        $i = $row0['количество'] - 1;
        if ($i == 0)
        {
            $state = $pdo->query('DELETE FROM `ЗаказыИТовары` WHERE `код` = '.$_GET['red_id']);
        }
        else
        {
            $state = $pdo->query("UPDATE `ЗаказыИТовары` SET `количество`= ".$i." WHERE `код` = ".$_GET['red_id']);
        }
    }
    header("Location: https://golden-hands.000webhostapp.com/order.php?user=".$_GET['user']);
?>