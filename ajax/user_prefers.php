<?php

if(sizeof($_POST) > 0){

    $db = mysql_connect("localhost","root","123");
    mysql_select_db("nep4uku_objektiv" ,$db);

    $id = intval($_POST['artID']);

    $selectSQL = mysql_query(
        "SELECT *
        FROM stobj_user_prefer
        WHERE art_id = $id
        "
    );

    if ($rows = mysql_fetch_assoc($selectSQL)) {
        $rows[$_POST['preferValue']]++;
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
        $rows['interest'] = 0;
        $rows['not_interest'] = 0;
        $rows['actual'] = 0;
        $rows['not_actual'] = 0;
        $rows[$fieldPreferValue] = 1;
    }

    $_COOKIE["articles"][$id.$_POST['preferType']] = $id.$_POST['preferType'];
    setcookie("articles[".$id.$_POST['preferType']."]", $id.$_POST['preferType'], time() + 360000, "/");

}
mysql_close($db);

?>
<div class="simpleVoteBlock interest " <?if(($_POST['preferType'] == "relevance") && (!in_array($id.'like',$_COOKIE['articles']))) echo "data-type = 'like'"?> data-value="interest" data-id="<?=$_POST['artID']?>">Интересно (<?=$rows['interest']?>)</div>
<div class="simpleVoteBlock actual " <?if($_POST['preferType'] == "like" && (!in_array($id.'relevance',$_COOKIE['articles']))) echo "data-type = 'relevance'"?> data-value="actual" data-id="<?=$_POST['artID']?>">Актуально (<?=$rows['actual']?>)</div>
<div class="simpleVoteBlock notActual " <?if($_POST['preferType'] == "like" && (!in_array($id.'relevance',$_COOKIE['articles']))) echo "data-type = 'relevance'"?> data-value="not_actual" data-id="<?=$_POST['artID']?>">Не актуально (<?=$rows['not_actual']?>)</div>
<div class="simpleVoteBlock nInterest " <?if($_POST['preferType'] == "relevance" && (!in_array($id.'like',$_COOKIE['articles']))) echo "data-type = 'like'"?> data-value="not_interest" data-id="<?=$_POST['artID']?>">Не интересно (<?=$rows['not_interest']?>)</div>

