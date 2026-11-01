# CMS Profil Sekolah Berbasis Web (Multi-Tenant)

Aplikasi Content Management System (CMS) berbasis web yang dikembangkan untuk memudahkan sekolah dalam mengelola dan mempublikasikan informasi profil sekolah secara mandiri.

Sistem ini menerapkan konsep **Multi-Tenant Architecture**, yang memungkinkan beberapa sekolah menggunakan satu platform CMS dengan pengelolaan data yang terpisah untuk setiap sekolah.

Pengembangan project berfokus pada **Backend Development**, meliputi perancangan database, implementasi logika bisnis, pengelolaan data, manajemen hak akses, serta integrasi antara backend dan frontend menggunakan Laravel.

---

## 1. Project Overview

CMS Profil Sekolah dikembangkan sebagai solusi untuk membantu sekolah dalam mengelola informasi dan publikasi digital melalui satu platform terintegrasi.

Sebelumnya, penyampaian informasi sekolah seperti profil, berita, fasilitas, tenaga pendidik, dan informasi Penerimaan Peserta Didik Baru (PPDB) masih memiliki keterbatasan dalam pengelolaannya.

Melalui sistem ini, setiap sekolah dapat memiliki website profil yang dapat dikelola dan dikustomisasi melalui admin panel tanpa harus membangun aplikasi secara terpisah.

**Project Information**

| Informasi | Keterangan |
|---|---|
| Project Type | Academic Project / Final Project |
| Application | Web-Based Content Management System |
| Architecture | Multi-Tenant |
| Development Method | Waterfall |
| Main Focus | Backend Development |
| Framework | Laravel |
| Admin Panel | Filament |
| Database | MySQL |

## 2. Key Features

Berikut merupakan fitur utama yang dikembangkan dalam aplikasi:

- **Multi-Tenant Management:** Mendukung beberapa sekolah dalam satu platform dengan pemisahan data berdasarkan identitas sekolah.
- **Role-Based Access:** Pembagian hak akses antara Super Admin dan Admin Sekolah.
- **School Profile Management:** Pengelolaan informasi dan identitas profil sekolah.
- **Content Management:** Pengelolaan berita, artikel, dan informasi kegiatan sekolah.
- **Teacher Management:** Pengelolaan data tenaga pendidik.
- **Subject Management:** Pengelolaan data mata pelajaran.
- **PPDB Management:** Pengelolaan informasi dan data pendaftaran peserta didik baru.
- **Website Customization:** Pengaturan tampilan website, termasuk warna, navigasi, dan footer.
- **Public Website:** Menampilkan informasi sekolah kepada pengunjung melalui website publik.

## 3. Backend Implementation

Pengembangan backend menggunakan Laravel dengan arsitektur Model-View-Controller (MVC) dan Filament sebagai admin panel untuk pengelolaan data.

Implementasi backend mencakup beberapa aspek berikut:

### Multi-Tenant Architecture
Menerapkan konsep multi-tenant untuk memungkinkan beberapa sekolah menggunakan satu aplikasi CMS. Pemisahan data dilakukan berdasarkan `school_id` sehingga setiap sekolah hanya dapat mengelola data yang menjadi kewenangannya.

### Role-Based Access Control
Mengimplementasikan pembagian hak akses pengguna berdasarkan peran:

- **Super Admin:** Memiliki akses untuk mengelola data sekolah dan keseluruhan sistem.
- **Admin Sekolah:** Memiliki akses untuk mengelola informasi dan konten website sekolah masing-masing.

### Database Management
Mengelola struktur dan relasi database menggunakan MySQL dan Eloquent ORM untuk mendukung hubungan antar entitas serta kebutuhan pengelolaan data aplikasi.

### CRUD Operations
Mengimplementasikan operasi Create, Read, Update, dan Delete pada modul pengelolaan data sekolah, profil sekolah, berita, guru, mata pelajaran, dan pengaturan website.

### Data Filtering & Isolation
Menerapkan pembatasan akses data berdasarkan identitas sekolah menggunakan mekanisme relasi dan filtering data agar pengelolaan setiap tenant tetap terpisah.

### Dynamic Website Configuration
Mengimplementasikan pengaturan konten dan tampilan website melalui admin panel sehingga setiap sekolah dapat menyesuaikan identitas visual website masing-masing.

## 4. Application Preview

Bagian ini menampilkan beberapa hasil implementasi aplikasi, baik dari sisi admin panel maupun website publik.

### Admin Dashboard
![Admin Dashboard](screenshots/dashboard.png)

### School Management
![School Management](screenshots/school-management.png)

### Data Management
![Data Management](screenshots/data-management.png)

### School Profile Configuration
![School Profile Configuration](screenshots/school-settings.png)

