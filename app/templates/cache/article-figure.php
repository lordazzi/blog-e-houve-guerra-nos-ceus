<?php if(!class_exists('raintpl')){exit;}?><figure>
  <picture>
    <source media="(min-width: 580px)" srcset="/image-archive/<?php echo $this->var['imagePath'];?>/<?php echo $this->var['imagePath'];?>-w530.jpg" />
    <source media="(min-width: 500px)" srcset="/image-archive/<?php echo $this->var['imagePath'];?>/<?php echo $this->var['imagePath'];?>-w450.jpg" />
    <source media="(min-width: 450px)" srcset="/image-archive/<?php echo $this->var['imagePath'];?>/<?php echo $this->var['imagePath'];?>-w400.jpg" />
    <source media="(min-width: 400px)" srcset="/image-archive/<?php echo $this->var['imagePath'];?>/<?php echo $this->var['imagePath'];?>-w350.jpg" />
    <source media="(min-width: 350px)" srcset="/image-archive/<?php echo $this->var['imagePath'];?>/<?php echo $this->var['imagePath'];?>-w300.jpg" />
    <source media="(min-width: 300px)" srcset="/image-archive/<?php echo $this->var['imagePath'];?>/<?php echo $this->var['imagePath'];?>-w250.jpg" />

    <img alt="<?php echo $this->var['caption'];?>" src="/image-archive/<?php echo $this->var['imagePath'];?>/<?php echo $this->var['imagePath'];?>-w670.jpg" />
  </picture>
  <figcaption><?php echo $this->var['caption'];?></figcaption>
</figure>
