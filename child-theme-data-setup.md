# Alur Isi Data Child Theme Berita5

## Plugin

- Wajib aktif: **Velocity Addons** (fitur Statistik Pengunjung aktif; meta `hit` dipakai tab **Populer**, angka "dilihat", dan **Berita Terpopuler** di artikel).
- Plugin **Kirki** (sejak 1.2.0) **tidak diperlukan**. Biarkan **nonaktif**: bila Kirki aktif, tema induk `velocity` tidak mencetak CSS warna/latarnya sendiri.

## Customize

1. **Settings › Reading**: pilih **Your latest posts**. Seluruh beranda dibangun di `index.php` dari tulisan terbaru.
2. **Site Identity**: Logo klien (PNG transparan, melebar ±4:1, tinggi tampil maks. 70 px), site icon. Tanpa logo, nama situs + tagline ditampilkan berwarna tema.
3. **Berita › Warna**:
   - **Warna Tema** (`color_theme`): menu utama, kotak headline, blok "Posts Home Main", judul widget, bingkai blok. Teks di atasnya putih/kuning, jadi pilih warna cukup gelap. Demo **#39960b**.
   - **Warna Tema Kedua** (`color_theme_second`): bar menu sekunder. Demo **#40731c**.
   - Kosong = memakai **Primary Color** induk (bila sudah diubah dari bawaan #1e73be), lalu warna demo. Warna kedua kosong = warna tema digelapkan 25%.
4. **Berita › Iklan** (slot tanpa gambar tidak tampil; link opsional):
   - Iklan Header **728x90** (samping logo, hanya desktop)
   - Iklan Home Kolom Kiri **300x250**, Iklan Home Bawah 1 & 2 **600x80**
   - Iklan Single **600x80** (bawah isi artikel), Iklan Single 2 **300x250** (samping Berita Terpopuler)
   - Iklan Sidebar & Sidebar 2 **300x250**
   - Iklan Archive (sesudah berita ke-1) & Archive 2 (sesudah berita ke-8) **600x60**
5. **Berita › Sosial Media**: link Facebook, Twitter/X, Instagram, YouTube. Kosong = ikon disembunyikan (footer & kotak "Ikuti Kami" di artikel).
6. **Berita › Home**: kategori tiap blok beranda. Judul kosong = nama kategori.
   - Carousel Home (6 berita; bisa *Nonaktifkan*), Home Headline (1 berita besar + 2 terkait), Posts Home Kiri Atas (5 judul), Posts Home Main (11 berita, kolom hijau), Posts Home Kiri Bawah (4 berita), Posts Home Footer 1–3 (3 berita).
   - Pilih kategori berisi **minimal 5 artikel** (Posts Home Main idealnya 11).
7. **Berita › Kolom Kanan**: Posts 1 (5 judul) & Posts 2 (5 berita, urut Tanggal/Tayangan); keduanya bisa *Nonaktifkan*. Tab Populer/Komentar/Tag selalu tampil di atasnya.

## Menu

- **Primary Menu**: Home + kategori berita (±8 item).
- **Secondary Menu** (bar di bawah menu utama): Tentang Kami, Redaksi, Pedoman Media Siber. Kosong = bar tidak tampil.

## Artikel

- Judul, isi, **gambar unggulan** (landscape, mis. 1200x800), kategori, tag.
- Minimal **15 artikel** tersebar di kategori yang dipilih pada Customize › Berita › Home.

## Widgets

- **Main Sidebar**: tampil di bawah blok bawaan kolom kanan (mis. Kalender, Text). Widget tanpa judul aman dipakai.
- **Footer Widget Area 1–3**: kolom footer gelap (mis. Berita Terbaru, Arsip, teks Tentang). Area kosong tidak tampil.
