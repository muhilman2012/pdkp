<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class usersAdmin extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function create()
    {
        $divisis = divisi::all(); // Mengambil semua data divisi dari tabel

        return view('admin.users.create', compact('divisis'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'nip'           => 'nullable',
            'phone'         => 'required',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email'         => 'required|min:8|email|max:255',
            'unit_kerja'    => 'required',
        ], [
            'name.required'       => 'Please input field Name!',
            'phone.required'      => 'Please input field Phone!',
            'foto.image'          => 'File is not foto',
            'foto.mimes'          => 'File must be foto',
            'foto.max'            => 'File foto oversized',
            'email.required'      => 'Masukan alamat Email!',
            'email.min'           => 'Oops sepertinya bukan email!',
            'email.email'         => 'Alamat email anda salah!',
            'email.max'           => 'Oops email melampaui batas!',
            'unit_kerja'          => 'Please input field Unit Kerja',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // foto 
            $resorce = $request->foto;
            $extension = $resorce->getClientOriginalExtension();
            $requestName = $request->input('name'); // Mengambil nama dari request
            $cleanedName = str_replace(' ', '', $requestName); // Menghapus spasi dari nama
            $NewNameImage = "IMG-" . $cleanedName;
            $namasamplefoto = $NewNameImage . "." . $extension;
        
            $data = new User();
            $data->name = $request->name;
            $data->nip = $request->nip;
            $data->phone = $request->phone;
            $data->email = $request->email;
            $data->unit_kerja = $request->unit_kerja;
        
            // Membuat password otomatis dengan format SWP-name tanpa spasi
            $autoPassword = "SWP-" . $cleanedName;
            $data->password = bcrypt($autoPassword);
        
            $data->foto = $namasamplefoto;
            $resorce->move(public_path() . "/images/users/", $namasamplefoto);
        
            if ($data->save()) {
                return redirect()->route('admin.users')->with('success', 'Data Pengguna Berhasil disimpan dengan Password : ' . $autoPassword);
            } else {
                return redirect()->back()->with('error', 'Sorry, the database is busy. Please try again later.');
            }
        }              
    }

    public function show($id)
    {
         $data= User::find($id);
         return view('admin.users.detail', [
             'data' => $data
         ]);
    }

    public function edit($id)
    {
        $data = User::find($id);
        return view('admin.users.edit', [
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'        => 'required',
            'description'  => 'required',
            'content'      => 'required',
            // 'imagesMultiple.*'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [
            'title.required'        => 'Please input field title users',
            'description.required'  => 'Please input field description users',
            'content.required'      => 'Please input field content users',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // slug from title
            $slug = Str::slug($request->title);
            // schedule
            $schedule = $request->dates . ' ' . date('H:i:s', strtotime($request->times));
            if ($request->images) {
                $validImages = Validator::make($request->all(), [
                    'images'       => 'image|mimes:jpeg,png,jpg,gif,svg|max:4512',
                ], [
                    'images.image'          => 'File is not images',
                    'images.mimes'          => 'File must be images',
                    'images.max'            => 'File images oversized',
                ]);
                if ($validImages->fails()) {
                    return redirect()->back()->withErrors($validImages)->withInput();
                } else {
                    // images 
                    $resorce = $request->images;
                    $originNamaImages = $resorce->getClientOriginalName();
                    $NewNameImage = "IMG-" . substr(md5($originNamaImages . date("YmdHis")), 0, 14);
                    $namasamplefoto = $NewNameImage . "." . $resorce->getClientOriginalExtension();
                    // update with images
                    $data = User::find($id);
                    $data->title = $request->title;
                    $data->slug = $slug;
                    $data->description = $request->description;
                    $data->content = $request->content;
                    $data->images = $namasamplefoto;
                    $resorce->move(public_path() . "/images/users/", $namasamplefoto);
                    if ($data->save()) {
                        return redirect()->route('admin.users')->with('success', 'users data saved successfully');
                    } else {
                        return redirect()->back()->with('error', 'sorry database is busy try again letter');
                    }
                }
            } else {
                // update no images
                $data = User::find($id);
                $data->title = $request->title;
                $data->slug = $slug;
                $data->description = $request->description;
                $data->content = $request->content;
                if ($data->save()) {
                    return redirect()->route('admin.users')->with('success', 'users data saved successfully');
                } else {
                    return redirect()->back()->with('error', 'sorry database is busy try again letter');
                }
            }
        }
    }
}
