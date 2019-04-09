<?php

namespace Forge\Themes\Allocate;

use \Forge\Core\App\App;
use \Forge\Core\App\Auth;
use \Forge\Core\Classes\User;
use \Forge\Core\Classes\Fields;



class Userinformation {

    public static function run() {
        // not even logged in...
        if(! Auth::any())
            return;

        if(array_key_exists('missing-fields-hidden', $_POST)) {
            self::updateUserMeta($_POST);
        }

        $missingFields = self::checkFieldData();
        if(count($missingFields) > 0) {
            return self::renderOverlay($missingFields);
        }
    }

    public static function updateUserMeta($data) {
        $missingFields = self::checkFieldData();
        foreach($missingFields as $field) {
            App::instance()->user->setMeta($field['key'], $data[$field['key']]);
        }
    }

    public static function checkFieldData() {
        $missing = [];
        foreach(User::getMetaFields() as $field) {
            if($field['required'] == true) {
                $value = App::instance()->user->getMeta($field['key']);
                if(strlen($value) > 0) {
                    continue;
                } else {
                    $missing[] = $field;
                }
            }
        }
        return $missing;
    }

    public static function renderOverlay($missingFields) {
        $fields = [];
        foreach($missingFields as $field) {
            $type = $field['type'];
            $fields[] = Fields::$type([
                'key' => $field['key'],
                'label' => $field['label'],
                'type' => $field['type']
            ], '');
        }
        $fields[] = Fields::hidden([
            'name' => 'missing-fields-hidden',
            'value' => 'yea'
        ]);
        $fields[] = Fields::button(i('Save changes'), 'primary', true);

        return App::instance()->render(App::instance()->getThemeDirectory()."templates/parts/", "missing-overlay", [
            'title' => i('User Information', 'allocate'),
            'info_text' => i('We changed our user profiles and need some additional information from you. We tread this informations confidential.', 'allocate'),
            'fields' => $fields
        ]);
    }

}