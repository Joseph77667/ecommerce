<?php

namespace App\Livewire\Auth;

use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('E-Commerce-> Login')]
class Login extends Component
{
    public $email;
    public $password;

    public function save(){
        $this->validate([
            'email'=>['required','email', Rule::exists('users','email')],
            'password' => ['required','min:5']
        ]);
        if(!auth()->attempt(['email'=>$this->email, 'password'=>$this->password])){
            session()->flash('error','Invalid credentials');
            return;
        }

        return redirect()->intended();
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
