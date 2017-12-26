<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html>
    <?php echo $head;?>
    <body class="<?php echo $bodyclass;?>">
        <header>
            <div class="wrapper">
                <div class="left">
                    <a class="logo" href="<?php echo $home_url;?>">
                        <?php if( $logo_url ){ ?><img src="<?php echo $logo_url;?>" /></a><?php } ?>
                    </a>
                    <?php echo $main_navigation;?>
                </div>
                <div class="right">
                    <div class="userarea">
                        <?php echo $userarea;?>
                    </div>
                </div>
            </div>
        </header>
        <div class="content">
            <?php echo $body;?>
        </div>
        <?php if( $messages ){ ?>
            <div class="message-container">
            <?php $counter1=-1; if( isset($messages) && is_array($messages) && sizeof($messages) ) foreach( $messages as $key1 => $value1 ){ $counter1++; ?>
                <div class="alert alert-<?php echo $value1["type"];?>" role="alert"><?php echo $value1["text"];?></div>
            <?php } ?>
            </div>
        <?php } ?>
        <div id="slidein-overlay">
            <a href="javascript://" class="close"></a>
            <div class="loader"></div>
            <div class="content">
            </div>
        </div>
    </body>
    <footer>
        <div class="wrapper">
            <div class="row">
                <a class="logo" href="<?php echo $home_url;?>">
                    <?php if( $logo_url ){ ?><img src="<?php echo $logo_url;?>" /></a><?php } ?>
                </a>
                <div class="right">
                    <?php echo $main_navigation;?>
                </div>
            </div>
        </div>
    </footer>

</html>
