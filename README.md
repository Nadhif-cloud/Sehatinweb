# Sehatin

Website Sehatin dibuat dengan HTML, CSS, JavaScript, dan PHP. Halaman `index.html` adalah halaman utama yang sudah ada, sedangkan `index.php` adalah halaman latihan server-side untuk Task 1–3 Week 5.

## Struktur file utama

```text
FitFromHome/
├── index.html          # Struktur halaman dan tempat data API ditampilkan
├── index.php           # Halaman PHP server-side untuk Task 1–3 Week 5
├── classes/
│   └── Sehatin.php     # Class Sehatin untuk profil dan daftar program
├── style.css           # Gaya halaman
├── script.js           # Fetch API, state request, render DOM, dan interaksi halaman
├── data/
│   └── program.json    # Data resep Sehatin dalam format JSON
├── assets/             # Gambar dan logo lokal Sehatin
├── 1.html              # Halaman latihan terpisah
├── 2.html              # Halaman latihan terpisah
└── 2.css               # Gaya untuk halaman latihan 2.html
```

File latihan terpisah tidak digunakan oleh halaman utama.

## Task 1–3 Week 6: PHP class dan object

1. **Class dan object:** class `Sehatin` di `classes/Sehatin.php` menyimpan profil serta daftar program sebagai property. `index.php` memuat class tersebut, membuat object, dan mengakses datanya melalui `getProfile()` dan `getPrograms()`.
2. **Data halaman:** `index.php` membaca `data/program.json` di server menggunakan PHP, lalu memberikan daftar menu ke object `Sehatin`.
3. **Konten dinamis:** PHP menggunakan data dari object untuk menghasilkan kartu menu sebagai HTML, tanpa mengubah desain halaman.

Jalankan dari folder project dengan PHP tersedia:

```sh
php -S localhost:8000
```

Lalu buka `http://localhost:8000/index.php`. **Live Server** biasa tidak memproses PHP; halaman harus dijalankan melalui PHP server.

`index.html` tetap tersedia sebagai halaman client-side sebelumnya dan bisa dibuka melalui Live Server.
