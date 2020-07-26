<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">

<head>

  <?php if( @$this->var['metadata']->bookName ){ ?>
  <title><?php echo $this->var['metadata']->title;?> - <?php echo $this->var['metadata']->bookName;?> - E Houve Guerra nos Céus</title>
  <?php }else{ ?>
    <?php if( @$this->var['metadata']->title ){ ?>
    <title><?php echo $this->var['metadata']->title;?> - E Houve Guerra nos Céus</title>
    <?php }else{ ?>
    <title>E Houve Guerra nos Céus</title>
    <?php } ?>
  <?php } ?>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0" />

  <meta name="author" content="Ricardo Azzi Silva" />
  <meta name="robots" content="index, follow" />
  <meta name="description" content="A ficção cientifica da guerra dos anjos e demônios: os que são a favor do governo central de Javé, e os que exigem serem reconhecidos como deuses e sagrados" />

  <meta property="og:title" content="<?php echo str_replace('"', "&quot;", $this->var['metadata']->title); ?>" />
  <meta property="og:description" content="<?php echo str_replace('"', "&quot;", $this->var['metadata']->subtitle); ?>" />
  <meta property="og:url" content="<?php echo $this->var['metadata']->website;?><?php echo $this->var['metadata']->url;?>" />
  <meta property="og:locale" content="pt_BR" />

  <?php if( @$this->var['metadata']->figure ){ ?>
  <meta property="og:image" content="<?php echo $this->var['metadata']->website;?><?php echo $this->var['metadata']->figure->url;?>" />
  <meta property="og:image:secure_url" content="<?php echo $this->var['metadata']->website;?><?php echo $this->var['metadata']->figure->url;?>" />
  <meta property="twitter:image" content="<?php echo $this->var['metadata']->website;?><?php echo $this->var['metadata']->figure->url;?>" />
  <meta property="og:image:type" content="<?php echo $this->var['metadata']->figure->mimeType;?>" />
  <meta property="og:image:width" content="<?php echo $this->var['metadata']->figure->width;?>" />
  <meta property="og:image:height" content="<?php echo $this->var['metadata']->figure->height;?>" />
  <?php } ?>

  <?php if( @$this->var['metadata']->isArticle ){ ?>
  <meta property="og:type" content="article" />
  <meta property="article:author" content="Ricardo Azzi Silva" />
  <meta property="article:section" content="<?php echo $this->var['metadata']->bookName;?>" />

  <meta property="article:published_time" content="<?php echo date("Y-m-d", $this->var['metadata']->publishedDate); ?>T<?php echo date("H:i", $this->var['metadata']->publishedDate); ?>Z" />
  <meta property="article:modified_time" content="<?php echo date("Y-m-d", $this->var['metadata']->lastEditDate); ?>T<?php echo date("H:i", $this->var['metadata']->lastEditDate); ?>Z" />
  <?php } ?>

  <?php if( @$this->var['metadata']->figure ){ ?>
  <meta name="twitter:card" content="summary_large_image" />
  <?php }else{ ?>
  <meta name="twitter:card" content="summary" />
  <?php } ?>
  <meta name="twitter:site" content="@ehouveguerra" />
  <meta name="twitter:creator" content="@fuckingazzi" />

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-172157320-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());
    gtag('config', 'UA-172157320-1');
  </script>

  <link rel="icon" type="image/x-icon" href="/favicon.ico" />

  <!-- Styles -->
  <link rel="stylesheet" type="text/css" href="/res/style/base-style.css" />
  <link rel="stylesheet" type="text/css" media="(min-width:700px)" href="/res/style/tablet-style.css" />
  <link rel="stylesheet" type="text/css" media="(min-width:1000px)" href="/res/style/desktop-style.css" />
  <link rel="stylesheet" type="text/css" href="/res/fonts/IcoFont/icofont.min.css" />

  <!-- Fonts -->
  <link rel="preload" as="font" type="font/ttf" href="/res/fonts/Aldrich/Aldrich-Regular.ttf" />
  <link rel="preload" as="font" type="font/ttf" href="/res/fonts/Teko/Teko-Bold.ttf" />
  <link rel="preload" as="font" type="font/ttf" href="/res/fonts/Markazi/MarkaziText-VariableFont_wght.ttf" />
  <link rel="preload" as="font" type="font/ttf" href="/res/fonts/Cuprum/Cuprum-Regular.ttf" />
  <link rel="preload" as="font" type="font/eot" href="/res/fonts/IcoFont/fonts/icofont.eot" />
  <link rel="preload" as="font" type="font/ttf" href="/res/fonts/IcoFont/fonts/icofont.ttf" />

  <script src="/res/js/script.js" type="text/javascript"></script>
</head>

<body>
  <div id="virtual-height-main-header"></div>
  <header
    id="main-header"
    class="main"
  >
    <button
      type="button"
      title="Menu lateral"
      aria-label="Menu lateral"
      class="is-icon burguer mainmenu-button"
      onclick="toogleMainMenu()"
    >
      <span></span>
      <span></span>
      <span></span>
    </button>
    <h1>
      <a href="/">E Houve Guerra nos Céus</a>
    </h1>
  </header>
  <nav
    id="main-menu"
    class="sidebar-menu"
  >
    <button
      onclick="toogleMainMenu()"
      class="menu-collapse icofont-curved-right"
    ></button>
    <?php $counter1=-1; if( isset($this->var['books']) && is_array($this->var['books']) && sizeof($this->var['books']) ) foreach( $this->var['books'] as $key1 => $value1 ){ $counter1++; ?>
    <?php $this->var['book']=$value1;?>
    <div class="submenu-heading">
      <h3 title="<?php echo $this->var['book']->title;?>"><?php echo $this->var['book']->title;?></h3>
      <span class="open-menu-icon icofont-curved-right"></span>
    </div>
    <ul>
      <?php $counter2=-1; if( isset($value1->chapters) && is_array($value1->chapters) && sizeof($value1->chapters) ) foreach( $value1->chapters as $key2 => $value2 ){ $counter2++; ?>
      <li><a href="/index.php/book/<?php echo $this->var['book']->id;?>/chapter/<?php echo $value2->id;?>/"><?php echo $value2->title;?></a></li>
      <?php } ?>
    </ul>
    <?php } ?>
  </nav>
  <main
    id="main"
    class="main"
    role="main"
  >
