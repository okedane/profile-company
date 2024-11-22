<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class serviceController extends Controller
{
    public function index(){
        $services = Service::get();
        return view('backend.service.index', compact('services'));
    }

    public function create() {
        return view('backend.service.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'                           =>'required|max:55|string',
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
            $image->storeAs('public/uploads/services', $imageName);
        }


        Service::create([
            'title'             => $request->input('title'),
            'deskripsi_singkat' => $request->input('deskripsi_singkat'),
            'deskripsi_panjang' => $request->input('deskripsi_panjang'),
            'image' => $imageName ?? null,
        ]);


        return redirect()->route('services.index')->with(['success' => 'Data Berhasil Disimpan !']);
    }

    public function edit($id)
    {
        $services = Service::findOrFail($id);
        return view('backend.service.edit', compact('services'));
    }


    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title'                           =>'required|max:55|string',
            'deskripsi_singkat'               => 'required|max:255|string',
            'deskripsi_panjang'               => 'required',
            'image'                           => 'nullable|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $services = Service::findOrFail($id);

        $imageName = $services->image;


        if ($request->hasFile('image')) {

            if ($imageName && Storage::exists('public/uploads/services/' . $imageName)) {
                Storage::delete('public/uploads/services/' . $imageName);
            }

            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->storeAs('public/uploads/services', $imageName);
        }

        $services->update([
            'deskripsi_singkat' => $request->input('deskripsi_singkat'),
            'deskripsi_panjang' => $request->input('deskripsi_panjang'),
            'image' => $imageName ?? $services->image,
        ]);


        return redirect()->route('services.index')->with('success', 'Data Berhasil Diupdate!');
    }

    public function destroy($id)
    {
        $services = Service::findOrFail($id);

        if ($services->image && Storage::exists('public/uploads/services/' . $services->image)) {
            Storage::delete('public/uploads/services/' . $services->image);
        }

        $services->delete();

        return redirect()->route('services.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
