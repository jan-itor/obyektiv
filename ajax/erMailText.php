<?php

    if(sizeof($_POST) > 0){

        $message = "Ошибка в тексте: ".$_POST['errText']." по ссылке".$_POST['erLink'];

        $success =  mail("http://obyektiv.press/", "Ошибка в тексте на сайте obyektiv.press", $message,
            "From: Газета Объектив\r\n"
            ."Reply-To:content-algoritm@yandex.ru\r\n"
            ."X-Mailer: PHP/" . phpversion());

    }

?>