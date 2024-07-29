<?php

namespace App\Livewire\Admin\Kendaraan;

use App\Models\kendaraan;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $id;
    public $search, $pages;

    protected $listeners = ["deleteAction" => "delete"];

    public function removed($id){
        $this->id = $id;
        $this->dispatch('deleteConfirmed');
    }

    public function delete()
    {
        $data = kendaraan::find($this->id);
        if ($data) {
            $data->delete();
            $this->dispatch('success', 'Data has been delete!');
        } else {
            $this->dispatch('error', 'sorry something problem in database!');
        }
    }

    public function mount()
    {
        $this->pages = 25;
    }

    public function render()
    {
        if($this->search){
            $data = kendaraan::where('title', 'like', '%' . $this->search . '%')->orderBy('created_at', 'desc')->paginate($this->pages);
        } else {
            $data = kendaraan::orderBy('created_at', 'desc')->paginate($this->pages);
        }
        return view('livewire.admin.kendaraan.data', ['data' => $data]);
    }
}