### Public Website
![Public Website](screenshots/public-website.png)

## 5. Technology Stack

Teknologi dan tools yang digunakan dalam pengembangan aplikasi:

| Technology | Description |
|---|---|
| PHP | Backend Programming Language |
| Laravel | Backend Web Framework |
| Filament | Admin Panel Development |
| MySQL | Relational Database Management System |
| Eloquent ORM | Database Interaction |
| Blade | Server-Side Templating |
| Tailwind CSS | UI Styling |
| HTML | Web Structure |
| CSS | Web Styling |
| JavaScript | Frontend Interactivity |

## 6. System Architecture

Aplikasi menggunakan arsitektur **Model-View-Controller (MVC)** dari Laravel untuk memisahkan pengelolaan data, logika aplikasi, dan tampilan.

Pada implementasi multi-tenant, setiap sekolah diidentifikasi melalui `school_id` sebagai dasar pemisahan dan pembatasan data.

Alur umum sistem:

1. Pengguna mengakses admin panel atau website publik.
2. Sistem mengidentifikasi pengguna atau sekolah berdasarkan konteks akses.
3. Controller memproses permintaan dan menjalankan logika aplikasi.
4. Model berinteraksi dengan database melalui Eloquent ORM.
5. Data diproses sesuai hak akses dan identitas sekolah.
6. Sistem mengembalikan hasil dalam bentuk tampilan admin panel atau website publik.

### Multi-Tenant Concept

Setiap sekolah menggunakan satu platform CMS dengan data yang dikelola secara terpisah berdasarkan identitas tenant.

Contoh entitas utama:

- School
- User
- SchoolProfile
- Teacher
- Post
- Subject
- Registration

![System Architecture](screenshots/system-architecture.png)

## 7. Database Design (ERD)

Perancangan database dilakukan menggunakan Entity Relationship Diagram (ERD) untuk menggambarkan struktur tabel, atribut, dan hubungan antar entitas dalam sistem.

Database dirancang untuk mendukung kebutuhan pengelolaan data sekolah serta penerapan konsep multi-tenant.

Beberapa entitas utama yang digunakan antara lain:

- **School:** Menyimpan data identitas sekolah sebagai tenant.
- **User:** Menyimpan data pengguna dan informasi hak akses.
- **SchoolProfile:** Menyimpan informasi profil masing-masing sekolah.
- **Teacher:** Menyimpan data tenaga pendidik.
- **Post:** Menyimpan berita dan artikel sekolah.
- **Subject:** Menyimpan data mata pelajaran.
- **Registration:** Menyimpan data pendaftaran peserta didik baru.

![Entity Relationship Diagram](screenshots/erd.png)

## 8. Testing

Pengujian sistem dilakukan menggunakan metode **Black Box Testing** untuk memastikan fungsi aplikasi berjalan sesuai kebutuhan dan menghasilkan output yang diharapkan.

Pengujian difokuskan pada:

- Pengujian fungsi login dan hak akses pengguna.
- Pengujian operasi CRUD pada setiap modul.
- Pengujian pengelolaan data berdasarkan identitas sekolah.
- Pengujian validasi input pada form.
- Pengujian fungsi pengaturan profil dan tampilan website.
- Pengujian tampilan dan akses informasi pada website publik.

## 9. Installation & Setup

### Prerequisites

Pastikan perangkat telah memiliki:

- PHP sesuai persyaratan versi Laravel yang digunakan.
- Composer.
- MySQL.
- Node.js dan NPM.
- Git.

### Installation Steps

**1. Clone Repository**

```bash
git clone https://github.com/USERNAME/web-cms-main.git
```

**2. Masuk ke Direktori Project**

```bash
cd web-cms-main
```

**3. Install Dependencies**

```bash
composer install
npm install
```

**4. Konfigurasi Environment**

Salin file `.env.example` menjadi `.env`.

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

**5. Generate Application Key**

```bash
php artisan key:generate
```

**6. Konfigurasi Database**

Buat database MySQL, kemudian sesuaikan konfigurasi berikut pada file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

**7. Jalankan Database Migration**

```bash
php artisan migrate
```

**8. Jalankan Aplikasi**

Terminal pertama:

```bash
php artisan serve
```

Terminal kedua:

```bash
npm run dev
```

Aplikasi dapat diakses melalui:

```text
http://127.0.0.1:8000
```

---

## Project Author

**Fahri Rabani**

Fresh Graduate – S1 Sistem Informasi, Universitas Mercu Buana.

Project ini dikembangkan sebagai bagian dari penyelesaian studi S1 Sistem Informasi dengan fokus pada perancangan dan implementasi backend CMS Profil Sekolah berbasis web menggunakan Laravel.

**Areas of Interest:** Backend Development, Web Development, Database Management, and System Analysis.
