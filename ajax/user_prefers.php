<?php

if(sizeof($_POST) > 0){

    $db = mysql_connect("localhost","root","123");
    mysql_select_db("nep4uku_objektiv" ,$db);
    $id = $_POST['artID'];

    $selectSQL = mysql_query(
        "SELECT *
        FROM stobj_user_prefer
        WHERE art_id = $id
        "
    );

    if ($rows = mysql_fetch_assoc($selectSQL)) {
        $fieldPrefer = $_POST['preferValue'];
        $updateSQL = mysql_query(
            "UPDATE stobj_user_prefer
            SET $fieldPrefer = $fieldPrefer+1
            WHERE art_id = $id"
        );
    } else {
        $fieldPreferArtID = $_POST['artID'];
        $fieldPreferValue = $_POST['preferValue'];
        $insertSQL = mysql_query(
            "INSERT INTO stobj_user_prefer (`art_id`, `$fieldPreferValue`)
            VALUES ($fieldPreferArtID, 1)"
        );
    }



    $_COOKIE["articles"][$id] = $id;
    $array = $_COOKIE["articles"];
    setcookie("articles", $array, time() + 360000);
   /* echo "<pre>";
    print_r($_COOKIE); echo "</pre>";*/


}
mysql_close($db);
?>
<div class="simpleVoteBlock interest" data-value="interest" data-id="<?=$_POST['artID']?>">Интересно (<?=$rows['interest']?>)</div>
<div class="simpleVoteBlock nInterest" data-value="not_interest" data-id="<?=$_POST['artID']?>">Не интересно (<?=$rows['not_interest']?>)</div>
<div class="simpleVoteBlock actual" data-value="actual" data-id="<?=$_POST['artID']?>">Актуально (<?=$rows['actual']?>)</div>
<div class="simpleVoteBlock notActual" data-value="not_actual" data-id="<?=$_POST['artID']?>">Не актуально (<?=$rows['not_actual']?>)</div>

