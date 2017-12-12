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

        // Dark or Light Theme Selection
        $this->cs->registerField(
            Fields::select([
                'key' => 'dark-or-light',
                'label' => i('Dark or Light', 'allocate'),
                'values' => [
                    'dark' => i('Dark', 'allocate'),
                    'light' => i('Light', 'allocate')
                ],
                'hint' => i('Choose if you want the dark or light theme.', 'allocate')
            ], Settings::get('dark-or-light')
        ), 'dark-or-light', 'left', 'allocate');

        // Logo Image
        $this->cs->registerField(
            Fields::image([
                'key' => 'site-logo',
                'label' => i('Choose/Upload your logo.', 'allocate'),
                'hint' => i('This logo wil be used in the main navigation', 'allocate')
            ], Settings::get('site-logo')
        ), 'site-logo', 'left', 'allocate');

        // Brand Primary Color
        $this->cs->registerField(
            Fields::text([
                'key' => 'color-brand-primary',
                'label' => i('Primary Color', 'allocate'),
                'hint' => i('Define a HEX Color Code of your preference', 'allocate')
            ], Settings::get('color-brand-primary')
        ), 'color-brand-primary', 'right', 'allocate');

        // Brand Secondary Color
        $this->cs->registerField(
            Fields::text([
                'key' => 'color-brand-secondary',
                'label' => i('Secondary Color', 'allocate'),
                'hint' => i('Define a HEX Color Code of your preference', 'allocate')
            ], Settings::get('color-brand-secondary')
        ), 'color-brand-secondary', 'right', 'allocate');

        // Font
        $this->cs->registerField(
            Fields::text([
                'key' => 'font',
                'label' => i('Google Font', 'allocate'),
                'hint' => i('Enter the name of a Google Font', 'allocate')
            ], Settings::get('font')
        ), 'font', 'right', 'allocate');
    }

    /**
     * Returns less variables for the theme according to "light" or "dark"
     * setting which is set in the backend panel.
     * @return array less variables
     */
    public function getLessVariables() {
        $schema = $this->getSchema();
        $primColor = Settings::get('color-brand-primary');
        $font = Settings::get('font');
        $variables = [
            'color-primary' =>  $primColor ? $primColor : '#F5A623',
            'font-family' => '"'.$font.'", Arial, "sans-serif"'
        ];

        // LIGHT SCHEMA 
        if($schema == 'light') {
            $variables = array_merge($variables, [
                'color-bg' => '#FFFFFF',
                'box-shadow' => '0 2px 4px 0 rgba(0,0,0,0.05)',
                'header-border-color' => '#EAEAEA',
                'nav-color' => '#333333',
                'cta-color' => '#626262',
                'color-text-main' => '#333333',
                'color-text-lighter' => '#666666',
                'color-gray' => '#464646',
                'form-border-color' => '#EAEAEA'
            ]);

        // DARK SCHEMA
        } else {
            $variables = array_merge($variables, [
                'color-bg' => '#1A1A1A',
                'box-shadow' => '0 2px 4px 0 rgba(0,0,0,0.5)',
                'header-border-color' => '#272727',
                'nav-color' => '#E2E2E2',
                'cta-color' => '#B3B3B3',
                'color-text-main' => '#FFFFFF',
                'color-text-lighter' => '#F2F2F2',
                'color-gray' => '#464646',
                'form-border-color' => '#3B3B3B'
            ]);
        }
        return $variables;
    }

    /**
     * Checks the admin panel settings for the selected
     * color theme, dark or light.
     * @return string color scheme
     */
    public function getSchema() {
        $schema = Settings::get('dark-or-light');
        if($schema == 'dark') {
            return $schema;
        } 
        return 'light';
    }

}

?>