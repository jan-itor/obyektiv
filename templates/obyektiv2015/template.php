<?php

defined('_JEXEC') or die;

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;

$app  = JFactory::getApplication();
$doc  = JFactory::getDocument();
$user = JFactory::getUser();
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');
$ruri = substr($_SERVER['REQUEST_URI'], 1);
$curi = JUri::current();
$isHome = ($curi == JUri::base() || $ruri == '' || $ruri == 'index.php');
$baseUrl = $this->baseUrl .'/templates/'. $this->template;
$bid = ($isHome) ? 'g-home':'g-page';
$bclass = $browser .' page-'. $itemid;
if ($ruri == '404')
$bclass.= ' e404';

$bclass.= ' '.str_replace('/', '_', $ruri);

if ($isHome)
$this->setTitle($sitename);

if (!$isHome)
{
    //Делаем редирект со слэша на без. Делаем именно, через PHP, т.к. через .htaccess ломается админка.
    $parseUrl = parse_url($_SERVER["REQUEST_URI"]);
    $explodeUrl = explode("/", $parseUrl["path"]);
    if (mb_strlen(end($explodeUrl)) < 1)
    {
        array_pop($explodeUrl);
        $explodeUrl = array_filter($explodeUrl);
        foreach ($explodeUrl as $url)
        {
            $buildUrl .= "/".$url;
        }
        if (sizeof($parseUrl["query"]) > 0)
        {
            $buildUrl .= "?".$parseUrl["query"];    
        }
        
        header("HTTP/1.1 301 Moved Permanently"); 
        header("Location: $buildUrl"); 
        die();
    }
}

?>

<!DOCTYPE html>

<html lang="ru">

<head>

    <?php require __DIR__ . '/_head.php'; ?>

</head>

