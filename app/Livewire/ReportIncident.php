<?php

namespace App\Livewire;

use App\Models\Incident;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ReportIncident extends Component
{
    use WithFileUploads;

    public $title = '';
    public $category = 'Public Safety';
    public $otherCategory = '';
    public $location = '';
    public $latitude = '';
    public $longitude = '';
    public $description = '';
    public $evidence;
    public $terms = false;
    public $submittedCode = '';

    public function submitReport()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'otherCategory' => 'required_if:category,Other|nullable|string|max:100',
            'location' => 'required|string|max:255',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'description' => 'required|string',
            'evidence' => 'nullable|image|max:5120', 
            'terms' => 'accepted',
        ], [
            'otherCategory.required_if' => 'Mangyaring tukuyin ang partikular na kategorya ng insidente.',
            'terms.accepted' => 'Kailangan mong sumang-ayon sa Data Privacy Consent bago magsumite.',
        ]);

        
        $finalCategory = $this->category === 'Other' ? trim($this->otherCategory) : $this->category;

        
        $evidencePath = null;
        if ($this->evidence) {
            $evidencePath = $this->evidence->store('evidences', 'public');
        }

        
        $trackingCode = 'TB-' . strtoupper(Str::random(6));

        Incident::create([
            'tracking_code' => $trackingCode,
            'title' => $this->title,
            'category' => $finalCategory,
            'location' => $this->location,
            'latitude' => $this->latitude ?: null,
            'longitude' => $this->longitude ?: null,
            'description' => $this->description,
            'evidence_path' => $evidencePath,
            'status' => 'Pending',
        ]);

        $this->submittedCode = $trackingCode;

        
        $this->reset([
            'title',
            'otherCategory',
            'location',
            'latitude',
            'longitude',
            'description',
            'evidence',
            'terms',
        ]);
        $this->category = 'Public Safety';
    }

    public function render()
    {
        return view('livewire.report-incident')->layout('layouts.app');
    }
}