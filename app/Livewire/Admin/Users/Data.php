<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;

    public $selectedUserId;  // Ganti nama variabel
    public $search, $pages;

    protected $listeners = ["deleteAction" => "delete"];

    public function removed($id){
        $this->selectedUserId = $id;  // Gunakan variabel yang baru
        $this->dispatch('deleteConfirmed');
    }

    public function delete()
    {
        $data = User::find($this->selectedUserId);
        if ($data) {
            $data->delete();
            $this->dispatch('success', ['message' => 'Data has been deleted!']);
        } else {
            $this->dispatch('error', ['message' => 'Sorry, something went wrong with the database!']);
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
