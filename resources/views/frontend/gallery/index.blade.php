<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri | {{ $school->name }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-50 to-pink-100 min-h-screen pt-32">

    <!-- Navigation -->
     @include('frontend.partials.navbar')

    <!-- Hero Section -->
    <div class="relative w-full h-80 flex items-center justify-center text-white"
    style="background-color: {{ $settings['secondary_color'] ?? '#000000' }};">
        <div class="absolute top-0 right-0 w-96 h-96 bg-purple-500 rounded-full -mr-48 -mt-48 opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-pink-600 rounded-full -ml-32 -mb-32 opacity-20"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-block bg-purple-500 bg-opacity-50 px-4 py-2 rounded-full mb-4">
                <span class="text-sm font-semibold">DOKUMENTASI VISUAL</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-extrabold mb-4">Galeri Sekolah</h1>
            <p class="text-xl text-purple-100">Momen berharga dari {{ $school->name }}</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if ($galleries->count() > 0)
            <!-- Filter Buttons -->
            <div class="flex flex-wrap justify-center gap-3 mb-12">
                <button class="filter-btn active px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-full hover:from-purple-700 hover:to-purple-800 transition duration-300 font-semibold shadow-lg" data-filter="all">
                    <i class="fas fa-th-large mr-2"></i>Semua
                </button>
                <button class="filter-btn px-6 py-3 bg-gray-200 text-gray-700 rounded-full hover:bg-purple-600 hover:text-white transition duration-300 font-semibold" data-filter="image">
                    <i class="fas fa-image mr-2"></i>Foto
                </button>
                <button class="filter-btn px-6 py-3 bg-gray-200 text-gray-700 rounded-full hover:bg-purple-600 hover:text-white transition duration-300 font-semibold" data-filter="video">
                    <i class="fas fa-video mr-2"></i>Video
                </button>
            </div>

            <!-- Gallery Grid -->
            <div class="gallery-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-12">
             @foreach ($galleries as $item)
    <div class="gallery-item {{ $item->type }} bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 transform hover:-translate-y-2 group">
        <div class="relative h-64 bg-gray-200 overflow-hidden">
            @if ($item->type === 'image')
                @php
                    $images = is_array($item->file_path) ? $item->file_path : json_decode($item->file_path, true);
                    $coverImage = $images[0] ?? null;
                @endphp

                @if($coverImage)
                    {{-- Bungkus HANYA bagian gambar dengan GLightbox --}}
                    <a href="{{ asset('storage/' . $coverImage) }}" 
                       class="glightbox block h-full w-full" 
                       data-gallery="gallery-{{ $item->id }}" 
                       data-title="{{ $item->title }}" 
                       data-description="{{ $item->caption }}">
                        
                        <img src="{{ asset('storage/' . $coverImage) }}"
                             alt="{{ $item->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition duration-300 flex items-center justify-center">
                            <i class="fas fa-search text-white text-4xl opacity-0 group-hover:opacity-100 transition duration-300"></i>
                        </div>
                    </a>

                    {{-- Link tersembunyi untuk foto ke-2, ke-3, dst agar bisa di-swipe --}}
                    @if(is_array($images) && count($images) > 1)
                        @foreach(array_slice($images, 1) as $extraImage)
                            <a href="{{ asset('storage/' . $extraImage) }}" 
                               class="glightbox hidden" 
                               data-gallery="gallery-{{ $item->id }}" 
                               data-title="{{ $item->title }}" 
                               data-description="{{ $item->caption }}">
                            </a>
                        @endforeach
                    @endif
                @endif
            @else
                {{-- Bagian Video --}}
                <iframe src="{{ $item->file_path }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
            @endif
        </div>

        {{-- BAGIAN TEXT: Harus di LUAR tag <a> Lightbox agar tetap muncul --}}
        <div class="p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-purple-600 transition">
                {{ $item->title }}
            </h3>
            <p class="text-gray-600 text-sm line-clamp-2 mb-4">
                {{ $item->caption }}
            </p>
            <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $item->type === 'image' ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700' }}">
                    <i class="fas {{ $item->type === 'image' ? 'fa-image' : 'fa-video' }} mr-1"></i>
                    {{ ucfirst($item->type) }} 
                    @if($item->type === 'image' && is_array($images) && count($images) > 1)
                        <span class="ml-1">({{ count($images) }} Foto)</span>
                    @endif
                </span>
                <span class="text-xs text-gray-500">
                    {{ $item->created_at->format('d M Y') }}
                </span>
            </div>
        </div>
    </div>
@endforeach
            </div>

            <!-- Statistics -->
            <div class="bg-white rounded-2xl shadow-xl p-10">
                <h3 class="text-3xl font-bold text-gray-800 mb-8 text-center flex items-center justify-center">
                    <i class="fas fa-chart-bar mr-3 text-purple-600"></i>Statistik Galeri
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-8 rounded-xl text-center border-2 border-purple-200">
                        <div class="text-5xl font-extrabold text-purple-600 mb-3">{{ $galleries->count() }}</div>
                        <div class="text-gray-700 font-medium">Total Konten</div>
                    </div>
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-xl text-center border-2 border-blue-200">
                        <div class="text-5xl font-extrabold text-blue-600 mb-3">{{ $galleries->where('type', 'image')->count() }}</div>
                        <div class="text-gray-700 font-medium">Total Foto</div>
                    </div>
                    <div class="bg-gradient-to-br from-red-50 to-red-100 p-8 rounded-xl text-center border-2 border-red-200">
                        <div class="text-5xl font-extrabold text-red-600 mb-3">{{ $galleries->where('type', 'video')->count() }}</div>
                        <div class="text-gray-700 font-medium">Total Video</div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <div class="bg-white rounded-2xl shadow-xl p-16 max-w-md mx-auto">
                    <div class="bg-purple-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-images text-5xl text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Galeri Kosong</h3>
                    <p class="text-gray-600 mb-8">Belum ada konten galeri untuk sekolah ini.</p>
                    <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-lg hover:from-purple-700 hover:to-purple-800 shadow-lg transition duration-300 font-semibold">
                        <i class="fas fa-plus mr-2"></i> Tambah Konten
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Footer -->
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

    <!-- WhatsApp Contact Overlay -->
    @if($school->profile && $school->profile->contact_phone)
        <div class="fixed bottom-6 right-6 z-50">
            <a href="https://wa.me/{{ '+62' . ltrim(preg_replace('/[^0-9]/', '', $school->profile->contact_phone), '0') }}"
               target="_blank"
               class="bg-green-500 hover:bg-green-600 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 group">
                <i class="fab fa-whatsapp text-2xl"></i>
                <div class="absolute right-full mr-3 bg-gray-800 text-white text-sm px-3 py-2 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                    Hubungi Kami
                    <div class="absolute left-full top-1/2 transform -translate-y-1/2 border-4 border-transparent border-l-gray-800"></div>
                </div>
            </a>
        </div>
    @endif

    <script>
        // Gallery filtering functionality
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const galleryItems = document.querySelectorAll('.gallery-item');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => {
                        btn.classList.remove('active', 'bg-gradient-to-r', 'from-purple-600', 'to-purple-700', 'text-white', 'shadow-lg');
                        btn.classList.add('bg-gray-200', 'text-gray-700');
                    });

                    // Add active class to clicked button
                    this.classList.add('active', 'bg-gradient-to-r', 'from-purple-600', 'to-purple-700', 'text-white', 'shadow-lg');
                    this.classList.remove('bg-gray-200', 'text-gray-700');

                    const filterValue = this.getAttribute('data-filter');

                    galleryItems.forEach(item => {
                        if (filterValue === 'all') {
                            item.style.display = 'block';
                        } else {
                            if (item.classList.contains(filterValue)) {
                                item.style.display = 'block';
                            } else {
                                item.style.display = 'none';
                            }
                        }
                    });
                });
            });
        });
    </script>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .aspect-w-4 { position: relative; padding-bottom: 75%; }
        .aspect-w-16 { position: relative; padding-bottom: 56.25%; }
        .aspect-w-4 > *, .aspect-w-16 > * {
            position: absolute;
            height: 100%;
            width: 100%;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }
    </style>
</body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lightbox = GLightbox({
            selector: '.glightbox',
            touchNavigation: true,
            loop: true,
            autoplayVideos: true
        });
    });
</script>
