<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Berita | {{ $school->name }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen pt-32">

    <!-- Navigation -->
  @include('frontend.partials.navbar')

    <!-- Hero Section -->
    <div class="relative w-full h-80 flex items-center justify-center text-white"
    style="background-color: {{ $settings['secondary_color'] ?? '#000000' }};">
        <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-500 rounded-full -mr-48 -mt-48 opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-600 rounded-full -ml-32 -mb-32 opacity-20"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-block bg-indigo-500 bg-opacity-50 px-4 py-2 rounded-full mb-4">
                <span class="text-sm font-semibold">BERITA SEKOLAH</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-extrabold mb-4">Berita Terbaru</h1>
            <p class="text-xl text-indigo-100">Informasi terkini dari {{ $school->name }}</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if ($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($posts as $post)
                    <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 transform hover:-translate-y-2 group">
                        <!-- Featured Image -->
                        <div class="h-48 overflow-hidden rounded-t-xl">
                            @if($post->photo_url)
                                <img src="{{ asset('storage/' . $post->photo_url) }}" 
                                    alt="{{ $post->title }}" 
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-3xl"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-8">
                            <div class="mb-3">
                                <span class="inline-block px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-semibold rounded-full">Berita</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4 line-clamp-2 group-hover:text-indigo-600 transition duration-300">
                                {{ $post->title }}
                            </h3>
                            <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                                {{ Str::limit($post->content, 150) }}
                            </p>

                            <!-- Meta Info -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-calendar-alt mr-2 text-indigo-500"></i>
                                    <span>{{ $post->created_at->format('d M Y') }}</span>
                                </div>
                                <button onclick="showPost(
                                    {{ json_encode($post->title) }}, 
                                    {{ json_encode($post->content) }}, 
                                    '{{ $post->photo_url ? asset('storage/' . $post->photo_url) : '' }}'
                                )" class="text-indigo-600 font-semibold flex items-center gap-1 hover:gap-2 transition-all">
                                    Baca →
                                </button>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination (if needed) -->
            <div class="mt-12 text-center">
                {{ $posts->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <div class="bg-white rounded-2xl shadow-xl p-16 max-w-md mx-auto">
                    <div class="bg-indigo-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-newspaper text-4xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Belum Ada Berita</h3>
                    <p class="text-gray-600 mb-8">Belum ada berita yang dipublikasikan untuk sekolah ini.</p>
                    <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-lg hover:from-indigo-700 hover:to-indigo-800 shadow-lg transition duration-300 font-semibold">
                        <i class="fas fa-plus mr-2"></i> Tambah Berita
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
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $school->profile->contact_phone) }}"
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

    <!-- Popup Container -->
   <div id="newsPopup" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto relative p-6">
        <button onclick="closePopup()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <i class="fas fa-times text-xl"></i>
        </button>

        <h2 id="popupTitle" class="text-2xl font-bold text-gray-900 mb-4"></h2>

        <div id="imageContainer" class="mb-4 hidden">
            <img id="popupImage" src="" alt="Foto Berita" class="w-full h-auto rounded-lg object-cover shadow-sm">
        </div>

        <div id="popupContent" class="text-gray-600 leading-relaxed whitespace-pre-wrap"></div>
    </div>
</div>

    <script>
function showPost(title, content, imageUrl) {
    try {
        console.log('Menampilkan berita:', title);
        
        document.getElementById('popupTitle').textContent = title;
        document.getElementById('popupContent').textContent = content;
        
        const imgElement = document.getElementById('popupImage');
        const imgContainer = document.getElementById('imageContainer');

        if (imageUrl && imageUrl.trim() !== '') {
            imgElement.src = imageUrl;
            imgContainer.classList.remove('hidden');
        } else {
            imgContainer.classList.add('hidden');
            imgElement.src = ''; 
        }

        document.getElementById('newsPopup').classList.remove('hidden');
        // Tambahan agar body tidak bisa di-scroll saat popup buka
        document.body.style.overflow = 'hidden';
    } catch (error) {
        console.error('Gagal membuka popup:', error);
    }
}

function closePopup() {
    document.getElementById('newsPopup').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Menutup popup jika klik di area hitam (overlay)
document.addEventListener('DOMContentLoaded', function() {
    const popup = document.getElementById('newsPopup');
    popup.addEventListener('click', function(e) {
        if (e.target === this) {
            closePopup();
        }
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
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</body>
</html>
