<?php

namespace App\Livewire;

use App\Models\ActivityLog; 
use App\Models\Incident;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AdminDashboard extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $categoryFilter = '';
    
    public $selectedIncidentId = null;
    public $newStatus = 'Pending';
    public $adminRemarks = '';
    public $isModalOpen = false;

    protected $updatesQueryString = ['search', 'statusFilter', 'categoryFilter'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openUpdateModal($id)
    {
        $incident = Incident::findOrFail($id);
        $this->selectedIncidentId = $incident->id;
        $this->newStatus = $incident->status;
        $this->adminRemarks = $incident->admin_remarks;
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->selectedIncidentId = null;
    }

    public function updateIncidentStatus()
    {
        $this->validate([
            'newStatus' => 'required|in:Pending,In Progress,Resolved,Archived',
            'adminRemarks' => 'nullable|string|max:500',
        ]);

        $incident = Incident::findOrFail($this->selectedIncidentId);
        
        $incident->update([
            'status' => $this->newStatus,
            'admin_remarks' => $this->adminRemarks,
            'verified_by' => Auth::id(),
        ]);

        
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => "Binago ang status sa '{$this->newStatus}' para sa insidente",
            'incident_code' => $incident->tracking_code,
        ]);

        $this->closeModal();
        session()->flash('message', 'Matagumpay na na-update ang status ng insidente at naitala sa log!');
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

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->categoryFilter) {
            $query->where('category', $this->categoryFilter);
        }

        $totalIncidents = Incident::count();
        $pendingCount = Incident::where('status', 'Pending')->count();
        $inProgressCount = Incident::where('status', 'In Progress')->count();
        $resolvedCount = Incident::where('status', 'Resolved')->count();

        $categoryData = Incident::selectRaw('category, count(*) as count')
            ->groupBy('category')
            ->pluck('count', 'category');

        $incidents = $query->latest()->paginate(10);

        
        $activityLogs = ActivityLog::with('user')->latest()->take(10)->get();

        return view('livewire.admin-dashboard', [
            'incidents' => $incidents,
            'totalIncidents' => $totalIncidents,
            'pendingCount' => $pendingCount,
            'inProgressCount' => $inProgressCount,
            'resolvedCount' => $resolvedCount,
            'categoryLabels' => $categoryData->keys(),
            'categoryCounts' => $categoryData->values(),
            'activityLogs' => $activityLogs, 
        ])->layout('layouts.app');
    }
}