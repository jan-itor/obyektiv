<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<?php
$city_id=33991; // id города
$new_data_file = "http://www.eurometeo.ru/russia/sevastopol/export/xml/data/";
$data_file="http://export.yandex.ru/weather-ng/forecasts/$city_id.xml"; // адрес xml файла
$xml = simplexml_load_file($new_data_file); // раскладываем xml на массив
// выбираем требуемые параметры (город, температура, пиктограмма и тип погоды текстом (облачно, ясно)

echo "<pre>"; print_r($xml); echo "</pre>";

$city=$xml->fact->station;
$temp=$xml->fact->temperature;
$pic=$xml->fact->image;
$type=$xml->fact->weather_type;

?>

<link rel="stylesheet" type="text/css" href="https://s1.gismeteo.ua/static/css/informer2/gs_informerClient.min.css">
<div id="gsInformerID-wB4UEF1n56AhDq" class="gsInformer" style="width:224px;height:68px">
    <div class="gsIContent">
        <div id="cityLink">
            <a href="https://www.gismeteo.ua/weather-sevastopol-5003/" target="_blank">Погода в Севастополе</a>
        </div>
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
<script src="https://www.gismeteo.ua/ajax/getInformer/?hash=wB4UEF1n56AhDq" type="text/javascript"></script>
<script>
    $( window ).load(function() {
        $("div.gsLinks").remove();
    });

</script>