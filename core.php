<?php
//происходит регистрация нового пользователя--------------------------------------
if(isset($_POST['submitReg']) && $_POST['passwordReg'] == $_POST['passwordReg2']){
    include('connect-db.php');
    $newRegistration = $mysqli ->query("INSERT INTO `u462989926_chat`.`users` (`id`, `login`, `password`, `email`, `data`) VALUE (NULL , '".$_POST['loginReg']."', '".md5($_POST['passwordReg'])."','".$_POST['mailReg']."', '".time()."')");
    ?>
    <script type="text/javascript">
        setTimeout('location.replace("http://ionsuruceanu.hol.es/")', 1);
    </script>
    <?php
    $mysqli -> close();
}
//происходит проверка введенного логина и пароля-----------------------------------
if(!$_POST['submitAth']){//выводится стандартный аватар если пользователь не авторизировался
    session_start();
    $_SESSION['user_avatar'] = "avatar.jpeg";
}
if(isset($_POST['submitAth'])){
    include('connect-db.php');
    $query = $mysqli -> query("SELECT * FROM `users`");
    $row = mysqli_fetch_array($query);
    do {
        if($_POST['loginAth'] == $row['login'] && md5($_POST['passwordAth']) == $row['password']){

            session_start(); //стартует сессия
            $_SESSION['user_id'] = $row['id'];//название сессии привязана к id пользователя
            $_SESSION['user_login'] = $row['login'];
            $_SESSION['user_email'] = $row['email'];
            //массив для вывод название месяца на русском
            $months = array (
                1=>'Январь', 2=>'Февраль', 3=>'Март', 4=>'Апрель', 5=>'Май', 6=>'Июнь', 7=>'Июль', 8=>'Август', 9=>'Сентябрь', 10=>'Октябрь', 11=>'Ноябрь', 12=>'Декабрь'
            );
            $_SESSION['user_data'] = date("d",$row['data']). $months[date("n",$row['data'])]. date("Y",$row['data']);
            if($row['avatar'] == null) {
                $_SESSION['user_avatar'] = "avatar.jpeg";
            }else {
                $_SESSION['user_avatar'] = $row['avatar'];
            }
            ?>
<script type="text/javascript">
    setTimeout('location.replace("http://ionsuruceanu.hol.es/")', 1);
</script>
<?php
        }

        if($_POST['loginAth'] != $row['login'] || $_POST['passwordAth'] != $row['password']){
            echo "Логин и пароль не совпадает!";
        }
    } while ($row = mysqli_fetch_array($query));
    $mysqli -> close();
}
// уничтожение сессии (выход из учетной записи)----------------------------------------
if(isset($_POST['exit'])){
    session_start();
    unset($_SESSION['user_id']);
    session_destroy();
    ?>
    <script type="text/javascript">
        setTimeout('location.replace("http://ionsuruceanu.hol.es/")', 1);
    </script>
    <?php
}

//-------------------загрузска файла начало-----------------------------
if(isset($_POST['addAvatar'])) {
    if ($_FILES["filename"]["size"] > 1024 * 3 * 1024) {
        echo("Размер файла превышает три мегабайта");
        exit;
    }
// Проверяем загружен ли файл
    if (is_uploaded_file($_FILES["filename"]["tmp_name"])) {
        // Если файл загружен успешно, перемещаем его
        // из временной директории в конечную
        move_uploaded_file($_FILES["filename"]["tmp_name"], "images/usersavatars/" . $_FILES["filename"]["name"]);
        //идет запись в таблицу имя загруженного аватара
        $fileName = $_FILES["filename"]["name"];
        include('connect-db.php');
        $saveName = $mysqli->query("UPDATE `users` SET `avatar` = '$fileName' WHERE `id` = '".$_SESSION['user_id']."'");
        $mysqli->close();
        $_SESSION['user_avatar'] = $fileName;
    } else {
        echo("Ошибка загрузки файла");
    }
}
//-------------------загрузска файла конец-----------------------------

//------------------Изменение профиля пользователя в настройках ---------------
if(isset($_POST['submitEdit'])){
    include('connect-db.php');
    if(isset($_POST['login-edit']))$loginEdit -> $mysqli("UPDATE `users` SET `login` = '".$_POST['login-edit']."' ");
    if(isset($_POST['password-edit'])) $passwordEdit -> $mysqli("UPDATE `users` SET `password` = '".$_POST['password-edit']."' ");
    if(isset($_POST['mail-edit']))$mailEdit -> $mysqli("UPDATE `users` SET `email` = '".$_POST['mail-edit']."' ");
    $mysqli->close();
}


?>
<script type="text/javascript">
    setTimeout('location.replace("http://ionsuruceanu.hol.es/")', 1);
</script>

