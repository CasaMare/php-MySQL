<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Пробный проект</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">
        /*по нажати на кнопку "регистрация" блок формы регистрации открывается*/
        function showRegForm(){
            $("#registration").fadeIn(800);
        }
        $(document).ready(function() {
            $("#registration").hide();
            $("#showRegForm").bind("click",showRegForm);
        });
        /* если блок регистрации открыт, то при нажатии вне его он закроется*/
        $(document).mouseup(function (e) {
            var container = $("#registration");
            if (container.has(e.target).length === 0){
                container.hide();
            }
        });
//отображения настрек аккаунта по нажатию на кнопку
        function showEdit(){
            $(".tools").fadeIn(800);
        }
        $(document).ready(function() {
            $(".tools").hide();
            $("#showEdit").bind("click",showEdit);
        });

        $(document).mouseup(function (e) {
            var container = $(".tools");
            if (container.has(e.target).length === 0){
                container.hide();
            }
        });





    </script>
</head>
<body>
<header>
    <div class="head">
        <div class="container">
            <div class="logo fl-left">
                <span>g</span>
            </div>
            <div class="logo-trg-r fl-left">
            </div>
            <div class="inc fl-left">
                Good Inc.
            </div>


        </div>
    </div>

    <nav class="container main-menu">
        <img src="images/map-icon.png" name="icon" alt="map-icon"/>
        <ul>
            <li><a href="">Portfolio</a></li>
            <li><a href="">Services</a></li>
            <li><a href="">Staff</a></li>
            <li><a href="">Articles</a></li>
            <li><a href="">Contact</a></li>
        </ul>

        <div class="user-table fl-left">
            <img id="avatar" src="images/usersavatars/<?php echo $_SESSION['user_avatar']; ?>" alt="avatar"><!--переменная создвется в core.php-->
            <!--Поле авторизации начало-->
            <?php
            if (!isset($_SESSION['user_id']) && !isset($_POST['showRegForm'])) {   //если пользователь не авторизировался и сессия не стартанула, то поле авторизации видно
                ?>
                <div class="login fl-left">
                    <form method="post" action="core.php">
                        <input type="text" name="loginAth" size="8" placeholder="логин">
                        <input type="password" name="passwordAth" size="8" placeholder="пароль">


                </div>
                <div class="user-button fl-left">
                    <input type="submit" value="Войти" name="submitAth">
                    </form>

                    <a href="" id="showRegForm" name="showRegForm" onclick="return false;" >Регистрация</a>

                </div>
                <?php
            }
            ?>
            <!--Поле авторизации конец-->

            <!--Если пользователь залогинился то выводится инфа+кнопка начало-->
            <?php if(isset($_SESSION['user_id'])) { //если сессия существует, то кнопка видна
                ?>
                <div class="login fl-left">
                    <span class="fl-left"><?php  echo  $_SESSION['user_login']; ?></span>
                    <img id="showEdit" src="img/tools.png" alt="tools" width="20" />
                    <br>
                    <form method="post" action="core.php">
                        <input type="submit" value="Выйти" name="exit">
                    </form>
                </div>
                <?php
            }
            ?>
            <!--Если пользователь залогинился то выводится инфа+кнопка конец-->
        </div>
    </nav>


</header>

<div class="left-container container">
    <?php include('min-chat.php'); ?>
</div>

<!--Форма регистрации начало -->
<div class="container">
    <div class="registration" id="registration">
        <center>
            <h1>Форма регистрации</h1>
        </center>
        <div class="label-reg fl-left">
            <label for="loginReg">Логин</label><br><br>
            <label for="mailReg">Эл.почта</label><br><br>
            <label for="passwordReg">Пароль</label><br><br>
            <label for="passwordReg2">Повторите пароль</label>

        </div>
        <div class="input-reg fl-left">
            <form method="post" action="core.php">
                <input type="text" id="loginReg" name="loginReg" size="25" placeholder="логин"><br><br>
                <input type="email" id="mailReg" name="mailReg" size="25" placeholder="эл.почта"><br><br>
                <input type="password" id="passwordReg" name="passwordReg" size="25" placeholder="пароль"><br><br>
                <input type="password" id="passwordReg2" name="passwordReg2" size="25" placeholder="пароль"><br><br><br>
                <input type="submit" name="submitReg" value="Зарегестрироваться">
            </form>
        </div>
    </div>
</div>
<!--Форма регистрации конец -->

<!--настройка аккаунта начало-->
<div class="container">
    <div class="tools">
        <div class="avatar fl-left">
            <img id="avatar" src="images/usersavatars/<?php echo $_SESSION['user_avatar']; ?>" alt="avatar"><!--переменная создвется в core.php-->
            <form method="post" action="core.php" enctype="multipart/form-data">
                <input name="filename" type="file" value="Добавить аватар" /><br>
                <input type="submit" name="addAvatar" />
            </form>
        </div>
        <div class="edit fl-left">
            <form method="post" action="core.php">
                <input id="login-edit" name="login-edit" class="form" type="text" value="<?php echo $_SESSION['user_login'];?>" /><span><label for="login-edit">логин</label></span><br>
                <input id="password-edit" name="password-edit" class="form" type="password" /><span><label for="password-edit">пароль</label></span><br>
                <input id="mail-edit" name="mail-edit" class="form" type="email" placeholder="<?php echo $_SESSION['user_email'];?>" /><span><label for="mail-edit">Эл.почта</label></span><br>
                <input name="submitEdit" type="submit" value="Изменить" />
            </form>
        </div>
        <div class="data">
            <img src="img/clock_time_watch.png" width="25" />
            <span>Дата регистрации</span><br>
            <span><?php echo $_SESSION['user_data']; ?></span>
        </div>
    </div>
</div>
<!--настройка аккаунта конец-->
</body>
</html>