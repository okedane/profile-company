<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class teamController extends Controller
{
    public function index(){
        $teams = Team::get();
        return view('backend.team.index', compact('teams'));
    }

    public function create() {
        return view('backend.team.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'                            => 'required',
            'role'                            => 'required',
            'info'                            => 'required|max:255|string',
            'image'                           => 'nullable|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->storeAs('public/uploads/teams', $imageName);
        }


        Team::create([
            'name' => $request->input('name'),
            'role' => $request->input('role'),
            'info' => $request->input('info'),
            'ig' => $request->input('ig'),
            'fb' => $request->input('fb'),
            'tt' => $request->input('tt'),
            'image' => $imageName ?? null,
        ]);


        return redirect()->route('team.index')->with(['success' => 'Data Berhasil Disimpan !']);
    }

    public function edit($id)
    {
        $teams = Team::findOrFail($id);
        return view('backend.team.edit', compact('teams'));
    }


    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name'                            => 'required',
            'role'                            => 'required',
            'info'                            => 'required|max:255|string',
            'image'                           => 'nullable|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $teams = Team::findOrFail($id);

        $imageName = $teams->image;


        if ($request->hasFile('image')) {

            if ($imageName && Storage::exists('public/uploads/teams/' . $imageName)) {
                Storage::delete('public/uploads/teams/' . $imageName);
            }

            $image      = $request->file('image');
            $imageName  = $image->hashName();
            $image->storeAs('public/uploads/teams', $imageName);
        }

        $teams->update([
            'name'   => $request->input('name'),
            'role'   => $request->input('role'),
            'info'   => $request->input('info'),
            'ig'     => $request->input('ig'),
            'fb'     => $request->input('fb'),
            'tt'     => $request->input('tt'),
            'image'  => $imageName ?? $teams->image,
        ]);


        return redirect()->route('team.index')->with('success', 'Data Berhasil Diupdate!');
    }

    public function destroy($id)
    {
        $teams = Team::findOrFail($id);

        if ($teams->image && Storage::exists('public/uploads/teams/' . $teams->image)) {
            Storage::delete('public/uploads/teams/' . $teams->image);
        }

        $teams->delete();

        return redirect()->route('team.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
