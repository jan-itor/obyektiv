<iframe allowtransparency="true" frameborder="no" scrolling="auto" height="203" width="308" src="http://poll.ru/1ewlch"></iframe>

<?
/*$request  = '<?xml version="1.0" encoding="utf-8"?>';
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


curl_close($curl);*/


$file='';
$file_ip='';
$message='<br>';
$view_res=0;
if (isset($_POST['view_res']) and is_numeric($_POST['id'])) $view_res=1;
if (isset($_POST['vote']) and is_numeric($_POST['item'])
    and is_numeric($_POST['id'])) {
    $f_name="vote".$_POST['id'].".txt";
    $f_ip="vote".$_POST['id']."_ip.txt";
    $ip=$_SERVER['REMOTE_ADDR'];

    $fh_ip=fopen($f_ip,"a+");
    flock($fh_ip,LOCK_EX);
    fseek($fh_ip,0);
    while (!feof($fh_ip)) $file_ip=fread($fh_ip,4096);
    if (array_search($ip,explode(",", $file_ip))!==FALSE) {
        $message="<b>Вы уже голосовали!</b><br>";
    }
    else if (file_exists($f_name)) {
        $fh=fopen($f_name,"a+");
        flock($fh,LOCK_EX);
        fseek($fh,0);
        while (!feof($fh)) $file=fread($fh,4096);
        $file=explode(",", $file);
        if ($_POST['item']>=0 and $_POST['item']<count($file)) $file[$_POST['item']]+=1;
        $file=implode(",",$file);
        ftruncate($fh,0);
        fwrite($fh,$file);
        flock($fh,LOCK_UN);
        fclose($fh);

        $file_ip.=$ip.',';
        fwrite($fh_ip,$ip.',');
        $message="<b>Ваш голос учтен!</b><br>";
    }
    $view_res=1;
    flock($fh_ip,LOCK_UN);
    fclose($fh_ip);
}

if ($view_res==1) {
    $f_name="vote".$_POST['id'].".txt";
    if (file_exists($f_name)) {
        $fh=fopen($f_name,"a+");
        flock($fh,LOCK_EX);
        fseek($fh,0);
        while (!feof($fh)) $file=fread($fh,4096);
        flock($fh,LOCK_UN);
        fclose($fh);
        $file=explode(",", $file);
        $summ=0;
        for ($n=0; $n<count($file); $n++) $summ+=$file[$n];
        if ($summ==0) $summ=1;
        for ($n=0; $n<count($file); $n++) $file[$n]=' - <b>'.$file[$n].
            '</b> ('.round(($file[$n]*100/$summ), 2).'%)';
    }
}

echo '<form method="POST" style="margin:0 0 0 35px;">Как Вам данная тема?
    <input type="hidden" name="id" value="1">';
echo '<table border="0"><tr><td><input type="radio" name="item" value="0" checked>
    Отлично</td><td>'.$file[0].'</td></tr>';
echo '<tr><td><input type="radio" name="item" value="1">Нормально</td><td>'.
    $file[1].'</td></tr>';
echo '<tr><td><input type="radio" name="item" value="2">Сойдет</td><td>'.
    $file[2].'</td></tr>';
echo '<tr><td><input type="radio" name="item" value="3">Так себе</td><td>'.
    $file[3].'</td></tr>';
echo '<tr><td><input type="radio" name="item" value="4">Ужасно</td><td>'.
    $file[4].'</td></tr>';
echo '<tr><td colspan="2"><input type="submit" name="view_res" value="Результат">
    <input type="submit" name="vote" value="Голосовать">';
echo '</td></tr></table>'.$message.'</form>';
?>