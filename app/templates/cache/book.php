<?php if(!class_exists('raintpl')){exit;}?><h3>Capítulos:</h3>
<ol class="book-chapters-list">
  <?php $counter1=-1; if( isset($this->var['chapters']) && is_array($this->var['chapters']) && sizeof($this->var['chapters']) ) foreach( $this->var['chapters'] as $key1 => $value1 ){ $counter1++; ?>
  <li><a href="<?php echo $value1->url;?>"><?php echo $value1->title;?></a></li>
  <?php } ?>
</ol>
