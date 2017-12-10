<?php if(!class_exists('raintpl')){exit;}?><button 
    type="button"
    id="login-area"
    data-trigger="#login-form"
    class="btn btn-default login trigger-overlay-fitsize"><?php echo $login_label;?></button>
<div class="overlay-fitsize <?php if( !$error ){ ?>hidden<?php } ?>" id="login-form">
    <h3><?php echo $login_label;?></h3>
    <?php if( $error ){ ?>

        <div class="alert alert-warning">
            <?php echo $error;?>

        </div>
    <?php } ?>

    <form method="post">
        <?php echo $form;?>

    </form>
    <a class="block" href="<?php echo $reset["link"];?>"><?php echo $reset["label"];?></a>
    <a class="block" href="<?php echo $register["link"];?>"><?php echo $register["label"];?></a>
</div>