<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function render()
    {
        $permintaan = permintaan::all();
        return view('livewire.pages.dashboard',[
            'permintaan'    => $permintaan,
        ]);
    }
}
