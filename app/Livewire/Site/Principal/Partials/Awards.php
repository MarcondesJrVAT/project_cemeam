<?php

namespace App\Livewire\Site\Principal\Partials;

use Livewire\Component;

class Awards extends Component
{
    public function render()
    {
        return view('livewire.site.principal.partials.awards')
            ->layout('layouts.site');
    }
}
