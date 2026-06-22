<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PPDB | {{ $school->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen pt-32">

     @include('frontend.partials.navbar')
    <div
    class="text-white py-16 text-center"
    style="background-color: {{ $settings['secondary_color'] ?? '#000000' }};">
        <h1 class="text-4xl font-extrabold uppercase">Formulir PPDB Online</h1>
        <p class="mt-2 text-indigo-100">Lengkapi seluruh data di bawah ini untuk mendaftar di {{ $school->name }}</p>
    </div>

    <div class="max-w-5xl mx-auto px-4 pb-20 -mt-10">
        <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('registration.store', $school->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                @csrf

                <section>
                    <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2 flex items-center">
                        <i class="fas fa-file-alt mr-2 text-indigo-600"></i> I. DATA PENDAFTARAN
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold mb-2">Jenis Pendaftaran *</label>
                            <select name="registration_type" class="w-full border rounded-xl p-3 bg-gray-50" required>
                                <option value="Siswa Baru">Siswa Baru</option>
                                <option value="Pindahan">Pindahan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2">Jalur Pendaftaran *</label>
                            <select name="registration_path" class="w-full border rounded-xl p-3 bg-gray-50" required>
                                <option value="Zonasi">Umum</option>
                                <option value="Prestasi">Prestasi</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2">NIK / No. KITAS *</label>
                            <input type="text" name="nik_kitas" class="w-full border rounded-xl p-3 bg-gray-50" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2">Nama Sekolah Asal *</label>
                            <input type="text" name="origin_school" class="w-full border rounded-xl p-3 bg-gray-50" required>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2 flex items-center">
                        <i class="fas fa-user mr-2 text-indigo-600"></i> II. DATA PRIBADI SISWA
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">Nama Lengkap *</label>
                            <input type="text" name="full_name" class="w-full border rounded-xl p-3 bg-gray-50" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2">NISN*</label>
                            <input type="text" name="nisn" class="w-full border-2 border-indigo-200 rounded-xl p-3 bg-white" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2">Jenis Kelamin *</label>
                            <select name="gender" class="w-full border rounded-xl p-3 bg-gray-50" required>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2">Tempat Lahir *</label>
                            <input type="text" name="birth_place" class="w-full border rounded-xl p-3 bg-gray-50" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2">Tanggal Lahir *</label>
                            <input type="date" name="birth_date" class="w-full border rounded-xl p-3 bg-gray-50" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2">Agama *</label>
                            <input type="text" name="religion" class="w-full border rounded-xl p-3 bg-gray-50" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2">Kewarganegaraan *</label>
                            <input type="text" name="nationality" value="Indonesia" class="w-full border rounded-xl p-3 bg-gray-50" required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2">Alamat Lengkap *</label>
                            <textarea name="address" rows="2" class="w-full border rounded-xl p-3 bg-gray-50" required></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2">Desa/Kelurahan *</label>
                            <input type="text" name="village" placeholder="Desa/Kelurahan *" class="w-full border rounded-xl p-3 bg-gray-50" required></div>
                        <div>
                            <label class="block text-sm font-bold mb-2">Kecamatan *</label>
                            <input type="text" name="district" placeholder="Kecamatan *" class="w-full border rounded-xl p-3 bg-gray-50" required></div>
                        <div>
                            <label class="block text-sm font-bold mb-2">Kabupaten/Kota *</label>
                            <input type="text" name="city" placeholder="Kabupaten/Kota *" class="w-full border rounded-xl p-3 bg-gray-50" required></div>
                        <div>
                            <label class="block text-sm font-bold mb-2">Kode Pos *</label>
                            <input type="text" name="postal_code" placeholder="Kode Pos *" class="w-full border rounded-xl p-3 bg-gray-50" required></div>
                        <div>
                            <label class="block text-sm font-bold mb-2">Tempat Tinggal *</label>
                            <select name="residence_type" class="w-full border rounded-xl p-3 bg-gray-50" required>
                                <option value="Bersama Orang Tua">Bersama Orang Tua</option>
                                <option value="Wali">Wali</option>
                                <option value="Wali">Asrama</option>
                                <option value="Wali">Panti Asuhan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2">Anak Ke Berapa *</label>
                            <input type="number" name="child_order" placeholder="Anak Ke- *" class="w-full border rounded-xl p-3 bg-gray-50" required></div>
                        <div>
                            <label class="block text-sm font-bold mb-2">Jumlah Saudara Kandung *</label>
                            <input type="number" name="siblings_count" placeholder="Jumlah Saudara *" class="w-full border rounded-xl p-3 bg-gray-50" required></div>
                        <div>
                            <label class="block text-sm font-bold mb-2">Memiliki KIP? *</label>
                            <select name="has_kip" class="w-full border rounded-xl p-3 bg-gray-50" required>
                                <option value="0">Tidak Memiliki KIP</option>
                                <option value="1">Memiliki KIP</option>
                            </select>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2 flex items-center">
                        <i class="fas fa-users mr-2 text-indigo-600"></i> III. DATA ORANG TUA
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <label class="font-bold text-indigo-600">Data Ayah Kandung</label>
                            <input type="text" name="father_name" placeholder="Nama Ayah *" class="w-full border rounded-xl p-3 bg-gray-50" required>
                            <input type="text" name="father_nik" placeholder="NIK Ayah *" class="w-full border rounded-xl p-3 bg-gray-50" required>
                            <input type="text" name="father_job" placeholder="Pekerjaan Ayah *" class="w-full border rounded-xl p-3 bg-gray-50" required>
                            <input type="text" name="father_income" placeholder="Penghasilan Ayah *" class="w-full border rounded-xl p-3 bg-gray-50" required>
                        </div>
                        <div class="space-y-4">
                            <label class="font-bold text-pink-600">Data Ibu Kandung</label>
                            <input type="text" name="mother_name" placeholder="Nama Ibu *" class="w-full border rounded-xl p-3 bg-gray-50" required>
                            <input type="text" name="mother_nik" placeholder="NIK Ibu *" class="w-full border rounded-xl p-3 bg-gray-50" required>
                            <input type="text" name="mother_job" placeholder="Pekerjaan Ibu *" class="w-full border rounded-xl p-3 bg-gray-50" required>
                            <input type="text" name="mother_income" placeholder="Penghasilan Ibu *" class="w-full border rounded-xl p-3 bg-gray-50" required>
                        </div>
                    </div>

                </section>
                <section>
                        <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2 flex items-center">
                        <i class="fas fa-file-alt mr-2 text-indigo-600"></i> IV. KONTAK
                    </h3>
                     <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <input type="text" name="phone_number" placeholder="No. Handphone / WA *" class="w-full border rounded-xl p-3 bg-gray-50" required>
                        <input type="email" name="email" placeholder="Email Aktif *" class="w-full border rounded-xl p-3 bg-gray-50" required>
                    </div>
                </section>
                
                <section>
                    <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2 flex items-center">
                        <i class="fas fa-upload mr-2 text-indigo-600"></i> V. UNGGAH DOKUMEN
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div><label class="text-xs font-bold uppercase">Pas Foto *</label><input type="file" name="photo_path" required class="text-xs"></div>
                        <div><label class="text-xs font-bold uppercase">Kartu Keluarga *</label><input type="file" name="family_card_path" required class="text-xs"></div>
                        <div><label class="text-xs font-bold uppercase">Akta Lahir *</label><input type="file" name="birth_cert_path" required class="text-xs"></div>
                    </div>
                </section>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold py-5 rounded-2xl shadow-xl transition transform hover:scale-[1.01]">
                    KIRIM PENDAFTARAN SEKARANG
                </button>
            </form>
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