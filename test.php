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
    <link rel="stylesheet" href="slider.css">
    <script src="slides.js"></script>
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



            /*
             Get the curent slide
             */
        function currentSlide( current ) {
            $(".current_slide").text(current + " of " + $("#slides").slides("status","total") );
        }

        $(function(){
            /*
             Initialize SlidesJS
             */
            $("#slides").slides({
                navigateEnd: function( current ) {
                    currentSlide( current );
                },
                loaded: function(){
                    currentSlide( 1 );
                }
            });

            /*
             Play/stop button
             */
            $(".controls").click(function(e) {
                e.preventDefault();

                // Example status method usage
                var slidesStatus = $("#slides").slides("status","state");

                if (!slidesStatus || slidesStatus === "stopped") {

                    // Example play method usage
                    $("#slides").slides("play");

                    // Change text
                    $(this).text("Stop");
                } else {

                    // Example stop method usage
                    $("#slides").slides("stop");

                    // Change text
                    $(this).text("Play");
                }
            });
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

                    <a href="#" id="showRegForm" name="showRegForm" >Регистрация</a>

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



    <div id="slides">
        <img src="images/1.jpg" width="780" height="300" alt="Slide 1">

        <img src="images/2.jpg" width="780" height="300" alt="Slide 2">

        <img src="images/3.jpg" width="780" height="300" alt="Slide 3">

        <img src="images/4.jpg" width="780" height="300" alt="Slide 4">

        <img src="http://slidesjs.com/examples/standard/img/slide-5.jpg" width="780" height="300" alt="Slide 5">

        <img src="http://slidesjs.com/examples/standard/img/slide-6.jpg" width="780" height="300" alt="Slide 6">

        <img src="http://slidesjs.com/examples/standard/img/slide-7.jpg" width="780" height="300" alt="Slide 7">
    </div>

    <a href="#" class="controls">Play</a>


    <p class="current_slide"></p>
</div>



</body>
</html>