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
    <time class="last-edition"> última edição <?php echo date("d/m/Y H:i", $this->var['lastEditDate']); ?> </time>
    <?php } ?>
  </div>

  <hr />
