<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContactMessage;

class AdminMessages extends Component
{
    public function deleteMessage($id)
    {
        ContactMessage::find($id)?->delete();
        session()->flash('message', 'Tagumpay na na-delete ang mensahe.');
    }

    public function render()
    {
        return view('livewire.admin-messages', [
            'messages' => ContactMessage::latest()->get()
        ])->layout('layouts.app');
    }
}