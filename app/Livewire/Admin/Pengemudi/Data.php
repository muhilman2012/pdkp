<?php

namespace App\Livewire\Admin\Pengemudi;

use App\Models\pengemudi;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $id_pengemudi;
    public $search, $pages;

    protected $listeners = ["deleteAction" => "delete"];

    public function removed($id){
        $this->id_pengemudi = $id;
        $this->dispatchBrowserEvent('deleteConfrimed');
    }

    public function delete()
    {
        $data = pengemudi::find($this->id_pengemudi);
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
        if($this->search){
            $data = pengemudi::where('title', 'like', '%' . $this->search . '%')->orderBy('created_at', 'desc')->paginate($this->pages);
        } else {
            $data = pengemudi::orderBy('created_at', 'desc')->paginate($this->pages);
        }
        return view('livewire.admin.pengemudi.data', ['data' => $data]);
    }
}
