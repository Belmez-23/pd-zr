<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="shotcut icon" href="source/handmade.png">
     <link rel="stylesheet" href="source/style.css" type="text/css">
    <title>О нас</title>
    </head>
<body link="#ffcba7"  alink="#5e216d" vlink="#ffcba7">
    <header align="center">
          ЗОЛОТЫЕ
          <img align="center" src="source/handmade.png" style="height: 100px; width: 100px; vertical-align: text-top;">
          РУЧКИ
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
            echo '<div id="Blok"><h2>О нас</h2>
<p>Золотые ручки - интернет-магазин товаров для рукоделия. Мы продаем людям возможность заниматься любимым делом и доставляем товары для рукоделия по всей России.
</p><p>
В нашем каталоге представлены товары для вышивки, вязания, шитья, рисования, изготовления бижутерии, мыловарения и других видов рукоделия. Мы стараемся охватить как можно больше направлений, чтобы ваше творчество поистине не знало границ.
</p><p>
Мы знаем, что такое вдохновение и как важно его не упустить. Поэтому мы не просто продаем наборы для вышивания, пряжу и другие материалы, мы предлагаем к ним большой выбор сопутствующих товаров и аксессуаров. Это дает вам возможность приступить к процессу сразу после получения заказа, не отвлекаясь на поиск необходимых инструментов.
</p><p>
Вы можете сделать заказ в любое время: служба поддержки и приема заказов работает круглосуточно. Мы доставляем заказы почтой.
</p><p>
Мы всегда на связи! Звоните нам, пишите на нашу почту - мы обязательно ответим.</p></div>
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
</html>';
        }
        ?>