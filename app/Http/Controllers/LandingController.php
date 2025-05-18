<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Berita;
use App\Models\Author;

class LandingController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        $featureds = Berita::where('is_featured', true)->get();
        $beritas = Berita::orderBy('created_at', 'desc')->get()->take(4);
        $authors = Author::take(5)->get();
        $mostViewed = Berita::orderBy('view_count', 'desc')->take(4)->get();
        
        return view('pages.landing', compact('banners', 'featureds', 'beritas', 'authors', 'mostViewed'));
    }
}
