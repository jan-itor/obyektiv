<?php
    $current_block_name = basename(__FILE__, '.php');
    $current_path = $baseUrl . '/blocks/' . $current_block_name . '/';
?>

    <link rel="stylesheet" href="<?php echo $current_path . $current_block_name . '.css'; ?>">

        <figure class="social">
            <h3 class="social__title">Читайте нас в соцсетях</h3>
            <a href="http://vk.com/obyektivsu" class="social__lnk social__lnk--vk" target="_blank"></a>
            <a href="https://www.facebook.com/obyektive" class="social__lnk social__lnk--fb" target="_blank"></a>
            
            <a href="https://plus.google.com/+ObyektivPressSev/" class="social__lnk social__lnk--gp" target="_blank"></a>
            <a href="https://twitter.com/Moder2017" class="social__lnk social__lnk--tw" target="_blank"></a>           
            <a href="https://ok.ru/group/52682861576338" class="social__lnk social__lnk--od" target="_blank"></a>           
            <a href="https://www.youtube.com/channel/UCUIIlcyrwsxbxVxpPGvycmA" class="social__lnk social__lnk--yt" target="_blank"></a>           
            
        </figure>

    <!--<script src="<?php echo $current_path . $current_block_name . '.js'; ?>" async></script>-->