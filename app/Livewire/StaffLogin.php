<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StaffLogin extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        $this->addError('email', 'Invalid credentials. Pakisuri ang iyong email at password.');
    }

    public function render()
    {
        return view('livewire.staff-login')->layout('layouts.app');
    }
}