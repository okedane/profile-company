<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    public function index(Request $request, $id)
    {
        $categories = Category::findOrFail($id);
        $portfolios = Portofolio::where('category_id', $id)->get();
        return view('backend.portfolio.index', compact('categories', 'portfolios'));
    }

    public function create($id)
    {
        $portfolios = Portofolio::all();
        $categories= Category::findOrFail($id);
        return view('backend.portfolio.create', compact('categories', 'portfolios'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'                           => 'required',
            'description'                       => 'required',
            'image'                           => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
            'category_id'                     =>'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->storeAs('public/uploads/portfolios', $imageName);
        }


        Portofolio::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $imageName ?? null,
            'category_id'   => $request->category_id,
        ]);

        return redirect()->route('port.index', $request->category_id)->with(['success' => 'Data Berhasil Disimpan !']);

    }
    public function edit($id)
    {
        $portfolios= Portofolio::findOrFail($id);
        return view('backend.portfolio.edit', compact('portfolios'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title'               => 'required',
            'description'            => 'required',
            'image'               => 'nullable|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $portfolios = Portofolio::findOrFail($id);

        $imageName = $portfolios->image;


        if ($request->hasFile('image')) {

            if ($imageName && Storage::exists('public/uploads/portfolios/' . $imageName)) {
                Storage::delete('public/uploads/portfolios/' . $imageName);
            }

            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->storeAs('public/uploads/portfolios', $imageName);
        }

        $portfolios->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $imageName ?? $portfolios->image,
        ]);


        return redirect()->route('port.index', $portfolios->category_id)->with(['success' => 'Data Berhasil DiUbah !']);
    }

    public function destroy($id)
    {
        $portfolios = Portofolio::findOrFail($id);
        $category_id = $portfolios->category_id;
        $portfolios->delete();

        return redirect()->route('port.index', ['id' => $category_id])->with('success', 'Data Berhail Dihapus!');
    }
}
