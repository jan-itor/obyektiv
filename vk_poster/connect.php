<?php

    require  'config.php';

    if (!empty($_GET['code'])){

        // вконтакт присылает нам код        
        $vkontakteCode=$_GET['code'];
        
        // получим токен 
        $tokenNeed = "https://oauth.vk.com/access_token?client_id=$vkontakteApplicationId&client_secret=$vkontakteKey&code=$vkontakteCode&redirect_uri=http://obyektiv.press/vk_poster/connect.php";
        $sUrl = "https://api.vk.com/oauth/access_token?client_id=$vkontakteApplicationId&client_secret=$vkontakteKey&code=$vkontakteCode";
        //print_r($tokenNeed);
// создадим объект, содержащий ответ сервера ¬контакте, который приходит в формате JSON
        $oResponce = json_decode(file_get_contents($tokenNeed));
          print_r($oResponce);
        $fp = fopen('token.txt', 'w');
        fputs($fp, $oResponce->access_token);
        fclose($fp);
        
}

?>
<a href="http://api.vk.com/oauth/authorize?client_id=<?=$vkontakteApplicationId?>&scope=wall,offline,messages,ads,photos&redirect_uri=https://oauth.vk.com/blank.html&response_type=token">Auth VK</a>