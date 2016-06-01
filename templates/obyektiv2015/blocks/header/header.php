

    <div class="left_anchor_full"> <nobr id="stl_text" class=""><div class="left_anchor_img"></div>Наверх</nobr></div>

<!--HEADER-->
<header class="header">
    <script src="https://www.gismeteo.ua/ajax/getInformer/?hash=wB4UEF1n56AhDq" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://s1.gismeteo.ua/static/css/informer2/gs_informerClient.min.css">
        <?
    /*$city_id=33991; // id города
    $data_file="http://export.yandex.ru/weather-ng/forecasts/$city_id.xml"; // адрес xml файла 
              $xml = simplexml_load_file($data_file); // раскладываем xml на массив
    // выбираем требуемые параметры (город, температура, пиктограмма и тип погоды текстом (облачно, ясно)

    $city=$xml->fact->station;
    $temp=$xml->fact->temperature;
    $pic=$xml->fact->image;
    $type=$xml->fact->weather_type;

    // Если значение температуры положительно, для наглядности добавляем "+"
    if ($temp>0) {$temp='+'.$temp;}*/
    
    $monthArray = array( 
"01" => "января", 
"02" => "февраля", 
"03" => "марта", 
"04" => "апреля", 
"05" => "мая", 
"06" => "июня", 
"07" => "июля", 
"08" => "августа", 
"09" => "сентября", 
"10" => "октября", 
"11" => "ноября", 
"12" => "декабря"
);
    $dayWeekArray = array( 
"0" => "воскресенье", 
"1" => "понедельник", 
"2" => "вторник", 
"3" => "среда", 
"4" => "четверг", 
"5" => "пятница", 
"6" => "суббота", 
);
    $today = explode(".",date("d.m.y.w"));
    
    function get_content() 
  { 
    // Формируем сегодняшнюю дату 
    $date = date("d/m/Y"); 
    // Формируем ссылку 
    $link = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=$date"; 
    // Загружаем HTML-страницу 
    $fd = fopen($link, "r"); 
    $text=""; 
    if (!$fd) return false; 
    else 
    { 
      // Чтение содержимого файла в переменную $text 
      while (!feof ($fd)) $text .= fgets($fd, 4096); 
    } 
    // Закрыть открытый файловый дескриптор 
    fclose ($fd); 
    return $text; 
  }  
  // Получаем текущие курсы валют в rss-формате с сайта www.cbr.ru 
  $content = get_content(); 
  // Разбираем содержимое, при помощи регулярных выражений 
  $pattern = "#<Valute ID=\"([^\"]+)[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>([^<]+)#i"; 
  preg_match_all($pattern, $content, $out, PREG_SET_ORDER); 
  $dollar = ""; 
  $euro = ""; 
  foreach($out as $cur) 
  { 
    if($cur[2] == 840) $dollar = str_replace(",",".",$cur[4]); 
    if($cur[2] == 978) $euro   = str_replace(",",".",$cur[4]); 
  }  
?>
   <a href="/" class="header__logo-lnk" title="Ежедневная информационная газета ОБЪЕКТИВ"></a>
   <div class="head-info-widgets">
   <p class="head-curr-time"><?=$today[0]." ".$monthArray[$today[1]].", ".$dayWeekArray[$today[3]]." ".date("H:i")?></p>
   <p class="head-curr-time">Курс Доллара: <?=$dollar;?>;  Курс Евро: <?=$euro;?></p>
   <a class="hLinks" href="http://obyektiv.press/probki">Яндекс.Пробки</a>
   <p class="rss-head-text">RSS</p>
   <a class="hLinks" id="rss" href="http://obyektiv.press/rss.php"> <div class="rss-head" > </div> </a>
    <?// if ($_SERVER["REMOTE_ADDR"] == "194.12.124.17"){?>
        <div class="gismeteo-weather">
        <div id="gsInformerID-wB4UEF1n56AhDq" class="gsInformer" style="width:224px;height:68px">
            <div class="gsIContent">
                <div class="gsLinks">
                    <table>
                        <tr>
                            <td>
                                <div class="leftCol">
                                    <a href="https://www.gismeteo.ua" target="_blank">
                                        <img alt="Gismeteo" title="Gismeteo" src="https://s1.gismeteo.ua/static/images/informer2/logo-mini2.png" align="absmiddle" border="0" />
                                        <span>Gismeteo</span>
                                    </a>
                                </div>
                                <div class="rightCol">
                                    <a href="https://www.gismeteo.ua/weather-sevastopol-5003/14-days/" target="_blank">Погода на 2 недели</a>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        </div>
<?/*}else{?>
   <<div id="weather">
            <?php
            echo "Cевастополь: ";
            echo ("<img src=\"http://img.yandex.net/i/wiz$pic.png\" style=\"position: relative;top: 5px;\" alt=\"$type\" title=\"$type\">");
            ?>
            <div style="display: inline-block;"><?=$temp?><sup>o</sup>C</div>
        </div>
   <?}*/?>
    </div>
    <nav class="header__menu / js-header-menu-text">
        <!-- <ul>
            <li><a href="#">Новости</a></li>
            <li><a href="#">Аналитика</a></li>
            <li><a href="#">Блогосфера</a></li>
            <li><a href="#">Расследование</a></li>
            <li><a href="#">Лицом к лицу</a></li>
            <li><a href="#">Ваше право</a></li>
            <li><a href="#">Духовность</a></li>
            <li><a href="#">История</a></li>
            <li><a href="#">Свой дом</a></li>
        </ul> -->
        <!--JOOMLA MODULE: topmenu-->
        <jdoc:include type="modules" name="topmenu" style="nowrap" />

    </nav>
<?/*else:?>
<a href="/" class="header__logo-lnk" title="Ежедневная информационная газета ОБЪЕКТИВ"></a>
    <nav class="header__menu / js-header-menu-text">
        <!-- <ul>
            <li><a href="#">Новости</a></li>
            <li><a href="#">Аналитика</a></li>
            <li><a href="#">Блогосфера</a></li>
            <li><a href="#">Расследование</a></li>
            <li><a href="#">Лицом к лицу</a></li>
            <li><a href="#">Ваше право</a></li>
            <li><a href="#">Духовность</a></li>
            <li><a href="#">История</a></li>
            <li><a href="#">Свой дом</a></li>
        </ul> -->
        <!--JOOMLA MODULE: topmenu-->
        <jdoc:include type="modules" name="topmenu" style="nowrap" />

    </nav>
<?endif;*/?>
</header>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.6&appId=1527600314216580";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>