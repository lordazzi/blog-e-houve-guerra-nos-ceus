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
      href="https://www.facebook.com/dialog/share?href={encodedUrl}&app_id=1994565347343864"
      target="_blank"
      class="is-icon icofont-facebook"
    ></a>
    <a
      rel="noopener noreferrer"
      onclick="SocialNetworkShare.twitter()"
      href="https://twitter.com/intent/tweet?hashtags=EHouveGuerraNosCeus&original_referer={encodedUrl}&text={encodedUrl}"
      target="_blank"
      class="is-icon icofont-twitter"
    ></a>
    <a
      rel="noopener noreferrer"
      onclick="SocialNetworkShare.whastapp()"
      href="https://wa.me/?text={encodedUrl}"
      target="_blank"
      class="is-icon icofont-brand-whatsapp"
    ></a>
    <a
      rel="noopener noreferrer mobile-sharable"
      data-share-title="<?php echo str_replace('"', "&quot;", $this->var['title']); ?>"
      data-share-text="<?php echo str_replace('"', "&quot;", $this->var['subtitle']); ?>"
      data-share-url="{encodedUrl}"
      onclick="SocialNetworkShare.share()"
      target="_blank"
      style="display:none"
      class="is-icon icofont-share"
    ></a>
  </div>
  <hr />
