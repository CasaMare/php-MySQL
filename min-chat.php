<?php //мини-чат,  добавление нового сообщения в чат

if(isset($_POST['chatSubmit']) && $_POST['chatName']!=null && htmlspecialchars($_POST['message'])!=null){
    include('connect-db.php');
    $newMessage = $mysqli ->query("INSERT INTO `u462989926_chat`.`chat` (`id`, `login`, `message`, `data`) VALUE (NULL , '".$_POST['chatName']."', '".htmlspecialchars($_POST['message'])."', '".time()."')");
    header("Location: {$_SERVER['HTTP_REFERER']}");// избавляет от всплывающего окошка после обновления страницы(нет повторной отправки инфы)
$mysqli ->close();
}
?>
<!--мини-чат-->
<div class="header-chat">
    <center><b>Мини-чат</b></center>
</div>
<div class="min-chat">
    <div class="chat">
        <?php
        //функция выводит все сообщения в мини-чате
        function printResult($result_set){
            while(($row = $result_set->fetch_assoc()) != false){
                echo "<div class='message'>
                <div class='header-message'>
                <div class='time'>";
                echo "<img class='img1' src='img/clock.png'/><div class='year'>".date("d.F.Y",$row["data"])."</div>".date("G.i",$row["data"])."<!--вывод времени-->
                <a  href='index.php?id=".$row["id"]."'><img class='img2' src='img/cross.png'></a>"; //выводит иконку крестика нужный id для ужаления сообщения
                echo "</div>";
                echo "<b>".$row["login"]."|</b>"."<br>";
                echo $row["message"];
                echo "</div>";
                echo "</div>";
            }
        }
        include('connect-db.php');
        /* $result_set = $mysqli->query("SELECT * FROM  `chat`");*/ //выводит сообщения по возрастанию
        $result_set = $mysqli->query("SELECT * FROM `chat` ORDER BY `id` DESC"); //выводит сообщения по убыванию
        printResult($result_set);


        //Если нажата иконка удаления, то нужное сообщение удаляется
        if(isset($_GET['id'])) {
            $mysqli->query("DELETE FROM `chat` WHERE `id`='" . $_GET['id'] . "' ");
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
        $mysqli ->close();

        //Вывод смайликов
        $m=$_POST['message'];
        $m = nl2br($m);
        $m = str_replace("<","[",$m);
        $m = str_replace(">","]",$m);
        $m = str_replace(":)","<IMG SRC='img/smiles/1.gif'",$m);
        $m = str_replace(":(","<IMG SRC='image/8.gif' WIDTH='19' HEIGHT='19' BORDER='0'>",$m);
        $m = str_replace(":B","<IMG SRC='image/2.gif' WIDTH='19' HEIGHT='19' BORDER='0'>",$m);
        $m = str_replace(":D","<IMG SRC='image/3.gif' WIDTH='19' HEIGHT='19' BORDER='0'>",$m);
        $m = str_replace("O_o","<IMG SRC='image/6.gif' WIDTH='19' HEIGHT='19' BORDER='0'>",$m);
        $m = str_replace(":~","<IMG SRC='image/5.gif' WIDTH='19' HEIGHT='19' BORDER='0'>",$m);
        $m = str_replace("!!!!","<IMG SRC='image/4.gif' WIDTH='19' HEIGHT='19' BORDER='0'>",$m);
        $m = str_replace(":-)","<IMG SRC='image/7.gif' WIDTH='19' HEIGHT='19' BORDER='0'>",$m);
        $m = str_replace("<","[",$m);
        $m = str_replace(">","]",$m);
        $m = str_replace("[b]","<b>",$m);
        $m = str_replace("[/b]","</b>",$m);
        $m = str_replace("[/i]","</i>",$m);
        $m = str_replace("[i]","<i>",$m);
        $m = str_replace("[br]","<br>",$m);

        if(isset($_GET['smile1'])){

        }

        ?>
    </div><br>
    <div class="text-form fl-left">
        <form method="post" action="">
            <input type="hidden" name="chatName" value="<?php echo $_SESSION['user_login'];?>">
            <textarea name="message" value=""></textarea>
            <input type="submit" name="chatSubmit" value="ok">
        </form>
        <div class="chat-nav fl-left">
            <div class="smiles fl-left">
                <img src="img/smiles/123.png">
                <div class="smiles-sub">
                    <ul>
                        <li><a href="" onClick="smile1();"><img src="img/smiles/1.gif"></a></li>
                        <li><a href=""><img src="img/smiles/2.gif"></a></li>
                        <li><a href=""><img src="img/smiles/3.gif"></a></li>
                        <li><a href=""><img src="img/smiles/4.gif"></a></li>
                        <li><a href=""><img src="img/smiles/5.gif"></a></li><br>
                        <li><a href=""><img src="img/smiles/6.gif"></a></li>
                        <li><a href=""><img src="img/smiles/7.gif"></a></li>
                        <li><a href=""><img src="img/smiles/8.gif"></a></li>
                        <li><a href=""><img src="img/smiles/9.gif"></a></li>
                        <li><a href=""><img src="img/smiles/10.gif"></a></li>
                        <li><a href=""><img src="img/smiles/11.gif"></a></li><br>
                        <li><a href=""><img src="img/smiles/12.gif"></a></li>
                        <li><a href=""><img src="img/smiles/13.gif"></a></li>
                        <li><a href=""><img src="img/smiles/14.gif"></a></li>
                        <li><a href=""><img src="img/smiles/15.gif"></a></li>
                        <li><a href=""><img src="img/smiles/16.gif"></a></li>
                        <li><a href=""><img src="img/smiles/17.gif"></a></li><br>
                        <li><a href=""><img src="img/smiles/18.gif"></a></li>
                        <li><a href=""><img src="img/smiles/19.gif"></a></li>
                    </ul>
                </div>
            </div>
            <a href="index.php"><img src="img/01-refresh.png" width="20"></a>
        </div>
    </div>






</div>