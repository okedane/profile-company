<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('backend.category.index', compact('categories'));
    }

    public function create() {
        return view('backend.category.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name'      => 'required'
        ]);

        Category::create(
            [
                'name'      => $request->name,
            ]
         );
         return redirect()->route('category.index')->with(['success' => 'Data Berhasil Disimpan !']);
    }

    public function edit($id)
    {
        $categories= Category::findOrFail($id);
        return view('backend.category.edit', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'         => 'required',

        ]);

        $categories = Category::findOrFail($id);

        $categories->update([
            'name'         => $request->name,

        ]);

        return redirect()->route('category.index')->with('success', 'Data Berhasil Diupdate!');
    }

    public function destroy($id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();

        return redirect()->route('category.index')->with('success', 'Data Berhasil Dihapus!');
    }

}
