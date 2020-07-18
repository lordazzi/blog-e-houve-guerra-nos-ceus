<?php if(!class_exists('raintpl')){exit;}?><figure>
  <picture>
    <img alt="<?php echo $this->var['caption'];?>" src="/<?php echo getImageUrl($this->var['imagePath']); ?>" />
  </picture>
  <figcaption><?php echo $this->var['caption'];?></figcaption>
</figure>
