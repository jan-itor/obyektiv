<?
$db = mysql_connect("localhost","nep4uku_objektiv","0dafs2ls");
mysql_select_db("nep4uku_objektiv" ,$db);

$categories = array();
$items = array();

function getParent($row, $db)
{
    
    $parenId = $row["parent"];

    $query = mysql_query("SELECT alias FROM stobj_k2_categories WHERE `id` = ".$parenId, $db);
    
    if ($result = mysql_fetch_assoc($query))
    {
        return $result["alias"];
    }    
    
}

function getCategory($item, $db)
{
    
    $query = mysql_query("SELECT * FROM stobj_k2_categories WHERE `id` = ".$item["catid"], $db);    
    if ($result = mysql_fetch_assoc($query))
    {   
        $item["parent_url"] = "/".$result["alias"];
        if (intval($result["parent"]) > 0) {
            $item["catid"] =  $result["parent"];
            return getCategory($item, $db);
        } else {
            return $item;
        }
    }   
}


$sql = mysql_query("SELECT * FROM stobj_k2_categories" ,$db);
while ($rows = mysql_fetch_assoc($sql))
{
    if ($rows["parent"] > 0)
    {
        $rows["alias"] = "/content/".$rows["id"]."-".$rows["alias"];
        $rows["parent_alias"] = getParent($rows, $db);
    }
    
    $categories[] = $rows;
}


$sql = mysql_query("SELECT id, title, alias, catid FROM stobj_k2_items WHERE `published` = 1 AND `catid` > 0 AND `trash` = 0" ,$db);
while ($rows = mysql_fetch_assoc($sql))
{
    $items[] = getCategory($rows, $db);    
}


$sitemapXML = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
    foreach ($categories as $itemCategory)
    {
        $sitemapXML .= "<url>";
            $sitemapXML .= "<loc>http://obyektiv.press/".$itemCategory["parent_alias"].$itemCategory["alias"]."</loc>";
        $sitemapXML .= "</url>";
    }
    foreach ($items as $item)
    {
        if (!empty($item["alias"]) && !empty($item["parent_url"]))
        {
            $sitemapXML .= "<url>";
                $sitemapXML .= "<loc>http://obyektiv.press".$item["parent_url"]."/".$item["alias"]."</loc>";
            $sitemapXML .= "</url>";
        }
        
    }
 
$sitemapXML .= "</urlset>";

$fp=fopen('/var/www/user32812/data/www/obyektiv.press/sitemap.xml','w+');if(!fwrite($fp,$sitemapXML)){echo 'Ошибка записи!';}fclose($fp);

mysql_close($db);
