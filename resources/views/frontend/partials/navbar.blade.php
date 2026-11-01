@php
use App\Models\Menu;
use App\Models\Setting;

$menus = Menu::where('school_id', $school->id)
    ->where('is_active', 1)
    ->orderBy('position')
    ->get();

$settings = Setting::where('school_id', $school->id)
    ->pluck('value', 'key')
    ->toArray();
@endphp
<style>
.dynamic-menu{
    color:#374151;
    border-bottom:2px solid transparent;
}

.dynamic-menu:hover{
    color: {{ $settings['primary_color'] ?? '#4F46E5' }};
    border-color: {{ $settings['primary_color'] ?? '#4F46E5' }};
}
</style>
   <nav
    class="fixed top-0 left-0 w-full z-50 shadow-lg"
    style="background-color: {{ $settings['navbar_color'] ?? '#FFFFFF' }}">
        <div
    class="border-b border-gray-200"
    style="background-color: {{ $settings['navbar_color'] ?? '#ffffff' }}">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-3">
                    <!-- Logo & School Name -->
                    <div class="flex items-center gap-3">
                        <a href="{{ route('school.homepage', $school->slug) }}" class="flex items-center gap-3 group">
                            @if($school->profile && $school->profile->logo_url)
                                {{-- Menampilkan logo dari storage sekolah yang bersangkutan --}}
                                <img src="{{ Storage::url($school->profile->logo_url) }}" 
                                    alt="Logo {{ $school->name }}" 
                                    class="h-10 w-10 object-contain transition duration-300 group-hover:scale-110">
                            @else
                                {{-- Placeholder jika logo belum diunggah --}}
                                <div class="h-10 w-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-school text-indigo-600"></i>
                                </div>
                            @endif
                            
                            <span
                                class="text-lg font-extrabold transition duration-300"
                                style="color: {{ $settings['primary_color'] ?? '#4F46E5' }}">
                                {{ $school->name }}
                            </span>
                        </a>
                    </div>

                    <!-- Social Media Icons -->
                    <div class="hidden md:flex items-center gap-3">
                            <a href="#" class="text-gray-600 hover:text-indigo-600 transition" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-indigo-600 transition" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-indigo-600 transition" title="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-indigo-600 transition" title="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      <!-- Bottom Bar: Navigation Menu -->
<div
    style="background-color: {{ $settings['navbar_color'] ?? '#ffffff' }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- MENU DINAMIS -->
            <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                @php
                $icons = [
                    '/' => 'fas fa-home',
                    'berita' => 'fas fa-newspaper',
                    'guru' => 'fas fa-users',
                    'galeri' => 'fas fa-images',
                    'fasilitas' => 'fas fa-building',
                    'ekstrakurikuler' => 'fas fa-trophy',
                    'ppdb' => 'fas fa-edit',
                ];
                @endphp
                @foreach($menus as $menu)

    @php
        switch($menu->slug) {
            case '/':
                $url = route('school.homepage', $school->slug);
                break;

            case 'berita':
                $url = route('posts', $school->slug);
                break;

            case 'guru':
                $url = route('teachers', $school->slug);
                break;

            case 'galeri':
                $url = route('gallery', $school->slug);
                break;

            case 'fasilitas':
                $url = route('facilities', $school->slug);
                break;

            case 'ekstrakurikuler':
                $url = route('extracurriculars', $school->slug);
                break;

            case 'ppdb':
                $url = route('registration', $school->slug);
                break;

            default:
                $url = '#';
        }

        $active = url()->current() == $url;
    @endphp

  <a href="{{ $url }}"
   class="dynamic-menu inline-flex items-center px-1 pt-1 text-sm font-medium border-b-2 transition duration-150"
   @if($active)
       style="
           border-bottom:2px solid {{ $settings['primary_color'] ?? '#4F46E5' }};
           color: {{ $settings['primary_color'] ?? '#4F46E5' }};
       "
   @endif>

        <i class="{{ $icons[$menu->slug] ?? 'fas fa-circle' }} mr-1"></i>

        {{ $menu->name }}
    </a>

@endforeach

            </div>

            <!-- LOGIN BUTTON -->

            <div class="flex sm:items-center">
                <a href="{{ route('login') }}"
                   class="text-sm font-medium text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 px-4 py-2 rounded-lg shadow-sm transition duration-300 transform hover:scale-105">
                    <i class="fas fa-user-shield mr-1"></i> Login Admin
                </a>
            </div>

        </div>
    </div>
</div>
</nav>