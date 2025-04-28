<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\KategoriBerita;

class BeritaController extends Controller
{
    public function show($slug)
{
    $berita = Berita::where('slug', $slug)->first(); 
    $newest = Berita::orderBy('created_at', 'desc')->get()->take(4); 

    return view('pages.berita.show', compact('berita', 'newest')); 
}

public function kategori($slug)
{
    $kategori = KategoriBerita::where('slug', $slug)->first(); 

    return view('pages.berita.kategori', compact('kategori')); 
}

}
