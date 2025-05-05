<!-- Nav -->
<nav class="sticky top-0 z-50 flex justify-between items-center py-5 px-4 lg:px-14 bg-white shadow-sm">
  <div class="flex items-center gap-4">
    <!-- Logo -->
    <a href="{{ route('landing') }}" class="flex items-center gap-2">  
      <img src="{{ asset('assets/img/logo.png')}}" alt="Logo" class="w-8 lg:w-10">
      <p class="text-lg lg:text-xl font-bold">Moco</p>
    </a>
  </div>

  <!-- Menu Toggle and Search -->
  <div class="flex items-center gap-3 lg:hidden ml-auto">
    <div class="flex items-center">
      <label for="check" class="open-menu text-primary text-3xl cursor-pointer">☰</label>
    </div>
  </div>

  <!-- Tengah: Menu Items -->
  <input type="checkbox" id="check" class="hidden">
  <ul class="menu flex-col lg:flex lg:flex-row lg:items-center gap-6 font-medium text-base hidden lg:flex">
    <li><a href="{{ route('landing') }}" class="{{ request()->is('/') ? 'text-primary' : '' }} hover:text-primary">Beranda</a></li>
    @foreach (\App\Models\kategoriBerita::all() as $kategori)
    <li><a href="{{ route('berita.kategori', $kategori->slug) }}" class="hover:text-primary">{{ $kategori->title }}</a></li>
    @endforeach
    <div class="lg:hidden fixed bottom-10 w-[216px]">
      <a href="/admin" class="bg-primary px-8 py-2 rounded-full text-white font-semibold text-sm min-w-[120px] text-center hover:bg-primary/90 transition-colors flex items-center justify-center">
        Masuk
      </a>
    </div>
    <label for="check" class="close-menu text-black text-2xl cursor-pointer absolute top-5 right-6 block lg:hidden">✕</label>
  </ul>

  <!-- Kanan: Search + Login (Desktop Only) -->
  <div class="hidden lg:flex items-center gap-4 ml-auto">
    <div class="relative">
      <input type="text" placeholder="Cari berita..."
        class="border border-slate-300 rounded-full px-4 py-2 pl-8 text-sm font-normal focus:outline-none focus:ring-primary focus:border-primary"
        id="searchInputDesktop" />
      <span class="absolute inset-y-0 left-3 flex items-center text-slate-400">
        <img src="{{ asset('assets/img/search.png')}}" alt="search" class="w-4">
      </span>
    </div>
    <a href="/admin"
      class="bg-primary px-8 py-2 rounded-full text-white font-semibold text-sm lg:text-base min-w-[120px] text-center hover:bg-primary/90 transition-colors h-fit flex items-center justify-center">
      Masuk
    </a>
  </div>
</nav>

<!-- Background Overlay -->
<div id="overlay" class="hidden fixed inset-0 bg-black opacity-50 z-30"></div>

</div>

<!-- Mobile Menu Style -->
<style>
  .close-menu,
  .open-menu {
    position: absolute;
    cursor: pointer;
    display: none;
  }

  .open-menu {
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
  }

  .close-menu {
    top: 20px;
    right: 20px;
    display: none !important;
  }

  #check {
    display: none;
  }

  @media (max-width: 1024px) {
    .menu {
      position: fixed;
      top: 0;
      right: -100%;
      width: 280px;
      height: 100vh;
      background-color: white;
      z-index: 50;
      padding: 80px 32px;
      transition: all 0.3s ease-in-out;
      display: flex !important;
      flex-direction: column;
      box-shadow: -4px 0 15px rgba(0, 0, 0, 0.05);
    }

    .close-menu {
      display: block !important;
    }

    .menu li {
      margin-bottom: -20px;
      list-style: none;
    }

    .menu li a {
      color: #374151;
      font-size: 16px;
      display: block;
      padding: 8px 0;
    }
}

    #check:checked ~ .menu {
      right: 0;
    }

    .close-menu,
    .open-menu {
      display: block;
    }
  
</style>

