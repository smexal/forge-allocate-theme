<?php if(!class_exists('raintpl')){exit;}?><a class="listing-item reveal to-overlay" href="<?php echo $detail_url;?>">
    <div class="image"><img src="<?php echo $image["src"];?>" alt="<?php echo $image["alt"];?>" /></div>
    <div class="additional">
        <h3><?php echo $title;?></h3>
        <p class="discreet"><?php echo $description;?></p>
    </div>
</a>