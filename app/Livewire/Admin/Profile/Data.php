<?php

namespace App\Livewire\Admin\Profile;

use App\Models\admins;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Data extends Component
{
    use WithFileUploads;
    public $id_admins, $username, $email, $phone, $born, $address, $avatar;
    public $images;
    public $edit = false;

    protected $listeners = ['images' => 'upload'];

    protected $rules = [
        'username'     => 'required',
    ];

    protected $messages = [
        'username.required' => 'Oops, username kamu tidak boleh kosong!',
    ];

    public function mount()
    {
        $user = Auth::guard('admin')->user();
        $this->username = $user->username;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->born = $user->born;
        $this->address = $user->address;
        $this->avatar = $user->avatar;
    }

    public function edit()
    {
        $this->edit = true;
    }

    public function cancel()
    {
        $this->edit = false;
        $this->mount();
    }

    public function save()
    {
        $this->validate();

        $user = Auth::guard('admin')->user();
        $user->username = $this->username;
        $user->phone = $this->phone;
        $user->born = $this->born;
        $user->address = $this->address;

        if ($this->images) {
            $imageName = 'avatar_' . $user->id . '.' . $this->images->extension();
            $this->images->storeAs('avatars', $imageName);
            $user->avatar = $imageName;
        }

        $user->save();

        $this->edit = false;

        $this->dispatchBrowserEvent('success', 'Data berhasil disimpan.');
    }

    public function upload()
    {
        $this->validate([
            'images'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096'
        ]);
        
        $id = auth('admin')->user()->id_admins;
        $resorces = $this->images;
        $extension = $resorces->getClientOriginalExtension();
        $FileName = "AVT-" . $id . date("YmdHis") . '.' . $extension;

        $data = admins::find($id);
        $data->avatar = $FileName;
        if ($data->save()) {
            $resorces->storeAs('/images/avatar/admin/',  $FileName, 'myLocal');
            $this->dispatch('success', 'Foto profile berhasil diperbaharui!');
        } else {
            $this->dispatch('errors', 'Database Error, data Gagal terupdate!!!');
        }
    }

    public function render()
    {
        return view('livewire.admin.profile.data');
    }
}