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

    protected $listeners = ["deleteAction" => "delete"];

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
            $this->dispatchBrowserEvent('success', 'Data has been delete!');
        } else {
            $this->dispatchBrowserEvent('error', 'sorry something problem in database!');
        }
    }

    public function mount()
    {
        $this->pages = 25;
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

        return view('livewire.admin.permintaan.dashboard', ['data' => $data]);
    }
}