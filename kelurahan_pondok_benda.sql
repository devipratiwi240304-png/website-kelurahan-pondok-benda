-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Okt 2025 pada 16.01
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kelurahan_pondok_benda`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama_lengkap`, `created_at`) VALUES
(1, 'kelurahan', '$2a$12$Km1JSk1I8erl28kFNWaCNOUOcSqKoCSoRd9uRrzOHu3z9WHhvSgK2', 'Admin Kelurahan', '2025-05-25 15:20:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `link` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `tanggal`, `link`, `gambar`) VALUES
(2, 'The Lord of the Rings', '', '2025-06-03 15:11:20', 'https://megapolitan.kompas.com/read/2025/06/03/21362011/sempat-hubungi-keluarga-warga-gagal-selamatkan-lansia-yang-tewas-dalam', 'WhatsApp Image 2025-06-03 at 15.38.46_6fb5bd60.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `counter_data`
--

CREATE TABLE `counter_data` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `nilai` varchar(50) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `ikon` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `counter_data`
--

INSERT INTO `counter_data` (`id`, `judul`, `nilai`, `satuan`, `ikon`) VALUES
(1, 'Jumlah Penduduk', '45679', '+', 'fa-users'),
(2, 'Kepadatan Penduduk', '11063', 'per KM', 'fa-home'),
(3, 'Luas Wilayah', '2413', 'Ha', 'fa-users');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cuaca_info`
--

CREATE TABLE `cuaca_info` (
  `id` int(11) NOT NULL,
  `ikon` varchar(50) DEFAULT NULL,
  `kondisi` varchar(100) DEFAULT NULL,
  `suhu_rata` float DEFAULT NULL,
  `suhu_min` float DEFAULT NULL,
  `suhu_max` float DEFAULT NULL,
  `peluang_hujan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cuaca_info`
--

INSERT INTO `cuaca_info` (`id`, `ikon`, `kondisi`, `suhu_rata`, `suhu_min`, `suhu_max`, `peluang_hujan`) VALUES
(1, 'wi-day-sunny', 'Cerah', 30.5, 27, 34, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `formulir`
--

CREATE TABLE `formulir` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `file` text NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `formulir`
--

INSERT INTO `formulir` (`id`, `nama`, `file`, `keterangan`) VALUES
(16, 'Surat Keterangan Tidak Mampu (SKTM)', 'SURAT_PERNYATAAN_SKTM/DomisiliYayasan.pdf', 'Digunakan untuk permohonan keterangan tidak mampu sebagai syarat administrasi bantuan pendidikan, kesehatan, dan lainnya.\n\nSyarat yang harus dibawa:\n- Surat Pengantar RT & RW\n- Foto Copy KTP\n- Foto Copy Kartu Keluarga\n- Surat Pernyataan Tidak Mampu (Download di folder download)\n- Foto Rumah Tampak Depan dan Foto Dalam Rumah'),
(17, 'Surat Keterangan Ahli Waris', 'SURAT_PERNYATAAN_SKTM/AhliWaris.pdf', 'Digunakan untuk membuktikan status ahli waris terhadap seseorang yang telah meninggal dunia.\n\nSyarat yang harus dibawa:\n- Foto Copy Surat Keterangan Kematian (Akta Kematian)\n- Foto Copy KTP Yang Meninggal\n- Foto Copy KTP Ahli Waris\n- Foto Kartu Keluarga (KK)\n- Foto Copy Akta Kelahiran Para Ahli Waris\n- Foto Copy Buku Nikah / Akta Nikah\n- Foto Copy Syarat Lainnya Sesuai Keperluan Keterangan Waris\nNB: Di Foto Copy 2 (Dua) Rangkap'),
(18, 'Surat Keterangan Ghoib', 'SURAT_PERNYATAAN_SKTM/Ghoib.pdf', 'Digunakan untuk menyatakan seseorang yang hilang dan belum ditemukan selama waktu tertentu.\n\nSyarat yang harus dibawa:\n- Surat Pengantar RT & RW\n- Surat Keterangan Hilang dari Kepolisian\n- Foto Copy KTP Pelapor'),
(19, 'Surat Domisili Yayasan', 'SURAT_PERNYATAAN_SKTM/DomisiliYayasan.pdf', 'Digunakan untuk mengurus legalitas alamat domisili yayasan yang berada di wilayah kelurahan.\n\nSyarat yang harus dibawa:\n- Akta Pendirian Yayasan\n- Surat Pengantar RT & RW\n- Foto Copy KTP Pengurus Yayasan\n- Surat Pernyataan Domisili Yayasan'),
(20, 'Surat Izin Keramaian', 'SURAT_PERNYATAAN_SKTM/IzinKeramaian.pdf', 'Digunakan untuk permohonan izin acara atau kegiatan yang melibatkan keramaian masyarakat.\n\nSyarat yang harus dibawa:\n- Surat Pengantar RT & RW\n- Surat Undangan atau Proposal Acara\n- Foto Copy KTP Penanggung Jawab'),
(21, 'Surat Pengantar SKCK', 'SURAT_PERNYATAAN_SKTM/PengantarSKCK.pdf', 'Digunakan untuk mendapatkan surat pengantar dari kelurahan sebagai syarat pembuatan SKCK di kepolisian.\n\nSyarat yang harus dibawa:\n- Foto Copy KTP\n- Foto Copy Kartu Keluarga\n- Surat Pengantar RT & RW');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `gambar`) VALUES
(7, 'Kegiatan Musyrawarah Perencanaan Pembangunan (Musrenbang) Kelurahan Pondok Benda Kecamatan Pamulang', 'WhatsApp Image 2025-06-03 at 15.38.46_6fb68c24.jpg'),
(8, 'Kegiatan Musyrawarah Perencanaan Pembangunan (Musrenbang) Kelurahan Pondok Benda Kecamatan Pamulang', 'WhatsApp Image 2025-06-03 at 15.38.46_6fb5bd60.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kependudukan`
--

CREATE TABLE `kependudukan` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kependudukan`
--

INSERT INTO `kependudukan` (`id`, `judul`, `isi`) VALUES
(1, 'dfghjk', 'fghjk'),
(2, 'dfghjk', 'fghjk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `navbar_menu`
--

CREATE TABLE `navbar_menu` (
  `id` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `link_menu` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  `tipe_menu` enum('utama','submenu') DEFAULT 'utama',
  `induk_menu` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `navbar_menu`
--

INSERT INTO `navbar_menu` (`id`, `nama_menu`, `link_menu`, `urutan`, `tipe_menu`, `induk_menu`, `parent_id`) VALUES
(1, 'Home', 'index.php', 1, 'utama', NULL, NULL),
(2, 'Galeri', 'view/galeri.php', 2, 'utama', NULL, NULL),
(3, 'Sejarah', 'view/sejarah.php', 3, 'utama', NULL, NULL),
(4, 'Peta Desa', 'view/peta.php', 4, 'utama', NULL, NULL),
(5, 'Pelayanan', 'view/pelayanan.php', 5, 'utama', NULL, NULL),
(6, 'Kependudukan', 'https://rumahdukcapil.tangerangselatankota.go.id/', 6, 'submenu', 'Pelayanan', NULL),
(7, 'Perizinan Usaha', 'https://oss.go.id/', 7, 'submenu', 'Pelayanan', NULL),
(8, 'Formulir', 'view/formulir.php', 8, 'submenu', 'Pelayanan', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelayanan`
--

CREATE TABLE `pelayanan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `link_web` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelayanan`
--

INSERT INTO `pelayanan` (`id`, `nama`, `deskripsi`, `link_web`) VALUES
(10, 'Kependudukan ', '', 'https://rumahdukcapil.tangerangselatankota.go.id/'),
(11, 'Perizinan Usaha', '', 'https://oss.go.id/');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peta`
--

CREATE TABLE `peta` (
  `id` int(11) NOT NULL,
  `nama_peta` varchar(255) DEFAULT NULL,
  `embed_link` text DEFAULT NULL,
  `batas_wilayah` text DEFAULT NULL,
  `kondisi_wilayah` text DEFAULT NULL,
  `batas_utara` text DEFAULT NULL,
  `batas_selatan` text DEFAULT NULL,
  `batas_barat` text DEFAULT NULL,
  `batas_timur` text DEFAULT NULL,
  `kondisi_luas` text DEFAULT NULL,
  `kondisi_ketinggian` text DEFAULT NULL,
  `kondisi_curah` text DEFAULT NULL,
  `kondisi_bulan` text DEFAULT NULL,
  `kondisi_kelembaban` text DEFAULT NULL,
  `kondisi_suhu` text DEFAULT NULL,
  `kondisi_topografi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peta`
--

INSERT INTO `peta` (`id`, `nama_peta`, `embed_link`, `batas_wilayah`, `kondisi_wilayah`, `batas_utara`, `batas_selatan`, `batas_barat`, `batas_timur`, `kondisi_luas`, `kondisi_ketinggian`, `kondisi_curah`, `kondisi_bulan`, `kondisi_kelembaban`, `kondisi_suhu`, `kondisi_topografi`) VALUES
(1, 'Kelurahan Pondok Benda	', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.3754391237953!2d106.71433870000001!3d-6.345403399999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e582f74fe06d%3A0xe5b0bcd8b72ff2a2!2sKantor%20Lurah%20Pondok%20Benda!5e0!3m2!1sid!2sid!4v1748899652653!5m2!1sid!2sid', '', '', 'Kec. Ciputat/Kel. Serua', 'Kota Depok/Kel. Pondok Petir', 'Kec. Serpong/Kec. Gunung Sindur', 'Kel. Pamulang Barat/Kel. Benda Baru', '412,28 Ha/Km²', '83 (m) dpl', 'rata-rata 154,9 mm', '4 bulan (Nopember – Februari)', '80,0%', '23,4℃ - 34,2℃', '100% Datar (Flat Area)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sejarah`
--

CREATE TABLE `sejarah` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `visi` text DEFAULT NULL,
  `misi` text DEFAULT NULL,
  `motto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sejarah`
--

INSERT INTO `sejarah` (`id`, `judul`, `isi`, `visi`, `misi`, `motto`) VALUES
(10, '', 'Pondok Benda adalah kelurahan yang terletak di Kecamatan Pamulang, Kota Tangerang Selatan, Provinsi Banten. Kelurahan Pondok Benda memiliki sejumlah RW yang tersebar di berbagai wilayah lingkungan. Beberapa lingkungan ini dikenal dengan sebutan Rukun Tetangga (RT) yang membentuk komunitas warga yang saling terhubung. Topografi wilayah Pondok Benda sebagian besar berupa dataran rendah perkotaan, namun masih terdapat area resapan dan ruang terbuka hijau di beberapa titik. Wilayah ini dialiri oleh beberapa saluran air dan anak sungai yang menjadi bagian dari sistem drainase menuju ke Kali Angke dan sekitarnya. Lokasi strategis Pondok Benda yang berbatasan langsung dengan beberapa kelurahan lain di Pamulang menjadikan wilayah ini padat aktivitas masyarakat, baik dalam sektor pemukiman, perdagangan, maupun pelayanan umum.', '“ Terwujudnya Kelurahan Pondok Benda Yang Sejahtera, Dilandasi Iman dan Taqwa (IMTAQ), Berwawasan Ilmu Pengetahuan dan Teknologi (IPTEK)”.', '1.	Meningkatkan Pelayanan Prima Terhadap Masyarakat\r\n\r\n2.	Meningkatkan Pemberdayaan Masyarakat Yang Berhasil\r\n\r\n3.	Mempererat Tali Silaturahmi Antar Umat Beragama\r\n\r\n4.	Meningkatkan Rasa Toleransi Dalam Kehidupan Bermasyarakat\r\n\r\n5.	Terciptanya Kesadaran Warga Dalam Pembinaan Lingkungan Yang Tertib, Aman, Nyaman dan Harmonis\r\n', '“CERDAS, BERDAYA GUNA DAN BERPRESTASI”');

-- --------------------------------------------------------

--
-- Struktur dari tabel `struktur`
--

CREATE TABLE `struktur` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `wilayah`
--

CREATE TABLE `wilayah` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `wilayah`
--

INSERT INTO `wilayah` (`id`, `judul`, `isi`) VALUES
(2, 'Pondok Benda', 'Pondok Benda adalah kelurahan yang terletak di Kecamatan Pamulang, Kota Tangerang Selatan, Provinsi Banten.\r\n                            Kelurahan ini memiliki sejumlah RW yang tersebar di berbagai wilayah lingkungan.\r\n                            Setiap lingkungan terdiri atas beberapa Rukun Tetangga (RT) yang membentuk komunitas warga yang saling terhubung.\r\n                            Topografi wilayah Pondok Benda sebagian besar berupa dataran rendah perkotaan, namun masih terdapat area resapan dan ruang terbuka hijau di beberapa titik.\r\n                            Wilayah ini juga dialiri oleh beberapa saluran air dan anak sungai yang merupakan bagian dari sistem drainase menuju Kali Angke dan sekitarnya.\r\n                            Lokasi strategis Pondok Benda yang berbatasan langsung dengan beberapa kelurahan lain di Pamulang menjadikan wilayah ini padat aktivitas masyarakat,\r\n                            baik dalam sektor permukiman, perdagangan, maupun pelayanan umum.');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `counter_data`
--
ALTER TABLE `counter_data`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cuaca_info`
--
ALTER TABLE `cuaca_info`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `formulir`
--
ALTER TABLE `formulir`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kependudukan`
--
ALTER TABLE `kependudukan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `navbar_menu`
--
ALTER TABLE `navbar_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peta`
--
ALTER TABLE `peta`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sejarah`
--
ALTER TABLE `sejarah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `struktur`
--
ALTER TABLE `struktur`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `counter_data`
--
ALTER TABLE `counter_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `cuaca_info`
--
ALTER TABLE `cuaca_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `formulir`
--
ALTER TABLE `formulir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `kependudukan`
--
ALTER TABLE `kependudukan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `navbar_menu`
--
ALTER TABLE `navbar_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pelayanan`
--
ALTER TABLE `pelayanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `peta`
--
ALTER TABLE `peta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sejarah`
--
ALTER TABLE `sejarah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `struktur`
--
ALTER TABLE `struktur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
