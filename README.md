# 🏥 SADEWA BEDS

## Sistem Informasi Ketersediaan Kamar Rawat Inap RSKIA Sadewa

<p align="center">
  <img src="public/assets/logo.png" alt="RSKIA Sadewa Logo" width="120">
</p>

<p align="center">
  <strong>Layanan Informasi Real-Time Ketersediaan Tempat Tidur Rawat Inap</strong>
</p>

<p align="center">
  <a href="#latar-belakang">Latar Belakang</a> •
  <a href="#fitur">Fitur</a> •
  <a href="#teknologi">Teknologi</a> •
  <a href="#instalasi">Instalasi</a> •
  <a href="#penggunaan">Penggunaan</a>
</p>

---

## 📋 Daftar Isi

1. [Latar Belakang](#-latar-belakang)
2. [Tujuan & Manfaat](#-tujuan--manfaat)
3. [Arsitektur Sistem](#-arsitektur-sistem)
4. [Konsep User (Publik)](#-konsep-user-publik)
5. [Konsep Admin (Petugas RS)](#-konsep-admin-petugas-rs)
6. [Infrastruktur & Teknologi](#-infrastruktur--teknologi)
7. [Database Schema](#-database-schema)
8. [Instalasi & Konfigurasi](#-instalasi--konfigurasi)
9. [Penggunaan Aplikasi](#-penggunaan-aplikasi)
10. [API & Integrasi](#-api--integrasi)
11. [Screenshot](#-screenshot)
12. [Kontributor](#-kontributor)

---

## 📖 Latar Belakang

### Permasalahan

Rumah Sakit Khusus Ibu dan Anak (RSKIA) Sadewa menghadapi tantangan dalam menyampaikan informasi ketersediaan kamar rawat inap kepada masyarakat. Beberapa permasalahan yang dihadapi:

1. **Keterbatasan Akses Informasi** - Masyarakat harus menghubungi rumah sakit secara langsung (telepon/datang) untuk mengetahui ketersediaan kamar
2. **Informasi Tidak Real-Time** - Data yang diberikan sering kali sudah tidak akurat karena perubahan status kamar yang dinamis
3. **Beban Kerja Petugas** - Petugas harus menjawab pertanyaan berulang tentang ketersediaan kamar
4. **Perencanaan Kunjungan** - Keluarga pasien kesulitan merencanakan perawatan karena ketidakpastian ketersediaan kamar

### Solusi

**Sadewa Beds** hadir sebagai solusi berupa aplikasi web berbasis Laravel yang menyediakan:

-   ✅ Informasi ketersediaan kamar **real-time** yang dapat diakses publik
-   ✅ Dashboard admin untuk petugas RS memperbarui status kamar dengan cepat
-   ✅ Antarmuka yang **responsif** dan mudah digunakan di berbagai perangkat
-   ✅ Sistem **audit log** untuk melacak setiap perubahan status
-   ✅ **Analytics** untuk analisis tingkat hunian kamar

---

## 🎯 Tujuan & Manfaat

### Tujuan Umum

Menyediakan layanan informasi ketersediaan kamar rawat inap yang akurat, real-time, dan mudah diakses oleh masyarakat.

### Tujuan Khusus

1. Membangun aplikasi web yang informatif dan user-friendly
2. Menyediakan dashboard admin yang efisien untuk pengelolaan data kamar
3. Memberikan transparansi informasi kepada masyarakat
4. Mengurangi beban kerja petugas dalam menjawab pertanyaan rutin

### Manfaat

| Stakeholder      | Manfaat                                                 |
| ---------------- | ------------------------------------------------------- |
| **Masyarakat**   | Akses informasi 24/7, perencanaan kunjungan lebih baik  |
| **Petugas RS**   | Kemudahan update status, mengurangi pertanyaan berulang |
| **Manajemen RS** | Data analytics untuk pengambilan keputusan              |
| **Rumah Sakit**  | Peningkatan kualitas layanan dan transparansi           |

---

## 🏗 Arsitektur Sistem

```
┌─────────────────────────────────────────────────────────────────┐
│                        SADEWA BEDS                               │
├─────────────────────────────────────────────────────────────────┤
│                                                                  │
│  ┌──────────────┐         ┌──────────────┐                      │
│  │   PUBLIC     │         │    ADMIN     │                      │
│  │   (User)     │         │  (Petugas)   │                      │
│  └──────┬───────┘         └──────┬───────┘                      │
│         │                        │                               │
│         ▼                        ▼                               │
│  ┌─────────────────────────────────────────┐                    │
│  │           LARAVEL APPLICATION            │                    │
│  │  ┌─────────┐ ┌─────────┐ ┌─────────┐   │                    │
│  │  │ Routes  │ │ Control │ │  Views  │   │                    │
│  │  │         │ │   lers  │ │ (Blade) │   │                    │
│  │  └────┬────┘ └────┬────┘ └────┬────┘   │                    │
│  │       │           │           │         │                    │
│  │       ▼           ▼           ▼         │                    │
│  │  ┌─────────────────────────────────┐   │                    │
│  │  │      ELOQUENT ORM (Models)      │   │                    │
│  │  └────────────────┬────────────────┘   │                    │
│  └───────────────────┼────────────────────┘                    │
│                      │                                          │
│                      ▼                                          │
│  ┌─────────────────────────────────────────┐                    │
│  │           MySQL / SQLite                 │                    │
│  │  ┌────────┐ ┌────────┐ ┌────────────┐  │                    │
│  │  │ rooms  │ │ audits │ │ room_types │  │                    │
│  │  └────────┘ └────────┘ └────────────┘  │                    │
│  └─────────────────────────────────────────┘                    │
│                                                                  │
└─────────────────────────────────────────────────────────────────┘
```

---

## 👤 Konsep User (Publik)

### Target Pengguna

-   Keluarga pasien yang akan melakukan rawat inap
-   Calon pasien yang membutuhkan informasi ketersediaan kamar
-   Masyarakat umum yang membutuhkan referensi rumah sakit

### Halaman User

#### 1. Homepage (`/`)

-   Hero section dengan statistik real-time
-   Daftar kamar tersedia
-   Informasi tentang layanan
-   Navigasi ke halaman lain

#### 2. Ketersediaan Kamar (`/rooms`)

-   Daftar semua kamar dengan status
-   Filter berdasarkan status (Tersedia, Terisi, Dibersihkan)
-   Filter berdasarkan lantai
-   Statistik ringkasan

#### 3. Detail Kamar (`/rooms/{id}`)

-   Informasi lengkap kamar
-   Fasilitas kamar
-   Status terkini
-   Kamar serupa yang tersedia

#### 4. Tentang Layanan (`/tentang`)

-   Penjelasan tentang layanan
-   Cara menggunakan
-   Informasi status kamar

### User Flow

```
┌─────────┐     ┌────────────┐     ┌─────────────┐     ┌──────────┐
│Homepage │ ──▶ │Daftar Kamar│ ──▶ │Detail Kamar │ ──▶ │ Informasi│
│         │     │            │     │             │     │ Lengkap  │
└─────────┘     └────────────┘     └─────────────┘     └──────────┘
     │                                    │
     │          ┌─────────────┐          │
     └────────▶ │Tentang Layanan│◀────────┘
                └─────────────┘
```

### Status Kamar

| Status             | Warna  | Keterangan                       |
| ------------------ | ------ | -------------------------------- |
| 🟢 **Tersedia**    | Hijau  | Kamar siap digunakan pasien baru |
| 🔴 **Terisi**      | Merah  | Kamar sedang digunakan pasien    |
| 🟡 **Dibersihkan** | Kuning | Kamar dalam proses pembersihan   |

---

## 🔐 Konsep Admin (Petugas RS)

### Akses Admin

-   URL Login: `/login`
-   Hanya user dengan role `admin` yang dapat mengakses
-   Autentikasi menggunakan Laravel Breeze

### Menu Admin

#### 1. Dashboard (`/admin/dashboard`)

-   Statistik keseluruhan kamar
-   Tingkat okupansi
-   Grafik aktivitas 7 hari terakhir
-   Aktivitas terbaru
-   Distribusi status

#### 2. Manajemen Kamar (`/admin/rooms`)

-   CRUD kamar (Create, Read, Update, Delete)
-   Quick status update (klik untuk ganti status)
-   Filter dan pencarian
-   Responsive table/cards

#### 3. Tipe Kamar (`/admin/room-types`)

-   CRUD tipe kamar
-   Atur urutan tampil
-   Aktifkan/nonaktifkan tipe
-   Proteksi hapus jika digunakan

#### 4. Audit Log (`/admin/audits`)

-   Riwayat semua perubahan status
-   Informasi user yang melakukan perubahan
-   Filter berdasarkan tanggal dan kamar
-   Export data (opsional)

#### 5. Analytics (`/admin/analytics`)

-   Rata-rata okupansi
-   Total perubahan status
-   Grafik perubahan per hari
-   Distribusi per lantai
-   Tingkat ketersediaan

### Admin Flow

```
┌─────────┐     ┌───────────────┐
│  Login  │ ──▶ │   Dashboard   │
└─────────┘     └───────┬───────┘
                        │
        ┌───────────────┼───────────────┐
        ▼               ▼               ▼
┌───────────────┐ ┌───────────┐ ┌───────────┐
│Manajemen Kamar│ │ Audit Log │ │ Analytics │
└───────┬───────┘ └───────────┘ └───────────┘
        │
        ▼
┌───────────────┐
│  Tipe Kamar   │
└───────────────┘
```

### Fitur Admin

| Fitur             | Deskripsi                         |
| ----------------- | --------------------------------- |
| **Quick Status**  | Ubah status kamar dengan 1 klik   |
| **Audit Trail**   | Semua perubahan tercatat otomatis |
| **Responsive**    | Dapat diakses dari mobile         |
| **Dynamic Types** | Tipe kamar dapat dikelola         |
| **Analytics**     | Visualisasi data dengan Chart.js  |

---

## 🛠 Infrastruktur & Teknologi

### Tech Stack

```
┌─────────────────────────────────────────────────────────────┐
│                      FRONTEND                                │
├─────────────────────────────────────────────────────────────┤
│  • Blade Templating (Laravel)                               │
│  • Tailwind CSS (via Vite)                                  │
│  • Alpine.js (Interactivity)                                │
│  • Chart.js (Visualization)                                 │
│  • Plus Jakarta Sans (Typography)                           │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│                      BACKEND                                 │
├─────────────────────────────────────────────────────────────┤
│  • Laravel 11.x (PHP Framework)                             │
│  • Laravel Breeze (Authentication)                          │
│  • Eloquent ORM (Database)                                  │
│  • Laravel Middleware (Authorization)                       │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│                      DATABASE                                │
├─────────────────────────────────────────────────────────────┤
│  • SQLite (Development) / MySQL (Production)                │
│  • Migrations (Schema Management)                           │
│  • Seeders (Initial Data)                                   │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│                      TOOLS                                   │
├─────────────────────────────────────────────────────────────┤
│  • Vite (Asset Bundling)                                    │
│  • NPM (Package Manager)                                    │
│  • Composer (PHP Dependencies)                              │
│  • Git (Version Control)                                    │
└─────────────────────────────────────────────────────────────┘
```

### Requirement

| Software | Versi Minimum      |
| -------- | ------------------ |
| PHP      | 8.2+               |
| Composer | 2.x                |
| Node.js  | 18.x+              |
| NPM      | 9.x+               |
| MySQL    | 8.0+ (atau SQLite) |

### Directory Structure

```
sadewa-beds/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── RoomController.php
│   │   │   │   ├── RoomTypeController.php
│   │   │   │   ├── AuditController.php
│   │   │   │   └── AnalyticsController.php
│   │   │   └── PublicController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php
│   └── Models/
│       ├── Room.php
│       ├── RoomType.php
│       ├── Audit.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── rooms/
│   │   │   ├── room-types/
│   │   │   ├── audits.blade.php
│   │   │   └── analytics.blade.php
│   │   ├── user/
│   │   │   ├── home.blade.php
│   │   │   ├── rooms.blade.php
│   │   │   ├── detail.blade.php
│   │   │   └── about.blade.php
│   │   ├── components/
│   │   │   ├── navbar.blade.php
│   │   │   └── admin-layout.blade.php
│   │   └── auth/
│   │       └── login.blade.php
│   └── css/
│       └── app.css
├── routes/
│   └── web.php
├── public/
│   └── assets/
│       └── logo.png
└── README.md
```

---

## 🗄 Database Schema

### Entity Relationship Diagram

```
┌──────────────────┐       ┌──────────────────┐
│      users       │       │     rooms        │
├──────────────────┤       ├──────────────────┤
│ id (PK)          │       │ id (PK)          │
│ name             │       │ name             │
│ email            │◀──┐   │ room_type        │
│ password         │   │   │ status           │
│ role             │   │   │ floor            │
│ created_at       │   │   │ bed_count        │
│ updated_at       │   │   │ facilities       │
└──────────────────┘   │   │ notes            │
                       │   │ created_at       │
                       │   │ updated_at       │
                       │   └────────┬─────────┘
                       │            │
┌──────────────────┐   │            │
│   room_types     │   │            │
├──────────────────┤   │            │
│ id (PK)          │   │            │
│ name             │   │            │
│ description      │   │            │
│ sort_order       │   │            │
│ is_active        │   │            │
│ created_at       │   │            │
│ updated_at       │   │            │
└──────────────────┘   │            │
                       │            │
┌──────────────────────┴────────────┴─────────┐
│                  audits                      │
├─────────────────────────────────────────────┤
│ id (PK)                                     │
│ room_id (FK) ──────────────────────────────▶│
│ user_id (FK) ──────────────────────────────▶│
│ old_status                                  │
│ new_status                                  │
│ created_at                                  │
│ updated_at                                  │
└─────────────────────────────────────────────┘
```

### Tabel Detail

#### `rooms`

| Column     | Type    | Description                   |
| ---------- | ------- | ----------------------------- |
| id         | bigint  | Primary key                   |
| name       | string  | Nama kamar                    |
| room_type  | string  | Tipe kamar                    |
| status     | enum    | tersedia, terisi, dibersihkan |
| floor      | integer | Nomor lantai                  |
| bed_count  | integer | Jumlah tempat tidur           |
| facilities | text    | Fasilitas (comma separated)   |
| notes      | text    | Catatan tambahan              |

#### `audits`

| Column     | Type   | Description          |
| ---------- | ------ | -------------------- |
| id         | bigint | Primary key          |
| room_id    | bigint | Foreign key ke rooms |
| user_id    | bigint | Foreign key ke users |
| old_status | string | Status sebelumnya    |
| new_status | string | Status baru          |

#### `room_types`

| Column      | Type    | Description   |
| ----------- | ------- | ------------- |
| id          | bigint  | Primary key   |
| name        | string  | Nama tipe     |
| description | string  | Deskripsi     |
| sort_order  | integer | Urutan tampil |
| is_active   | boolean | Status aktif  |

---

## 🚀 Instalasi & Konfigurasi

### Prasyarat

Pastikan sistem Anda sudah terinstal:

-   PHP 8.2 atau lebih baru
-   Composer
-   Node.js & NPM
-   Git

### Langkah Instalasi

#### 1. Clone Repository

```bash
git clone https://github.com/your-username/sadewa-beds.git
cd sadewa-beds
```

#### 2. Install Dependencies PHP

```bash
composer install
```

#### 3. Install Dependencies JavaScript

```bash
npm install
```

#### 4. Konfigurasi Environment

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

#### 5. Konfigurasi Database

Edit file `.env` sesuai kebutuhan:

**Untuk SQLite (Development):**

```env
DB_CONNECTION=sqlite
# DB_DATABASE akan otomatis menggunakan database/database.sqlite
```

**Untuk MySQL (Production):**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sadewa_beds
DB_USERNAME=root
DB_PASSWORD=your_password
```

#### 6. Jalankan Migrasi & Seeder

```bash
# Buat tabel database
php artisan migrate

# Isi data awal
php artisan db:seed
```

#### 7. Build Assets

```bash
# Development (dengan hot reload)
npm run dev

# Production
npm run build
```

#### 8. Jalankan Server

```bash
php artisan serve
```

Aplikasi dapat diakses di: `http://127.0.0.1:8000`

### Akun Default

| Role  | Email            | Password |
| ----- | ---------------- | -------- |
| Admin | admin@sadewa.com | password |

---

## 📱 Penggunaan Aplikasi

### Untuk Publik (User)

1. **Akses Homepage**

    - Buka browser dan kunjungi `http://127.0.0.1:8000`
    - Lihat statistik ketersediaan kamar secara real-time

2. **Lihat Daftar Kamar**

    - Klik menu "Ketersediaan Kamar"
    - Gunakan filter untuk mencari kamar tertentu
    - Status kamar ditampilkan dengan warna berbeda

3. **Detail Kamar**
    - Klik pada kartu kamar untuk melihat detail
    - Lihat fasilitas dan catatan kamar
    - Lihat kamar serupa yang tersedia

### Untuk Admin (Petugas RS)

1. **Login**

    - Akses `/login`
    - Masukkan email dan password admin

2. **Update Status Kamar**

    - Buka menu "Manajemen Kamar"
    - Klik badge status pada kamar
    - Pilih status baru (Tersedia/Terisi/Dibersihkan)

3. **Tambah Kamar Baru**

    - Klik tombol "Tambah Kamar"
    - Isi form dengan data kamar
    - Klik "Simpan"

4. **Kelola Tipe Kamar**

    - Buka menu "Tipe Kamar"
    - Tambah/Edit/Hapus tipe kamar
    - Atur urutan tampil

5. **Lihat Audit Log**

    - Buka menu "Audit Log"
    - Lihat riwayat perubahan status
    - Filter berdasarkan tanggal

6. **Analytics**
    - Buka menu "Analytics"
    - Lihat grafik dan statistik
    - Analisis tingkat hunian

---

## 🔌 API & Integrasi

### Quick Status Update (AJAX)

```http
PATCH /admin/rooms/{id}/status
Content-Type: application/json
X-CSRF-TOKEN: {token}

{
  "status": "tersedia" | "terisi" | "dibersihkan"
}
```

### Response

```json
{
    "success": true,
    "room": {
        "id": 1,
        "name": "Kamar Melati 101",
        "status": "tersedia"
    }
}
```

---

## 📸 Screenshot

### Halaman Publik

| Homepage                        | Daftar Kamar          |
| ------------------------------- | --------------------- |
| Hero dengan statistik real-time | Filter dan grid kamar |

| Detail Kamar       | Tentang Layanan    |
| ------------------ | ------------------ |
| Info lengkap kamar | Panduan penggunaan |

### Halaman Admin

| Dashboard          | Manajemen Kamar |
| ------------------ | --------------- |
| Statistik & grafik | CRUD kamar      |

| Tipe Kamar  | Analytics        |
| ----------- | ---------------- |
| Kelola tipe | Visualisasi data |

---

## 🎨 Design System

### Warna

| Nama         | Hex       | Penggunaan                  |
| ------------ | --------- | --------------------------- |
| Primary      | `#0CA15C` | Aksen utama, CTA, success   |
| Primary Dark | `#0B6B40` | Hover states                |
| Background   | `#F5F7F9` | Background halaman          |
| Red          | `#EF4444` | Status terisi, error        |
| Amber        | `#F59E0B` | Status dibersihkan, warning |

### Typography

-   **Font Family**: Plus Jakarta Sans
-   **Heading**: 700-800 weight
-   **Body**: 400-500 weight

### Responsive Breakpoints

| Breakpoint | Width   | Device        |
| ---------- | ------- | ------------- |
| Default    | < 640px | Mobile        |
| `sm:`      | 640px+  | Tablet        |
| `md:`      | 768px+  | Small Desktop |
| `lg:`      | 1024px+ | Desktop       |

---

## 👥 Kontributor

| Nama         | Role                   |
| ------------ | ---------------------- |
| Developer    | Full Stack Development |
| RSKIA Sadewa | Client & Requirement   |

---

## 📄 Lisensi

Proyek ini dikembangkan untuk RSKIA Sadewa.

---

## 📞 Kontak

**RSKIA Sadewa**

-   Alamat: Jl. Raya Sadewa No. 123, Yogyakarta
-   Telepon: (0274) 123-4567
-   Website: [rskia-sadewa.com](https://rskia-sadewa.com)

---

<p align="center">
  <strong>© 2025 RSKIA Sadewa - Layanan Informasi Ketersediaan Kamar Rawat Inap</strong>
</p>
