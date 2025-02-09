<?php

namespace App\Livewire;

use GuzzleHttp\Psr7\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    #[Layout('components.layouts.login')]

    public $user_nama;
    public $user_pass;
    public function render()
    {
        return view('livewire.login');
    }
    public function login()
    {
        $this->validate([
            'user_nama' => 'required|string|max:50',
            'user_pass' => 'required|string|max:32',
        ]);

        $user = User::where('user_nama', $this->user_nama)->first();
        if ($user && md5($this->user_pass) === $user->user_pass) {
            Auth::login($user);

            // $token = $user->createToken('token')->plainTextToken;
            return redirect()->route('dashboard');
        }
        session()->flash('error', 'Nama pengguna atau Password salah.');
        return;
    }
    public function logout()
    {
        Auth::logout();
        session()->invalidate(); 
        session()->regenerateToken();
        return redirect()->route('login');
    }
}
