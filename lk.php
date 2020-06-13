<?php
             if ($_GET['user'] == 1)
            {
                header("Location: https://golden-hands.000webhostapp.com/admin.php");
            }
            else
            {
                echo '<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="shotcut icon" href="source/handmade.png">
     <link rel="stylesheet" href="source/style.css" type="text/css">
    <title>Золотые ручки</title>
  
</head>
<body link="#ffcba7"  alink="#5e216d" vlink="#ffcba7">
    <header align="center">
          ЗОЛОТЫЕ <a href="https://golden-hands.000webhostapp.com/"><img align="center" src="source/handmade.png" style="height: 1em; width: 1em; vertical-align: text-top;"></a> РУЧКИ
    </header>';
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
             $state = $pdo->query('SELECT `e-mail` as `key` FROM `Пользователь` WHERE `слкод` = "'.$_GET['user'].'"');
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
                        $state1 = $pdo->query('SELECT * FROM `Пользователь` WHERE `слкод` = "'.$_GET['user'].'"');
            $row1 = $state1->fetch(PDO::FETCH_ASSOC);
echo '    
    <H2>Личный кабинет</H2>
<div id="MiniBlok" style="height: auto; width: 22%;"><H2>'.$row1['имя'].'</H2>
<button onclick="location.href=`lk.php?user='.$_GET['user'].'`">Личные данные</button><br>
<button onclick="location.href=`order.php?user='.$_GET['user'].'`">Корзина</button><br>
<button onclick="location.href=`waiting.php?user='.$_GET['user'].'`">В ожидании</button><br>
<button onclick="location.href=`order_ok.php?user='.$_GET['user'].'`">Обработано</button><br>
<button onclick="location.href=`sent.php?user='.$_GET['user'].'`">Отправлено</button><br>
<button onclick="location.href=`rej.php?user='.$_GET['user'].'`">Отклонено</button><br>
    </div>
<div id="MiniBlok" align="left" style="width: 74%;"><H2>Личные данные</H2>
<form name="form3" action="add/ch_user.php" method="get" enctype="multipart/form-data">
<table id="table" width="50%" style="color: #fcf7fc;"><tr><td>
    <input hidden name="user" value="'.$_GET['user'].'">
    Имя </td><td><input type="text" style="width: 100%; font: caption;" name="name" value="'.$row1['имя'].'">
        </td></tr><tr><td>
    Фамилия </td><td><input type="text" style="width: 100%; font: caption;" name="name2" value="'.$row1['фамилия'].'">
        </td></tr><tr><td>
    Отчество </td><td><input type="text" style="width: 100%; font: caption;" name="name3" value="'.$row1['отчество'].'">
        </td></tr><tr><td>
    Телефон </td><td><input type="text" style="width: 100%; font: caption;" name="ph" value="'.$row1['телефон'].'">
        </td></tr><tr><td>
    Индекс </td><td><input type="text" style="width: 100%; font: caption;" name="index" value="'.$row1['индекс'].'">
        </td></tr><tr><td>
    Область </td><td><input type="textarea" style="width: 100%; font: caption;" name="adress1" value="'.$row1['область'].'">
        </td></tr><tr><td>
    Населенный пункт </td><td><input type="text" style="width: 100%; font: caption;" name="city" value="'.$row1['населенныйПункт'].'">
        </td></tr><tr><td>
    Улица </td><td><input type="textarea" style="width: 100%; font: caption;" name="adress" value="'.$row1['улица'].'">
    </td></tr><tr><td>
    Дом </td><td><input type="textarea" style="width: 100%; font: caption;" name="adress2" value="'.$row1['дом'].'">
    </td></tr><tr><td>
    Квартира </td><td><input type="textarea" style="width: 100%; font: caption;" name="adress3" value="'.$row1['квартира'].'">
        </td></tr></table>
<button align="center">Сохранить</button>
</form>';
            }
echo '<button onclick="location.href=`index.php`">Выйти</button>';
echo '</div>
    <hr color="#e4acdf">
      <footer style="background: #7b2d91; color: #fcf7fc; font-size: small;">  
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
</html>';}?>