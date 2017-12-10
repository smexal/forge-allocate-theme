<?php

namespace Forge\Themes\Allocate;

use \Forge\Core\App\App;
use \Forge\Core\App\Auth;
use \Forge\Core\Classes\ContentNavigation;
use \Forge\Core\Classes\Fields;
use \Forge\Core\Classes\Utils;



class UserArea {
    private $error = false;
    private $permissions = array(
        0 => "user.menu"
    );

    public function __construct() {
        Auth::registerPermissions($this->permissions);
    }

    public function loginFailed() {
        $this->error = i('Username and/or Password wrong.', 'allocate');
    }

    public function output() {
        if(Auth::allowed($this->permissions[0], 'stay')) {
            return $this->userArea();
        } else {
            return $this->loginArea();
        }
    }

    private function userArea() {
        $app = App::instance();
        return $app->render($app->getThemeDirectory()."templates/parts/", "user-area", [
            'warning' => $this->hasWarning(),
            'logged_in_as' => i('Logged in as', 'allocate'),
            'username' => App::instance()->user->get('username'),
            'user_navigation' => $this->getUserNavigation(),
            'profile_image' => App::instance()->user->getAvatar()
        ]);
    }

    private function hasWarning() {
        if(App::instance()->user->get('active') == 0) {
            return true;
        }
        return false;
    }

    private function getUserNavigation() {
        $navigation = $this->getWarnings();
        $navigation.= ContentNavigation::getNavigationList('user-nav');
        return $navigation;
    }

    private function getWarnings() {
        $return = '';
        if(App::instance()->user->get('active') == 0) {
            $return.= '<div class="alert alert-warning">';
            $return.= i('Your account has not been verified. Unverified accounts may get deleted after a while.').'<br />';
            $return.= '<a href="'.Utils::getUrl(array('registration', 'resend-verification')).'">'.i('Resend verification link', 'allocate').'</a>';
            $return.= '</div>';
        }
        return $return;
    }

    private function loginArea() {
        $app = App::instance();

        return $app->render($app->getThemeDirectory()."templates/parts/", "login-area", array(
            "login_label" => i('Login', 'allocate'),
            "error" => $this->error,
            "form" => $this->loginForm(),
            "reset" => array(
                'link' => Utils::getUrl(['recover']),
                'label' => i('Forgot login?', 'allocate')
            ),
            "register" => array(
                'link' => Utils::getUrl(['registration']),
                'label' => i('Register', 'allocate')
            )
        ));
    }

    private function loginForm() {
        $return = '';
        $return.= Fields::hidden(array(
            "name" => "event",
            "value" => "onLoginSubmit"
        ));
        $return.= Fields::hidden(array(
            "name" => "redirect",
            "value" => Utils::getCurrentUrl()
        ));
        $return.= Fields::text(array(
            'key' => 'name',
            'label' => i('Username or E-Mail', 'allocate'),
            'autocomplete' => false
        ));
        $return.= Fields::text(array(
            'key' => 'password',
            'label' => i('Password', 'allocate'),
            'type' => 'password',
            'autocomplete' => false
        ));
        $return.= Fields::button(i('Login', 'allocate'));
        return $return;
    }

}

?>
