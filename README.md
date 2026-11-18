# Sehatin

Sehatin adalah website bertema kesehatan yang menyediakan informasi program olahraga, menu makanan sehat, kalkulator BMI, serta rencana aktivitas harian. Project ini dikembangkan secara bertahap dari tampilan web statis sampai halaman dinamis menggunakan PHP.

## Riwayat Pekerjaan Week 1–7

Seluruh task berikut ditandai selesai berdasarkan file dan riwayat perubahan yang terdapat di repository project.

### Week 1 — Inisialisasi dan konsep aplikasi

- [x] **Task 1 — Menentukan ide dan tujuan aplikasi.** Sehatin dibuat sebagai website pendamping gaya hidup sehat dengan fitur olahraga, makanan sehat, BMI, dan agenda harian.
- [x] **Task 2 — Membuat rancangan halaman awal.** Struktur halaman landing, navigasi, hero section, serta bagian fitur mulai disusun.
- [x] **Task 3 — Membuat project awal dan aset dasar.** Project awal dibuat dengan struktur aplikasi web, logo Sehatin, komponen halaman, dan konfigurasi dasar.

### Week 2 — Struktur HTML dan tampilan dasar

- [x] **Task 1 — Membuat struktur HTML halaman utama.** Halaman utama dikembangkan dalam [index.html](./index.html) dengan section landing, fitur, agenda, dan konten Sehatin.
- [x] **Task 2 — Menambahkan halaman latihan dan pendukung.** Halaman [1.html](./1.html) dan [2.html](./2.html) dibuat sebagai halaman latihan terpisah.
- [x] **Task 3 — Menambahkan aset visual dan styling.** Logo, gambar fitur, [style.css](./style.css), serta [2.css](./2.css) digunakan untuk membangun tampilan dan identitas visual website.

### Week 3 — Penyempurnaan tampilan dan interaksi halaman

- [x] **Task 1 — Memperbaiki layout halaman utama.** Section, kartu fitur, navigasi, dan konten landing ditata agar lebih terstruktur.
- [x] **Task 2 — Memperbaiki halaman login dan alur pengguna.** Perbaikan bug dan tampilan halaman login dilakukan pada riwayat pengembangan project.
- [x] **Task 3 — Menyempurnakan tampilan agar responsif.** Spacing, warna, tombol, kartu, serta tampilan pada ukuran layar berbeda diperbaiki.

### Week 4 — JavaScript dan data dinamis client-side

- [x] **Task 1 — Menambahkan pengambilan data menggunakan JavaScript.** [script.js](./script.js) menangani request data dan state proses pemuatan.
- [x] **Task 2 — Menampilkan data ke halaman secara dinamis.** Data program dan konten halaman dirender ke DOM menggunakan JavaScript.
- [x] **Task 3 — Menambahkan interaksi dan penanganan kondisi request.** Loading, error, data kosong, serta interaksi halaman ditangani di sisi client.

### Week 5 — Migrasi ke PHP server-side

- [x] **Task 1 — Membuat halaman PHP.** [index.php](./index.php) disiapkan sebagai entry point untuk menjalankan aplikasi melalui server PHP.
- [x] **Task 2 — Membaca data JSON di server.** [data/program.json](./data/program.json) digunakan sebagai sumber data program dan menu Sehatin.
- [x] **Task 3 — Menampilkan konten dinamis dengan PHP.** Data program diproses di server dan ditampilkan menjadi kartu menu pada halaman Sehatin.

### Week 6 — Penerapan struktur controller, model, dan view

- [x] **Task 1 — Membuat controller aplikasi.** [controller/fileController.php](./controller/fileController.php) menangani alur request dan pemilihan halaman.
- [x] **Task 2 — Membuat model data Sehatin.** [model/sehatin.php](./model/sehatin.php) mengelola data profil dan program yang digunakan aplikasi.
- [x] **Task 3 — Memisahkan tampilan dari logika aplikasi.** Tampilan dinamis dipindahkan ke [view/sehatin-page.php](./view/sehatin-page.php) sehingga struktur project lebih terorganisir.

### Week 7 — Integrasi, upgrade fitur, dan dokumentasi

- [x] **Task 1 — Mengintegrasikan seluruh bagian aplikasi.** Entry point, controller, model, view, data JSON, JavaScript, CSS, dan aset dihubungkan menjadi satu project.
- [x] **Task 2 — Meng-upgrade halaman rekomendasi menu sehat.** [view/sehatin-page.php](./view/sehatin-page.php) menampilkan nama menu, gambar, jenis makanan, tingkat kesulitan, kalori, waktu memasak, dan bahan.
- [x] **Task 3 — Menambahkan keamanan dan penanganan error dasar.** Data keluaran di-escape dengan `htmlspecialchars`, data JSON divalidasi, serta kondisi data gagal atau kosong diberi pesan kepada pengguna.

### Week 9 — Aplikasi Laravel untuk pengelolaan program

- [x] **Task 1 — Menyiapkan fondasi Laravel dan struktur data program.** Project Laravel dilengkapi konfigurasi aplikasi, model [Program](./app/Models/Program.php), serta migration [create_programs_table](./database/migrations/2026_11_11_000000_create_programs_table.php) untuk menyimpan nama dan deskripsi program.
- [x] **Task 2 — Membuat fitur CRUD program.** [ProgramController](./app/Http/Controllers/ProgramController.php) menangani daftar, detail, tambah, edit, dan hapus program. Fitur dihubungkan melalui resource route di [routes/web.php](./routes/web.php) dan halaman Blade pada `resources/views/programs/`.
- [x] **Task 3 — Menambahkan validasi dan alur formulir.** Form tambah dan edit memakai [StoreProgramRequest](./app/Http/Requests/StoreProgramRequest.php) serta [UpdateProgramRequest](./app/Http/Requests/UpdateProgramRequest.php). Setelah data disimpan, diperbarui, atau dihapus, pengguna diarahkan kembali ke daftar dengan pesan status.
## Struktur File Utama

```text
Sehatin/
├── index.html                      # Halaman utama versi client-side
├── index.php                       # Entry point aplikasi PHP
├── controller/
│   └── fileController.php          # Controller request dan halaman
├── model/
│   └── sehatin.php                 # Model data Sehatin
├── view/
│   └── sehatin-page.php            # Tampilan rekomendasi menu dinamis
├── data/
│   └── program.json                # Data program dan menu Sehatin
├── assets/                         # Logo dan gambar fitur
├── style.css                       # Styling halaman utama
├── 2.css                           # Styling halaman latihan 2.html
├── script.js                       # Interaksi dan data client-side
├── 1.html                          # Halaman latihan 1
└── 2.html                          # Halaman latihan 2
```

## Cara Menjalankan

Pastikan PHP sudah terpasang, kemudian jalankan perintah berikut dari folder project:

```sh
php -S localhost:8000
```

Buka `http://localhost:8000/index.php` di browser. Live Server biasa tidak memproses file PHP, sehingga halaman PHP harus dijalankan menggunakan PHP built-in server.

Halaman client-side sebelumnya tetap tersedia melalui [index.html](./index.html).
