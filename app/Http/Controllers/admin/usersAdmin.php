<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required',
            'description'  => 'required',
            'content'      => 'required',
            'images'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'imagesMultiple.*'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [
            'name.required'        => 'Please input field name users',
            'description.required'  => 'Please input field description users',
            'content.required'      => 'Please input field content users',
            'images.required'       => 'Please upload images',
            'images.image'          => 'File is not images',
            'images.mimes'          => 'File must be images',
            'images.max'            => 'File images oversized',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // images 
            $resorce = $request->images;
            $originNamaImages = $resorce->getClientOriginalName();
            $NewNameImage = "IMG-" . substr(md5($originNamaImages . date("YmdHis")), 0, 14);
            $namasamplefoto = $NewNameImage . "." . $resorce->getClientOriginalExtension();
            // schedule
            $schedule = $request->dates . ' ' . date('H:i:s', strtotime($request->times));

            $data = new User();
            $data->name = $request->title;
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