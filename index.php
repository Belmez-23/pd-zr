<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="shotcut icon" href="source/handmade.png">
     <link rel="stylesheet" href="source/style.css" type="text/css">
    <title>Золотые ручки</title>
</head>
<body link="#ffcba7"  alink="#5e216d" vlink="#ffcba7">
    <header>


  <p align="center">
ЗОЛОТЫЕ <img align="center" src="source/handmade.png" style='height: 10%; width: 10%;'> РУЧКИ
</header>
    <button style="width: 24%">Статьи</button>
    <button style="width: 24%">Каталог товаров</button>
    <button style="width: 24%">Оплата и доставка</button>
    <button style="width: 24%">О нас</button>
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
            $state0 = $pdo->query('SELECT `кодПодраздела` as `key`, `имяПодраздела` as `name` FROM `Подраздел`');
            while($row0 = $state0->fetch(PDO::FETCH_ASSOC))
            {
                if($row0['name'] != 'Нет')
                {
                    $state1 = $pdo->query('SELECT `кодТовара` as `tov` FROM `Товар`, `Подраздел` 
                    WHERE  `Товар`.`кодПодраздела` =  '.$row0['key']);
                    echo '<div width=100%><h2>'.$row0['name'].'</h2></div>';
                    $i = 3;
                    while($i > 0)
                    {
                        echo '<div id="MiniBlok" >';
                        $row1 = $state1->fetch(PDO::FETCH_ASSOC);
                        $i--;
                        $state2 = $pdo->query('SELECT `имяТовара` AS `name` FROM `Товар`
                        WHERE `кодТовара` = '.$row1['tov']);
                        $row2 = $state2->fetch(PDO::FETCH_ASSOC);
                        echo $row2['name'].'<br>';
                        $state2 = $pdo->query('SELECT `фотоТовара` AS `photo` FROM `Фото`
                        WHERE `Фото`.`кодТовара` = '.$row1['tov']);
                        $row2 = $state2->fetch(PDO::FETCH_ASSOC);
                        echo '<br><img src='.$row2['photo'].' height="86%">';
                        echo '<button>Купить</button></div>';
                    }
                }
            }
        }
    ?>
</div>
</body>
</html>