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
        $name=$_GET['name'];
        $name1=$_GET['name2'];
        $name2=$_GET['name3'];
        $ph=$_GET['ph'];
        $index=$_GET['index'];
        $city=$_GET['city'];
        $adress=$_GET['adress'];
        $adress1=$_GET['adress1'];
        $adress2=$_GET['adress2'];
        $adress3=$_GET['adress3'];
        $state = $pdo->query("UPDATE `Пользователь` SET `имя`='".$name."',`фамилия`='".$name1."',`отчество`='".$name2."',`телефон`='".$ph."',`индекс`='".$index."',`населенныйПункт`='".$city."',`улица`='".$adress."',`дом`='".$adress2."',`квартира`='".$adress3."',`область`='".$adress1."' WHERE `слкод` = '".$_GET['user']."'");
        header("Location: https://golden-hands.000webhostapp.com/lk.php?user=".$_GET['user']);
    }
?>