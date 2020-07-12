<?php if(!class_exists('raintpl')){exit;}?><blockquote>
  <?php $counter1=-1; if( isset($this->var['paragraphs']) && is_array($this->var['paragraphs']) && sizeof($this->var['paragraphs']) ) foreach( $this->var['paragraphs'] as $key1 => $value1 ){ $counter1++; ?>
  <p><?php echo $value1;?></p>
  <?php } ?>
  <?php if( @$this->var['cite'] ){ ?>
  <cite><?php echo $this->var['cite'];?></cite>
  <?php } ?>
</blockquote>
