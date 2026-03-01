<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Overview Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-8 shadow-lg text-white mb-8 flex flex-col md:flex-row justify-between items-center gap-6 overflow-hidden relative">
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-white opacity-10 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-24 -left-12 w-48 h-48 bg-blue-400 opacity-20 rounded-full blur-xl"></div>

                <div class="relative z-10">
                    <h2 class="text-2xl md:text-3xl font-extrabold mb-2 tracking-tight">Selamat Datang, Admin! 👋</h2>
                    <p class="text-blue-100 text-sm md:text-base max-w-xl">
                        Pantau terus perkembangan jaringan alumni hari ini. Segala informasi mulai dari verifikasi data hingga persebaran lulusan ada dalam kendali Anda.
                    </p>
                </div>
                <div class="relative z-10 hidden md:block">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 text-center border border-white/30">
                        <div class="text-blue-50 text-xs font-semibold uppercase tracking-wider mb-1">Tanggal Hari Ini</div>
                        <div class="text-xl font-bold">{{ date('d M Y') }}</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300 border border-slate-100 flex items-center justify-between group">
                    <div>
                        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Alumni</p>
                        <h3 class="text-3xl font-extrabold text-slate-800 group-hover:text-blue-600 transition-colors">{{ $totalAlumni ?? 0 }}</h3>
                    </div>
                    <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300 border border-slate-100 flex items-center justify-between group">
                    <div>
                        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Terverifikasi</p>
                        <h3 class="text-3xl font-extrabold text-slate-800 group-hover:text-emerald-500 transition-colors">{{ $totalVerified ?? 0 }}</h3>
                    </div>
                    <div class="w-14 h-14 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300 border border-slate-100 flex items-center justify-between group">
                    <div>
                        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Menunggu</p>
                        <h3 class="text-3xl font-extrabold text-slate-800 group-hover:text-amber-500 transition-colors">{{ $totalPending ?? 0 }}</h3>
                    </div>
                    <div class="w-14 h-14 rounded-full bg-amber-50 flex items-center justify-center text-amber-500 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-lg text-slate-800">Pertumbuhan Alumni Per Tahun</h3>
                        <span class="px-3 py-1 bg-blue-50 text-blue-600 text-xs font-bold rounded-full">Statistik</span>
                    </div>
                    <div class="relative flex-1 min-h-[250px]">
                        <canvas id="yearChart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-lg text-slate-800">Komposisi Status Data</h3>
                        <span class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded-full">Distribusi</span>
                    </div>
                    <div class="relative flex-1 min-h-[250px] flex justify-center">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxYear = document.getElementById('yearChart');
        const yearLabels = {!! json_encode($yearData->keys()) !!};
        const yearValues = {!! json_encode($yearData->values()) !!};

        new Chart(ctxYear, {
            type: 'bar',
            data: {
                labels: yearLabels,
                datasets: [{
                    label: 'Lulusan (Verified)',
                    data: yearValues,
                    backgroundColor: 'rgba(59, 130, 246, 0.8)',
                    borderColor: 'rgb(37, 99, 235)',
                    borderWidth: 1,
                    borderRadius: 6, // Tambahan: Membuat ujung batang melengkung
                    barPercentage: 0.6 // Tambahan: Membuat batang lebih ramping
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false } // Menyembunyikan legend agar lebih bersih
                },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { borderDash: [5, 5] } },
                    x: { grid: { display: false } }
                }
            }
        });

        const ctxStatus = document.getElementById('statusChart');
        const verifiedCount = {{ $statusData['verified'] ?? 0 }};
        const pendingCount = {{ $statusData['pending'] ?? 0 }};
        const rejectedCount = {{ $statusData['rejected'] ?? 0 }};

        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: ['Terverifikasi', 'Menunggu', 'Ditolak'],
                datasets: [{
                    data: [verifiedCount, pendingCount, rejectedCount],
                    backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                    borderWidth: 0,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%', // Membuat cincin donat lebih tipis elegan
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } }
                }
            }
        });
    </script>
</x-app-layout>