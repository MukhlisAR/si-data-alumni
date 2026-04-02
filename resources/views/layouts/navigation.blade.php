<div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-40 bg-slate-900/50 lg:hidden" @click="sidebarOpen = false"></div>

<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 text-slate-300 transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 flex flex-col h-full shadow-2xl lg:shadow-none border-r border-slate-800 shrink-0">
    
    <div class="h-20 flex items-center px-6 border-b border-slate-800 shrink-0">
        <img src="{{ asset('assets/logo.png') }}" class="w-10 h-10 bg-white p-1 rounded-lg mr-3 object-contain" alt="Logo">
        <span class="font-bold text-xl tracking-tight text-white">Portal<span class="text-blue-500">Alumni</span></span>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        
        @php
            // Styling standar untuk menu sidebar
            $baseClass = "flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 text-sm font-semibold group";
            $activeClass = "bg-blue-600 text-white shadow-lg shadow-blue-600/30";
            $inactiveClass = "text-slate-400 hover:bg-slate-800 hover:text-white";
        @endphp

        @if(Auth::user()->role === 'admin')
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 px-4 mt-4">Menu Admin</div>
            
            <a href="{{ route('admin.dashboard') }}" class="{{ $baseClass }} {{ request()->routeIs('admin.dashboard') ? $activeClass : $inactiveClass }}">
                <svg class="w-5 h-5 opacity-70 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                Dashboard
            </a>
            
        <a href="{{ route('admin.academic_years.index') }}" class="{{ $baseClass }} {{ request()->routeIs('admin.academic_years.*') ? $activeClass : $inactiveClass }}">
    <svg class="w-5 h-5 opacity-70 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
    Data Master
</a>
            <a href="{{ route('admin.alumni.index') }}" class="{{ $baseClass }} {{ request()->routeIs('admin.alumni.*') ? $activeClass : $inactiveClass }}">
                <svg class="w-5 h-5 opacity-70 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                Kelola Alumni
            </a>

            <a href="{{ route('admin.news.index') }}" class="{{ $baseClass }} {{ request()->routeIs('admin.news.*') ? $activeClass : $inactiveClass }}">
                <svg class="w-5 h-5 opacity-70 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M9 11l3 3m0 0l3-3m-3 3V8" /></svg>
                Berita & Karir
            </a>

            <a href="{{ route('admin.broadcast.index') }}" class="{{ $baseClass }} {{ request()->routeIs('admin.broadcast.*') ? $activeClass : $inactiveClass }}">
                <svg class="w-5 h-5 opacity-70 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>
                Broadcast WA
            </a>
            <a href="{{ route('profile.edit') }}" class="{{ $baseClass }} {{ request()->routeIs('profile.edit') ? $activeClass : $inactiveClass }}">
                <svg class="w-5 h-5 opacity-70 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Pengaturan Akun
            </a>
        @endif

        @if(Auth::user()->role === 'alumni')
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 px-4 mt-4">Menu Alumni</div>

            <a href="{{ route('alumni.dashboard') }}" class="{{ $baseClass }} {{ request()->routeIs('alumni.dashboard') ? $activeClass : $inactiveClass }}">
                <svg class="w-5 h-5 opacity-70 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                Dashboard
            </a>

            <a href="{{ route('alumni.biodata') }}" class="{{ $baseClass }} {{ request()->routeIs('alumni.biodata') ? $activeClass : $inactiveClass }}">
                <svg class="w-5 h-5 opacity-70 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                Biodata Saya
            </a>

          <a href="{{ route('alumni.directory') }}" class="{{ $baseClass }} {{ request()->routeIs('alumni.directory') ? $activeClass : $inactiveClass }}">
                <svg class="w-5 h-5 opacity-70 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                Direktori Alumni
            </a>

            <a href="{{ route('alumni.news.index') }}" class="{{ $baseClass }} {{ request()->routeIs('alumni.news.*') ? $activeClass : $inactiveClass }}">
                <svg class="w-5 h-5 opacity-70 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M9 11l3 3m0 0l3-3m-3 3V8" /></svg>
                Berita & Karir
            </a>
        @endif

    </nav>

    <div class="p-4 border-t border-slate-800 shrink-0 bg-slate-900/50">
        <div class="flex items-center gap-3 mb-4 px-2">
           <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-lg overflow-hidden shrink-0 bg-blue-600">
            @if(Auth::user()->role === 'alumni' && Auth::user()->alumni && Auth::user()->alumni->photo)
                <img src="{{ asset('storage/' . Auth::user()->alumni->photo) }}" class="w-full h-full object-cover" alt="Profile Photo">
            @else
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            @endif
        </div>
            <div class="overflow-hidden">
                <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-400 capitalize">{{ Auth::user()->role }}</p>
            </div>
        </div>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white rounded-xl transition-colors text-sm font-bold border border-red-500/20 hover:border-red-500">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                Log Out
            </button>
        </form>
    </div>

</aside>