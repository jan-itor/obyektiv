<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.Growwweb
 *
 * @copyright   Copyright (C) 2005 - 2014 Web Studio Growwweb. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl?>/templates/objectiv/css/style.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl?>/templates/objectiv/css/other.css" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="<?php echo $this->baseurl?>/templates/objectiv/favicon.ico" type="image/x-icon">
<?php $this->setGenerator('objectiv');?>
</head>

<body>
<div class="all">

   <div id="top">
      <div class="correct">
        <jdoc:include type="modules"  name="logo" style="xhtml" />
        <jdoc:include type="modules"  name="links" style="xhtml" />
        <jdoc:include type="modules"  name="search" style="xhtml" />
      </div>
   </div>
<div id="mainblock">
   <div id="topmenu">
        <jdoc:include type="modules"  name="topmenu" style="xhtml" />
   </div>



  <div id="main">
    <div id="content">
      <jdoc:include type="modules"  name="navigaror" style="xhtml" />
      <jdoc:include type="message" style="xhtml" />
      <jdoc:include type="component" style="xhtml" />
    </div>
    <div id="right">
      <jdoc:include type="modules"  name="right" style="xhtml" />
    </div>
  </div>
   <div id="banners">
        <jdoc:include type="modules"  name="banners" style="xhtml" />
   </div>
</div>

   <div id="footer">
       <jdoc:include type="modules"  name="footmenu" style="xhtml" />
       <jdoc:include type="modules"  name="copy" style="xhtml" />
       <!-- Yandex.Metrika informer -->
<a class="metinformer" href="https://metrika.yandex.ru/stat/?id=29860809&amp;from=informer"
target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/29860809/3_0_FFFFFFFF_FFFFFFFF_0_pageviews"
style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:29860809,lang:'ru'});return false}catch(e){}" /></a>
<!-- /Yandex.Metrika informer -->
   </div>
<script type="text/javascript">
(function($){ 
  $('.contact a').click(function(){
    $('#callback').toggleClass('active');
  });
 })(jQuery);
</script>
</div>


<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter29860809 = new Ya.Metrika({
                    id:29860809,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/29860809" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>
