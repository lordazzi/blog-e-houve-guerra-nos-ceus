<?php if(!class_exists('raintpl')){exit;}?><h1 itemprop="headline"><?php echo $this->var['title'];?></h1>
<h2 itemprop="alternativeHeadline"><?php echo $this->var['subtitle'];?></h2>
<div class="publication-data">
  <p
    class="publication-author"
    title="<?php echo $this->var['author'];?>"
  >por <?php echo $this->var['author'];?> <span class="publication-location"> - <?php echo $this->var['location'];?></span></p>
  <time itemprop="datePublished"> <?php echo $this->var['publishedDate'];?> </time>
</div>

<hr />
