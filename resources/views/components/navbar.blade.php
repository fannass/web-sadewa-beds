{{--
    PREMIUM NAVBAR COMPONENT - RSKIA SADEWA
    Healthcare-grade design, professional, crafted, RESPONSIVE
--}}

<nav class="sticky top-0 z-50 bg-white border-b border-gray-200" style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between h-16 sm:h-[68px]">

            {{-- LEFT: Logo + Brand --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 sm:gap-3 group">
                <div class="relative">
                    <img src="{{ asset('assets/logo.png') }}" alt="RSKIA Sadewa"
                        class="h-8 sm:h-10 w-auto transition-transform duration-200 group-hover:scale-105">
                </div>
                <div class="flex flex-col">
                    <span class="text-[13px] sm:text-[15px] font-semibold text-gray-800 leading-tight tracking-tight">
                        RSKIA Sadewa
                    </span>
                    <span class="text-[10px] sm:text-[11px] text-gray-400 font-normal leading-tight hidden sm:block">
                        Rumah Sakit Ibu & Anak
                    </span>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}" class="relative py-2 text-[14px] font-medium transition-colors duration-200
                        {{ request()->routeIs('home') ? 'text-[#0CA15C]' : 'text-gray-600 hover:text-[#0CA15C]' }}">
                    Beranda
                    @if(request()->routeIs('home'))
                        <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-[#0CA15C] rounded-full"></span>
                    @endif
                </a>

                <a href="{{ route('rooms') }}" class="relative py-2 text-[14px] font-medium transition-colors duration-200
                        {{ request()->routeIs('rooms') || request()->routeIs('rooms.detail') ? 'text-[#0CA15C]' : 'text-gray-600 hover:text-[#0CA15C]' }}">
                    Ketersediaan Kamar
                    @if(request()->routeIs('rooms') || request()->routeIs('rooms.detail'))
                        <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-[#0CA15C] rounded-full"></span>
                    @endif
                </a>

                <a href="{{ route('about') }}" class="relative py-2 text-[14px] font-medium transition-colors duration-200
                        {{ request()->routeIs('about') ? 'text-[#0CA15C]' : 'text-gray-600 hover:text-[#0CA15C]' }}">
                    Tentang Layanan
                    @if(request()->routeIs('about'))
                        <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-[#0CA15C] rounded-full"></span>
                    @endif
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <button type="button" id="mobile-menu-btn" class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100 bg-white">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('home') }}" 
                class="block px-4 py-3 rounded-lg text-[14px] font-medium {{ request()->routeIs('home') ? 'text-[#0CA15C] bg-green-50' : 'text-gray-600 hover:bg-gray-50' }}">
                Beranda
            </a>
            <a href="{{ route('rooms') }}" 
                class="block px-4 py-3 rounded-lg text-[14px] font-medium {{ request()->routeIs('rooms') || request()->routeIs('rooms.detail') ? 'text-[#0CA15C] bg-green-50' : 'text-gray-600 hover:bg-gray-50' }}">
                Ketersediaan Kamar
            </a>
            <a href="{{ route('about') }}" 
                class="block px-4 py-3 rounded-lg text-[14px] font-medium {{ request()->routeIs('about') ? 'text-[#0CA15C] bg-green-50' : 'text-gray-600 hover:bg-gray-50' }}">
                Tentang Layanan
            </a>
        </div>
    </div>
</nav>

<script>
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>