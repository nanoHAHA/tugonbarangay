<?php

namespace App\Livewire;

use App\Models\Incident;
use Livewire\Component;

class TrackIncident extends Component
{
    public $tracking_code = '';
    public $incident = null;

    protected $rules = [
        'tracking_code' => 'required|string',
    ];

    public function searchIncident()
    {
        $this->validate();

        $this->incident = Incident::where('tracking_code', trim($this->tracking_code))->first();

        if (!$this->incident) {
            session()->flash('error', 'Walang nakitang insidente sa tracking code na ito. Pakisuri at subukang muli.');
        }
    }

    public function render()
    {
        return view('livewire.track-incident')->layout('layouts.app');
    }
}