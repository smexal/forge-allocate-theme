<?php

namespace Forge\Themes\Allocate\Components;

use Forge\Core\Abstracts\Component;
use Forge\Core\App\App;

class AboutComponent extends Component {
    public $settings = [];

    public function prefs() {
        $this->settings = [
            [
                'label' => i('Title', 'allocate'),
                'key' => 'title',
                'type' => 'text'
            ],
            [
                'label' => i('Description', 'allocate'),
                'key' => 'description',
                'type' => 'text'
            ],
            [
                'label' => i('Fact 1 - Title', 'allocate'),
                'key' => 'f1_title',
                'type' => 'text'
            ],
            [
                'label' => i('Fact 1 - Text', 'allocate'),
                'key' => 'f1_text',
                'type' => 'text'
            ],
            [
                'label' => i('Fact 2 - Title', 'allocate'),
                'key' => 'f2_title',
                'type' => 'text'
            ],
            [
                'label' => i('Fact 2 - Text', 'allocate'),
                'key' => 'f2_text',
                'type' => 'text'
            ],
            [
                'label' => i('CTA-Label', 'allocate'),
                'key' => 'cta_label',
                'type' => 'text'
            ],
            [
                'label' => i('CTA-Link', 'allocate'),
                'key' => 'cta_link',
                'type' => 'text'
            ],  

        ];
        return [
            'name' => i('About Block', 'allocate'),
            'description' => i('Tell people a bit about you.', 'allocate'),
            'id' => 'allocate_about_block',
            'image' => '',
            'level' => 'inner',
            'container' => false
        ];
    }

    public function content() {

        // Mailchimp Component
        $mcForm = '';
        if (App::instance()->mm->isActive('forge-mailchimp')) {
            $mcC = new \Forge\Modules\ForgeMailchimp\MailchimpComponent();
            $mcC->configureManual([
                'forge_mailchimp_input_label' => i('E-Mail Address', 'allocate'),
                'forge_mailchimp_button_text' => i('Subscribe', 'allocate'),
                'forge_mailchimp_lead_text' => i('Newsletter Subscription', 'allocate')
            ]);
            $mcForm = $mcC->content();
        }


        return App::instance()->render(App::instance()->getThemeDirectory()."templates/parts/", 'about', [
            'title' => $this->getField('title'),
            'description' => $this->getField('description'),
            'f1_title' => $this->getField('f1_title'),
            'f1_text' => $this->getField('f1_text'),
            'f2_title' => $this->getField('f2_title'),
            'f2_text' => $this->getField('f2_text'),
            'cta_label' => $this->getField('cta_label'),
            'cta_link' => $this->getField('cta_link'),
            'mc_form' => $mcForm
        ]);
    }

}