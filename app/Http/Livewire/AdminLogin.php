<?php

namespace App\Livewire;

use Livewire\Component;

class AdminLogin extends Component
{
    public $password;
    public $error = false;

    public function login()
    {
        
        if ($this->password === 'admin123') {
            session(['is_admin' => true]);
            return redirect()->to('/admin/dashboard');
        } else {
            $this->error = true;
        }
    }

    public function render()
    {
        return view('livewire.admin-login')->layout('layouts.app');
    }
}