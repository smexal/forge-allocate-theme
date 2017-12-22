<?php
namespace Forge\Themes\Allocate\Collections;

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
            ]
        ]);
    }
}
?>