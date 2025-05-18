@extends('layout.app')

@section('title', 'Moco | Seputar berita')

@section('content')
<div class="relative">
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      @foreach ($banners as $banner)
        <div class="swiper-slide">
          <a href="{{ route('berita.show', $banner->berita->slug) }}">
            <div
              class="relative h-72 sm:h-80 md:h-96 lg:h-[50vh] w-full bg-center bg-cover" 
              style="background-image: url('{{ asset('storage/' . $banner->berita->thumbnail) }}');">
              
              <!-- Overlay -->
              <div class="absolute inset-0 bg-black/50"></div>

              <!-- Teks di tengah -->
              <div class="absolute bottom-0 left-0 p-4 md:p-6 z-10 text-left"> <!-- Adjusted positioning and padding -->
                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-2">{{ $banner->berita->title }}</h1>
                <div class="flex items-center text-white text-sm">
                  <span class="mr-4"><i class="fas fa-calendar-alt"></i> {{ $banner->berita->created_at->format('d M Y') }}</span>
                </div>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>

    <!-- Navigasi -->
    <div class="swiper-button-next text-white"></div>
    <div class="swiper-button-prev text-white"></div>
    <div class="swiper-pagination"></div>
  </div>
</div>




    <!-- Berita Unggulan -->
    <div class="flex flex-col px-14 mt-10 ">
      <div class="flex flex-col md:flex-row justify-between items-center w-full mb-6">
        <div class="font-bold text-2xl text-center md:text-left">
          <p>Berita Unggulan</p>
          <p>Untuk Kamu</p>
        </div>
        <a href="semuaberita.html"
          class="bg-primary px-5 py-2 rounded-full text-white font-semibold mt-4 md:mt-0 h-fit">
          Lihat Semua
        </a>
      </div>
      <div class="grid sm:grid-cols-1 gap-5 lg:grid-cols-4">
        @foreach ($featureds as $featured)
        <a href="{{ route('berita.show', $featured->slug) }}">
          <div
            class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out" style="height: 100%">
            <div class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute">
              {{ $featured->kategoriBerita->title }}</div>
            <img src="{{ asset('storage/' . $featured->thumbnail) }}" alt="" class="w-full rounded-xl mb-3" style="height: 150px; objext-fit; cover;">
            <p class="font-bold text-base mb-1">{{ $featured->title }}</p>
            <p class="text-slate-400">{{ $featured->created_at->format('d F Y') }}</p>
          </div>
        </a>
        @endforeach
       
      </div>
    </div>

    <!-- Berita Terbaru -->
    <div class="flex flex-col px-4 md:px-10 lg:px-14 mt-10">
      <div class="flex flex-col md:flex-row w-full mb-6">
        <div class="font-bold text-2xl text-center md:text-left">
          <p>Berita Terbaru</p>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-12 gap-5">
        <!-- Berita Utama -->
        <div
          class="relative col-span-7 lg:row-span-3 border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer">
          <a href="{{ route('berita.show', $beritas[0]->slug) }}">
            <div class="bg-primary text-white rounded-full w-fit px-4 py-1 font-normal ml-5 mt-5 absolute">Pariwisata
            {{ $beritas[0]->kategoriBerita->title }}    
            </div>
            <img src="{{ asset('storage/' . $beritas[0]->thumbnail) }}" alt="berita1" class="rounded-2xl">
            <p class="font-bold text-xl mt-3"> {{ $beritas[0]->title }} </p>
            <p class="text-slate-400 text-base mt-1">{{ Str::limit(strip_tags($beritas[0]->content), 100) }}</p>
            <p class="text-slate-400">{{ \Carbon\Carbon::parse($beritas[0]->created_at)->format('d F Y') }}</p>
          </a>
        </div>

        <!-- Berita 1 -->
         @foreach ($beritas->skip(1) as $berita)
         <a href="{{ route('berita.show', $berita->slug) }}"
          class="relative col-span-5 flex flex-col h-fit md:flex-row gap-3 border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer">
          <div class="bg-primary text-white rounded-full w-fit px-4 py-1 font-normal ml-2 mt-2 absolute text-sm">
          {{ $berita->kategoriBerita->title }}    </div>
          <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="berita2" class="rounded-xl" style="width: 250px; object-fit: cover;">
          <div class="mt-2 md:mt-0">
            <p class="font-semibold text-lg">{{ $berita->title }}</p>
            <p class="text-slate-400 mt-3 text-sm font-normal">{{ Str::limit(strip_tags($berita->content), 100) }}</p>
          </div>
        </a>
         @endforeach
      </div>
    </div>

    <!-- Berita Paling Banyak Dilihat -->
    <div class="flex flex-col px-4 md:px-10 lg:px-14 mt-10">
        <div class="flex flex-col md:flex-row w-full mb-6">
            <div class="font-bold text-2xl text-center md:text-left">
                <p>Berita Paling Banyak Dilihat</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach ($mostViewed as $viewed)
            <a href="{{ route('berita.show', $viewed->slug) }}" class="block">
                <div class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out" style="height: 100%">
                    <div class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute">
                        {{ $viewed->kategoriBerita->title }}
                    </div>
                    <img src="{{ asset('storage/' . $viewed->thumbnail) }}" alt="" class="w-full rounded-xl mb-3" style="height: 150px; object-fit: cover;">
                    <p class="font-bold text-base mb-1">{{ $viewed->title }}</p>
                    <div class="flex justify-between items-center">
                        <p class="text-slate-400">{{ $viewed->created_at->format('d F Y') }}</p>
                        <p class="text-slate-400 flex items-center gap-1">
                            <img src="{{ asset('assets/img/view.png') }}" alt="views" class="w-4 h-4"> {{ $viewed->view_count }}
                        </p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    

@endsection

