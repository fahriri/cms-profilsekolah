# CMS Profil Sekolah Berbasis Web (Multi-Tenant)

Aplikasi **Content Management System (CMS) Profil Sekolah** berbasis web yang dikembangkan untuk memudahkan sekolah dalam mengelola dan mempublikasikan informasi profil sekolah secara mandiri melalui satu platform terintegrasi.

Sistem ini menerapkan konsep **Multi-Tenant Architecture**, yang memungkinkan beberapa sekolah menggunakan satu platform CMS dengan pengelolaan dan pemisahan data masing-masing sekolah.

Aplikasi dikembangkan menggunakan Laravel dengan mencakup implementasi backend dan frontend. Fokus utama pengembangan terletak pada **Backend Development**, meliputi perancangan database, implementasi logika aplikasi, pengelolaan data, manajemen hak akses, serta penerapan mekanisme pemisahan data antar sekolah.

---

## 1. Project Overview

CMS Profil Sekolah dikembangkan sebagai solusi untuk membantu sekolah dalam mengelola informasi dan publikasi digital melalui satu platform terintegrasi.

Penyampaian informasi sekolah seperti profil, berita, kegiatan, fasilitas, tenaga pendidik, dan informasi Penerimaan Peserta Didik Baru (PPDB) membutuhkan media digital yang mudah diakses dan dikelola.

Melalui aplikasi ini, setiap sekolah dapat memiliki website profil yang dapat dikelola dan dikustomisasi melalui admin panel tanpa harus membangun website secara terpisah.

### Project Information

| Informasi | Keterangan |
|---|---|
| Project Type | Academic Project / Final Project |
| Application Type | Web-Based Application |
| Architecture | Multi-Tenant |
| Development Method | Waterfall |
| Development Scope | Full Web Application |
| Main Focus | Backend Development |
| Framework | Laravel |
| Admin Panel | Filament |
| Database | MySQL |

## 2. Key Features

Berikut merupakan fitur utama yang dikembangkan dalam aplikasi:

- **Multi-Tenant Management:** Mendukung beberapa sekolah dalam satu platform dengan pemisahan data berdasarkan identitas sekolah.
- **Role-Based Access Control:** Pembagian hak akses antara Super Admin dan Admin Sekolah.
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

Menerapkan konsep multi-tenant untuk memungkinkan beberapa sekolah menggunakan satu aplikasi CMS. Pemisahan data dilakukan berdasarkan `school_id` sehingga setiap sekolah memiliki ruang pengelolaan data masing-masing.

### Role-Based Access Control

Mengimplementasikan pembagian hak akses pengguna berdasarkan peran:

- **Super Admin:** Memiliki akses untuk mengelola data sekolah dan keseluruhan sistem.
- **Admin Sekolah:** Memiliki akses untuk mengelola informasi dan konten website sekolah masing-masing.

### Database Management

Mengelola struktur dan relasi database menggunakan MySQL dan Eloquent ORM untuk mendukung hubungan antarentitas serta kebutuhan pengelolaan data aplikasi.

### CRUD Operations

Mengimplementasikan operasi Create, Read, Update, dan Delete pada modul pengelolaan data sekolah, profil sekolah, berita, guru, mata pelajaran, dan pengaturan website.

### Data Filtering & Isolation

Menerapkan pembatasan dan penyaringan data berdasarkan identitas sekolah menggunakan relasi dan mekanisme filtering pada aplikasi untuk menjaga pemisahan data antar-tenant.

### Dynamic Website Configuration

Mengimplementasikan pengaturan konten dan tampilan website melalui admin panel sehingga setiap sekolah dapat menyesuaikan identitas visual website masing-masing.

## 4. Application Preview

Bagian ini menampilkan hasil implementasi aplikasi dari sisi admin panel dan website publik.

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
| Laravel | Web Application Framework |
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

### Application Flow

1. Pengguna mengakses admin panel atau website publik.
2. Sistem mengidentifikasi pengguna atau sekolah berdasarkan konteks akses.
3. Controller memproses permintaan dan menjalankan logika aplikasi.
4. Model berinteraksi dengan database melalui Eloquent ORM.
5. Data diproses sesuai hak akses dan identitas sekolah.
6. Sistem mengembalikan hasil dalam bentuk tampilan admin panel atau website publik.

### Multi-Tenant Architecture

Setiap sekolah menggunakan satu platform CMS dengan data yang dikelola secara terpisah berdasarkan identitas tenant.

Entitas utama yang mendukung implementasi sistem meliputi:

- School
- User
- SchoolProfile
- Teacher
- Post
- Subject
- Registration

![System Architecture](screenshots/system-architecture.png)

## 7. Database Design (ERD)

Perancangan database dilakukan menggunakan Entity Relationship Diagram (ERD) untuk menggambarkan struktur tabel, atribut, dan hubungan antarentitas dalam sistem.

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
- Pengujian akses informasi pada website publik.

---

## Project Author

**Fahri Rabani**

Fresh Graduate – S1 Sistem Informasi, Universitas Mercu Buana.

Project ini dikembangkan sebagai bagian dari penyelesaian studi S1 Sistem Informasi dengan fokus pada perancangan dan implementasi backend CMS Profil Sekolah berbasis web menggunakan Laravel.

**Areas of Interest:** Backend Development, Web Development, Database Management, and System Analysis.
