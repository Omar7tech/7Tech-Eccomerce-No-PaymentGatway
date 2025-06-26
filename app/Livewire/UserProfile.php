<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserProfile extends Component
{
    public $name;
    public $email;
    public $phone;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;
    public $showPasswordModal = false;
    public $isUpdatingProfile = false;
    public $isUpdatingPassword = false;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
    }

    public function updateProfile()
    {
        $this->isUpdatingProfile = true;

        try {
            $user = Auth::user();

            $validated = $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'phone' => ['nullable', 'string', 'max:20'],
            ]);

            $user->update($validated);

            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Profile updated successfully!'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Failed to update profile. Please try again.'
            ]);
        } finally {
            $this->isUpdatingProfile = false;
        }
    }

    public function updatePassword()
    {
        $this->isUpdatingPassword = true;

        try {
            $validated = $this->validate([
                'current_password' => ['required', 'current_password'],
                'new_password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            Auth::user()->update([
                'password' => Hash::make($validated['new_password'])
            ]);

            $this->reset(['current_password', 'new_password', 'new_password_confirmation', 'showPasswordModal']);

            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Password updated successfully!'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Failed to update password. Please try again.'
            ]);
        } finally {
            $this->isUpdatingPassword = false;
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
