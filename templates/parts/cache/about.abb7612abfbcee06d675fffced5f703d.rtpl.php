<?php if(!class_exists('raintpl')){exit;}?><div class="component about-block">
    <div class="wrapper">
        <div class="row">
            <div class="col-lg-6">
                <h2><?php echo $title;?></h2>
                <p><?php echo $description;?></p>
                <div class="row">
                    <div class="col-lg-6">
                        <p class="discreet"><?php echo $f1_title;?></p>
                        <h3><?php echo $f1_text;?></h3>
                    </div>
                    <div class="col-lg-6">
                        <p class="discreet"><?php echo $f2_title;?></p>
                        <h3><?php echo $f2_text;?></h3>
                    </div>
                </div>
                <a href="<?php echo $cta_link;?>" class="btn btn-primary"><?php echo $cta_label;?></a>
            </div>
            <div class="col-lg-1">
            </div>
            <div class="col-lg-5">
                <?php echo $mc_form;?>

            </div>
        </div>
    </div>
</div>