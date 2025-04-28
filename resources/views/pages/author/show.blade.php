@extends('layout.app')

@section('title', $author->name)

@section('content')
  <!-- Author -->
  <div class="flex gap-4 items-center mb-10 text-white p-10" style="background-image: url('{{ asset('assets/img/bg-profile.png') }}')"> 
  <img src="{{ asset('storage/' . $author->avatar) }}" alt="profile" class="rounded-full max-w-28">
      <div class="">
        <p class="font-bold text-lg">{{ $author->name }}</p>
        <p>
            {{ $author->bio }}
        </p>
      </div>
    </div>

    <!-- Berita -->
    <div class="flex flex-col gap-5 px-4 lg:px-14">
      <div class="grid sm:grid-cols-1 gap-5 lg:grid-cols-4">
        @foreach ($author->berita as $beritas)
        <a href="{{ route('berita.show', $beritas->slug) }}">
          <div class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out" style="height: 100%">
            <div class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute">
              {{ $beritas->kategoriBerita->title }}
            </div>
            <img src="{{ asset('storage/' . $beritas->thumbnail) }}" alt="" class="w-full rounded-xl mb-3" style="height: 200px; object-fit; cover;">
            <p class="font-bold text-base mb-1">{{ $beritas->title }}</p>
            <p class="text-slate-400">{{ \Carbon\Carbon::parse($beritas->created_at)->format('d F Y') }}</p>
          </div>
        </a>
        @endforeach       
      </div>

      <!-- Pagination -->
      <div class="w-full flex items-center justify-center gap-3 pt-12 mb-10">
        <p class="border border-slate-300 rounded-lg px-4 py-2 font-medium text-slate-300 hover:cursor-pointer">&lt;</p>
        <p
          class="rounded-lg px-4 py-2 font-medium bg-primary text-white hover:bg-slate-300 hover:text-black hover:cursor-pointer">
          1</p>
        <p
          class="border border-slate-300 rounded-lg px-4 py-2 font-medium hover:bg-primary hover:border-none hover:text-white hover:cursor-pointer">
          2</p>
        <p
          class="border border-slate-300 rounded-lg px-4 py-2 font-medium hover:bg-primary hover:border-none hover:text-white hover:cursor-pointer">
          3</p>
        <p class="border border-slate-300 rounded-lg px-4 py-2 font-medium hover:cursor-pointer">...</p>
        <p
          class="border border-slate-300 rounded-lg px-4 py-2 font-medium hover:bg-primary hover:border-none hover:text-white hover:cursor-pointer">
          10</p>
        <p
          class="border border-slate-300 rounded-lg px-4 py-2 font-medium hover:bg-primary hover:border-none hover:text-white hover:cursor-pointer">
          ></p>
      </div>
    </div>
@endsection 