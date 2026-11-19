<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SystemEvaluation extends Component
{
    public $evaluator_name = '';
    public $evaluator_role = 'Community Resident';
    public $functional_suitability = 5;
    public $performance_efficiency = 5;
    public $usability = 5;
    public $reliability = 5;
    public $security = 5;
    public $portability = 5;
    public $comments = '';
    public $successMessage = false;

    protected $rules = [
        'evaluator_name' => 'required|string|max:100',
        'evaluator_role' => 'required|string',
        'functional_suitability' => 'required|integer|min:1|max:5',
        'performance_efficiency' => 'required|integer|min:1|max:5',
        'usability' => 'required|integer|min:1|max:5',
        'reliability' => 'required|integer|min:1|max:5',
        'security' => 'required|integer|min:1|max:5',
        'portability' => 'required|integer|min:1|max:5',
        'comments' => 'nullable|string|max:1000',
    ];

    public function submitEvaluation()
    {
        $this->validate();

        DB::table('system_evaluations')->insert([
            'evaluator_name' => $this->evaluator_name,
            'evaluator_role' => $this->evaluator_role,
            'functional_suitability' => $this->functional_suitability,
            'performance_efficiency' => $this->performance_efficiency,
            'usability' => $this->usability,
            'reliability' => $this->reliability,
            'security' => $this->security,
            'portability' => $this->portability,
            'comments' => $this->comments,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->successMessage = true;
        $this->reset(['evaluator_name', 'comments']);
    }

    public function render()
    {
        
        $stats = DB::table('system_evaluations')->selectRaw('
            count(*) as total,
            avg(functional_suitability) as avg_func,
            avg(performance_efficiency) as avg_perf,
            avg(usability) as avg_usable,
            avg(reliability) as avg_rel,
            avg(security) as avg_sec,
            avg(portability) as avg_port
        ')->first();

        return view('livewire.system-evaluation', [
            'stats' => $stats,
        ])->layout('layouts.app');
    }
}