<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
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
        $this->dispatch('deleteConfrimed');
    }

    public function delete()
    {
        $data = User::find($this->id);
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
            $data = User::where('title', 'like', '%' . $this->search . '%')->orderBy('created_at', 'desc')->paginate($this->pages);
        } else {
            $data = User::orderBy('created_at', 'desc')->paginate($this->pages);
        }
        return view('livewire.admin.users.data', ['data' => $data]);
    }
}
