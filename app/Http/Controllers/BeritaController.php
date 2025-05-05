<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Support\Facades\Session;

class BeritaController extends Controller
{
   
    public function show($slug)
{
    $berita = Berita::where('slug', $slug)->firstOrFail();
    
    $sessionKey = 'viewed_article_'.$berita->id;
    if (!Session::has($sessionKey)) {
        $berita->incrementViewCount();
        Session::put($sessionKey, now()->addHours(24)->toDateTimeString());
    }
    
    $newest = Berita::orderBy('created_at', 'desc')->get()->take(4);
    
    return view('pages.berita.show', compact('berita', 'newest'));
}

public function kategori($slug)
{
    $kategori = KategoriBerita::where('slug', $slug)->first(); 

    return view('pages.berita.kategori', compact('kategori')); 
}

    public function index()
    {
        $beritas = Berita::accessibleByUser(auth()->user())->get();
        return view('pages.berita.index', compact('beritas'));
    }

    
}
