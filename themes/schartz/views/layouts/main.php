<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name='yandex-verification' content='6b9c2b76461217e8' />
  <meta name="google-site-verification" content="vR8HvA_1LyR1HiYVUD96KP5zUPMdTa77FdbAkIgurqU" />
  <title><?php echo $this->title; ?> </title>
  <?php echo CHtml::cssFile(Yii::app()->theme->baseUrl.'/css/main.css');?>
  <?php echo CHtml::cssFile(Yii::app()->theme->baseUrl.'/css/menu.css');?>
  <?php echo CHtml::cssFile(Yii::app()->theme->baseUrl.'/css/content.css');?>
  <?php echo CHtml::cssFile(Yii::app()->theme->baseUrl.'/css/form.css');?>
  <?php echo CHtml::cssFile(Yii::app()->theme->baseUrl.'/css/carousel.css');?>
  <?php echo CHtml::cssFile(Yii::app()->theme->baseUrl.'/css/nyroModal.css');?>
  <?php echo CHtml::cssFile(Yii::app()->theme->baseUrl.'/css/kontakt.css');?>

  <!--[if IE]>
     <?php echo CHtml::cssFile(Yii::app()->theme->baseUrl.'/css/ie.css');?>
  <![endif]-->
  <!--[if IE 7]>
     <?php echo CHtml::cssFile(Yii::app()->theme->baseUrl.'/css/ie7.css');?>
  <![endif]-->
  <!--[if lt IE 8]>
     <?php echo CHtml::cssFile(Yii::app()->theme->baseUrl.'/css/lt_ie8.css');?>
  <![endif]-->
  <?php echo CHtml::scriptFile(Yii::app()->theme->baseUrl.'/js/functions');?>
</head>

<body>
  <a name="top"></a>
  <div id="site_holder">
    <div id="main_holder">
      <div id="frame_holder">
        <div id="header_text_holder">
            
            <div id="header">
                 <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl.'/image/logo.gif','Zschimmer &amp; Schwarz',
                                        array('height'=>'55','width'=>'314','id'=>'logo')),'/');?>
                 <?php echo CHtml::image(Yii::app()->theme->baseUrl.'/image/chemie_nach_mass.jpg','Zschimmer &amp; Schwarz',
                                        array('height'=>'107','width'=>'902'));?>
                
                    <!--<div id="header_text">CHEMIE NACH MASS</div>-->
            </div>
        </div>
        <div id="menu_bar">
            
            <div id="top_bar_menu">
		<div style="float:left;margin-right:10px;">
                    <a href="/contact">О компании</a>
                </div>
		<div style="float:left;margin-right:10px;">
                    <a href="/advice">Статьи</a>
                </div>
		<div style="float:left;margin-right:10px;">
                    <a href="/news">Новости</a>
                </div>
                <div style="float:left;margin-right:10px;">
                    <a href="/file">Документы для скачивания</a>
                </div>
                <div style="float:left;">
                    <a href="<?=$this->certificate?>" >СЕРТИФИКАТ ISO</a>
                </div>
            </div>
        </div>
        <div id="content_holder">
          <div id="menu_col">
            <div id="menu">
                <?php foreach (Category::getTree(0) as $key => $value) : ?>
                <div id="wrapper">
                      <div id="norm">
                            <?php echo $value['text']; ?>
                      </div>
                </div>
                <?php endforeach; ?>
            </div><!-- menu -->
	  <? if($_SERVER['REQUEST_URI']=='/') :?>
	  <div class="images">
	    <img src="/images/phosphonate.jpg" alt="фосфонат" title="фосфонат"/>
	    <img src="/images/svechenie_phosphonata.jpg" alt="свечение фосфоната" title="свечение фосфоната"/>
	  </div>
	  <? endif;?>
          </div><!-- menu_col -->
          <div id="main_col">
            <div class="content">
                <?php echo $content; ?>
            </div>
             <div class="sidebar">

		  <? if($_SERVER['REQUEST_URI']!='/file') :?>
		    <?php echo CHtml::image(Yii::app()->theme->baseUrl.'/image/mohsdorf.jpg','',array('class'=>'s_img')); ?>
		  <?else:?>	
		    <?php echo CHtml::image('/images/chemistry-phosphonate.jpg','',array('class'=>'s_img')); ?>
		    <?php echo CHtml::image('/images/mol_str_phosphonate.jpg','',array('class'=>'s_img')); ?>
                 <? endif;?>
		 <div class="sidebar_text">
                    <h2 id="red"><b>Эксклюзивный дистрибьютор<br> в России:</b></h2>
                 <div><b>ИП Пелевина Галина Евгеньевна</b></div>
		 <div>Телефон  - +7 4912 30 19 33 </div>
                 <div>Телефон/Факс - +7 4912 24 14 94 </div>
                 <div>Моб - +7 910 576 28 56 </div>
                 <div>Email - pelevina.galina@gmail.com </div>
		 <div style="margin-top:10px;"><b>Склад готовой продукции:</b></div>
		 <div>Абрамова Инна Владимировна</div>
		 <div>Моб.тел. склада - +7 920 637 25 76</div>
		 <div>Телефон склада - + 7 4912 41 80 71</div>
		 <div>Email - abramova_inna5@mail.ru </div>
		 <div style="margin-top:10px;"><b>Все  продукты  марки  PLEVREN  имеют  государственную  регистрацию!</b></div>

                </div>
            </div>
             <div class="clear"></div>
                        <div id="search">
              <form id="searchForm" method="get" action="/phosphonate/search">
                <table id="search_table" summary="SearchForm" border="0" cellpadding="0" cellspacing="0" width="238">
                  <tbody><tr>
                    <td align="right" width="180">
                        <input class="search_text" name="search" value=""  type="text">
                    </td>
                    <td style="padding-left: 2px;"><input src="<?php echo Yii::app()->theme->baseUrl; ?>/image/search.gif" type="image"></td>
                  </tr>
                </tbody></table>
                <input name="startsearch" value="true" type="hidden">
              </form>
              <div class="white_line">
                  <img src="/images/empty.gif" alt="" border="0" height="3" width="1">
              </div>
            </div>
          </div>
          <div class="clear"></div>
        </div><!-- content_holder -->
        <div id="footer">
        </div>
      </div><!-- frame_holder -->
    </div><!-- main_holder -->
  </div><!-- site_holder -->
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter14494714 = new Ya.Metrika({id:14494714, enableAll: true, webvisor:true});
        } catch(e) {}
    });
    
    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/14494714" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-31677926-1']);
  _gaq.push(['_setDomainName', 'phosphonates.ru']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body></html>