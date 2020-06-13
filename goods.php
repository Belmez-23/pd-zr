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
    
    echo '<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="shotcut icon" href="source/handmade.png">
    <link rel="stylesheet" href="source/style.css" type="text/css">
    <title>Золотые ручки</title>
</head>
<body link="#ffcba7"  alink="#5e216d" vlink="#ffcba7">';
            if (isset($_GET['add']))
            echo "Товар добавлен в корзину. <a href='order.php?user=".$_GET['user']."'>Перейти в корзину</a>";
echo '
    <header align="center">
          ЗОЛОТЫЕ
          <img align="center" src="source/handmade.png" style="height: 1em; width: 1em; vertical-align: text-top;">
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

        echo '<div id="Blok" >'; 
        //вооот здесь было начало дива который в диве, но я его удалила кек маша небей
        $k = 0;
        $state1 = $pdo->query('SELECT * FROM `Вид` WHERE `кодТовара` = '.$_GET['red_id']);
        while($row1 = $state1->fetch(PDO::FETCH_ASSOC))
        {
            $k++;
        }
        if($k > 1)
        {
            $state1 = $pdo->query('SELECT * FROM `Вид` WHERE `кодТовара` = '.$_GET['red_id']);
            $row1 = $state1->fetch(PDO::FETCH_ASSOC);
            $state2 = $pdo->query('SELECT `фотоТовара` as `photo` FROM `Фото` WHERE `кодВида` ='.$row1['кодВида']);
            $row2 = $state2->fetch(PDO::FETCH_ASSOC);
            echo '<img src="'.$row2['photo'].'" align="left" vspace="5" hspace="5" style="height: 282px; width: auto;">';
            $state3 = $pdo->query('SELECT * FROM `Товар` WHERE `кодТовара` = '.$_GET['red_id']);
            $row3 = $state3->fetch(PDO::FETCH_ASSOC);
            echo '<h2>'.$row3['имяТовара'].'</h2>';
            if ($row3['цена'] > $row3['новаяЦена'])
            {
                echo '<s>'.$row3['цена'].' p </s> '.$row3['новаяЦена'].' p<br>';
            }
            else
            {
                echo $row3['новаяЦена'].' p<br>';
            }
            echo $row3['описаниеТовара'];
            echo '<table id="table" width="70%" color="#fcf7fc">';
            $state5 = $pdo->query('SELECT * FROM `Производитель` WHERE `кодПроизводителя` = '.$row3['кодПроизводителя']);
            $row5 = $state5->fetch(PDO::FETCH_ASSOC);
            echo '<tr><td width="30%">Производитель</td><td><a href="company.php?red_id='.$row5['кодПроизводителя'].'&user='.$_GET['user'].'">
                <span id="'.$row5['кодПроизводителя'].':?id">'.$row5['имяПроизводителя'].'</span>
                </a></li></td></tr>';

            $state4 = $pdo->query('SELECT * FROM `Характеристики` WHERE `кодВида` = '.$row1['кодВида']);
            while ($row4 = $state4->fetch(PDO::FETCH_ASSOC))
            {
                echo '<tr><td width="30%">'.$row4['имяХарактеристики'].'</td><td>'.$row4['величина'].' '.$row4['едИзмерения'].'</td></tr>';
            }
            echo '</table></div><h2>Все виды товара:</h2>';
            while ($row1 = $state1->fetch(PDO::FETCH_ASSOC))
            {
                $state4 = $pdo->query('SELECT * FROM `Характеристики` WHERE `кодВида` = '.$row1['кодВида']);
                $row4 = $state4->fetch(PDO::FETCH_ASSOC);
                echo '<div id="MiniBlok">'.$row4['имяХарактеристики'].': '.$row4['величина'].' '.$row4['едИзмерения'].'<br>';
                $state2 = $pdo->query('SELECT `фотоТовара` as `photo` FROM `Фото` WHERE `кодВида` ='.$row1['кодВида']);
                $row2 = $state2->fetch(PDO::FETCH_ASSOC);
                echo '<img src="'.$row2['photo'].'" style="width: 86%;">';
                if ($row1['остаток'] > 0)
                {
                    echo '<br>В наличии: '.$row1['остаток'].'
                <button onclick="location.href=`add/in_order.php?red_id='.$row1['кодВида'].'&user='.$_GET['user'].'`">В корзину</button></div>';
                }
                else
                {
                    echo '<br>Нет в наличии
                <button>Нет в наличии</button></div>';
                }
            }
        }
        else
        {
            $state1 = $pdo->query('SELECT * FROM `Вид` WHERE `кодТовара` = '.$_GET['red_id']);
            $row1 = $state1->fetch(PDO::FETCH_ASSOC);
            $state2 = $pdo->query('SELECT `фотоТовара` as `photo` FROM `Фото` WHERE `кодВида` ='.$row1['кодВида']);
            $row2 = $state2->fetch(PDO::FETCH_ASSOC);
            echo '<img src="'.$row2['photo'].'" align="left" vspace="5" hspace="5" style="height: 282px; width: auto;">';
            $state3 = $pdo->query('SELECT * FROM `Товар` WHERE `кодТовара` = '.$_GET['red_id']);
            $row3 = $state3->fetch(PDO::FETCH_ASSOC);
            echo '<h2>'.$row3['имяТовара'].'</h2>';
            if ($row3['цена'] > $row3['новаяЦена'])
            {
                echo '<s>'.$row3['цена'].' p </s> '.$row3['новаяЦена'].' p<br>';
            }
            else
            {
                echo $row3['новаяЦена'].' p<br>';
            }
            echo $row3['описаниеТовара'];


            $state5 = $pdo->query('SELECT * FROM `Производитель` WHERE `кодПроизводителя` = '.$row3['кодПроизводителя']);
            $row5 = $state5->fetch(PDO::FETCH_ASSOC);
            echo '<table id="table" width="50%" style="color: #fcf7fc;">';
            echo '<tr><td width="30%">Производитель</td><td>'.$row5['имяПроизводителя'].'</td></tr>';
            $state4 = $pdo->query('SELECT * FROM `Характеристики` WHERE `кодВида` = '.$row1['кодВида']);
            while ($row4 = $state4->fetch(PDO::FETCH_ASSOC))
            {
                echo '<tr><td width="30%">'.$row4['имяХарактеристики'].'</td><td>'.$row4['величина'].' '.$row4['едИзмерения'].'</td></tr>';
            }
            $row2 = $state2->fetch(PDO::FETCH_ASSOC);
            if ($row1['остаток'] >0){
            echo '</table><br>В наличии: '.$row1['остаток'].'<br>
            <button id="butt2" onclick="location.href=`add/in_order.php?red_id='.$row1['кодВида'].'&user='.$_GET['user'].'`">В корзину</button></div>';
            }
            else
            {
                         echo '</table><br>Нет в наличии<br>
            <button id="butt2">Нет в наличии</button></div>';   
            }
        }
    }
echo '
    <!--<div width=100% height=20px style="background: #000000;">qqqqqqqqqqqqqqqq</div>!-->
        <hr width="100%"><footer style="background: #7b2d91; color: #fcf7fc; font-size: small;">  
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
 Бельмесова Марина, Мадурова Мария, 2020 год. <br>
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