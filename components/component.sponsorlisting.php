<?php

namespace Forge\Themes\Allocate\Components;

use \Forge\Core\Classes\Media;
use \Forge\Core\Abstracts\Components;
use \Forge\Core\App\App;
use \Forge\Core\Components\ListingComponent;



class SponsorlistingComponent extends ListingComponent {
    protected $collection = 'forge-sponsors';
    protected $cssClasses = ['wrapper'];

    public function prefs() {
        $this->settings = array_merge([
            [
                'label' => i('Display type', 'forge-tournaments'),
                'hint' => i('Small or big display type', 'forge-tournaments'),
                'key' => 'display_type',
                'type' => 'select',
                'values' => [
                    'big' => i('Big Teaser Elements', 'forge-tournaments'),
                    'small' => i('Small Teasr Elements', 'forge-tournaments')
                ]
            ]
        ], $this->settings);
        return [
            'name' => i('Sponsor Listing', 'allocate'),
            'description' => i('Select and list sponsors.', 'allocate'),
            'id' => 'sponsor-listing',
            'image' => '',
            'level' => 'inner',
            'container' => false
        ];
    }

    public function beforeContent() {
        if($this->getField('display_type') == 'small') {
            $this->cssClasses[] = 'small';
        };
    }
    
    public function renderItem($item) {
        $image = $item->getMeta('image');
        $image = new Media($image);

        return App::instance()->render(App::instance()->getThemeDirectory()."templates/parts/", 'sponsor-listing-item', [
            'title' => $item->getMeta('title'),
            'description' => $item->getMeta('description'),
            'image' => [
                'src' => $image->url.$image->name,
                'alt' => $item->getMeta('title')
            ],
            'detail_url' => $item->url()
        ]);
    }
}
?>