<body>

    <?php require __DIR__ . '/blocks/header/header.php'; ?>

    <?php if ($isHome) { ?>

        <?php require __DIR__ . '/blocks/main-carousel/main-carousel.php'; ?>

        <main class="grid">

            <!--grid row 1-->
            <div class="grid__row">
                <div class="grid__item grid__item--big">

                    <!--JOOMLA MODULE: navigaror-->
                    <jdoc:include type="modules" name="navigaror" style="nowrap" />

                </div>
                <div class="grid__item grid__item--small">

                    <!--JOOMLA MODULE: search-->
                    <jdoc:include type="modules" name="search" style="nowrap" />

                    <?php require __DIR__ . '/blocks/hotline/hotline.php'; ?>

                </div>
            </div>


            
            <!--grid row 2-->
            <div class="grid__row">
                <div class="grid__item grid__item--big">

                    <!--JOOMLA MODULE: navigaror2-->
                    <jdoc:include type="modules" name="navigaror2" style="nowrap" />

                </div>
                <div class="grid__item grid__item--small">

                    <!--JOOMLA MODULE: banners-->
                    <jdoc:include type="modules" name="banners" style="nowrap" />

                </div>
            </div>
               

            
            <!--grid row 3-->
            <div class="grid__row">
                <div class="grid__item grid__item--small grid__item--news">
                    <h3 class="grid__title">Новости</h3>

                    <!--JOOMLA MODULE: navigaror4-->
                    <jdoc:include type="modules" name="navigaror4" style="nowrap" />

                    <!--BTN-TRAMSPARENT-->
                    <a href="/novosti" class="grid__btn-wrap / btn-transparent" target="_blank">Все новости</a>

                    <?php require __DIR__ . '/blocks/social/social.php'; ?>

                </div>

                <div class="vidgetPoll">
                    <iframe class="pollRU" allowtransparency="true" frameborder="no" scrolling="auto" height="850" width="308" src="http://poll.ru/1tittm"></iframe>
                    <!--<form method="post" action="http://www.rupoll.com/vote.php">
                        <h3>За кого Вы отдадите свой голос на предварительном голосовании партии "Единая Россия" 22 мая 2016г.?</h3>
                                    <input type="hidden" name="id" value="1">';
      >                             <input type='radio' name='vote' value='1'> Белик Дмитрий Анатольевич
                                    <input type='radio' name='vote' value='2'> Вертий Наталья Анатольевна<
                                    <input type='radio' name='vote' value='3'> Жбанков Юрий Александрович<
                                    <input type='radio' name='vote' value='4'> Кашанская Юлия Константиновна>
                                    <input type='radio' name='vote' value='5'> Кириченко Владимир Владимирович<>
                                    <input type='radio' name='vote' value='6'> Колесников Борис Дмитриевич
                                    <input type='radio' name='vote' value='7'> Колмагоров Александр Алексеевич
                                    <input type='radio' name='vote' value='8'> Кузьмина Ольга Александровна
                                    <input type='radio' name='vote' value='9'> Лисейцев Сергей Алексеевич
                                    <input type='radio' name='vote' value='10'> Мишин Максим Анатольевич
                                    <input type='radio' name='vote' value='11'> Мудрецова Светлана Александровна
                                    <input type='radio' name='vote' value='12'> Осташко Руслан Станиславович
                                    <input type='radio' name='vote' value='13'> Плотка Владимир Григорьевич
                                    <input type='radio' name='vote' value='14'> Поддубный Григорий Александрович
                                    <input type='radio' name='vote' value='15'> Полищук Александра Александровна
                                    <input type='radio' name='vote' value='16'> Романова Олесия Александровна
                                    <input type='radio' name='vote' value='17'> Солдатова Елена Михайловна
                                    <input type='radio' name='vote' value='18'> Халайчев Евгений Георгиевич
                                    <input type='radio' name='vote' value='19'> Шкаплеров Антон Николаевич
                                    <input type='button' value='  Голосовать !'>
                    </form>-->

                    <!--<div id="hypercomments_widget"></div>
                    <script type="text/javascript">
                        _hcwp = window._hcwp || [];
                        _hcwp.push({widget:"Stream", widget_id: 75078});
                        (function() {
                            if("HC_LOAD_INIT" in window)return;
                            HC_LOAD_INIT = true;
                            var lang = (navigator.language || navigator.systemLanguage || navigator.userLanguage || "en").substr(0, 2).toLowerCase();
                            var hcc = document.createElement("script"); hcc.type = "text/javascript"; hcc.async = true;
                            hcc.src = ("https:" == document.location.protocol ? "https" : "http")+"://w.hypercomments.com/widget/hc/75078/"+lang+"/widget.js";
                            var s = document.getElementsByTagName("script")[0];
                            s.parentNode.insertBefore(hcc, s.nextSibling);
                        })();
                    </script>
                    <a href="http://hypercomments.com" class="hc-link" title="comments widget">comments powered by HyperComments</a>-->

                </div>


                <div class="grid__item grid__item--big">

                    <!--JOOMLA MODULE: navigaror3-->
                    <jdoc:include type="modules" name="navigaror3" style="nowrap" />

                </div>
                
            <!--VIDEO_BLOCK-->
            <div class="grid__row pd_left video_block_home">
                <jdoc:include type="modules" name="video_block" style="nowrap" />
            </div>
            <!--/VIDEO_BLOCK-->                
            </div>

            <div class="seoTxtHome">
                <h1>Новости Севастополя в онлайн газете «Объектив»</h1>
                <p>Севастопольская газета «Объектив» - это независимая российская газета, которая успешно развивает новые форматы средств массовой информации. Мы приветствуем беспристрастие и объективность, поэтому в наших публикациях вы никогда не найдете исковерканные факты или данные, выгодные какой-либо политической силе или органам власти. Мы предоставляем Вам только правдивые и свежие новости Севастополя, Крыма и России.</p>
                <p>Наша газета создана компанией «Медиа коммандер груп», основной целью которой является своевременное и достоверное информирование всех читателей о политических, экономических, культурных и общественных новостях Севастополя, Крыма, России и всего мира.</p>
                <p>В отличие от многих других газет Севастополя, в нашем издании можно найти как информационные сводки и материалы, так и аналитические статьи и журналистские расследования, ДТП происшествия и т.д.</p>
                <p>Ежедневный мониторинг всех важных событий и новостей в Севастопольской онлайн газете «Объектив» позволяет предоставлять нашим читателям полную картину о происходящем. Эксклюзивные материалы о медицине, криминале, образовании и других сферах нашей жизни, интересные интервью с известными людьми в категории «Лицом к лицу», полезные рекомендации раздела «Свой дом» и многое другое вы всегда можете найти на нашем информационном портале.</p>
            </div>
            
        </main>

    <?php } else { ?>

        <?php require __DIR__ . '/blocks/internal-subheader/internal-subheader.php'; ?>

        <main class="grid grid--internal">
            <div class="grid__item grid__item--big / typography">    
                <jdoc:include type="modules" name="breadcrumbs" />
         
                <!--JOOMLA MESSAGE-->
                <jdoc:include type="message" />

                <!--JOOMLA COMPONENT-->
                <jdoc:include type="component" />
                <jdoc:include type="modules" name="after_content" />
            </div>
</div><!--k2 missing tag fix-->
            <div class="grid__item grid__item--small grid__item--news / js-sticky-aside">
                <h3 class="grid__title">Новости</h3>

                <!--JOOMLA MODULE: navigaror4-->
                <jdoc:include type="modules" name="navigaror4" style="nowrap" />

                <!--BTN-TRAMSPARENT-->
                <a href="/novosti" class="grid__btn-wrap / btn-transparent" target="_blank">Все новости</a>

                <?php require __DIR__ . '/blocks/social/social.php'; ?>

            </div>
        </main>

    <?php } ?>

    <?php require __DIR__ . '/blocks/footer/footer.php'; ?>

</body>

</html>