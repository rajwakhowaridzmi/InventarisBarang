<?php

namespace App\Livewire\Referensi;

use App\Models\User;
use Livewire\Component;

class DaftarUser extends Component
{
    public $user_id;

    public function render()
    {
        $users = User::get();

        return view('livewire.referensi.daftar-user', ['user' => $users]);
    }
}
