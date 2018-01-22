<?php

namespace Forge\Themes\Allocate\Views;

use Forge\Core\Classes\ContentNavigation;
use \Forge\Core\Abstracts\View;



class MorenavigationView extends View {
    public $name = 'more-navigation';
    public $standalone = true;

    public function content($parts=[]) {
        $main = ContentNavigation::getNavigationList('main-navigation');
        return $main.ContentNavigation::getNavigationList('more-navigation');
    }

}