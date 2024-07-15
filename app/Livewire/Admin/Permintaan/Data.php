<?php

namespace App\Livewire\Admin\Permintaan;

use App\Models\permintaan;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $id_permintaan;
    public $search, $pages;

    protected $listeners = ["deleteAction" => "delete"];

    public function removed($id){
        $this->id_permintaan = $id;
        $this->dispatch('deleteConfirmed');
    }

    public function delete()
    {
        $data = permintaan::find($this->id_permintaan);
        if ($data) {
            $data->delete();
            $this->dispatch('success', 'Data Berhasil Dihapus!');
        } else {
            $this->dispatch('error', 'Maaf ada Kesalahan Database!');
        }
    }

    public function mount()
    {
        $this->pages = 25;
    }

    public function render()
    {
        $query = permintaan::query();

        if ($this->search) {
            $query->where(function($q) {
                $q->where('uuid', 'like', '%' . $this->search . '%')
                ->orWhere('pengguna', 'like', '%' . $this->search . '%'); // Asumsikan 'pengguna' adalah nama kolom
            });
        }

        $data = $query->orderBy('created_at', 'desc')->paginate($this->pages);

        return view('livewire.admin.permintaan.data', ['data' => $data]);
    }

}
