<?php if(!class_exists('raintpl')){exit;}?><figure>
  <picture>
    <source media="(min-width: 580px)" srcset="/image-archive/<?php echo getImageUrl($this->var['imagePath'], 530); ?>" />
    <source media="(min-width: 500px)" srcset="/image-archive/<?php echo getImageUrl($this->var['imagePath'], 450); ?>" />
    <source media="(min-width: 450px)" srcset="/image-archive/<?php echo getImageUrl($this->var['imagePath'], 400); ?>" />
    <source media="(min-width: 400px)" srcset="/image-archive/<?php echo getImageUrl($this->var['imagePath'], 350); ?>" />
    <source media="(min-width: 350px)" srcset="/image-archive/<?php echo getImageUrl($this->var['imagePath'], 300); ?>" />
    <source media="(min-width: 300px)" srcset="/image-archive/<?php echo getImageUrl($this->var['imagePath'], 250); ?>" />

    <img alt="<?php echo $this->var['caption'];?>" src="/image-archive/<?php echo getImageUrl($this->var['imagePath'], 670); ?>" />
  </picture>
  <figcaption><?php echo $this->var['caption'];?></figcaption>
</figure>
