<?php if(!class_exists('raintpl')){exit;}?><?php if( $this->var['pages'] ){ ?>
<nav class="pagination">
  <ul>
    <?php $counter1=-1; if( isset($this->var['pages']) && is_array($this->var['pages']) && sizeof($this->var['pages']) ) foreach( $this->var['pages'] as $key1 => $value1 ){ $counter1++; ?>
    <li>
      <a href="/?page=<?php echo $value1;?>"><?php echo $value1;?></a>
    </li>
    <?php } ?>
      <!-- <a class="open-menu-icon icofont-curved-left"></a> -->
    <!-- <li>
      <a class="open-menu-icon icofont-curved-right"></a>
    </li> -->
  </ul>
</nav>
<?php } ?>

<?php $counter1=-1; if( isset($this->var['chapters']) && is_array($this->var['chapters']) && sizeof($this->var['chapters']) ) foreach( $this->var['chapters'] as $key1 => $value1 ){ $counter1++; ?>
<section class="postagem">
  <div>
    <a href="<?php echo $value1->url;?>" class="heading-1-like"><?php echo $value1->title;?></a>
    <a href="<?php echo $value1->url;?>" class="heading-2-like"><?php echo $value1->subtitle;?></a>
  </div>
  <?php if( $value1->figure ){ ?>
  <a href="<?php echo $value1->url;?>">
    <figure>
      <img src="<?php echo $value1->figure->url;?>" />
    </figure>
  </a>
  <?php } ?>
  <div class="publication-data">
    <p class="publication-author">
      <?php echo $value1->author;?> <span class="publication-location"> - <?php echo $value1->location;?></span>
    </p>
    <time itemprop="datePublished"> <?php echo date("d/m/Y H:i", $value1->publishedDate); ?> </time>
  </div>
</section>
<hr />
<?php } ?>

<?php if( $this->var['pages'] ){ ?>
<nav class="pagination">
  <ul>
    <?php $counter1=-1; if( isset($this->var['pages']) && is_array($this->var['pages']) && sizeof($this->var['pages']) ) foreach( $this->var['pages'] as $key1 => $value1 ){ $counter1++; ?>
    <li>
      <a href="/?page=<?php echo $value1;?>"><?php echo $value1;?></a>
    </li>
    <?php } ?>
      <!-- <a class="open-menu-icon icofont-curved-left"></a> -->
    <!-- <li>
      <a class="open-menu-icon icofont-curved-right"></a>
    </li> -->
  </ul>
</nav>
<?php } ?>