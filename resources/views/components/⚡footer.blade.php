<?php

use Livewire\Component;

new class extends Component {
    public $siteSetting;
    public function mount($config = null)
    {
        $this->siteSetting = $config;
    }
}; ?>

<x-thema.ecoindustrial.footer :siteSetting="$siteSetting"/>
