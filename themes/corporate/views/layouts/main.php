<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <title><?php echo $this->title; ?> </title>
  <?php echo CHtml::cssFile(Yii::app()->theme->baseUrl.'/css/style.css');?>
  <?php echo CHtml::scriptFile(Yii::app()->theme->baseUrl.'/js/cufon-yui.js');?>
  <?php echo CHtml::scriptFile(Yii::app()->theme->baseUrl.'/js/arial.js');?>
  <?php echo CHtml::scriptFile(Yii::app()->theme->baseUrl.'/js/cuf_run.js');?>
  <meta name='yandex-verification' content='6b9c2b76461217e8' />
  <meta name="google-site-verification" content="vR8HvA_1LyR1HiYVUD96KP5zUPMdTa77FdbAkIgurqU" />
</head>

<body>
<div class="main">
  <div class="header">
    <div class="header_resize">
      <div class="logo">
        <div class="header_img"><a href="/"><img src="/images/logo.gif" alt="image" height="59px"/></a></div>
      </div>

      <div class="menu_nav">
       <ul>
          <li class="<?=$this->menu['main']?>"><a href="/"><span>Главная</span></a></li>
          <li class="<?=$this->menu['contact']?>"><a href="/contact"><span>О компании</span></a></li>
          <li class="<?=$this->menu['advice']?>"><a href="/advice"><span>Статьи</span></a></li>
          <li class="<?=$this->menu['news']?>"><a href="/news"><span>Новости</span></a></li>
          <li><a href="/files/TUEV_CERT_ISO_9001_en.pdf"><span>Сертификаты</span></a></li>
          <li class="<?=$this->menu['file']?>"><a href="/file"><span>Документы</span></a></li>
        </ul>        
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
      
      
      <div class="header_img">
          
          <div class="float_left" >
                <a href="/"><img src="/images/mohsdorf.jpg" alt="image" /></a>
                <h1>Фосфонаты "Zschimmer & Schwarz", Германия</h1>
                <p>
                  Под маркой  PLEVREN  фирма “Zschimmer & Schwarz Mohsdorf”, Германия предлагает целый ряд фосфонатов, 
                  которые применяются для производства средств бытовой химии и в водообработке вот уже несколько лет. 
                  Представленные фосфонаты имеют сходные общие химические свойства, предполагающие общую взаимозаменяемость фосфонатов. 
                  Однако, такая точка зрения не совсем верная. Так как фосфонаты имеют различную химическую структуру , то, соответственно, и выраженные их характеристики проявляются по-разному. 
                  Этот факт позволяет предлагать из нашего ассортимента продукты, которые могут использоваться в различных химических и технических сферах.
                </p>
          </div>
          <div class="clr"></div>
      </div>
      
    </div>
  </div>
  <div class="clr"></div>
  <div class="content">
    <div class="content_resize">
      <div class="mainbar">
        <div class="article">
          
          <?php echo $content; ?>
        </div>
      </div>
      <div class="sidebar">
	    
            <div class="search">
              <form id="form" name="form" method="post" action="">
                <span>
                <input name="q" type="text" class="keywords" id="textfield" maxlength="50" value="Поиск..." />

                <input name="b" type="image" src="/images/search.gif" class="button" />
                </span>
              </form>
            </div>

	    <div style="margin: 50px 0px 20px 0px;">
	      <p><a href="/advice/view/id/4"><img src="/images/phosph3.png" /></a></p>
	      <a href="/advice/view/id/3"><img src="/images/phosphonates-presentation.jpg" /></a>
	    </div>

            <div class="gadget big">
                    <h3 class="color_red">
                    <span>Эксклюзивный дистрибьютор в России</span></h3>
                      <div class="clr"></div>

                      <strong>ИП Пелевина Галина Евгеньевна</strong></br>
                          Телефон - <strong> +7 4912 30 19 33</strong><br>
                      Моб - <strong> +7 910 576 28 56</strong></br>
                      Email - <strong><a href="mailto:pelevina.galina@gmail.com">pelevina.galina@gmail.com</a></strong></br><br>

                      <strong>Склад готовой продукции:</strong></br>
                          Абрамова Инна Владимировна<br>
                      Моб.тел. склада - <strong> +7 920 637 25 76</strong></br>
                      Телефон склада - <strong> + 7 4912 47 18 89</strong></br>
                      Email - <strong><a href="mailto:abramova_inna5@mail.ru">abramova_inna5@mail.ru</a></strong></br>
            </div>
            <div class="gadget">
              <h2>Виды фосфонатов</h2>
              <div class="clr"></div>

              <ul class="sb_menu">
                <?php foreach (Category::getTree(0) as $key => $value) : ?>
                 <li><?php echo $value['text']; ?></li>
                <?php endforeach; ?>

              </ul>
            </div>
           
      
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="fbg">
    <div class="fbg_resize">
      <div class="col c1">
        <h2><span>Фото продукции</span></h2>
        <img src="/images/phosphonate.jpg" alt="фосфонаты" class="float_left"/>
        <img src="/images/svechenie_phosphonata.jpg" alt="фосфонаты" class="float_left" />
      </div>

      <div class="col c3">
        <h2><span>Контакты</span></h2>
        <strong>Эксклюзивный дистрибьютор в России:</strong>

        <strong>ИП Пелевина Галина Евгеньевна</strong></br>
            Телефон - +7 4912 30 19 33<br>
        Моб - +7 910 576 28 56</br>
        Email - <a href="mailto:pelevina.galina@gmail.com">pelevina.galina@gmail.com</a></br>
        
      </div>
      <div class="clr"></div>
    </div>
    <div class="footer">
      <p class="lr">&copy; Copyright 2012-2013 ИП Пелевина.</p>
      <div class="clr"></div>
    </div>
  </div>
</div>
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
</body>
    
</html>