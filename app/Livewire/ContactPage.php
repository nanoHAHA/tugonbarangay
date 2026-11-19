<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContactMessage;

class Contactpage extends Component
{
    public $full_name = '';
    public $contact_info = '';
    public $message = '';

    protected $rules = [
        'full_name' => 'required|min:3',
        'contact_info' => 'required',
        'message' => 'required|min:5',
    ];

    public function sendMessage()
    {
        $this->validate();

        ContactMessage::create([
            'full_name' => $this->full_name,
            'contact_info' => $this->contact_info,
            'message' => $this->message,
        ]);

        // I-reset ang form at magpakita ng success state
        $this->reset(['full_name', 'contact_info', 'message']);
        session()->flash('success', 'Naipadala na ang iyong mensahe sa Barangay Command Center!');
    }

    public function render()
    {
        return view('contact-page')
            ->layout('layouts.app');
    }
}