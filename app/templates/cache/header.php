<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0"
  />

  <title>E Houve Guerra nos Céus</title>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script
    async
    src="https://www.googletagmanager.com/gtag/js?id=UA-172157320-1"
  ></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());
    gtag('config', 'UA-172157320-1');
  </script>

  <link
    rel="icon"
    type="image/x-icon"
    href="/favicon.ico"
  >

  <!-- Styles -->
  <link
    rel="stylesheet"
    type="text/css"
    href="/res/style/base-style.css"
  >
  <link
    rel="stylesheet"
    type="text/css"
    media="(min-width:700px)"
    href="/res/style/tablet-style.css"
  >
  <link
    rel="stylesheet"
    type="text/css"
    media="(min-width:1000px)"
    href="/res/style/desktop-style.css"
  >
  <link
    rel="stylesheet"
    type="text/css"
    href="/res/fonts/IcoFont/icofont.min.css"
  >

  <!-- Fonts -->
  <link
    rel="preload"
    as="font"
    type="font/ttf"
    href="/res/fonts/Aldrich/Aldrich-Regular.ttf"
  >
  <link
    rel="preload"
    as="font"
    type="font/ttf"
    href="/res/fonts/Teko/Teko-Bold.ttf"
  >
  <link
    rel="preload"
    as="font"
    type="font/ttf"
    href="/res/fonts/Markazi/MarkaziText-VariableFont_wght.ttf"
  >
  <link
    rel="preload"
    as="font"
    type="font/ttf"
    href="/res/fonts/Cuprum/Cuprum-Regular.ttf"
  >
  <link
    rel="preload"
    as="font"
    type="font/eot"
    href="/res/fonts/IcoFont/fonts/icofont.eot"
  >
  <link
    rel="preload"
    as="font"
    type="font/ttf"
    href="/res/fonts/IcoFont/fonts/icofont.ttf"
  >

  <script
    src="/res/js/script.js"
    type="text/javascript"
  ></script>
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
    <?php $counter1=-1; if( isset($this->var['books']) && is_array($this->var['books']) && sizeof($this->var['books']) ) foreach( $this->var['books'] as $key1 => $value1 ){ $counter1++; ?>
    <?php $this->var['book']=$value1;?>
    <div class="submenu-heading">
      <h3 title="<?php echo $this->var['book']->title;?>"><?php echo $this->var['book']->title;?></h3>
      <span class="open-menu-icon icofont-curved-right"></span>
    </div>
    <ul>
      <?php $counter2=-1; if( isset($value1->chapters) && is_array($value1->chapters) && sizeof($value1->chapters) ) foreach( $value1->chapters as $key2 => $value2 ){ $counter2++; ?>
      <li><a href="/index.php/book/<?php echo $this->var['book']->path;?>/chapter/<?php echo $value2->path;?>/"><?php echo $value2->title;?></a></li>
      <?php } ?>
    </ul>
    <?php } ?>
  </nav>
  <main
    id="main"
    class="main"
    role="main"
  >
