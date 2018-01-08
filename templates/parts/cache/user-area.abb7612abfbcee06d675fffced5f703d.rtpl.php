<?php if(!class_exists('raintpl')){exit;}?><div class="user-info trigger-overlay-fitsize" data-trigger="#user-menu">
    <div class="loggedin-as">
        <i class="icon ion-android-more-vertical"></i>
        <span class="username"><?php echo $username;?></span>
        <div class="user-image" <?php if( $profile_image ){ ?>style="background-image:url(<?php echo $profile_image;?>)"<?php } ?>></div>
    </div>
    <a class="menu-trigger<?php if( $warning ){ ?> warning<?php } ?>"></a>
</div>
<div class="overlay-fitsize hidden" id="user-menu">
    <?php echo $user_navigation;?>

</div>