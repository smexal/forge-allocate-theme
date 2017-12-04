<?php

namespace Forge\Themes\Allocate;

use Forge\Core\Abstracts\Theme;
use Forge\Core\App\App;
use Forge\Loader;

use Forge\Themes\Allocate\ThemeSettings;


class AllocateTheme extends Theme {
    public $lessVariables = [
        'key' => 'var'
    ];

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

    private function loadFiles() {
        $l = Loader::instance();
        $l->loadDirectory($this->directory()."classes/");
    }

    public function start() {
        $this->loadFiles();
        $this->registerNavigations();

        new ThemeSettings();
    }

    private function registerNavigations() {
        //ContentNavigation::registerPosition('footer-nav', i('Footer Navigation', 'butterlan'));/
    }

    public function globals() {
        return [
        ];
    }

    public function styles() {
        // load core if wanted...
        $this->addStyle(CORE_WWW_ROOT."ressources/css/externals/bootstrap.core.min.css", true);
        $this->addStyle(CORE_WWW_ROOT.'ressources/css/externals/material-icons.css', false, false);

        //$this->addStyle("//fonts.googleapis.com/css?family=Crimson+Text:600|Exo+2:300,400,500,700", true);

        // load custom css
        //$this->addStyle($this->directory().'css/main.less');
    }

    public function scripts() {
        $this->addScript(CORE_WWW_ROOT."ressources/scripts/externals/jquery.js", true, 0);
        $this->addScript(CORE_WWW_ROOT."ressources/scripts/externals/bootstrap.js", true, 1);
        $this->addScript(CORE_WWW_ROOT."ressources/scripts/messages.js", true);
        $this->addScript(CORE_WWW_ROOT."ressources/scripts/helpers.js", true, 2);

        $this->addScript("//www.google.com/recaptcha/api.js", true, false, true);
    }

    public function customHeader() {
        return '';
    }
}

?>
