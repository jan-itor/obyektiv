<?
die();
$request  = '<?xml version="1.0" encoding="utf-8"?>';
$request .= "<methodCall>";
$request .= "<methodName>weblogUpdates.ping</methodName>";
$request .= "<params>";

    $request .= "<param>";
        $request .= "<value>";
            $request .= "Онлайн газета Объектив";
        $request .= "</value>";
    $request .= "</param>";
    
    $request .= "<param>";
        $request .= "<value>";
            $request .= "http://obyektiv.press/";
        $request .= "</value>";
    $request .= "</param>";
        
$request .= "</params>";
$request .= "</methodCall>";

$curl_options = array (
  CURLOPT_URL => 'http://ping.blogs.yandex.ru/RPC2',
  CURLOPT_POST => TRUE,
  CURLOPT_RETURNTRANSFER => FALSE,
  CURLOPT_HEADER => array(
        'POST /RPC2 HTTP/1.1', 
        'Host: ping.blogs.yandex.ru', 
        'Content-Type: text/xml', 
        'Content-Length:'.mb_strlen($request),
    ),
  CURLOPT_POSTFIELDS => ($request)
  
);
$curl = curl_init() or die("cURL init error");

curl_setopt_array($curl, $curl_options) or die("cURL set options error" . curl_error($curl));

$response = curl_exec($curl) or die ("cURL execute error" . curl_error($curl));


curl_close($curl);