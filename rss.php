<?
header('Content-Type: application/rss+xml; charset=utf-8');
$db = mysql_connect("localhost","nep4uku_objektiv","0dafs2ls");
mysql_select_db("nep4uku_objektiv" ,$db);
mysql_set_charset( 'utf8' );
$items = array();


function getCategory($item, $db)
{
    $query = mysql_query("SELECT * FROM stobj_k2_categories WHERE `id` = ".$item["catid"], $db);    
    if ($result = mysql_fetch_assoc($query))
    {   
        $item["parent_url"] = "/".$result["alias"];
        $item["parent_name"] = $result["title"];
        if (intval($result["parent"]) > 0) {
            $item["catid"] =  $result["parent"];
            return getCategory($item, $db);
        } else {
            return $item;
        }
    }   
}



$sql = mysql_query("SELECT * 
FROM  `stobj_k2_items`
WHERE `fulltext` != ''
ORDER BY  `stobj_k2_items`.`id` DESC 
LIMIT 0 , 30" ,$db);
while ($rows = mysql_fetch_assoc($sql))
{   
    $items[] = getCategory($rows, $db);    
}



//Ну как-то так....не хватает смайлика в виде рукожопа.
$rss = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
$rss .= '   <rss xmlns:yandex="http://news.yandex.ru" xmlns:media="http://search.yahoo.com/mrss/" version="2.0">'."\n";
$rss .=  '      <channel>'."\n";
$rss .= '           <title>Объектив - информационная Севастопольская газета</title>'."\n";
$rss .= '           <link>http://'.$_SERVER["HTTP_HOST"].'</link>'."\n";
$rss .= '           <description>Онлайн газета Севастополя Объектив - самые свежие новости Севастополя и всего мира. Российская газета Объектив все про аналитику, происшествия, криминал, духовность, историю, права граждан.</description>'."\n";
$rss .= '           <yandex:logo>http://'.$_SERVER["HTTP_HOST"].'/logo.png</yandex:logo>'."\n";
$rss .= '           <yandex:logo type="square">http://'.$_SERVER["HTTP_HOST"].'/square_logo.png</yandex:logo>'."\n";


foreach ($items as $item)
{   
    if (!empty($item["alias"]) && !empty($item["parent_url"]))
    {
        $date = new DateTime($item["created"]);
        $pubDate = date_format($date, "D, d M Y H:i:s +0300");
        $rss .= "           <item>"."\n";
        $rss .= "               <title><![CDATA[".$item["title"]."]]></title>"."\n";
        $rss .= "               <link>http://obyektiv.press".$item["parent_url"]."/".$item["alias"]."</link>"."\n";
        $rss .= "               <description><![CDATA[".strip_tags($item["introtext"])."]]></description>"."\n";
        $rss .= "               <category>".$item["parent_name"]."</category>"."\n";
        $rss .= "               <pubDate>".$pubDate."</pubDate>"."\n";
        $rss .= "               <yandex:full-text>".strip_tags($item["fulltext"])."</yandex:full-text>"."\n";
        $rss .= "           </item>"."\n";
}
}
 
$rss .= "</channel>"."\n";
$rss .= "</rss>";
echo $rss;

mysql_close($db);
