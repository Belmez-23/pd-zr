<?php
if(!isset($_GET['user']))
{
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
    $a = bin2hex(random_bytes(10));
    $state = $pdo->query("INSERT INTO `Пользователь`(`пароль`, `имя`, `фамилия`, `отчество`, `телефон`, `e-mail`, `индекс`, `улица`, `дом`, `квартира`, `населенныйПункт`, `область`, `слкод`) VALUES ('-','-','-','-','-','-','-','-','-', '-','-','-', '".$a."')");
    $state = $pdo->query('INSERT INTO `Заказ`(`кодПользователя`, `суммаЗаказа`, `суммаЗаказаСоСкидкой`, `кодДоставки`, `кодОплаты`, `кодСтатуса`, `датаЗаказа`, `датаОплаты`, `датаОбработки`, `датаДоставки`, `трек`, `комментарий`) VALUES ((SELECT MAX(`кодПользователя`) FROM `Пользователь`), 0, 0, 1, 1, 1, "2020-05-18", "2020-05-18", "2020-05-18", "2020-05-18", "-", "-")');
    header("Location: https://golden-hands.000webhostapp.com/index.php?user=".$a);
}
else
{
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
    
    echo '<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="shotcut icon" href="source/handmade.png">
    <link rel="stylesheet" href="source/style.css" type="text/css">
    <title>Золотые ручки</title>
</head>
<body link="#ffcba7"  alink="#5e216d" vlink="#ffcba7">
        <header align="center">
          ЗОЛОТЫЕ
          <img align="center" src="source/handmade.png" style="height: 100px; width: 100px; vertical-align: text-top;">
          РУЧКИ
    </header>';
    if (!$pdo)
    {
        echo("Невозможно подключиться к базе данных. Код ошибки: " + mysqli_connect_error()); 
        exit; 
    }
    else
        { $state = $pdo->query('SELECT `e-mail` as `key` FROM `Пользователь` WHERE `слкод` = "'.$_GET['user'].'"');
            $row = $state->fetch(PDO::FETCH_ASSOC);
            echo '<nav role="navigation"><ul>
            <li><a href="https://golden-hands.000webhostapp.com/index.php?user='.$_GET['user'].'" aria-haspopup="true">Каталог</a>
            <ul class="dropdown" aria-label="submenu">';

            echo '<li><a href="index.php?red_id=0&user='.$_GET['user'].'">';
            echo '<span id="0:?id">Все товары</span>';
            echo '</a></li>';
            $state = $pdo->query('SELECT `кодКатегории` as `key`, `имяКатегории` as `name` FROM `Категория`');
            while($row = $state->fetch(PDO::FETCH_ASSOC))
            {
                echo '<li><a href="index.php?red_id='.$row['key'].'&user='.$_GET['user'].'">';
                echo '<span id="'.$row['key'].':?id">'.$row['name'].'</span>';
                echo '</a></li>';
            }
            echo '</ul></li>
                <li><a href="posts.php?user='.$_GET['user'].'">Статьи</a></li>
                <li><a href="about.php?user='.$_GET['user'].'">О нас</a></li>';
            $state1 = $pdo->query('SELECT * FROM `Пользователь` WHERE `слкод` = "'.$_GET['user'].'"');
            $row1 = $state1->fetch(PDO::FETCH_ASSOC);
            echo '<li><a href="order.php?user='.$_GET['user'].'">Корзина</a></li>';
            if ($row1['e-mail'] == "-")
            {
                echo '
                <li><a href="user.php?user='.$_GET['user'].'">Вход</a>
                <ul class="dropdown" aria-label="submenu">
                <li>
                <a href="user.php?user='.$_GET['user'].'">Вход</a>
                </li>
                <li>
                <a href="reg.php?user='.$_GET['user'].'">Регистрация</a>
                </li></ul></li>';
            }
            else
            {
                $row1 = $state1->fetch(PDO::FETCH_ASSOC);
                echo '<li><a href="lk.php?user='.$_GET['user'].'">Личный кабинет</a></li>';
            }
            echo '</nav>';
            if (!isset($_GET['red_id']))
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
                            $state2 = $pdo->query('SELECT `имяТовара` AS `name`, `цена` as `p1`, `новаяЦена` as `p2`, `имяПроизводителя` as `proizv`
                            FROM `Товар`, `Производитель`
                            WHERE `кодТовара` = '.$row1['tov'].' AND `Производитель`.`кодПроизводителя` = `Товар`.`кодПроизводителя`');
                            $state5 = $pdo->query('SELECT `кодВида` AS `key`
                            FROM `Вид`
                            WHERE `кодТовара` = '.$row1['tov']);
                            $row2 = $state2->fetch(PDO::FETCH_ASSOC);
                            $row5 = $state5->fetch(PDO::FETCH_ASSOC);
                            echo '<h3>'.$row2['name'].'</h3>';
                            echo $row2['proizv'];
                            $p1 = $row2['p1'];
                            $p2 = $row2['p2'];
                            $state2 = $pdo->query('SELECT `фотоТовара` AS `photo` FROM `Фото`
                            WHERE `Фото`.`кодВида` = '.$row5['key']);
                            $row2 = $state2->fetch(PDO::FETCH_ASSOC);
                            echo '<br><img src='.$row2['photo'].' width="86%">';
                            if($p1>$p2)
                            {
                                echo '<div><s>'.$p1.' р</s> '.$p2.' р</div>';
                            }
                            else
                            {
                                echo '<div>'.$p2.' р</div>';
                            }
                            echo '<button onclick="location.href=`goods.php?red_id='.$row1['tov'].'&user='.$_GET['user'].'`">Купить</button></div>';
                        }
                        echo '<button id="butt2" onclick="location.href=`act.php?red_id='.$row0['key'].'&user='.$_GET['user'].'`">Все товары категории →</button>';
                    }
                }
            }
            else if($_GET['red_id'] == 0)
            {
                echo '<div width=100%><h2>Все товары</h2></div>';
                $state1 = $pdo->query('SELECT `кодТовара` as `tov` FROM `Товар`
                WHERE  1');
                $i = 0;
                while($row1 = $state1->fetch(PDO::FETCH_ASSOC))
                {
                    $i++;
                    echo '<div id="MiniBlok">';
                    $state2 = $pdo->query('SELECT `имяТовара` AS `name`, `цена` as `p1`, `новаяЦена` as `p2`, `имяПроизводителя` as `proizv`
                            FROM `Товар`, `Производитель`
                            WHERE `кодТовара` = '.$row1['tov'].' AND `Производитель`.`кодПроизводителя` = `Товар`.`кодПроизводителя`');
                    $state5 = $pdo->query('SELECT `кодВида` AS `key`
                    FROM `Вид`
                    WHERE `кодТовара` = '.$row1['tov']);
                    $row2 = $state2->fetch(PDO::FETCH_ASSOC);
                    $row5 = $state5->fetch(PDO::FETCH_ASSOC);
                            echo '<h3>'.$row2['name'].'</h3>';
                            echo $row2['proizv'];
                    $p1 = $row2['p1'];
                    $p2 = $row2['p2'];
                    $state2 = $pdo->query("SELECT `фотоТовара` AS `photo` FROM `Фото`
                    WHERE `Фото`.`кодВида` = ".$row5['key']);
                    $row2 = $state2->fetch(PDO::FETCH_ASSOC);
                    echo '<br><img src='.$row2['photo'].' width="86%">';
                    if($p1>$p2)
                    {
                        echo '<div><s>'.$p1.' р</s> '.$p2.' р</div>';
                    }
                    else
                    {
                        echo '<div>'.$p2.' р</div>';
                    }
                     echo '<button onclick="location.href=`goods.php?red_id='.$row1['tov'].'&user='.$_GET['user'].'`">Купить</button></div>';
                     if($i%3==0)
                     echo "<hr width=100% color=#e4acdf>";
                }
            }
            else
            {
                $state1 = $pdo->query('SELECT * FROM `Категория`
                WHERE  `кодКатегории` = '.$_GET['red_id']);
                $row1 = $state1->fetch(PDO::FETCH_ASSOC);
                echo '';
                echo '<div id="Blok"><h2>'.$row1['имяКатегории'].'</h2>'.$row1['описаниеКатегории'].'</div>';
                $state1 = $pdo->query('SELECT `кодТовара` as `tov` FROM `Товар`
                WHERE  `Товар`.`кодКатегории` = '.$_GET['red_id']);
                while($row1 = $state1->fetch(PDO::FETCH_ASSOC))
                {
                    echo '<div id="MiniBlok" >';
                    $state2 = $pdo->query('SELECT `имяТовара` AS `name`, `цена` as `p1`, `новаяЦена` as `p2`, `имяПроизводителя` as `proizv`
                            FROM `Товар`, `Производитель`
                            WHERE `кодТовара` = '.$row1['tov'].' AND `Производитель`.`кодПроизводителя` = `Товар`.`кодПроизводителя`');
                    $state5 = $pdo->query('SELECT `кодВида` AS `key`
                    FROM `Вид`
                    WHERE `кодТовара` = '.$row1['tov']);
                    $row2 = $state2->fetch(PDO::FETCH_ASSOC);
                    $row5 = $state5->fetch(PDO::FETCH_ASSOC);
                            echo '<h3>'.$row2['name'].'</h3>';
                            echo $row2['proizv'];
                    $p1 = $row2['p1'];
                    $p2 = $row2['p2'];
                    $state2 = $pdo->query('SELECT `фотоТовара` AS `photo` FROM `Фото`
                    WHERE `Фото`.`кодВида` = '.$row5['key']);
                    $row2 = $state2->fetch(PDO::FETCH_ASSOC);
                    echo '<br><img src='.$row2['photo'].' width="86%">';
                    if($p1>$p2)
                    {
                        echo '<div><s>'.$p1.' р</s> '.$p2.' р</div>';
                    }
                    else
                    {
                        echo '<div>'.$p2.' р</div>';
                    }
                    echo '<button onclick="location.href=`goods.php?red_id='.$row1['tov'].'&user='.$_GET['user'].'`">Купить</button></div>';
                }
            }
        }
    }
echo '
    <!--<div width=100% height=20px style="background: #000000;">qqqqqqqqqqqqqqqq</div>!-->
        <h2><hr width="100%"></h2><footer style="background: #7b2d91; color: #fcf7fc; font-size: small;">  
<hr>
        <table style="
    font-size: inherit;
    margin-left: 1%;
    margin-right: 1%;
">
            <tbody><tr>
                <td style="
    width: 30%;
">
                <div>
                <h2 style="
    text-align: center;
    color: #fcf7fc;
    font-size: 3em;
"></h2>ЗОЛОТЫЕ <img align="center" src="source/handmade.png" style="height: 45px; width: 45px;"> РУЧКИ</h2>
 Бельмесова Марина, Мадурова Мария, 2020 год.<br>
            8-(903)-511-77-77<br>
             Все права защищены.
                    </div></td> 
            <td><div>
                 <a href="contacts.php?user="'.$_GET['user'].'">Контакты</a><br>
                <a href="politics.php?user='.$_GET['user'].'">Политика в отношении персональных данных.</a><br>
                 <a href="rules.php?user='.$_GET['user'].'">Условия обмена и возврата товара</a><br>

                </div></td> 
                 <td><div> 
                 <a href="shipping.php?user='.$_GET['user'].'">Оплата И Доствка</a><br>
  <a href="shipping.php?user='.$_GET['user'].'">  Статьи</a><br>
  <a href="about.php?user='.$_GET['user'].'">  О компании</a><br>
                     </div></td> 
            </tr>
</tbody></table>
    </footer>
</body>
</html>';?>
