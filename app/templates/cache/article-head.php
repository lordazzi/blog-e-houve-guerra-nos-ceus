<?php if(!class_exists('raintpl')){exit;}?><div class="facebook-wrapper">
  <div id="fb-root"></div>
  <button
    id="facebook-share"
    class="fb-share-button"
    data-href="https://ehouveguerranosceus.com.br/index.php/article/do-que-se-trata/"
    data-layout="button_count"
  ></button>
  <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
  fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
</div>

<article class="postagem">
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
    <label for="facebook-share">
      <a
        rel="noopener noreferrer"
        onclick="SocialNetworkShare.facebook()"
        target="_blank"
        class="is-icon icofont-facebook"
      ></a>
    </label>
    <a
      rel="noopener noreferrer"
      onclick="SocialNetworkShare.twitter()"
      href="https://twitter.com/ehouveguerra"
      target="_blank"
      class="is-icon icofont-twitter"
    ></a>
    <a
      rel="noopener noreferrer"
      onclick="SocialNetworkShare.whastapp()"
      href="https://github.com/lordazzi/website-e-houve-guerra-nos-ceus"
      target="_blank"
      class="is-icon icofont-brand-whatsapp"
    ></a>
    <a
      rel="noopener noreferrer"
      onclick="SocialNetworkShare.share()"
      href="https://github.com/lordazzi/website-e-houve-guerra-nos-ceus"
      target="_blank"
      class="is-icon icofont-share"
    ></a>
  </div>
  <hr />
