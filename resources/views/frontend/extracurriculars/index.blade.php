<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ekstrakurikuler - {{ $school->name }}</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-50 antialiased font-sans flex flex-col min-h-screen pt-32">
    @include('frontend.partials.navbar')
        <div
    class="relative w-full h-80 flex items-center justify-center text-white"
    style="background-color: {{ $settings['secondary_color'] ?? '#000000' }};">
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        
        <div class="relative z-10 text-center px-4">
            <p class="text-sm font-bold uppercase tracking-[0.2em] mb-3 text-indigo-200">Aktivitas Siswa</p>
            <h1 class="text-4xl md:text-6xl font-black mb-4">EKSTRAKURIKULER</h1>
            <p class="text-lg md:text-xl font-light max-w-2xl mx-auto text-indigo-100">
                Eksplorasi bakatmu dan raih prestasi bersama berbagai pilihan kegiatan menarik di {{ $school->name }}
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-4">
            <div>
                <div class="flex items-center mb-2">
                    <span class="h-1 w-10 bg-indigo-600 rounded-full mr-3"></span>
                    <span class="text-indigo-600 font-bold tracking-widest uppercase text-sm">Pilihan Eskul</span>
                </div>
                <h2 class="text-4xl font-bold text-gray-900">Daftar Kegiatan</h2>
            </div>
            <p class="text-gray-500 max-w-md">Tersedia berbagai bidang mulai dari olahraga, seni, hingga sains untuk mendukung pengembangan karaktermu.</p>
        </div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
    @forelse($extracurriculars as $eskul)
        <div class="group bg-white rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden flex flex-col">
            
            <div class="relative w-full h-[250px] overflow-hidden bg-gray-100">
                @if($eskul->photo_url)
                    <img src="{{ asset('storage/' . $eskul->photo_url) }}" 
                         alt="{{ $eskul->name }}" 
                         class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400 text-5xl">
                        <i class="fas fa-image"></i>
                    </div>
                @endif
            </div>

            {{-- Area Konten --}}
            <div class="p-6">
                {{-- Nama Ekstrakurikuler --}}
                <div class="mb-4">
                    <h3 class="text-2xl font-bold text-gray-800 group-hover:text-indigo-600 transition-colors">
                        {{ $eskul->name }}
                    </h3>
                </div>
                
                {{-- Detail Info: Pembimbing & Jadwal --}}
                <div class="space-y-3">
                    {{-- Pembimbing --}}
                    <div class="flex items-center text-gray-600">
                        <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center mr-3 text-indigo-600">
                            <i class="fas fa-user-tie text-sm"></i>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase tracking-wider font-bold text-gray-400 leading-none mb-1">Pembimbing</p>
                            <p class="text-sm font-semibold">{{ $eskul->instructor_name ?? 'Belum ditentukan' }}</p>
                        </div>
                    </div>

                    {{-- Jadwal --}}
                    <div class="flex items-center text-gray-600">
                        <div class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center mr-3 text-purple-600">
                            <i class="fas fa-calendar-alt text-sm"></i>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase tracking-wider font-bold text-gray-400 leading-none mb-1">Jadwal Latihan</p>
                            <p class="text-sm font-semibold">{{ $eskul->schedule ?? 'Akan diinformasikan' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Footer Card --}}
                <div class="pt-6 border-t border-gray-50 mt-6 flex items-center justify-between">
                    <span class="text-xs font-bold text-indigo-600 uppercase tracking-widest flex items-center">
                         Gabung Sekarang
                    </span>
                    <i class="fas fa-arrow-right text-indigo-400 group-hover:translate-x-2 transition-transform"></i>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-200">
            <p class="text-gray-400">Data ekstrakurikuler belum tersedia.</p>
        </div>
    @endforelse
</div>
    </div>
<footer class="bg-gray-900 text-gray-300 w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-10">
            
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <i class="fas fa-school text-2xl text-indigo-500"></i>
                    <h3 class="text-xl font-bold text-white uppercase">{{ $school->name }}</h3>
                </div>
                <p class="text-sm leading-relaxed text-gray-400">
                    Website sekolah ini dibuat dalam rangka meningkatkan akses informasi, mempererat interaksi, publikasi, transparansi, dan digitalisasi layanan.
                </p>
                @if($school->profile && $school->profile->address)
                <div class="flex items-start gap-3 text-sm border-t border-gray-800 pt-4">
                    <i class="fas fa-map-marker-alt text-indigo-500 mt-1"></i>
                    <p>{{ $school->profile->address }}</p>
                </div>
                @endif
            </div>

            <div>
                <h4 class="text-lg font-bold text-white mb-6 border-b border-gray-800 pb-2">Navigasi Cepat</h4>
                <ul class="grid grid-cols-2 gap-y-3 gap-x-4 text-sm">
                    <li><a href="{{ route('school.homepage', $school->slug) }}" class="hover:text-indigo-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px]"></i> Beranda</a></li>
                    <li><a href="{{ route('posts', $school->slug) }}" class="hover:text-indigo-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px]"></i> Berita</a></li>
                    <li><a href="{{ route('teachers', $school->slug) }}" class="hover:text-indigo-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px]"></i> Guru</a></li>
                    <li><a href="{{ route('gallery', $school->slug) }}" class="hover:text-indigo-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px]"></i> Galeri</a></li>
                    <li><a href="{{ route('facilities', $school->slug) }}" class="hover:text-indigo-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px]"></i> Fasilitas</a></li>
                    <li><a href="{{ route('extracurriculars', $school->slug) }}" class="hover:text-indigo-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px]"></i> Ekstrakurikuler</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-bold text-white mb-6 border-b border-gray-800 pb-2">Kontak Kami</h4>
                <div class="space-y-4 text-sm">
                    @if($school->profile && $school->profile->contact_email)
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center">
                            <i class="fas fa-envelope text-indigo-500"></i>
                        </div>
                        <span>{{ $school->profile->contact_email }}</span>
                    </div>
                    @endif

                    @if($school->profile && $school->profile->contact_phone)
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center">
                            <i class="fas fa-phone text-indigo-500"></i>
                        </div>
                        <span>{{ $school->profile->contact_phone }}</span>
                    </div>
                    @endif
                </div>
            </div>

        </div>

        <div class="border-t border-gray-800 pt-8 mt-8 text-center text-xs text-gray-500">
            <p>&copy; {{ date('Y') }} <span class="text-indigo-500 font-semibold">{{ $school->name }}</span> | CMS Padamu Negeri</p>
        </div>
    </div>
</footer>

</body>
</html>