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

    /**
     * Returns less variables for the theme according to "light" or "dark"
     * setting which is set in the backend panel.
     * @return array less variables
     */
    public function getLessVariables() {
        $schema = $this->getSchema();
        $variables = [
        ];
        if($schema == 'light') {
            $variables = array_merge($variables, [
                'color-bg' => '#FFFFFF',
                'header-shadow' => '0 2px 4px 0 rgba(0,0,0,0.05)'
            ]);
        } else {
            $variables = array_merge($variables, [
                'color-bg' => '#1A1A1A',
                'header-shadow' => '0 2px 4px 0 rgba(0,0,0,0.5)'
            ]);
        }
        return $variables;
    }

    /**
     * Checks the admin panel settings for the selected
     * color theme, dark or light.
     * @return string color scheme
     */
    private function getSchema() {
        $schema = Settings::get('dark-or-light');
        if($schema == 'dark') {
            return $schema;
        } 
        return 'light';
    }

}

?>