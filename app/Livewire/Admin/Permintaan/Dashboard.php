<?php

namespace App\Livewire\Admin\Permintaan;

use App\Models\permintaan;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;
    public $id_permintaan;
    public $search, $pages;
    public $previousCount;

    protected $listeners = ["deleteAction" => "delete"];

    public function mount()
    {
        $this->pages = 25;
        $this->previousCount = permintaan::count();
    }

    public function removed($id)
    {
        $this->id_permintaan = $id;
        $this->dispatchBrowserEvent('deleteConfrimed');
    }

    public function delete()
    {
        $data = permintaan::find($this->id_permintaan);
        if ($data) {
            $data->delete();
            $this->dispatchBrowserEvent('success', 'Data has been deleted!');
        } else {
            $this->dispatchBrowserEvent('error', 'Sorry, there is a problem with the database!');
        }
    }

    public function render()
    {
        $query = permintaan::where('status', '!=', 'SELESAI');

        if ($this->search) {
            $query = $query->where(function($q) {
                $q->where('uuid', 'like', '%' . $this->search . '%')
                  ->orWhere('pengguna', 'like', '%' . $this->search . '%');
            });
        }

        $data = $query->orderByRaw("FIELD(status, 'BARU', 'DIKONFIRMASI', 'DALAM PERJALANAN'), created_at DESC")
            ->paginate($this->pages);

        // Cek apakah ada permintaan baru
        $newRequests = permintaan::where('status', 'BARU')->count();
        if ($newRequests > 0) {
            $this->dispatch('newData');
        }

        return view('livewire.admin.permintaan.dashboard', ['data' => $data]);
    }
}