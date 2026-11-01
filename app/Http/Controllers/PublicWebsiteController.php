<?php

namespace App\Http\Controllers;


use App\Models\School;
use App\Models\Post;
use App\Models\Teacher;
use App\Models\Gallery;
use App\Models\Facilities;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Menu;
use App\Models\Section;
use App\Models\Setting;
class PublicWebsiteController extends Controller
{
    /**
     * Dapatkan objek School saat ini dari Service Container dengan pengecekan aman.
     */
protected function getCurrentSchool(): ?School
{
    if (app()->has('currentSchool')) {

        $school = app('currentSchool');

        $school->load('profile');

        return $school;
    }

    return null;
}

    /**
     * Tampilkan Homepage Profil Sekolah atau Landing Page Platform.
     */
public function index(): View
{
    $school = $this->getCurrentSchool();
    $menus = Menu::where('school_id', $school->id)
            ->where('is_active', 1)
            ->orderBy('position')
            ->get();

    $sections = Section::where('school_id', $school->id)
            ->where('is_active', 1)
            ->orderBy('position')
            ->get();

    $settings = Setting::where('school_id', $school->id)
            ->pluck('value', 'key');
        
    if (!$school) return view('landing');

    $posts = Post::where('school_id', $school->id)->limit(3)->get();
    $teachers = Teacher::with('subject')->where('school_id', $school->id)->get();
    $students = \App\Models\Student::where('school_id', $school->id)->get();
    $schoolProfile = \App\Models\SchoolProfile::where('school_id', $school->id)->first();
    $facilities = \App\Models\Facilities::where('school_id', $school->id)->get();
    $subjects = \App\Models\Subject::where('school_id', $school->id)->get();
    $extracurriculars = \App\Models\Extracurriculars::where('school_id', $school->id)->get();
    $totalSubjects = $subjects->count();
    $totalEskul = $extracurriculars->count();

    return view('frontend.homepage', compact(
        'school', 'schoolProfile', 'posts', 'teachers', 'students', 
        'facilities', 'subjects', 'totalSubjects', 'totalEskul', 'menus', 'sections', 'settings'
    ));
}

    /**
     * Tampilkan Daftar Berita.
     */
    public function showPosts(): View
    {
        $school = $this->getCurrentSchool();
        

        // Pastikan school ada sebelum mengambil data
        if (!$school) {
            return view('errors.tenant-not-found'); // Kita belum buat view ini, tapi ini lebih baik
        }

        $posts = Post::where('school_id', $school->id)->paginate(10);
        return view('frontend.posts.index', compact('school', 'posts'));
    }

    /**
     * Tampilkan Daftar Guru.
     */
    public function showTeachers(): View
    {
        $school = $this->getCurrentSchool();
        if (!$school) {
            return view('errors.tenant-not-found');
        }

        $teachers = Teacher::with('subject')->where('school_id', $school->id)->get();
        return view('frontend.teachers.index', compact('school', 'teachers'));
    }

    /**
     * Tampilkan Daftar Galeri.
     */
    public function showGallery(): View
    {
        $school = $this->getCurrentSchool();
        if (!$school) {
            return view('errors.tenant-not-found');
        }

        $galleries = Gallery::where('school_id', $school->id)->get();
        return view('frontend.gallery.index', compact('school', 'galleries'));
    }

    /**
     * Tampilkan Daftar Siswa.
     */
    public function showStudents(): View
    {
        $school = $this->getCurrentSchool();
        if (!$school) {
            return view('errors.tenant-not-found');
        }

        $students = \App\Models\Student::where('school_id', $school->id)->get();
        return view('frontend.students.index', compact('school', 'students'));
    }

    /**
     * Tampilkan Daftar Fasilitas.
     */
    public function showFacilities(): View
    {
        $school = $this->getCurrentSchool();
        if (!$school) {
            return view('errors.tenant-not-found');
        }

        $facilities = \App\Models\Facilities::where('school_id', $school->id)
                    ->get();
        return view('frontend.facilities.index', compact('school', 'facilities'));
    }

    /**
     * Tampilkan Daftar Ekstrakurikuler.
     */
public function showExtracurriculars(): View
{
    $school = $this->getCurrentSchool();

    if (!$school) {
        return view('errors.tenant-not-found');
    }

    $settings = Setting::where('school_id', $school->id)
        ->pluck('value', 'key');

    $extracurriculars = \App\Models\Extracurriculars::where(
        'school_id',
        $school->id
    )->get();

    return view(
        'frontend.extracurriculars.index',
        compact(
            'school',
            'extracurriculars',
            'settings'
        )
    );
}

    /**
     * Tampilkan Daftar Acara.
     */
    public function showEvents(): View
    {
        $school = $this->getCurrentSchool();
        if (!$school) {
            return view('errors.tenant-not-found');
        }

        $events = \App\Models\Events::where('school_id', $school->id)->get();
        return view('frontend.events.index', compact('school', 'events'));
    }

    public function showPpdbRegistrations($schoolSlug)
    {
        // Mengambil data sekolah berdasarkan slug di URL
    $school = $this->getCurrentSchool();

    return view('frontend.ppdb.index', compact('school'));
    }
        
    public function storePpdb(Request $request, $schoolSlug)
{
    $school = \App\Models\School::where('slug', $schoolSlug)->firstOrFail();

    // 1. Tangkap SEMUA input dari form sekaligus
    $validatedData = $request->all();

    // 2. Tambahkan data sistem (School ID dan Status awal)
    $validatedData['school_id'] = $school->id;
    $validatedData['status']    = 'pending';

    // 3. Proses Upload File (Pastikan folder storage sudah di-link)
    if ($request->hasFile('photo_path')) {
        $validatedData['photo_path'] = $request->file('photo_path')->store('ppdb/photos', 'public');
    }
    if ($request->hasFile('family_card_path')) {
        $validatedData['family_card_path'] = $request->file('family_card_path')->store('ppdb/kk', 'public');
    }
    if ($request->hasFile('birth_cert_path')) {
        $validatedData['birth_cert_path'] = $request->file('birth_cert_path')->store('ppdb/akta', 'public');
    }

    // 4. Simpan ke Database
    \App\Models\Registration::create($validatedData);

    return redirect()->back()->with('success', 'Pendaftaran berhasil! Data Anda telah kami terima. Silakan tunggu informasi selanjutnya melalui nomor WhatsApp yang telah didaftarkan.');
}
}
