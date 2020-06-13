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
        $state1 = $pdo->query('SELECT * FROM `Пользователь` WHERE `слкод` = "'.$_GET['user'].'"');
            $row = $state1->fetch(PDO::FETCH_ASSOC);
        $state = $pdo->query('UPDATE `Заказ` SET `кодПользователя`= '.$row['кодПользователя'].',`суммаЗаказа`= '.$_GET['total'].',`суммаЗаказаСоСкидкой`= '.$_GET['total'].',`кодДоставки`= 2,`кодОплаты`= 2,`кодСтатуса`= 2,`датаЗаказа`= "'.date('o')."-".date('n')."-".date('d').'" WHERE `кодЗаказа` = '.$_GET['red_id']);
        $state = $pdo->query('INSERT INTO `Заказ`(`кодПользователя`, `суммаЗаказа`, `суммаЗаказаСоСкидкой`, `кодДоставки`, `кодОплаты`, `кодСтатуса`, `датаЗаказа`, `датаОплаты`, `датаОбработки`, `датаДоставки`, `комментарий`, `трек`) VALUES ('.$row['кодПользователя'].', 0, 0, 1, 1, 1, "2020-05-18", "2020-05-18", "2020-05-18", "2020-05-18", "-", "-")');
            header("Location: https://golden-hands.000webhostapp.com/waiting.php?user=".$_GET['user']);
    }
?>
