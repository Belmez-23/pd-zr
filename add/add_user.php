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
    $psw_repeat = $_POST["pswr"];
    if ($psw == $psw_repeat)
    {
                    $state = $pdo->query('SELECT * FROM `Пользователь` WHERE `слкод` = "'.$_GET['user'].'"');
            $row1 = $state->fetch(PDO::FETCH_ASSOC);
    $state = $pdo->query("UPDATE `Пользователь` SET `пароль`= '".$psw."',`e-mail`= '".$email."' WHERE `слкод` = '".$_GET['user']."'");
    $state = $pdo->query('INSERT INTO `Заказ`(`кодПользователя`, `суммаЗаказа`, `суммаЗаказаСоСкидкой`, `кодДоставки`, `кодОплаты`, `кодСтатуса`, `датаЗаказа`, `датаОплаты`, `датаОбработки`, `датаДоставки`, `трек`, `комментарий`) VALUES ('.$row1['кодПользователя'].', 0, 0, 1, 1, 1, "2020-05-18", "2020-05-18", "2020-05-18", "2020-05-18", "-", "-")');
    if (isset($_GET['s']))
    header("Location: https://golden-hands.000webhostapp.com/user.php?s=1&user=".$_GET['user']);
    else
    header("Location: https://golden-hands.000webhostapp.com/user.php?user=".$_GET['user']);
    }
    else
    {
        header("Location: https://golden-hands.000webhostapp.com/reg.php?err=1&user=".$_GET['user']);
    }
    }
?>