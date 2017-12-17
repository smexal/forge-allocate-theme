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
            'userarea' => $this->userArea->output()
        ];
    }

    public function styles() {
        // load core if wanted...
        $this->addStyle(CORE_WWW_ROOT."ressources/css/externals/bootstrap.core.min.css", true);
        $this->addStyle(CORE_WWW_ROOT.'ressources/css/externals/material-icons.css', false, false);

        $this->addStyle(WWW_ROOT.'themes/allocate/css/external/ionicon.css', false, false);

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
    }

    public function customHeader() {
        return '';
    }
}

?>
