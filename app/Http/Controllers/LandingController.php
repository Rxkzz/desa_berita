<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Berita;

class LandingController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        $featureds = Berita::where('is_featured', true)->get();
        $beritas = Berita::orderBy('created_at', 'desc')->get()->take(4);
        // dd($banners);
        return view('pages.landing', compact('banners', 'featureds', 'beritas'));
    }
}
