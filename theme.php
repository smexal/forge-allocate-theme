<?php

namespace Forge\Themes\Allocate;

use Forge\Core\Abstracts\Theme;
use Forge\Core\App\App;
use Forge\Core\Classes\ContentNavigation;
use Forge\Core\Classes\Media;
use Forge\Core\Classes\Settings;
use Forge\Core\Classes\Utils;
use Forge\Loader;
use Forge\Themes\Allocate\ThemeSettings;
use Forge\Themes\Allocate\UserArea;



class AllocateTheme extends Theme {
    public $lessVariables = [];

    private $userArea = null;
    private $tSettings = null;
    public $ajaxLayout = 'layout.ajax';

    public function tinyUrl() {
        return $this->url().'css/compiled/main.css';
    }

    public function tinyFormats() {
        return [
            [
                'title' => i('Lead text', 'allocate'),
                'selector' => 'p',
                'classes' => 'lead'
            ],
            [
                'title' => i('Small text', 'allocate'),
                'selector' => 'p',
                'classes' => 'discreet'
            ],
            [
                'title' => i('Heading 1', 'allocate'),
                'block' => 'h1'
            ],
            [
                'title' => i('Heading 2', 'allocate'),
                'block' => 'h2'
            ],
            [
                'title' => i('Heading 3', 'allocate'),
                'block' => 'h3'
            ],
            [
                'title' => i('Heading 4', 'allocate'),
                'block' => 'h4'
            ],
        ];
    }

    private function registerEvents() {
        $app = App::instance();
        $app->eh->register('loginFailed', array($this->userArea, 'loginFailed'));
    }

    private function loadFiles() {
        $l = Loader::instance();
        $l->loadDirectory($this->directory()."classes/");
    }

    public function start() {
        $this->registerNavigations();

        $this->userArea = new UserArea();   

        $this->loadFiles();
        $this->tSettings = new ThemeSettings();
        $this->lessVariables = $this->tSettings->getLessVariables();

        /**
         * remove existing css files for recompilation
         */
        App::instance()->eh->register('globalSettingsUpdated', function() {
            $files = glob($this->directory().'css/compiled/*.css'); // get all file names
            foreach($files as $file){ // iterate files
                if(is_file($file))
                    unlink($file); // delete file
            }
        });
    }

    private function registerNavigations() {
        ContentNavigation::registerPosition('main-navigation', i('Main Navigation', 'allocate'));
        ContentNavigation::registerPosition('more-navigation', i('Sidebar Navigation in Hamburger', 'allocate'));
        ContentNavigation::registerPosition('user-nav', i('User Navigation', 'allocate'));
    }

    public function globals() {
        $logo = false;
        if(is_numeric(Settings::get('site-logo'))) {
            $logo = new Media(Settings::get('site-logo'));
        }

        return [
            'logo_url' => $logo ? $logo->getUrl() : false,
            'home_url' => Utils::getHomeUrl(),
            'bodyclass' => 'theme-'.$this->tSettings->getSchema(),
            'main_navigation' => ContentNavigation::getNavigationList('main-navigation'),
            'userarea' => $this->userArea->output(),
            'more_navigation_url' => App::instance()->vm->getViewByName('more-navigation')->buildURL()
        ];
    }

    public function styles() {
        // load core if wanted...
        $this->addStyle(CORE_WWW_ROOT."ressources/css/externals/bootstrap.core.min.css", true);
        $this->addStyle(CORE_WWW_ROOT.'ressources/css/externals/material-icons.css', false, false);

        $this->addStyle(WWW_ROOT.'themes/allocate/css/external/ionicon.css', false, false);
        $this->addStyle(WWW_ROOT.'themes/allocate/css/external/socicons.css', false, false);

        $font = Settings::get('font');
        if($font) {
            $this->addStyle("//fonts.googleapis.com/css?family=".str_replace(" ", "+", $font).":400,500,700", true);
        }

        // load custom css
        $this->addStyle($this->directory().'css/main.less');
        $this->addStyle($this->directory().'css/forms.less');

        $this->addStyle($this->directory().'css/animation-smack.less');

        $this->addStyle($this->directory().'css/blocks/header.less');
        $this->addStyle($this->directory().'css/blocks/button.less');
        $this->addStyle($this->directory().'css/blocks/userarea.less');
        $this->addStyle($this->directory().'css/blocks/messages.less');
        $this->addStyle($this->directory().'css/blocks/slidein.less');
        $this->addStyle($this->directory().'css/blocks/loader.less');
        $this->addStyle($this->directory().'css/blocks/collections.less');
        $this->addStyle($this->directory().'css/blocks/tabs.less');
        $this->addStyle($this->directory().'css/blocks/table.less');

        $this->addStyle($this->directory().'css/blocks/components.less');

    }

    public function scripts() {
        $this->addScript(CORE_WWW_ROOT."ressources/scripts/externals/jquery.js", true, 0);
        $this->addScript(CORE_WWW_ROOT."ressources/scripts/externals/bootstrap.js", true, 1);
        $this->addScript(CORE_WWW_ROOT."ressources/scripts/messages.js", true);
        $this->addScript(CORE_WWW_ROOT."ressources/scripts/helpers.js", true, 2);

        $this->addScript("//www.google.com/recaptcha/api.js", true, false, true);

        $this->addScript("assets/scripts/main.js");
        $this->addScript("assets/scripts/revealing.js");
        $this->addScript("assets/scripts/slidein.js");
    }

    public function customHeader() {
        $variables = $this->tSettings->getLessVariables();
        $favicon = new Media(Settings::get('favicon'));
        return '
            <link rel="apple-touch-icon" sizes="180x180" href="'.$favicon->getSizedImage(180, 180).'">
            <link rel="icon" type="image/png" sizes="32x32" href="'.$favicon->getSizedImage(32, 32).'">
            <link rel="icon" type="image/png" sizes="16x16" href="'.$favicon->getSizedImage(16, 16).'">
            <meta name="theme-color" content="'.$variables['color-bg'].'">
            <meta name="viewport" content="width=device-width, initial-scale=1">
        ';
    }
}

?>
