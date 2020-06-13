<?php
echo '<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="shotcut icon" href="source/handmade.png">
     <link rel="stylesheet" href="source/style.css" type="text/css">
    <title>Золотые ручки</title>
    <style type="text/css">
        /*Взято из https://html5css.ru/howto/howto_css_register_form.php*/
        * {box-sizing: border-box}

/* Add padding to containers */
.container {
  padding: 16px;
}
body
{
    	font-family: Arial;
}
/* Я шатал эти гиперссылки */
a {
  color: #fcfcfc;
}
a:hover {
  color: #fcfcfc;
}

a:link {
  color: #fcfcfc;
}

a:active {
  color: #fcfcfc;
}

footer: hover{
    color: #ff4873;
}
/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #fcf7fc;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #fcf7fc;
  margin-bottom: 25px;
}

/* Set a style for the submit/register button */
.registerbtn {
  background-color: #ff4873;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
    height: 52px;
}

.registerbtn:hover {
  opacity:1;
}


/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #5e216d;
  text-align: center;
}
</style>
</head>
<body link="#ffcba7"  alink="#5e216d" vlink="#ffcba7">';
if(isset($_GET['s']))
    echo 'Вам необходимо зарегистрироваться, чтобы оформить заказ<br>';
if(isset($_GET["err"]))
echo "Пароли не совпадают";
echo ' <header>
  <p align="center">
ЗОЛОТЫЕ <a href="https://golden-hands.000webhostapp.com/"><img align="center" src="source/handmade.png" style="height: 66px; width: 66px; vertical-align: text-top;"></a> РУЧКИ
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
    }
    if (isset($_GET['s']))
    echo '<form name="1" method="POST" action="add/add_user.php?s=1&user='.$_GET['user'].'">';
    else echo '<form name="1" method="POST" action="add/add_user.php?user='.$_GET['user'].'">';
    echo '
  <div class="container">
    <h2>Регистрация нового пользователя</h2>
    Пожалуйста, заполните эту форму, чтобы создать аккаунт.
    <hr>
    <label for="email"><b>Электронная почта</b></label>
    <input type="text" placeholder="Введите Email" name="email" required>

    <label for="psw"><b>Пароль</b></label>
    <input type="password" placeholder="Введите пароль" name="psw" required>

    <label for="pswr"><b>Повторите пароль</b></label>
    <input type="password" placeholder="Повторите пароль" name="pswr" required>
    <hr>

    <button type="submit" class="registerbtn">Зарегистрироваться</button>
  </div>

  <div class="container signin" width="100%">
    Уже есть аккаунт? <a href="user.php?user='.$_GET['user'].'" alink="#ff4873">Войти</a>.
  </div>
</form>

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