<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class aboutController extends Controller
{
    public function index() {
        $abouts = About::get();
        return view('backend.about.index' , compact('abouts'));
    }

    public function create() {
        return view('backend.about.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'deskripsi_singkat'               => 'required',
            'deskripsi_panjang'               => 'required',
            'image'                           => 'nullable|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->storeAs('public/uploads/abouts', $imageName);
        }


        About::create([
            'deskripsi_singkat' => $request->input('deskripsi_singkat'),
            'deskripsi_panjang' => $request->input('deskripsi_panjang'),
            'image' => $imageName ?? null,
        ]);


        return redirect()->route('abouts.index')->with(['success' => 'Data Berhasil Disimpan !']);
    }

    public function edit($id)
    {
        $abouts = About::findOrFail($id);
        return view('backend.about.edit', compact('abouts'));
    }


    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'deskripsi_singkat'               => 'required',
            'deskripsi_panjang'               => 'required',
            'image'                           => 'nullable|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $abouts = About::findOrFail($id);

        $imageName = $abouts->image;


        if ($request->hasFile('image')) {

            if ($imageName && Storage::exists('public/uploads/abouts/' . $imageName)) {
                Storage::delete('public/uploads/abouts/' . $imageName);
            }

            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->storeAs('public/uploads/abouts', $imageName);
        }

        $abouts->update([
            'deskripsi_singkat' => $request->input('deskripsi_singkat'),
            'deskripsi_panjang' => $request->input('deskripsi_panjang'),
            'image' => $imageName ?? $abouts->image,
        ]);


        return redirect()->route('abouts.index')->with('success', 'Data Berhasil Diupdate!');
    }

    public function destroy($id)
    {
        $abouts = About::findOrFail($id);

        if ($abouts->image && Storage::exists('public/uploads/abouts/' . $abouts->image)) {
            Storage::delete('public/uploads/abouts/' . $abouts->image);
        }

        $abouts->delete();

        return redirect()->route('abouts.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
