<?php

namespace Forge\Themes\Allocate;

use Forge\Core\App\Auth;
use Forge\Core\Classes\Fields;
use Forge\Core\Classes\Settings;

class ThemeSettings {
    private $cs = null;

    public function __construct() {
        if(! Auth::allowed("manage.settings", true)) {
            return;
        }

        Settings::addTab('allocate', i('Allocate Theme', 'allocate'));

        $this->cs = Settings::instance();
        $this->fields();
    }

    private function fields() {
        $this->cs->registerField(
            Fields::select([
                'key' => 'dark-or-light',
                'label' => i('Dark or Light', 'allocate'),
                'values' => [
                    'dark' => i('Dark', 'allocate'),
                    'light' => i('Light', 'allocate')
                ],
                'hint' => i('Choose if you want the dark or light theme.', 'allocate')
        ], Settings::get('dark-or-light')), 'dark-or-light', 'left', 'allocate');
    }

}

?>