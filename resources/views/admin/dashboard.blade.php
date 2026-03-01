<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-slate-500 text-sm font-medium uppercase">Total Alumni Terdaftar</div>
                    <div class="text-3xl font-bold text-slate-800 mt-2">{{ $totalAlumni ?? 0 }}</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-slate-500 text-sm font-medium uppercase">Sudah Diverifikasi</div>
                    <div class="text-3xl font-bold text-slate-800 mt-2">{{ $totalVerified ?? 0 }}</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500">
                    <div class="text-slate-500 text-sm font-medium uppercase">Menunggu Verifikasi</div>
                    <div class="text-3xl font-bold text-slate-800 mt-2">{{ $totalPending ?? 0 }}</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-bold text-lg text-slate-700 mb-4">Pertumbuhan Alumni per Tahun</h3>
                    <div class="relative h-64">
                        <canvas id="yearChart"></canvas>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-bold text-lg text-slate-700 mb-4">Komposisi Status Data</h3>
                    <div class="relative h-64 flex justify-center">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>

            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-slate-900">
                    <h3 class="font-bold text-lg mb-2">Selamat Datang, Admin!</h3>
                    <p class="text-slate-500">
                        Pantau terus perkembangan data alumni melalui grafik di atas. Gunakan menu navigasi untuk mengelola data secara lebih rinci.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // === 1. Konfigurasi Grafik Batang (Tahun Lulus) ===
        const ctxYear = document.getElementById('yearChart');
        
        // Ambil data dari PHP Controller
        const yearLabels = {!! json_encode($yearData->keys()) !!};
        const yearValues = {!! json_encode($yearData->values()) !!};

        new Chart(ctxYear, {
            type: 'bar',
            data: {
                labels: yearLabels,
                datasets: [{
                    label: 'Jumlah Alumni Lulus (Verified)',
                    data: yearValues,
                    backgroundColor: 'rgba(59, 130, 246, 0.6)', // Warna Biru
                    borderColor: 'rgb(59, 130, 246)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1 // Agar angka sumbu Y bulat (tidak desimal)
                        }
                    }
                }
            }
        });

        // === 2. Konfigurasi Grafik Lingkaran (Status) ===
        const ctxStatus = document.getElementById('statusChart');

        // Siapkan data manual agar urutan warnanya konsisten
        // Kita ambil data PHP, jika kosong kasih 0
        const verifiedCount = {{ $statusData['verified'] ?? 0 }};
        const pendingCount = {{ $statusData['pending'] ?? 0 }};
        const rejectedCount = {{ $statusData['rejected'] ?? 0 }};

        new Chart(ctxStatus, {
            type: 'doughnut', // Bisa diganti 'pie'
            data: {
                labels: ['Verified', 'Pending', 'Rejected'],
                datasets: [{
                    label: 'Jumlah Alumni',
                    data: [verifiedCount, pendingCount, rejectedCount],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.7)',  // Hijau (Verified)
                        'rgba(234, 179, 8, 0.7)',  // Kuning (Pending)
                        'rgba(239, 68, 68, 0.7)'   // Merah (Rejected)
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script>
</x-app-layout>