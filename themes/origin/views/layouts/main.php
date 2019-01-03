<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <?php echo CHtml::cssFile(Yii::app()->theme->baseUrl.'/css/main.css');?>
    <title><?=$this->title?></title>
    <meta name="description" content="<?=$this->meta_descr?>"/>
  </head>
  <body>
    <div class="wrapper">
      <div class="container header">
      <div class="row text-right">
      Продажа продуктов марки PLEVREN на территории Российской Федерации осуществляется исключительно:
      </div>
        <div class="row">
          <div class="col-sm">
            <a class="headerLogo" href="/">
            </a>
          </div>

           <div class="col-sm text-right">
           <p style="margin: 20px 0px; color: #4c729c;"></p>
           <p style="margin: 0px; color: #4c729c;">Телефон склада готовой продукции:<br> + 7 920 637 25 76, +7 4912 47 18 89</p>
          <p style="margin: 0px; color: #4c729c;">Абрамова Инна Владимировна</p>
          <p style="margin: 0px; color: #4c729c;">abramova_inna5@mail.ru</p>
            

          </div>

          <div class="col-sm text-right">
          <form action="/category/search" method="POST">
          <p style="margin: 0px; color: #4c729c;">ИП ПЕЛЕВИНА ГАЛИНА ЕВГЕНЬЕВНА</p>
          <p style="margin: 0px; color: #4c729c;">+7 4912 30 19 33</p>
          <p style="margin: 0px; color: #4c729c;"> + 7 910 576 28 56</p>
          <p style="margin: 0px; color: #4c729c;">pelevina.galina@gmail.com</p>
            <div class="input-group mb-3 search">
              <input type="text" class="form-control" name="search">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2"></button>
              </div>
            </div>
            </form>
          </div>

         

        </div>
      </div>
      <div class="container-fluid menuWrapper">
        <nav class="navbar navbar-expand-lg">
          <a class="navbar-brand" href="#"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="/">
                  <span style="padding: 0 11px;">Главная</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/contact">
                <span style="padding: 0 11px;">О компании</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/contact/#feedbackForm">
                <span style="padding: 0 11px;">Обратная связь</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/files/TUEV_CERT_ISO_9001_en.pdf">
                <span style="padding: 0 11px;">Сертификаты</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/advice">
                <span style="padding: 0 11px;">Статьи</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/file">
                <span style="padding: 0 11px;">Документы</span>
                </a>
              </li>
        </nav>
      </div>

      <div class="container-fluid mainBan">
        <div id="carouselExampleControls" class="carousel slide carouselContainer" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="carousel-content">
                <div class="banMainContent">
                  <div class="bannerImg">
                    <img class="d-block w-100" src="<?=Yii::app()->theme->baseUrl?>/images/pic_1.png" alt="First slide">
                  </div>
                  <p class="banText">
                    Под маркой PLEVREN фирма “Zschimmer & Schwarz Mohsdorf”, Германия предлагает целый ряд фосфонатов, которые применяются для производства средств бытовой химии и в водообработке вот уже несколько лет. Представленные фосфонаты имеют сходные общие химические свойства, предполагающие общую взаимозаменяемость фосфонатов. Однако, такая точка зрения не совсем верная. Так как фосфонаты имеют различную химическую структуру , то, соответственно, и выраженные их характеристики проявляются по-разному. Этот факт позволяет предлагать из нашего ассортимента продукты, которые могут использоваться в различных химических и технических сферах.
                  </p>
                </div>
                <div class="ban-bottomBlock">
                  <div class="line">
                    <div class="lineTextWrapper">
                      <p>Фосфонаты <span>«ZSCHIMMER & SCHWARZ»</span> Германия</p>
                    </div>
                  </div>
                  <div class="btn-banner-more">
                    <a href="/advice/view/id/1">Подробнее</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="carousel-content">
                <div class="banMainContent">
                  <p class="banText">
                    В современном пищевом, пивном производстве, виноделии, молочной и мясной промышленности используются закрытые герметичные системы для изготовления продукции. Такое оборудование необходимо периодически очищать и дезинфицировать, не разбирая его на составные части. Для этого существуют специальные станции, называемые CIP-мойками.
                  </p>
                </div>
                <div class="ban-bottomBlock">
                  <div class="line">
                    <div class="lineTextWrapper">
                      <p>Сырьё марки <span>PLEVREN</span> для производства моющих средств и очистителей для CIP — мойки оборудования</p>
                    </div>
                  </div>
                  <div class="btn-banner-more">
                    <a href="/advice/view/id/4">Подробнее</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="carousel-content">
                <div class="banMainContent">
                  <p class="banText">
                    Будь то для домашнего хозяйства или крупной промышленности, для производства моющих средств и косметики, а также бумажных и текстильных изделий или в опреснительных системах и системах охлаждения воды, где вода используется в промышленных масштабах, повсюду используются фосфонаты компании Zschimmer & Schwarz. Благодаря своим выдающимся свойствам они гарантируют как экономичные, так и энергоэффективные результаты. В тесном сотрудничестве с нашими клиентами мы разрабатываем специальные продукты, адаптированные к потребностям и требованиям заказчика, которые последовательно отвечают самым высоким стандартам безопасности, качества и окружающей среды.
                  </p>
                </div>
                <div class="ban-bottomBlock">
                  <div class="line">
                    <div class="lineTextWrapper">
                      <p>Фосфонаты <span>PLEVREN</span></p>
                    </div>
                  </div>
                  <div class="btn-banner-more">
                    <a href="/advice/view/id/3">Подробнее</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <img src="<?=Yii::app()->theme->baseUrl?>/images/arrow-left.png">
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <img src="<?=Yii::app()->theme->baseUrl?>/images/arrow-right.png">
          </a>
        </div>
      </div>
      <?php echo $content; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<div class="container-fluid footer">
<div class="container">
<div class="row">
<div class="footerColumn"><img class="footerFoto" src="/themes/origin/images/logo-footer.png" alt="" /></div>
<div class="footerColumn">
<p class="footerHeader">Контакты</p>
<p>Эксклюзивный дистрибьютор в России:<br />
ИП Пелевина Галина Евгеньевна<br />
Телефон - +7 4912 30 19 33<br />
Моб - +7 910 576 28 56<br />
Email - <a href="mailto:pelevina.galina@gmail.com">pelevina.galina@gmail.com</a></p>
</div>
<div class="footerColumn">
<ul class="list-unstyled footerList">
    <li><a href="/">Главная</a></li>
    <li><a href="/contact">Контакты</a></li>
    <li><a href="/files/TUEV_CERT_ISO_9001_en.pdf">Сертификаты</a></li>
    <li><a href="/contact/#feedbackForm">Обратная связь</a></li>
    <li><a href="/advice">Статьи</a></li>
</ul>
</div>
</div>
</div>
</div>
<div class="container-fluid footer dark text-center">&copy; Copyright 2012-2019 ИП Пелевина.</div>
  </body>
</html>