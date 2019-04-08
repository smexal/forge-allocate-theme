<?php

namespace Forge\Themes\Allocate;

use \Forge\Core\App\App;
use \Forge\Core\App\ModifyHandler;



class Shop {

    public function __construct() {
        ModifyHandler::instance()->add(
            'modify_product_listing_template_name',
            [$this, 'updateListingTemplateName']
        );

        ModifyHandler::instance()->add(
            'modify_product_listing_template_path',
            [$this, 'updateListingTemplatePath']
        );
    }

    public function updateListingTemplateName() {
        return 'shoplisting';
    }

    public function updateListingTemplatePath() {
        return DOC_ROOT.'themes/allocate/templates/parts/';
    }

    private function isAvailable() {
        if(!App::instance()->mm->isActive('forge-prodcuts'))
            return;
        return true;
    }

}