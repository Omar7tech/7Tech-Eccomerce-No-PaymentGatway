<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Login')]
class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    protected function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    protected function messages()
    {
        return [
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is required.',
        ];
    }

    public function login()
    {
        $this->validate();

        $user = \App\Models\User::where('email', $this->email)->first();

        if ($user && $user->isBlocked()) {
            throw ValidationException::withMessages([
                'email' => 'Your account has been blocked. Please contact support.',
            ]);
        }

        if ($user && !$user->hasVerifiedEmail()) {
            Auth::login($user, $this->remember);
            session()->regenerate();
            return $this->redirect(route('verification.notice'), navigate: true);
        }

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        session()->regenerate();

        return $this->redirect(route('home'), navigate: true);
    }

    public function render()
    {

        return view('livewire.auth.login');
    }
}
