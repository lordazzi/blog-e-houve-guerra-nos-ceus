<?php if(!class_exists('raintpl')){exit;}?><figure>
  <img
    alt="<?php echo $this->var['caption'];?>"
    src="/image-archive/<?php echo $this->var['imagePath'];?>"
  >
  <figcaption><?php echo $this->var['caption'];?></figcaption>
</figure>
