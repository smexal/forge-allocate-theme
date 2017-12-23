<?php

namespace Forge\Themes\Allocate\Components;

use \Forge\Core\Classes\Media;
use \Forge\Core\Abstracts\Components;
use \Forge\Core\App\App;
use \Forge\Core\Components\ListingComponent;



class SponsorlistingComponent extends ListingComponent {
    protected $collection = 'forge-sponsors';
    protected $cssClasses = ['wrapper', 'reveal'];

    public function prefs() {
        return [
            'name' => i('Sponsor Listing', 'allocate'),
            'description' => i('Select and list sponsors.', 'allocate'),
            'id' => 'sponsor-listing',
            'image' => '',
            'level' => 'inner',
            'container' => false
        ];
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