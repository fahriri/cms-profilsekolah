<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Sekolah - CMS Padamu Negeri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="antialiased bg-slate-900">
    @if ($errors->any())
    <div class="bg-red-500 text-white p-4 rounded-xl mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="min-h-screen flex items-center justify-center p-6 bg-gradient-to-br from-indigo-900 via-purple-900 to-slate-900">
        
        <div class="w-full max-w-lg">
            <div class="text-center mb-8">
                <i class="fas fa-school text-5xl text-indigo-400 mb-4"></i>
                <h1 class="text-3xl font-bold text-white">Daftarkan Sekolah Anda</h1>
                <p class="text-slate-400">Mulailah langkah digitalisasi pendidikan hari ini.</p>
            </div>

            <div class="bg-white/10 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/10">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Nama Sekolah</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white focus:ring-2 focus:ring-indigo-500 outline-none transition" placeholder="SD Negeri 01 Jakarta">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">NPSN Sekolah</label>
                        <input type="text" name="npsn" maxlength="8"  
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white focus:ring-2 focus:ring-indigo-500 outline-none transition" 
                            placeholder="Contoh: 12345678">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">URL Sekolah (Slug)</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-4 rounded-l-xl border border-r-0 border-slate-700 bg-slate-800 text-slate-400">s/</span>
                            <input type="text" name="slug" required class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-r-xl text-white focus:ring-2 focus:ring-indigo-500 outline-none transition" placeholder="sd-negeri-01">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Nama Admin</label>
                            <input type="text" name="admin_name" required class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Email</label>
                            <input type="email" name="email" required class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                            <input type="password" name="password" required class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" required class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                        </div>
                    </div>

                    <div class="pt-4 flex items-center justify-between">
                        <a href= "admin/login" class="text-sm text-indigo-400 hover:text-indigo-300">Sudah punya akun?</a>
                        <button type="submit" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition shadow-lg shadow-indigo-500/20">
                            DAFTAR SEKARANG
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>