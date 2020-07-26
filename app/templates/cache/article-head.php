<?php if(!class_exists('raintpl')){exit;}?><article class="postagem">
  <h1 itemprop="headline"><?php echo $this->var['title'];?></h1>
  <h2 itemprop="alternativeHeadline"><?php echo $this->var['subtitle'];?></h2>
  <div class="publication-data">
    <p
      class="publication-author"
      title="<?php echo $this->var['author'];?>"
    >por <?php echo $this->var['author'];?> <span class="publication-location"> - <?php echo $this->var['location'];?></span></p>
    <time itemprop="datePublished"> <?php echo date("d/m/Y H:i", $this->var['publishedDate']); ?> </time>
    <?php if( $this->var['lastEditDate'] ){ ?>
    <time class="last-edition"> edição <?php echo date("d/m/Y H:i", $this->var['lastEditDate']); ?> </time>
    <?php } ?>
  </div>

  <hr />
  <div class="share-this-article">Compartilhe</div>
  <div class="social-network">
    <a
      rel="noopener noreferrer"
      onclick="SocialNetworkShare.facebook()"
      href="https://www.facebook.com/dialog/share?href=<?php echo urlencode($this->var['website']); ?><?php echo urlencode($this->var['url']); ?>&app_id=1994565347343864"
      target="_blank"
      class="is-icon icofont-facebook"
    ></a>
    <a
      rel="noopener noreferrer"
      onclick="SocialNetworkShare.twitter()"
      href="https://twitter.com/intent/tweet?hashtags=EHouveGuerraNosCeus&original_referer=<?php echo urlencode($this->var['website']); ?><?php echo urlencode($this->var['url']); ?>&text=<?php echo urlencode($this->var['website']); ?><?php echo urlencode($this->var['url']); ?>"
      target="_blank"
      class="is-icon icofont-twitter"
    ></a>
    <a
      rel="noopener noreferrer"
      onclick="SocialNetworkShare.whastapp()"
      href="https://wa.me/?text=<?php echo urlencode($this->var['website']); ?><?php echo urlencode($this->var['url']); ?>"
      target="_blank"
      class="is-icon icofont-brand-whatsapp"
    ></a>
    <a
      rel="noopener noreferrer mobile-sharable"
      data-share-title="<?php echo str_replace('"', "&quot;", $this->var['title']); ?>"
      data-share-text="<?php echo str_replace('"', "&quot;", $this->var['subtitle']); ?>"
      data-share-url="<?php echo urlencode($this->var['website']); ?><?php echo urlencode($this->var['url']); ?>"
      onclick="SocialNetworkShare.share()"
      target="_blank"
      style="display:none"
      class="is-icon icofont-share"
    ></a>
  </div>
  <hr />
  <?php if( !@$this->var['chapters'] ){ ?>
  <nav class="chapters-navigation">
    <a
      <?php if( @$this->var['previousChapter'] ){ ?>
        href="/index.php/book/<?php echo $this->var['bookId'];?>/chapter/<?php echo $this->var['previousChapter'];?>/"
      <?php }else{ ?>
        disabled="disabled" href="javascript:void(0)"
      <?php } ?>
    >capítulo anterior</a>
    <a href="/index.php/book/<?php echo $this->var['bookId'];?>/">voltar ao livro</a>
    <a
      <?php if( @$this->var['nextChapter'] ){ ?>
        href="/index.php/book/<?php echo $this->var['bookId'];?>/chapter/<?php echo $this->var['nextChapter'];?>/"
      <?php }else{ ?>
        disabled="disabled" href="javascript:void(0)"
      <?php } ?>
    >próximo capítulo</a>
  </nav>
  <hr />
  <?php } ?>
