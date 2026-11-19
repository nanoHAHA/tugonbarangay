<?php

namespace App\Livewire;

use App\Models\ActivityLog;
use App\Models\Incident;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class BlotterArchive extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    
    public function deleteIncident($id)
    {
        $incident = Incident::findOrFail($id);
        
        
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => "Binuwag/Binura ang blotter archive record",
            'incident_code' => $incident->tracking_code,
        ]);

        $incident->delete();

        session()->flash('message', 'Matagumpay na na-delete ang blotter record.');
    }

    public function render()
    {
        $query = Incident::query();

        if ($this->search) {
            $query->where(function($q) {
                $q->where('tracking_code', 'like', '%' . $this->search . '%')
                  ->orWhere('title', 'like', '%' . $this->search . '%')
                  ->orWhere('location', 'like', '%' . $this->search . '%');
            });
        }

        $archives = $query->latest()->paginate(10);

        return view('livewire.blotter-archive', [
            'archives' => $archives,
        ])->layout('layouts.app');
    }
}