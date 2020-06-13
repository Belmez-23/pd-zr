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
        }
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
<div id="MiniBlok" align="left" style="width: 74%;"><H2>Одобренные заказы</H2>';
                $state1 = $pdo->query('SELECT * FROM `Пользователь` WHERE `слкод` = "'.$_GET['user'].'"');
                $row = $state1->fetch(PDO::FETCH_ASSOC);
$state1 = $pdo->query('SELECT * FROM `Заказ` WHERE `кодСтатуса` = 3 AND `кодПользователя` = '.$row['кодПользователя']);
$i=0;
while($row1 = $state1->fetch(PDO::FETCH_ASSOC))
$i++;
if ($i == 0)
echo '<h3>Здесь ничего нет!</h3>';
else {
        $state1 = $pdo->query('SELECT * FROM `Заказ` WHERE `кодСтатуса` = 3 AND `кодПользователя` = '.$row['кодПользователя']);
while($row1 = $state1->fetch(PDO::FETCH_ASSOC))
{

 echo '<table id="table"  width="100%">';  
$state2 = $pdo->query('SELECT * FROM `ЗаказыИТовары` WHERE `кодЗаказа` = '.$row1['кодЗаказа']);
echo '<tr><th>Фото1</th><th>Товар</th><th>Вид</th><th>Кол-во</th><th>Цена</th><th>Стоимость</th></tr>';
$total = 0;
$i = 0;
while($row2 = $state2->fetch(PDO::FETCH_ASSOC))
{
    $state3 = $pdo->query('SELECT * FROM `Вид` WHERE `кодВида` = '.$row2['кодВида']);
    $row3 = $state3->fetch(PDO::FETCH_ASSOC);
    $state4 = $pdo->query('SELECT * FROM `Фото` WHERE `кодВида` = '.$row3['кодВида']);
    $row4 = $state4->fetch(PDO::FETCH_ASSOC);
    $state5 = $pdo->query('SELECT * FROM `Товар` WHERE `кодТовара` = '.$row3['кодТовара']);
    $row5 = $state5->fetch(PDO::FETCH_ASSOC);
    $state6 = $pdo->query('SELECT * FROM `Характеристики` WHERE `кодВида` = '.$row2['кодВида']);
    $row6 = $state6->fetch(PDO::FETCH_ASSOC);
    echo '<tr><td><img src="'.$row4['фотоТовара'].'" style="width: 50px; height: 50px; vertical-align: middle;"></td><td> 
    '.$row5['имяТовара'].'</td><td>'.$row6['имяХарактеристики'].': '.$row6['величина'].' '.$row6['едИзмерения'].'</td><td>'.$row2['количество'].'</td><td>'.$row5['новаяЦена'].' p</td><td>'.$row5['новаяЦена']*$row2['количество'].' p</td></tr>';
        $total = $row5['новаяЦена']*$row2['количество'] + $total;
    $i++;
}
$total = $total + 365;
echo '<tr><td></td><td colspan="4">Доставка</td><td>365 р</td>';
echo '<tr><td>Итого</td><td colspan="4">'.$i;
if ($i%10 == 1 && $i/10 != 1)
    echo ' товар';
else if (($i%10 == 2 || $i%10 == 3 || $i%10 == 4) && $i/10 != 1)
    echo ' товара';
else echo 'товаров';
echo '</td><td>'.$total.' p</td></tr>';
echo '</table>';
echo $row1['комментарий'];
}
}
echo '
   </div>
        <hr  width="100%" color="#e4acdf"><footer style="background: #7b2d91; color: #fcf7fc; font-size: small;">  
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