<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\pengemudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class pengemudiAdmin extends Controller
{
    public function index()
    {
        return view('admin.pengemudi.index');
    }

    public function create()
    {
        return view('admin.pengemudi.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'nip'          => 'nullable',
            'jabatan'      => 'nullable',
            'phone'        => 'required',
            'email'        => 'required|min:8|email|max:255',
            'foto'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required'       => 'Harap isi Nama Pengemudi',
            'phone.required'      => 'Harap isi Nomor Pengemudi',
            'email.required'      => 'Harap isi Email Pengemudi',
            'email.min'           => 'Oops sepertinya bukan email!',
            'email.email'         => 'Alamat email anda salah!',
            'email.max'           => 'Oops email melampaui batas!',
            'foto.required'       => 'Please upload images',
            'foto.image'          => 'File is not images',
            'foto.mimes'          => 'File must be images',
            'foto.max'            => 'File images oversized',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // Handle image upload
            $resorce = $request->foto;
            $pengemudiName = $request->input('name');
            $originNamaImages = $resorce->getClientOriginalName();
            $NewNameImage = "IMG-" . $pengemudiName;
            $namasamplefoto = $NewNameImage . "." . $resorce->getClientOriginalExtension();
        
            // Generate password
            $cleanedName = str_replace(' ', '', $pengemudiName); // Remove spaces from name
            $generatedPassword = 'SWP-' . $cleanedName;
        
            // Save data to database
            $data = new pengemudi();
            $data->name     = $request->name;
            $data->nip      = $request->nip;
            $data->jabatan  = $request->jabatan;
            $data->phone    = $request->phone;
            $data->email    = $request->email;
            $data->foto     = $namasamplefoto;
            $data->password = bcrypt($generatedPassword); // Encrypt the password
            $resorce->move(public_path() . "/images/pengemudi/", $namasamplefoto);
        
            if ($data->save()) {
                return redirect()->route('admin.pengemudi')->with('success', 'Data Pengemudi Berhasil Ditambah dengan password : ' . $generatedPassword);
            } else {
                return redirect()->back()->with('error', 'Maaf, database sedang sibuk. Coba lagi nanti.');
            }
        }        
    }

    public function show($id)
    {
         $data= pengemudi::find($id);
         return view('admin.pengemudi.detail', [
             'data' => $data
         ]);
    }

    public function edit($id)
    {
        $data = pengemudi::find($id);
        return view('admin.pengemudi.edit', [
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
            'title.required'        => 'Please input field title pengemudi',
            'description.required'  => 'Please input field description pengemudi',
            'content.required'      => 'Please input field content pengemudi',
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
                    $data = pengemudi::find($id);
                    $data->title = $request->title;
                    $data->slug = $slug;
                    $data->description = $request->description;
                    $data->content = $request->content;
                    $data->images = $namasamplefoto;
                    $resorce->move(public_path() . "/images/pengemudi/", $namasamplefoto);
                    if ($data->save()) {
                        return redirect()->route('admin.pengemudi')->with('success', 'pengemudi data saved successfully');
                    } else {
                        return redirect()->back()->with('error', 'sorry database is busy try again letter');
                    }
                }
            } else {
                // update no images
                $data = pengemudi::find($id);
                $data->title = $request->title;
                $data->slug = $slug;
                $data->description = $request->description;
                $data->content = $request->content;
                if ($data->save()) {
                    return redirect()->route('admin.pengemudi')->with('success', 'pengemudi data saved successfully');
                } else {
                    return redirect()->back()->with('error', 'sorry database is busy try again letter');
                }
            }
        }
    }
}
