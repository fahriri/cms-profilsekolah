<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guru & Staf | {{ $school->name }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-green-50 to-emerald-100 min-h-screen pt-32">

    <!-- Navigation -->
     @include('frontend.partials.navbar')


    <!-- Hero Section -->
    <div class="relative w-full h-80 flex items-center justify-center text-white"
    style="background-color: {{ $settings['secondary_color'] ?? '#000000' }};">
        <div class="absolute top-0 right-0 w-96 h-96 bg-green-500 rounded-full -mr-48 -mt-48 opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-teal-600 rounded-full -ml-32 -mb-32 opacity-20"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-block bg-green-500 bg-opacity-50 px-4 py-2 rounded-full mb-4">
                <span class="text-sm font-semibold">TIM PENGAJAR</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-extrabold mb-4">Guru & Staf</h1>
            <p class="text-xl text-green-100">Profesional berkualitas di {{ $school->name }}</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if ($teachers->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-12">
                @foreach ($teachers as $teacher)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 transform hover:-translate-y-2 group">
                    <div class="relative h-72 bg-gradient-to-br from-green-400 to-teal-500 flex items-center justify-center overflow-hidden">
                        {{-- Sesuaikan nama kolom foto: photo_url atau photo --}}
                        @if($teacher->photo_url || $teacher->photo)
                            <img src="{{ asset('storage/'. ($teacher->photo_url ?? $teacher->photo)) }}"
                                 alt="Foto {{ $teacher->name }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-300"
                                 onerror="this.onerror=null; this.src='https://placehold.co/400x400/cccccc/333333?text=Foto+Guru';">
                        @else
                            <i class="fas fa-user-tie text-8xl text-white opacity-40 group-hover:scale-125 transition duration-300"></i>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black opacity-20"></div>
                        
                        <div class="absolute top-4 right-4 bg-white bg-opacity-95 text-green-700 px-4 py-2 rounded-full text-xs font-bold shadow-lg">
                            <i class="fas fa-book-open mr-1"></i>
                            {{ $teacher->subject?->name ?? 'Umum' }}
                        </div>
                    </div>

                    <div class="p-7">
                        <h3 class="text-xl font-bold text-gray-800 mb-3 text-center">
                            {{ $teacher->name }}
                        </h3>

                        <div class="space-y-3 text-sm text-gray-600 mb-5 pb-5 border-b border-gray-200">
                            <div class="flex items-center">
                                <i class="fas fa-id-card mr-3 text-green-500 w-5"></i>
                                <span class="font-medium text-gray-400">NIP:</span>
                                <span class="ml-2 font-semibold">{{ $teacher->nip ?? '-' }}</span>
                            </div>
                           <div class="flex items-center">
                                {{-- Menggunakan ikon venus-mars untuk merepresentasikan gender --}}
                                <i class="fas fa-venus-mars mr-3 text-green-500 w-5"></i>
                                <span class="font-medium">
                                    {{-- Logika untuk menerjemahkan L/P menjadi Laki-laki/Perempuan --}}
                                    @if($teacher->gender === 'L')
                                        Laki-laki
                                    @elseif($teacher->gender === 'P')
                                        Perempuan
                                    @else
                                        {{ $teacher->gender ?? 'Tidak Diset' }}
                                    @endif
                                </span>
                            </div>
                        </div>

                        {{-- <a href="https://wa.me/{{ $teacher->phone }}" target="_blank" class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-2 px-4 rounded-lg hover:from-green-600 hover:to-green-700 transition duration-300 flex items-center justify-center font-semibold shadow-md">
                            <i class="fas fa-envelope mr-2"></i> Hubungi
                        </a> --}}
                    </div>
                </div>
            @endforeach
            </div>

            <!-- Statistics -->
            <div class="bg-white rounded-2xl shadow-xl p-10">
                <h3 class="text-3xl font-bold text-gray-800 mb-8 text-center flex items-center justify-center">
                    <i class="fas fa-chart-bar mr-3 text-green-600"></i>Statistik Guru
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-xl text-center border-2 border-green-200">
                        <div class="text-5xl font-extrabold text-green-600 mb-3">{{ $teachers->count() }}</div>
                        <div class="text-gray-700 font-medium">Total Guru</div>
                    </div>
                    <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 p-8 rounded-xl text-center border-2 border-emerald-200">
                        <div class="text-5xl font-extrabold text-emerald-600 mb-3">{{ $teachers->whereNotNull('subject_id')->pluck('subject_id')->unique()->count() }}</div>
                        <div class="text-gray-700 font-medium">Mata Pelajaran</div>
                    </div>
                    <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-8 rounded-xl text-center border-2 border-teal-200">
                        <div class="text-5xl font-extrabold text-teal-600 mb-3">{{ $teachers->whereNotNull('nip')->count() }}</div>
                        <div class="text-gray-700 font-medium">Guru Tersertifikasi</div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <div class="bg-white rounded-2xl shadow-xl p-16 max-w-md mx-auto">
                    <div class="bg-green-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-users text-5xl text-green-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Belum Ada Data Guru</h3>
                    <p class="text-gray-600 mb-8">Data guru belum tersedia untuk sekolah ini.</p>
                    <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:from-green-700 hover:to-green-800 shadow-lg transition duration-300 font-semibold">
                        <i class="fas fa-plus mr-2"></i> Tambah Data Guru
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
                    Portal informasi resmi yang menyediakan berita, data guru dan siswa, serta fasilitas sekolah.
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
</body>
</html>
