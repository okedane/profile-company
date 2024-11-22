<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Portofolio;
use App\Models\Service;
use App\Models\Team;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        $about = About::first();
        $service = Service::all();
        $team = Team::all();
        $categories = Category::all();
        $portfolioItems = Portofolio::all();
        return view('frontend.home', compact('about', 'service', 'team', 'categories', 'portfolioItems'));
    }

    public function about()
    {
        $about = About::first();
        return view('frontend.about', compact('about'));
    }

    public function service(string $id): View
{
    try {
        $service = Service::findOrFail($id);
        return view('frontend.service', compact('service'));
    } catch (ModelNotFoundException $e) {
        return redirect()->route('home')->with('error', 'Service not found');
    }
}
}
