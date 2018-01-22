<?php if(!class_exists('raintpl')){exit;}?><div class="component about-block reveal">
    <div class="wrapper">
        <div class="row">
            <div class="col-lg-6 col-md-7">
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
            <div class="col-lg-1 col-md-1">
            </div>
            <div class="col-lg-5 col-md-4">
                <?php echo $mc_form;?>

                <div class="social">
                    <h3><?php echo $social_title;?></h3>
                    <ul class="medias">
                        <?php $counter1=-1; if( isset($social_medias) && is_array($social_medias) && sizeof($social_medias) ) foreach( $social_medias as $key1 => $value1 ){ $counter1++; ?>

                            <li><a href="<?php echo $value1["link"];?>" target="_blank" class="icon-circle socicon-<?php echo $value1["type"];?>"></a></li>
                        <?php } ?>

                    </li>
                </div>
            </div>
        </div>
    </div>
</div>