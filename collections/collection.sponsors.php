<?php
namespace Forge\Themes\Allocate\Collections;

use Forge\Core\App\App;
use Forge\Core\Classes\Media;
use \Forge\Core\Abstracts\DataCollection;

class SponsorsCollection extends DataCollection {
    public $permission = "manage";

    protected function setup() {
        $this->preferences['name'] = 'forge-sponsors';
        $this->preferences['title'] = i('Sponsors', 'allocate');
        $this->preferences['all-title'] = i('Manage Sponsors', 'allocate');
        $this->preferences['add-label'] = i('Add sponsors', 'allocate');
        $this->preferences['single-item'] = i('Sponsors', 'allocate');
        $this->custom_fields();
    }
    private function custom_fields() {
        $this->addFields([
            [
                'key' => 'image',
                'label' => i('Image of that sponsor', 'allocate'),
                'multilang' => true,
                'type' => 'image',
                'order' => 30,
                'position' => 'left',
                'hint' => ''
            ],
            [
                'key' => 'text',
                'label' => i('Text', 'allocate'),
                'multilang' => true,
                'type' => 'wysiwyg',
                'order' => 20
            ],
            [
                'key' => 'website',
                'label' => i('Website', 'allocate'),
                'multilang' => true,
                'type' => 'url'
            ]
        ]);
    }

    public function render($item) {
        $dir = App::instance()->getThemeDirectory()."templates/collections/";
        $image = new Media($item->getMeta('image'));
        return App::instance()->render($dir, 'sponsor', [
            'title' => $item->getMeta('title'),
            'lead' => $item->getMeta('description'),
            'text' => $item->getMeta('text'),
            'website' => $item->getMeta('website'),
            'visit_website' => i('Visit sponsor website', 'allocate'),
            'image' => $image->getUrl()
        ]);
    }
}
?>