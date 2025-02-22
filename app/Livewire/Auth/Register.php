<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('E-Commerce-> Register')]
class Register extends Component
{

    public $name;
    public $email;
    public $password;

    public function save(){
        $this->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255','email', Rule::unique('users','email')],
            'password' => ['required', 'min:5']
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'email_verified_at' => now()
        ]);

        auth()->login($user);
        return redirect()->intended();
    }
    public function render()
    {
        return view('livewire.auth.register');
    }
}
