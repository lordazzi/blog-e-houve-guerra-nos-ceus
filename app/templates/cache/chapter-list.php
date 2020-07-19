<?php if(!class_exists('raintpl')){exit;}?><nav class="pagination">
  <ul>
    <li>
      <!-- <a>1</a> -->
      <a class="open-menu-icon icofont-curved-left"></a>
    </li>
    <li>
      <a>2</a>
    </li>
    <li>
      <a>3</a>
    </li>
    <li>
      <a>4</a>
    </li>
    <li>
      <a>5</a>
    </li>
    <li>
      <a>6</a>
    </li>
    <li>
      <a>7</a>
    </li>
    <li>
      <a>8</a>
    </li>
    <li>
      <a>9</a>
    </li>
    <li>
      <a class="open-menu-icon icofont-curved-right"></a>
    </li>
  </ul>
</nav>
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

1. Corrigir defeito da sobreposição do nome do autor e a localização para ambiente mobile
2. Incluir dados de cabeçalho
3. Incluir paginação
4. Criar arquivo cache com ordenação, atualizar arquivo a cada novo artigo escrito
5. Incluir botões para compartilhamento em redes sociais: facebook, twitter, whatsapp e native share