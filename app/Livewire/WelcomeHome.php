<?php

namespace App\Livewire;

use Livewire\Component;

class WelcomeHome extends Component
{
    public function render()
    {
        return view('livewire.welcome-home')->layout('layouts.app');
    }
}