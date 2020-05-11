<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="shotcut icon" href="source/handmade.png">
     <link rel="stylesheet" href="source/style3.css" type="text/css">
    <title>Золотые ручки</title>
</head>
<body link="#ffcba7"  alink="#5e216d" vlink="#ffcba7">
    <header>
  <p align="center">
ЗОЛОТЫЕ <img align="center" src="source/handmade.png" style='height: 10%; width: 10%;'> РУЧКИ
</header>
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
            echo '<nav role="navigation"><ul>
            <li><a href="#" aria-haspopup="true">Каталог</a>
            <ul class="dropdown" aria-label="submenu">';
            echo '<li><a href="?red_id=0">';
            echo '<span id="0:?id">Все товары</span>';
            echo '</a></li>';
            $state = $pdo->query('SELECT `кодКатегории` as `key`, `имяКатегории` as `name` FROM `Категория`');
            while($row = $state->fetch(PDO::FETCH_ASSOC))
            {
                echo '<li><a href="?red_id='.$row['key'].'">';
                echo '<span id="'.$row['key'].':?id">'.$row['name'].'</span>';
                echo '</a></li>';
            }
            echo '</ul></li>
                <li><a href="#">Статьи</a></li>
                <li><a href="#">Оплата и доставка</a></li>
                <li><a href="#">О нас</a></li>
            </ul></nav><div width="100%"></div>';
        }
    echo '<div id="Blok" >
    <div style="float:left; width: 28%; height: inherit;">';
    $state1 = $pdo->query('SELECT * FROM `Вид` WHERE `кодТовара` = '.$_GET['red_id']);
    $row1 = $state1->fetch(PDO::FETCH_ASSOC);
    $state2 = $pdo->query('SELECT `фотоТовара` as `photo` FROM `Фото` WHERE `кодВида` ='.$row1['кодВида']);
    $row2 = $state2->fetch(PDO::FETCH_ASSOC);
    echo '<img src="'.$row2['photo'].'" style="height: 100%; width: 100%;">';
    $state3 = $pdo->query('SELECT * FROM `Товар` WHERE `кодТовара` = '.$_GET['red_id']);
    $row3 = $state3->fetch(PDO::FETCH_ASSOC);
    echo '</div><h2>'.$row3['имяТовара'].'</h2><br>';
    if ($row3['цена'] > $row3['новаяЦена'])
    {
        echo '<s>'.$row3['цена'].' p </s> '.$row3['новаяЦена'].' p<br>';
    }
    else
    {
        echo $row3['новаяЦена'].' p<br>';
    }
    echo $row3['описаниеТовара'];
    echo '<table id="table">';
    $state4 = $pdo->query('SELECT * FROM `Характеристики` WHERE `кодВида` = '.$row1['кодВида']);
    while ($row4 = $state4->fetch(PDO::FETCH_ASSOC))
    {
        echo '<tr><td>'.$row4['имяХарактеристики'].'</td><td>'.$row4['величина'].' '.$row4['едИзмерения'].'</td></tr>';
    }?>

    </table>
    </div>
    <h2>Другие товары этой категории:</h2>
      <div id="MiniBlok" > 
        Крючок для вязания<br>
        <img src="https://images.ua.prom.st/800824790_kryuchok-dlya-vyazaniya.jpg" >
        <button>Купить</button>
        </div>
    <div id="MiniBlok" > 
        Пряжа Альпака<br>
         <img src="выносите альпак.png" >
        <button>Купить</button>
        </div>
    <div id="MiniBlok" >
         Спицы деревянные на леске
         <img src="https://aknitting.ru/crn_fls/ak_pr/32728-addi_555-7.jpg" >
        <button>Купить</button>
        </div>
    </body>
</html>
