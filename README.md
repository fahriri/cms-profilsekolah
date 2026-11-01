# CMS Profil Sekolah Berbasis Web (Multi-Tenant)

**Content Management System (CMS) Profil Sekolah** merupakan aplikasi berbasis web yang dikembangkan untuk memudahkan sekolah dalam membuat, mengelola, dan memperbarui website profil secara mandiri melalui satu platform terintegrasi.

Sistem ini menerapkan konsep **Multi-Tenant**, sehingga beberapa sekolah dapat menggunakan satu aplikasi CMS dengan pengelolaan dan pemisahan data masing-masing sekolah.

## 📌 Latar Belakang

Penyampaian informasi profil sekolah, berita, kegiatan, fasilitas, dan informasi Penerimaan Peserta Didik Baru (PPDB) membutuhkan media digital yang mudah diakses dan dikelola.

Melalui aplikasi ini, setiap sekolah dapat memiliki website profil yang dapat dikustomisasi tanpa harus membangun website secara terpisah.

## ✨ Fitur Utama

- **Multi-Tenant System** – Mendukung pengelolaan beberapa sekolah dalam satu platform dengan pemisahan data berdasarkan identitas sekolah.
- **Role-Based Access Control** – Memiliki hak akses berbeda untuk Super Admin dan Admin Sekolah.
- **School Profile Management** – Pengelolaan informasi dan identitas profil sekolah.
- **Content Management** – Pengelolaan berita, artikel, dan informasi sekolah.
- **Teacher Management** – Pengelolaan data tenaga pendidik.
- **Subject Management** – Pengelolaan data mata pelajaran.
- **PPDB Management** – Pengelolaan informasi dan data pendaftaran peserta didik baru.
- **Website Customization** – Pengaturan tampilan website, termasuk warna utama, warna sekunder, navigasi, dan footer.
- **Responsive Website** – Tampilan website yang menyesuaikan berbagai ukuran perangkat.

## 🛠️ Teknologi yang Digunakan

| Teknologi | Kegunaan |
|---|---|
| PHP | Backend Programming |
| Laravel | Web Application Framework |
| Filament | Admin Panel |
| MySQL | Database Management |
| Tailwind CSS | UI Styling |
| HTML & CSS | Frontend Development |
| JavaScript | Interaktivitas Website |

## 🏗️ Arsitektur dan Pengembangan Sistem

Pengembangan aplikasi menggunakan metode **Waterfall**, dengan tahapan sebagai berikut:

1. **Analisis Kebutuhan** – Mengidentifikasi kebutuhan sistem dan pengguna.
2. **Perancangan Sistem** – Membuat UML, ERD, dan perancangan arsitektur sistem.
3. **Implementasi** – Mengembangkan backend, pengelolaan database, dan fitur CMS menggunakan Laravel dan Filament.
4. **Pengujian** – Melakukan pengujian fungsional menggunakan metode Black Box Testing.

## 👥 Hak Akses Pengguna

| Role | Hak Akses |
|---|---|
| Super Admin | Mengelola data sekolah dan keseluruhan sistem. |
| Admin Sekolah | Mengelola informasi dan konten website sekolah masing-masing. |

## 🗂️ Struktur Sistem

Aplikasi terdiri dari dua bagian utama:

- **Admin Panel:** Digunakan untuk mengelola data, konten, konfigurasi, dan informasi sekolah.
- **Public Website:** Halaman website yang dapat diakses oleh pengunjung untuk melihat profil, berita, fasilitas, dan informasi sekolah.

## 🧪 Pengujian Sistem

Pengujian dilakukan menggunakan metode **Black Box Testing** untuk memastikan setiap fungsi aplikasi berjalan sesuai kebutuhan dan menghasilkan output yang diharapkan.

## 🎓 Informasi Proyek

**Jenis Proyek:** Academic Project / Tugas Akhir

**Judul Penelitian:** Perancangan dan Implementasi Backend pada Content Management System (CMS) Profil Sekolah Berbasis Web Menggunakan Framework Laravel (Studi Kasus: SD Plus Quantumahad Persis 165 Arjasari, Bandung).

**Metode Pengembangan:** Waterfall

**Fokus Pengembangan:** Backend Development, Multi-Tenant Architecture, Database Management, dan Functional Testing.

---

*Project ini dikembangkan sebagai bagian dari penyelesaian studi S1 Sistem Informasi di Universitas Mercu Buana.*
