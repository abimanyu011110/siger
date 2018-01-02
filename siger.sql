-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02 Jan 2018 pada 01.50
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u860194164_tgms`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisis_kegiatan`
--

CREATE TABLE `analisis_kegiatan` (
  `id` int(11) NOT NULL,
  `identifikasi_id` int(11) DEFAULT NULL,
  `kemungkinan_id` int(11) UNSIGNED DEFAULT NULL,
  `dampak_id` int(11) UNSIGNED DEFAULT NULL,
  `tingkat_risiko` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisis_opd`
--

CREATE TABLE `analisis_opd` (
  `id` int(11) NOT NULL,
  `identifikasi_id` int(11) DEFAULT NULL,
  `kemungkinan_id` int(11) DEFAULT NULL,
  `dampak_id` int(11) DEFAULT NULL,
  `tingkat_risiko` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisis_pemda`
--

CREATE TABLE `analisis_pemda` (
  `id` int(11) NOT NULL,
  `identifikasi_id` int(11) DEFAULT NULL,
  `kemungkinan_id` int(11) UNSIGNED DEFAULT NULL,
  `dampak_id` int(1) UNSIGNED DEFAULT NULL,
  `tingkat_risiko` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `identifikasi_kegiatan`
--

CREATE TABLE `identifikasi_kegiatan` (
  `id` int(11) NOT NULL,
  `opd_id` int(11) UNSIGNED NOT NULL,
  `sasaran_id` int(11) UNSIGNED NOT NULL,
  `program_id` int(11) UNSIGNED NOT NULL,
  `kegiatan_id` int(11) UNSIGNED NOT NULL,
  `periode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `proses_id` int(11) UNSIGNED NOT NULL,
  `risiko_id` int(11) UNSIGNED NOT NULL,
  `uraian` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sumber_risiko` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kontrol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `penyebab` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dampak` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pengendalian` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sisa_risiko` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `identifikasi_opd`
--

CREATE TABLE `identifikasi_opd` (
  `id` int(11) NOT NULL,
  `analisis_id` int(11) DEFAULT NULL,
  `opd_id` int(11) DEFAULT NULL,
  `sasaran_id` int(11) DEFAULT NULL,
  `periode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `proses_id` int(11) UNSIGNED NOT NULL,
  `risiko_id` int(11) DEFAULT NULL,
  `uraian` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sumber_risiko` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kontrol` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `penyebab` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dampak` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pengendalian` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sisa_risiko` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `identifikasi_pemda`
--

CREATE TABLE `identifikasi_pemda` (
  `id` int(11) NOT NULL,
  `analisis_id` int(11) NOT NULL,
  `sasaran_id` int(11) UNSIGNED NOT NULL,
  `periode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `proses_id` int(11) UNSIGNED NOT NULL,
  `risiko_id` int(11) UNSIGNED NOT NULL,
  `uraian` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sumber_risiko` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kontrol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `penyebab` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dampak` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pengendalian` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sisa_risiko` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan_opd`
--

CREATE TABLE `kegiatan_opd` (
  `id` int(11) NOT NULL,
  `opd_id` int(11) UNSIGNED NOT NULL,
  `program_id` int(11) UNSIGNED NOT NULL,
  `nama_kegiatan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bobot` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `misi_pemda`
--

CREATE TABLE `misi_pemda` (
  `id` int(11) NOT NULL,
  `visi_id` int(11) UNSIGNED NOT NULL,
  `nama_misi` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemantauan_kegiatan`
--

CREATE TABLE `pemantauan_kegiatan` (
  `id` int(11) NOT NULL,
  `rtpkegiatan_id` int(11) DEFAULT NULL,
  `kemungkinan_id` int(11) DEFAULT NULL,
  `dampak_id` int(11) DEFAULT NULL,
  `tingkat_risiko` int(11) DEFAULT NULL,
  `deviasi` int(11) DEFAULT NULL,
  `rtp` varchar(255) NOT NULL,
  `rekomendasi` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemantauan_opd`
--

CREATE TABLE `pemantauan_opd` (
  `id` int(11) NOT NULL,
  `rtpopd_id` int(11) DEFAULT NULL,
  `kemungkinan_id` int(11) DEFAULT NULL,
  `dampak_id` int(11) DEFAULT NULL,
  `tingkat_risiko` int(11) DEFAULT NULL,
  `deviasi` int(11) DEFAULT NULL,
  `rtp` varchar(255) NOT NULL,
  `rekomendasi` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemantauan_pemda`
--

CREATE TABLE `pemantauan_pemda` (
  `id` int(11) NOT NULL,
  `rtpopd_id` int(11) DEFAULT NULL,
  `kemungkinan_id` int(11) DEFAULT NULL,
  `dampak_id` int(11) DEFAULT NULL,
  `tingkat_risiko` int(11) DEFAULT NULL,
  `deviasi` int(11) DEFAULT NULL,
  `rtp` varchar(255) NOT NULL,
  `rekomendasi` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `program_opd`
--

CREATE TABLE `program_opd` (
  `id` int(11) NOT NULL,
  `opd_id` int(11) UNSIGNED NOT NULL,
  `sasaran_id` int(11) UNSIGNED NOT NULL,
  `nama_program` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `program_pemda`
--

CREATE TABLE `program_pemda` (
  `id` int(11) NOT NULL,
  `sasaran_id` int(11) UNSIGNED NOT NULL,
  `nama_program` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_bidang`
--

CREATE TABLE `ref_bidang` (
  `id` int(11) NOT NULL,
  `urusan_id` int(11) UNSIGNED NOT NULL,
  `nama_bidang` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `ref_bidang`
--

INSERT INTO `ref_bidang` (`id`, `urusan_id`, `nama_bidang`) VALUES
(1, 1, 'Pendidikan'),
(2, 1, 'Kesehatan'),
(3, 1, 'Pekerjaan Umum dan Penataan Ruang'),
(4, 1, 'Perumahan Rakyat dan Kawasan Pemukiman'),
(5, 1, 'Ketentraman dan Ketertiban Umum serta Perlindungan Masyarakat'),
(6, 1, 'Sosial'),
(7, 2, 'Tenaga Kerja'),
(8, 2, 'Pemberdayaan Perempuan dan Perlindungan Anak'),
(9, 2, 'Pangan'),
(10, 2, 'Pertanahan'),
(11, 2, 'Lingkungan Hidup'),
(12, 2, 'Administrasi Kependudukan & Capil'),
(13, 2, 'Pemberdayaan Masyarakat Desa'),
(14, 2, 'Pengendalian Penduduk dan Keluarga Berencana'),
(15, 2, 'Perhubungan'),
(16, 2, 'Komunikasi & Informatika'),
(17, 2, 'Koperasi, Usaha Kecil, & Menengah'),
(18, 2, 'Penanaman Modal'),
(19, 2, 'Kepemudaan & Olahraga'),
(20, 2, 'Statistik'),
(21, 2, 'Persandian'),
(22, 2, 'Kebudayaan'),
(23, 2, 'Perpustakaan'),
(24, 2, 'Kearsipan'),
(25, 3, 'Kelautan & Perikanan'),
(26, 3, 'Pariwisata'),
(27, 3, 'Pertanian'),
(28, 3, 'Kehutanan'),
(29, 3, 'Energi & Sumber Daya Mineral'),
(30, 3, 'Perdagangan'),
(31, 3, 'Perindustrian'),
(32, 3, 'Transmigrasi'),
(33, 4, 'Administrasi Pemerintahan'),
(34, 4, 'Pengawasan'),
(35, 4, 'Perencanaan'),
(36, 4, 'Keuangan'),
(37, 4, 'Kepegawaian'),
(38, 4, 'Pendidikan & Pelatihan'),
(39, 4, 'Penelitian & Pengembangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_dampak`
--

CREATE TABLE `ref_dampak` (
  `id` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `nama_dampak` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `ref_dampak`
--

INSERT INTO `ref_dampak` (`id`, `nilai`, `nama_dampak`) VALUES
(1, 1, 'Tidak Signifikan'),
(2, 2, 'Kecil'),
(3, 3, 'Menengah'),
(4, 4, 'Tinggi'),
(5, 5, 'Sangat Tinggi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_kemungkinan`
--

CREATE TABLE `ref_kemungkinan` (
  `id` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `nama_kemungkinan` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `ref_kemungkinan`
--

INSERT INTO `ref_kemungkinan` (`id`, `nilai`, `nama_kemungkinan`) VALUES
(1, 1, 'Sangat Jarang Terjadi'),
(2, 2, 'Kemungkinan Kecil Terjadi'),
(3, 3, 'Mungkin Terjadi'),
(4, 4, 'Kemungkinan Besar Terjadi'),
(5, 5, 'Hampir Pasti Terjadi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_urusan`
--

CREATE TABLE `ref_urusan` (
  `id` int(11) NOT NULL,
  `nama_urusan` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `ref_urusan`
--

INSERT INTO `ref_urusan` (`id`, `nama_urusan`) VALUES
(1, 'Urusan Wajib Pelayanan Dasar'),
(2, 'Urusan Wajib Bukan Pelayanan Dasar'),
(3, 'Urusan Pilihan'),
(4, 'Urusan Pemerintah Fungsi Penunjang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rtp_kegiatan`
--

CREATE TABLE `rtp_kegiatan` (
  `id` int(11) NOT NULL,
  `analisis_id` int(11) UNSIGNED NOT NULL,
  `rtp_tambah` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jadwal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `penanggungjawab` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kemungkinan_id` int(11) UNSIGNED NOT NULL,
  `dampak_id` int(11) UNSIGNED NOT NULL,
  `tingkat_risiko` int(11) NOT NULL,
  `opsi` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rtp_opd`
--

CREATE TABLE `rtp_opd` (
  `id` int(11) NOT NULL,
  `analisis_id` int(11) DEFAULT NULL,
  `rtp_tambah` varchar(765) DEFAULT NULL,
  `jadwal` varchar(765) DEFAULT NULL,
  `penanggungjawab` varchar(765) DEFAULT NULL,
  `kemungkinan_id` int(11) DEFAULT NULL,
  `dampak_id` int(11) DEFAULT NULL,
  `tingkat_risiko` int(11) DEFAULT NULL,
  `opsi` varchar(765) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rtp_pemda`
--

CREATE TABLE `rtp_pemda` (
  `id` int(11) NOT NULL,
  `analisis_id` int(11) DEFAULT NULL,
  `rtp_tambah` varchar(765) DEFAULT NULL,
  `jadwal` varchar(765) DEFAULT NULL,
  `penanggungjawab` varchar(765) DEFAULT NULL,
  `kemungkinan_id` int(11) DEFAULT NULL,
  `dampak_id` int(11) DEFAULT NULL,
  `tingkat_risiko` int(11) DEFAULT NULL,
  `opsi` varchar(765) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sasaran_opd`
--

CREATE TABLE `sasaran_opd` (
  `id` int(11) NOT NULL,
  `opd_id` int(11) UNSIGNED NOT NULL,
  `tujuan_id` int(11) UNSIGNED NOT NULL,
  `nama_sasaran` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sasaran_pemda`
--

CREATE TABLE `sasaran_pemda` (
  `id` int(11) NOT NULL,
  `tujuan_id` int(11) UNSIGNED NOT NULL,
  `nama_sasaran` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_baganrisiko`
--

CREATE TABLE `tbl_baganrisiko` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) UNSIGNED NOT NULL,
  `proses_id` int(11) UNSIGNED NOT NULL,
  `nama_risiko` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `tbl_baganrisiko`
--

INSERT INTO `tbl_baganrisiko` (`id`, `kategori_id`, `proses_id`, `nama_risiko`) VALUES
(1, 1, 1, 'Anggaran yang diusulkan tidak mencukupi '),
(2, 1, 1, 'TAPD tidak mempertimbangkan ketersediaan dana pada Kas Daerah dalam merencanakan alokasi penggunaan kas untuk tiap kegiatan'),
(3, 1, 1, 'Kegiatan yang diusulkan tidak dibutuhkan/ tidak sesuai dengan Renja OPD/ RENSTRA OPD'),
(4, 1, 1, 'Estimasi belanja  kegiatan dalam RKPD/Renja OPD terlalu tinggi'),
(5, 1, 1, 'Menyisipkan kegiatan tertentu pada rancangan akhir RKPD sebelum ditetapkan oleh kepala daerah'),
(6, 1, 1, 'Pencantuman program dan kegiatan dalam KUA/PPAS tidak berdasar pada RKPD'),
(7, 1, 1, 'Penetapan plafon anggaran tidak realistis'),
(8, 1, 1, 'Terdapat kegiatan yang sama (duplikasi) antar OPD'),
(9, 1, 1, 'Usulan belanja barang tidak sesuai kebutuhan'),
(10, 1, 1, 'Mark up nilai kegiatan dengan memasukkan belanja melebihi standar harga'),
(11, 1, 1, 'Mark up nilai kegiatan dengan menambahkan belanja yang tidak dibutuhkan'),
(12, 1, 1, 'Pengabaian perbaikan RKA sebagian atau keseluruhan sesuai hasil evaluasi'),
(13, 1, 1, 'Evaluasi RKA sudah di atur sebelumnya'),
(14, 1, 1, 'Penyempurnaan Raperda APBD tidak berdasarkan hasil evaluasi'),
(15, 1, 1, 'Penambahan kegiatan baru yang tidak dibutuhkan tanpa melalui pembahasan tahap sebelumnya'),
(16, 1, 1, 'Musrenbang tidak mengikut sertakan pihak pihak terkait dan kompeten'),
(17, 1, 1, 'Kegiatan yg dihasilkan dalam musrenbang kecamatan tidak didasari hasil musrenbang desa/kelurahan'),
(18, 1, 1, 'Kegiatan yang dibahas dalam Musrenbang RKPD bukan merupakan kegiatan yang ditetapkan dalam tahap Musrenbang sebelumnya'),
(19, 1, 1, 'Menyisipkan kegiatan tertentu pada rancangan akhir Renja OPD sebelum ditetapkan oleh Kepala OPD'),
(20, 1, 1, 'Kegiatan yang dibahas dalam forum OPD bukan merupakan kegiatan yang ditetapkan dalam tahap Musrenbang'),
(21, 1, 1, 'Kurangnya advokasi ke stakeholder terkait kebijakan '),
(22, 1, 1, 'Aplikasi sistem perencanaan kurang '),
(23, 1, 1, 'Belum optimalnya koordinasi antar OPD Provinsi dan Kab/Kota '),
(24, 1, 1, 'Koordinasi TKPKD lemah'),
(25, 1, 1, 'Tidak memiliki komitmen dalam melaksanakan perencanaan'),
(26, 1, 1, 'Penetapan kelompok sasaran kurang tepat'),
(27, 1, 2, 'Sumber Data Tidak Valid'),
(28, 1, 2, 'Narasumber tidak kompeten'),
(29, 1, 2, 'Tim Penyusun tidak kompeten'),
(30, 1, 2, 'Volume RAB Tidak Dihitung dengan cermat'),
(31, 1, 2, 'Design Gambar tidak berdasarkan hasil survey'),
(32, 1, 2, 'Design Gambar tidak memperhitungkan anggaran'),
(33, 1, 2, 'Barang yang akan dibeli tidak sesuai kebutuhan'),
(34, 1, 2, 'HPS yang dibuat terlalu tinggi'),
(35, 1, 2, 'ULP/ POKJA ULP meloloskan dokumen penawaran yang tidak memenuhi kualifikasi'),
(36, 1, 2, 'Gagal Tender'),
(37, 1, 2, 'Penunjukan Langsung setelah gagal tender ke dua tidak tepat'),
(38, 1, 2, 'Lokasi tidak sesuai penetapan rencana'),
(39, 1, 2, 'Bahan tidak sesuai spesifikasi teknis'),
(40, 1, 2, 'Bahan tidak tersedia'),
(41, 1, 2, 'Pekerjaan tidak selesai tepat waktu'),
(42, 1, 2, 'Wan Prestasi'),
(43, 1, 2, 'Barang tidak sesuai spesifikasi teknis'),
(44, 1, 2, 'Konsultan Pengawasan bekerja sub standar'),
(45, 1, 2, 'PHO atau FHO dilakukan tanpa pemeriksaan fisik'),
(46, 1, 2, 'Pekerjaan Pengawas Lapangan Over load'),
(47, 1, 2, 'Berita Acara Fisik Tidak Sesuai dengan Progres Fisik'),
(48, 1, 2, 'Adanya defisit dalam SiLPA'),
(49, 1, 2, 'Adanya keterlambatan penyetoran Pajak2 yang telah dipungut Bendahara Pengeluaran'),
(50, 1, 2, 'Adanya penerimaan asli daerah yang tidak disetor ke Kas Daerah'),
(51, 1, 2, 'Adanya penyalahgunaan uang persediaan oleh Bendahara atau PPTK'),
(52, 1, 2, 'Adanya unsur nepotisme dalam pengadaan barang dan jasa'),
(53, 1, 2, 'Bantuan Sosial Kemasyarakatan diberikan kepada pihak yang tidak berhak dan tidak tepat sasaran'),
(54, 1, 2, 'Kekurangan volume pekerjaan dan/atau barang'),
(55, 1, 2, 'Kelebihan pembayaran atas kekurangan\nvolume pada pekerjaan'),
(56, 1, 2, 'Belanja atau pengadaan barang/jasa fiktif'),
(57, 1, 2, 'Bendahara pengeluaran mempertanggungjawabkan belanja tidak sesuai dengan realisasi kegiatan'),
(58, 1, 2, 'Pembayaran Paket Pekerjaan tidak sesuai ketentuan'),
(59, 1, 2, 'Realisasi belanja pegawai tidak sesuai dengan peraturan'),
(60, 1, 2, 'Realisasi belanja pegawai untuk\npembayaran honorarium tidak sesuai dengan ketentuan'),
(61, 1, 2, 'Kelebihan pembayaran selain kekurangan volume pekerjaan dan/atau barang '),
(62, 1, 2, 'Rekanan pengadaan barang/jasa tidak menyelesaikan pekerjaan'),
(63, 1, 2, 'Penggunaan uang/barang untuk\nkepentingan pribadi'),
(64, 1, 2, 'Spesifikasi barang/jasa yang diterima tidak sesuai dengan kontrak/SPK'),
(65, 1, 2, 'Belanja tidak sesuai atau melebihi ketentuan'),
(66, 1, 2, 'Aset tetap tidak diketahui keberadaannya'),
(67, 1, 2, 'Piutang/ pinjaman atau dana bergulir\ntidak tertagih'),
(68, 1, 2, 'Tuntutan Ganti Kerugian Daerah yang disajikan pada Akun Aset Lain-Lain belum didukung dengan SKTJM'),
(69, 1, 2, 'Kelebihan pembayaran gaji dan tunjangan kepada pegawai yang telah pensiun dan terkena hukuman'),
(70, 1, 2, 'Pembayaran ganda tunjangan profesi guru'),
(71, 1, 2, 'Tunjangan profesi guru tidak dibayar'),
(72, 1, 2, 'Pengakuan tagihan angsuran sewa tidak didukung oleh naskah perjanjian yang memadai'),
(73, 1, 2, 'Sistem Pengelolaan PAD kurang memadai'),
(74, 1, 2, 'Denda atas keterlambatan pekerjaan belum dikenakan'),
(75, 1, 2, 'Pengenaan tarif pajak tidak sesuai dengan ketentuan'),
(76, 1, 2, 'Pengelolaan belanja bantuan sosial  tidak tertib dan berpotensi merugikan keuangan daerah'),
(77, 1, 2, 'Pertanggungjawaban belanja tidak akurat'),
(78, 1, 2, 'Pembayaran jaminan kesehatan daerah tidak sesuai dengan ketentuan'),
(79, 1, 2, 'Uang muka atas pemutusan kontrak pekerjaan belum disetor ke kas daerah'),
(80, 1, 2, 'Kelebihan pembayaran atas kegiatan belanja jasa konsultansi (biaya personel) '),
(81, 1, 2, 'Terdapat bukti pertanggungjawaban yang direkayasa/ dipalsukan'),
(82, 1, 2, 'Pertanggungjawaban belanja tidak sesuai dengan ketentuan '),
(83, 1, 2, 'Barang hilang atau dikuasai oleh pegawai dan pejabat bukan pegawai pemda'),
(84, 1, 2, 'Kekurangan kas di bendahara pengeluaran '),
(85, 1, 2, 'Aset tetap yang dipinjampakaikan tidak dilengkapi berita acara'),
(86, 1, 2, 'Aset dikuasai oleh mantan pejabat'),
(87, 1, 2, 'Jaminan atas keterlambatan pelaksanaan pekerjaan tidak dapat dicairkan'),
(88, 1, 2, 'Pekerjaan tidak selesai dan belum dilakukan pemutusan kontrak serta jaminan pelaksanaan belum dicairkan'),
(89, 1, 2, 'Penerima hibah tidak menyampaikan laporan pertanggungjawaban belanja hibah'),
(90, 1, 2, 'Pertanggungjawaban belanja tidak lengkap'),
(91, 1, 2, 'Penerima bantuan sosial belum menyampaikan bukti pertanggungjawaban penggunaan dana'),
(92, 1, 2, 'Penyajian aset tetap dan pengelolaan BMD belum sepenuhnya memadai'),
(93, 1, 2, 'Penggunaan kendaraan dinas  tidak sesuai dengan ketentuan'),
(94, 1, 2, 'laporan keuangan terlambat disampaikan'),
(95, 1, 2, 'Kebakaran'),
(96, 1, 2, 'Kebanjiran'),
(97, 1, 2, 'Listrik padam'),
(98, 1, 2, 'Demonstrasi dari masyarakat'),
(99, 1, 2, 'Menurunnya kepercayaan stakeholder kepada organisasi'),
(100, 1, 2, 'Fisik uang yang ada lebih kecil daripada jumlah uang tercatat'),
(101, 1, 2, 'Persediaan usang, hilang, tidak dimanfaatkan'),
(102, 1, 2, 'Kecurian'),
(103, 1, 2, 'Hilangnya data di komputer'),
(104, 1, 2, 'Aset kantor dikuasai pihak ketiga (pensiunan/non PNS)'),
(105, 1, 2, 'Hilang/Rusaknya aset dan dokumen penting kantor'),
(106, 1, 2, 'Pengadaan barang/jasa terlambat dari rencana'),
(107, 1, 2, 'Tuntutan hukum terhadap organisasi'),
(108, 1, 2, 'Keterbatasan jumlah dan kompetensi SDM'),
(109, 1, 2, 'Persediaan Kurang/Habis'),
(110, 1, 2, 'Puskesmas belum terakreditasi'),
(111, 1, 2, 'Kalibrasi Alkes belum ada yang menangani'),
(112, 1, 2, 'Belum ada form pembinaan'),
(113, 1, 2, 'Sosialisasi tidak tepat sasaran'),
(114, 1, 2, 'Materi tidak sesuai kebutuhan'),
(115, 1, 2, 'Kegiatan pelatihan tidak terdokumentasi'),
(116, 1, 2, 'Peran serta masyarakat belum optimal'),
(117, 1, 2, 'Pengumpulan obrik dan pengolahan data pemeriksaan dari Kab/Kota  terlambat diterima'),
(118, 1, 2, 'Menyiapkan rancangan PKPT tidak selaras RPJMD/Kebijakan Pengawasan'),
(119, 1, 2, 'Masukan tentang penyusunan RKA dan DPA terlambat'),
(120, 1, 2, 'Usulan kegiatan tidak sesuai pedoman'),
(121, 1, 2, 'Data ICQ belum disempurnakan '),
(122, 1, 2, 'ICQ terlambat dikembalikan oleh Obrik'),
(123, 1, 2, 'Data LAKIP terlambat diterima'),
(124, 1, 2, 'Isi LAKIP tidak lengkap'),
(125, 1, 2, 'Koordinasi penyusunan renstra terlambat'),
(126, 1, 2, 'Rekomendasi audit tidak dapat ditindaklanjuti'),
(127, 1, 2, 'Data TLHP reguler Inspektorat tidak dimutakhirkan'),
(128, 1, 2, 'Data TLHP BPK RI tidak dimutakhirkan'),
(129, 1, 2, 'OPD terlambat/tidak menindaklanjuti LHP'),
(130, 1, 2, 'Laporan TLHP (Triwulanan) terlambat/tidak dibuat'),
(131, 1, 2, 'OPD  tidak memahami SPIP'),
(132, 1, 2, 'Satgas SPIP Pemprov. gagal mengidentifikasi permasalahan SPIP di OPD'),
(133, 1, 2, 'Sosialisasi SPIP tidak dilaksanakan'),
(134, 1, 2, 'Sosialisasi SPIP tidak dihadiri oleh seluruh tim implementasi SPIP di OPD'),
(135, 1, 2, 'Laporan pelaksanaan SPIP tidak dibuat'),
(136, 1, 2, 'Daftar Penilaian Risiko tidak dibuat'),
(137, 1, 2, 'Sosialisasi SPIP tidak didukung dengan sumber daya yang memadai'),
(138, 1, 2, 'Auditor/pemeriksa tidak paham aturan perilaku'),
(139, 1, 2, 'Auditor/pemeriksa gagal mengidentifikasi penyimpangan'),
(140, 1, 2, 'Pelaksanaan audit tidak tepat waktu'),
(141, 1, 2, 'Penerbitan LHP tidak tepat waktu'),
(142, 1, 2, 'LHP tidak didukung dengan kertas kerja pemeriksaan'),
(143, 1, 2, 'Hasil pelatihan tidak diterapkan'),
(144, 1, 2, 'Peserta pelatihan tidak bersungguh-sunguh mengikuti pelatihan '),
(145, 1, 2, 'Peserta pelatihan tidak berminat mengikuti pelatihan '),
(146, 1, 2, 'Peserta tidak bersungguh-sungguh mengikuti Kunjungan Kerja/Studi Banding'),
(147, 1, 2, 'Lokasi tujuan kunjungan kerja/studi banding tidak tepat '),
(148, 1, 2, 'LAKIP dan Laporan Keuangan SKPD terlambat dikumpulkan oleh Tim Evaluasi'),
(149, 1, 2, 'Pelaksanaan Evaluasi LAKIP dan Reviu Keuangan SKPD tidak direncanakan dengan baik'),
(150, 1, 2, 'Pedoman reviu tidak dipahami dengan baik'),
(151, 1, 2, 'Pengaduan masyarakat tidak tertangani'),
(152, 1, 2, 'Penetapan obrik tidak tepat'),
(153, 1, 2, 'Pengaduan sudah kadaluarsa'),
(154, 1, 2, 'Tuntutan ganti rugi tidak dilunasi'),
(155, 1, 2, 'Pajak yang telah dipungut belum disetorkan'),
(156, 1, 2, 'Penerimaan selain pajak daerah belum disetor'),
(157, 1, 2, 'Penyimpangan dari Pedoman Pelaksanaan APBD'),
(158, 1, 2, 'Penyimpangan dari dokumen pelaksanaan anggaran '),
(159, 1, 2, 'Pelaksanaan kegiatan menyimpang dari jadwal'),
(160, 1, 2, 'Tupoksi tidak dilaksanakan'),
(161, 1, 2, 'Bukti-bukti pencatatan tidak lengkap'),
(162, 1, 2, 'Dokumen pelaksanaan kegiatan tidak diarsipkan dengan baik'),
(163, 1, 2, 'Penerbitan izin kepada masyarakat tidak tepat waktu'),
(164, 1, 2, 'Pelaksanaan tugas belum efisien'),
(165, 1, 2, 'Pelaksanaan pengadaan sumber daya belum hemat'),
(166, 1, 2, 'Pencapaian tujuan belum efektif'),
(167, 1, 2, 'Produktivitas masih rendah'),
(168, 1, 2, 'Banyak anak mengalami gizi buruk'),
(169, 1, 2, 'Tidak terwujudnya kesejahteraan masyarakat yang berkeadilan secara merata/menyeluruh dan kegagalan dalam penanggulangan'),
(170, 1, 2, 'Data dan informasi belum tersedia secara lengkap'),
(171, 1, 2, 'Terjadinya perubahan regulasi'),
(172, 1, 2, 'Penduduk miskin tidak tertangani'),
(173, 1, 2, 'Kurangnya Sarana Pendidikan'),
(174, 1, 2, 'Bantuan sambungan listrik bagi keluarga kurang mampu tidak tepat sasaran'),
(175, 1, 2, 'Waktu Pelayanan tidak sesuai SOP'),
(176, 1, 2, 'Informasi potensi pariwisata tidak optimal'),
(177, 1, 2, 'Rendahnya pramuwisata yang memiliki sertifikasi kompetensi'),
(178, 1, 2, 'Kurang optimalnya kualitas produk, pengelolaan dan pelayanan usaha pariwisata'),
(179, 1, 2, 'Belum optimalnya sarana pendukung pariwisata'),
(180, 1, 2, 'Rendahnya Penyerapan angkatan kerja'),
(181, 1, 2, 'Adanya moratorium penempatan Tenaga Kerja ke Luar Negeri'),
(182, 1, 2, 'Rendahnya kualitas tenaga kerja yang tersedia'),
(183, 1, 2, 'Kurangnya tenaga fungsional Mediator'),
(184, 1, 2, 'Keterbatasan kuota yang ditetapkan oleh Pusat'),
(185, 1, 2, 'Rendahnya kompetensi dan daya saing masyarakat'),
(186, 1, 2, 'Kegiatan penambangan tidak sesuai dengan ketentuan'),
(187, 1, 2, 'Tidak optimalnya fungsi klaster dan sentra industri'),
(188, 1, 2, 'Koperasi binaan tidak aktif'),
(189, 1, 2, 'Kelembagaan dan manajemen koperasi dan UMKM belum sesuai aturan'),
(190, 1, 2, 'Pengawas koperasi kurang memahami tentang peraturan pengawasan koperasi'),
(191, 1, 2, 'Pengawas koperasi tidak melaksanakan pengawasan secara obyektif'),
(192, 1, 2, 'Pendamping KUMKM tidak memahami prosedur pendampingan'),
(193, 1, 2, 'Pengajuan proposal bantuan hibah sarana produksi tidak lengkap'),
(194, 1, 2, 'KUMKM belum memenuhi kriteria yang dipersyaratkan oleh bank'),
(195, 1, 2, 'Penyelenggaraan pameran kurang terkoordinasi dengan baik'),
(196, 1, 2, 'Jumlah pengajar/pelatih yang kompeten terbatas'),
(197, 1, 2, 'kualitas  komoditi tidak memenuhi standar'),
(198, 1, 2, 'Jumlah ketersediaan pangan tidak memenuhi target'),
(199, 1, 2, 'Data tidak akurat'),
(200, 1, 2, 'Pemberian bantuan tidak sesuai dengan standar '),
(201, 1, 2, 'Pelaku tidak menerapkan standar mutu dan keamanan pangan'),
(202, 1, 2, 'Sarana dan prasarana pengawasan terbatas'),
(203, 1, 2, 'Belum semua bantuan hibah barang diserahkan kepada Kelompok Usaha Bersama (KUB)'),
(204, 1, 2, 'Kelompok nelayan skala kecil  belum berbadan hukum'),
(205, 1, 2, 'Materi yang  diberikanan kepada peserta sulit dipahami'),
(206, 1, 2, 'Budidaya tanaman perkebunan belum memenuhi standar baku teknis/GAP'),
(207, 1, 2, 'Produksi dan produktivitas tanaman perkebunan yang dihasilkan  rendah'),
(208, 1, 2, 'Produk alat mesin belum memenuhi standar'),
(209, 1, 2, 'Kandungan residu bahan kimia produk  melebihi standar '),
(210, 1, 2, 'Kebun benih belum menghasilkan benih sesuai standar'),
(211, 1, 2, 'Peredaran benih ilegal tanpa label dan non sertifikasi'),
(212, 1, 2, 'Hak Guna Usaha untuk usaha perkebunan tidak sesuai dengan peruntukannya'),
(213, 1, 2, 'Wisata agro yang ada kurang menarik'),
(214, 1, 2, 'Produk perkebunan yang dihasilkan belum memenuhi standar '),
(215, 1, 2, 'Petani tidak mau menggunakan pupuk organik'),
(216, 1, 2, 'Petani belum mengadopsi teknologi pengolahan hasil perkebunan '),
(217, 1, 2, 'Ekplosi serangan hama dan penyakit tanaman perkebunan'),
(218, 1, 2, 'Keterbatasan kesediaan air dilahan kering'),
(219, 1, 2, 'Adanya pemotongan ternak ruminansia betina produktif'),
(220, 1, 2, 'Bibit ternak tidak sesuai Standar Nasional Indonesia (SNI)'),
(221, 1, 2, 'Adanya penyakit hewan'),
(222, 1, 2, 'Pakan Sapi perah  dibawah kualitas'),
(223, 1, 2, 'Pembangunan belum merepresentasikan kebutuhan desa'),
(224, 1, 2, 'Peneliti gagal mendeteksi informasi dan/atau permasalahan yang terkait dengan tujuan penelitian'),
(225, 1, 2, 'Hasil penelitian disanggah /tidak dipercaya oleh pengguna'),
(226, 1, 2, 'Pembangunan di perdesaan belum dilaksanakan secara inovatif '),
(227, 1, 2, 'Jumlah unit usaha yang berkembang terbatas'),
(228, 1, 2, 'Rendahnya kompetensi penyuluh sesuai dengan bidang keahliannya'),
(229, 1, 2, 'Munculnya budaya konsumtif masyarakat'),
(230, 1, 2, 'Produk potensial Lampung yang belum dapat di ekspor'),
(231, 1, 2, 'bahan baku proses produksi tidak tersedia didalam negeri'),
(232, 1, 2, 'Mesin-mesin canggih belum dapat di produksi di dalam negeri'),
(233, 1, 2, 'Investor tidak tertarik berinvestasi di Lampung'),
(234, 1, 2, 'Kebijakan PUG kurang mendapat dukungan dalam pembahasan anggaran'),
(235, 1, 2, 'Tidak terlaksananya strategi PUG pada masyarakat desa'),
(236, 1, 2, 'Partisipasi perempuan masih rendah, baik sektor publik maupun sektor swasta'),
(237, 1, 2, 'Banyaknya Anak yang tidak memiliki Akta Kelahiran'),
(238, 1, 2, 'Masih banyaknya Regulasi/kebijakan yang tidak berperspektif hak anak'),
(239, 1, 2, 'Kurangnya kesadaran masyarakat berolahraga'),
(240, 1, 2, 'Kurangnya pemahaman mengenai industri olahraga dan sportainment'),
(241, 1, 2, 'Tidak termanfaatkan dengan baik sarpras keolahragaan yang disediakan'),
(242, 1, 2, 'Kapasitas panti sosial tidak mencukupi'),
(243, 1, 2, 'Penempatan PNS tidak sesuai Kompetensi dan Keahliannya'),
(244, 1, 2, 'Evaluasi Pasca Diklat belum bisa menjangkau seluruh alumni'),
(245, 1, 2, 'Kurikulum dan Modul Diklat tidak mutakhir'),
(246, 1, 2, 'Penetapan target pendapatan tidak sesuai dengan potensi riil'),
(247, 1, 2, 'Penyedia bahan bakar tidak melaporkan realisasi penjualan secara obyektif'),
(248, 1, 2, 'Penyusunan tabel Nilai Jual Kendaraan Bermotor tidak sesuai dengan harga pasaran umum'),
(249, 1, 2, 'Wajib Retribusi Daerah tidak memenuhi kewajibannya'),
(250, 1, 2, 'Terdapat aset tetap (tanah dan bangunan) dikuasai oleh pihak ketiga secara tidak sah'),
(251, 1, 2, 'Kalah dalam gugatan/sengketa kepemilikan dan atau penguasaan atas aset tetap (tanah /'),
(252, 1, 2, 'Aset rusak /tidak dimanfaatkan tidak dilakukan penghapusan'),
(253, 1, 2, 'Rumah dan kendaraan Dinas yang dipakai pegawai pensiun/mutasi/meninggal dunia belum ditarik'),
(254, 1, 2, 'Daftar Kebutuhan Barang Milik Daerah (DKBMD) dan Daftar Kebutuhan Pemeliharaan Barang Milik Daerah (DKPBMD) tidak mencerminkan kebutuhan riil'),
(255, 1, 2, 'Pemeriksa gagal mendeteksi informasi dan/atau permasalahan yang terkait dengan tujuan pemeriksaan'),
(256, 1, 2, 'OPD belum menyelenggarakan SPIP'),
(257, 1, 3, 'Dokumen pendukung Keuangan tidak lengkap'),
(258, 1, 3, 'Pelaporan Progres Kegiatan Tidak terdokumentasi'),
(259, 1, 3, 'Aset Pemda Tidak dicatat pada Daftar Aset'),
(260, 1, 4, 'Pertanggungjawaban perjalanan dinas tidak akuntabel'),
(261, 1, 4, 'Pertanggungjawaban selain perjalanan dinas tidak akuntabel'),
(262, 1, 4, 'Sisa kas di bendahara pengeluaran akhir tahun\nanggaran belum disetor ke kas daerah'),
(263, 1, 4, 'Keterlambatan penyetoran sisa UP/GU/TU'),
(264, 1, 4, 'Tanah belum bersertifikat'),
(265, 1, 4, 'Kendaraan tidak memiliki bukti kepemilikan'),
(266, 1, 4, 'Jasa giro dari rekening dana kapitasi JKN ataupun Dana BOS belum disetor ke Kas Daerah'),
(267, 1, 4, 'Keterlambatan penyetoran utang PFK ke kas negara/pihak terkait'),
(268, 1, 4, 'Proses Balik nama aset tanah Pemerintah tidak sesuai dengan ketentuan'),
(269, 1, 4, 'Perjalanan Dinas Fiktif'),
(270, 1, 4, 'Duplikasi Output'),
(271, 1, 4, 'Pembayaran Honor Fiktif'),
(272, 1, 4, 'Opini Laporan Keuangan Pemerintah Daerah tidak WTP'),
(273, 1, 4, 'Kesulitan memperoleh data '),
(274, 2, 1, 'Penetapan target pendapatan melebihi kondisi potensi riil'),
(275, 3, 1, 'Adanya markup nilai pengadaan barang dan jasa pada usulan kegiatan'),
(276, 3, 1, 'Tim penyusun anggaran OPD terdiri dari orang-orang yang tidak independen, mempunyai kepentingan pribadi/ kelompok terhadap RKPD/ Renja OPD'),
(277, 3, 1, 'Kesepakatan pihak-pihak tertentu untuk melakukan kegiatan yang tidak dibutuhkan'),
(278, 3, 1, 'Terdapat arahan yang bertendensi memuluskan usulan kegiatan yang menguntungkan pihak-pihak tertentu'),
(279, 3, 1, 'Terdapat kesepakatan pihak-pihak tertentu untuk merencanakan kegiatan yang sama (duplikasi)'),
(280, 3, 1, 'Ada kesepakatan untuk meloloskan usulan kegiatan untuk kepentingan pihak tertentu yang menguntungkan secara pribadi atau golongan'),
(281, 3, 1, 'Pembahasan anggaran sudah diatur oleh TAPD untuk menguntungkan pihak-pihak tertentu'),
(282, 3, 1, 'Pembahasan Raperda APBD untuk meloloskan program yang menguntungkan pihak-pihak tertentu'),
(283, 3, 1, 'Musrenbang hanya membahas kegiatan yang sudah ditetapkan untuk menguntungkan kepentingan pihak tertentu'),
(284, 3, 1, 'Meloloskan usulan kegiatan yang menguntungkan pihak-pihak tertentu'),
(285, 3, 2, 'Uang/Barang Milik Daerah diambil untuk kepentingan pribadi'),
(286, 3, 2, 'Pengeluaran tanpa imbalan barang atau jasa (fiktif)'),
(287, 3, 2, 'Pungutan tidak memiliki dasar hukum '),
(288, 3, 2, 'Bantuan tidak diterima oleh masyarakat'),
(289, 3, 2, 'jumlah bantuan yang diterima masyarakat tidak tepat  '),
(290, 3, 2, 'Adanya kolusi'),
(291, 3, 2, 'Adanya nepotisme'),
(292, 3, 2, 'Rencana pengadaan di arahkan'),
(293, 3, 2, 'Rekayasa Pemaketan untuk KKN'),
(294, 3, 2, 'Penentuan jadwal pengadaan yang tidak realistis'),
(295, 3, 2, 'Panitia tidak transparan'),
(296, 3, 2, 'Integritas panitia lemah'),
(297, 3, 2, 'Panitia yang Memihak'),
(298, 3, 2, 'Panitia tidak independen'),
(299, 3, 2, 'Dokumen administrasi tidak emmenuhi syarat'),
(300, 3, 2, 'Dokumen administrasi \"Aspal\"'),
(301, 3, 2, 'Legalisasi dokumen tidak dilakukan'),
(302, 3, 2, 'Evaluasi prakualifikasi calon peserta lelang tidak sesuai kriteria'),
(303, 3, 2, 'Spesifikasi teknis di arahkan ke produk tertentu'),
(304, 3, 2, 'Rekayasa kriteria evaluasi prakualifikasi'),
(305, 3, 2, 'Dokumen lelang non standar'),
(306, 3, 2, 'Dokumen lelang yang tidak lengkap'),
(307, 3, 2, 'Jangka waktu pengumuman terlalu singkat'),
(308, 3, 2, 'Pengumuman lelang tidak lengkap'),
(309, 3, 2, 'Pengumuman lelang yang semu atau fiktif'),
(310, 3, 2, 'Dokumen lelang yang diserahkan tidak sama (inkonsisten)'),
(311, 3, 2, 'Waktu pendistribusian dokumen terbatas'),
(312, 3, 2, 'Lokasi pengambilan dokumen sulit di cari'),
(313, 3, 2, 'Harga dasar tidak standar (dalam KKN)'),
(314, 3, 2, 'Penentuan estimasi harga tidak sesuai aturan'),
(315, 3, 2, 'Pre-Bid Meeting yang terbatas'),
(316, 3, 2, 'Informasi dan deskripsi Terbatas'),
(317, 3, 2, 'Penjelasan yang kontroversial'),
(318, 3, 2, 'Relokasi tempat penyerahan dokumen penawaran'),
(319, 3, 2, 'Penerimaan dokumen penawaran yang terlambat'),
(320, 3, 2, 'Penyerahan dokumen fiktif'),
(321, 3, 2, 'Kriteraia evaluasi penawaran cacat'),
(322, 3, 2, 'Penggantian dokumen penawaran'),
(323, 3, 2, 'Evaluasi Tertutup dan Tersembunyi'),
(324, 3, 2, 'Peserta lelang terpola dalam rangka berkolusi'),
(325, 3, 2, 'Pengumuman calon pemenang terbatas'),
(326, 3, 2, 'Pengeumuman tanggal di tunda'),
(327, 3, 2, 'Pengumuman yang tidak sesuai dengan kaidah pengumuman'),
(328, 3, 2, 'Tidak seluruh sanggahan ditanggapai'),
(329, 3, 2, 'Substansi sanggahan tidak ditanggapai'),
(330, 3, 2, 'Sanggahan proforma untuk menghidari tuduhan lelang diatur'),
(331, 3, 2, 'Penandatangan kontrak yang kolutif'),
(332, 3, 2, 'Surat penunjukan pemenang tidak lengkap'),
(333, 3, 2, 'Surat penunjukan yang sengaja ditunda pengeluarannya'),
(334, 3, 2, 'Surat penunjukan yang  tidak sah'),
(335, 3, 2, 'Surat penunjukan yang  pengeluaranya terburu-buru'),
(336, 3, 2, 'Penandatangan kontrak yang secara tertutup'),
(337, 3, 2, 'Penandatangan kontrak yang tidak sah'),
(338, 3, 2, 'Penandatangan kontrak yang tertunda-tunda'),
(339, 3, 2, 'Adanya addendum kontrak yang tidak sesuai ketentuan'),
(340, 4, 1, 'Kegiatan yang masuk dalam RKPD bukan merupakan kegiatan yang ditetapkan dalam tahap Musrenbang '),
(341, 4, 1, 'Adanya pihak yang memasukkan aspirasi baru berupa kegiatan tidak sesuai dengan RPJMD, RKPD dan kewenangan'),
(342, 4, 1, 'Perubahan sasaran, lokasi dan volume kegiatan yang tidak didasarkan pada kebutuhan riil'),
(343, 6, 1, 'Lokasi kegiatan yang diusulkan tidak tepat/tidak sesuai dengan ketentuan'),
(344, 6, 1, 'Pemecahan Paket pada usulan kegiatan yang tidak sesuai ketentuan'),
(345, 6, 1, 'Usulan Kegiatan untuk Kepentingan Pihak Tertentu tidak sesuai dengan ketentuan'),
(346, 6, 1, 'Usulan perencanaan barang modal tidak sesuai dengan standar kebutuhan'),
(347, 6, 1, 'Harga komponen kegiatan melampaui harga pasar atau harga standar pemerintah daerah'),
(348, 6, 1, 'Mark up nilai kegiatan dengan cara memasukkan belanja dalam RKA melebihi standar harga atau belanja barang yang tidak sesuai kebutuhan riil'),
(349, 6, 2, 'Metode Pengadaan Tidak sesuai dengan ketentuan'),
(350, 6, 2, 'Kegiatan penghapusan barang milik daerah tidak sesuai ketentuan'),
(351, 6, 2, 'Salah saji material dalam penyajian nilai aset pada neraca Daerah'),
(352, 7, 1, 'Dokumen AMDAL tidak disusun');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `selera_risiko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id`, `nama_kategori`, `selera_risiko`) VALUES
(1, 'Operasional', 4),
(2, 'Finansial', 4),
(3, 'Fraud', 1),
(4, 'Strategis', 6),
(5, 'Reputasi', 1),
(6, 'Kepatuhan', 2),
(7, 'Lingkungan', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_maping`
--

CREATE TABLE `tbl_maping` (
  `id` int(11) NOT NULL,
  `sasaranpemda_id` int(11) DEFAULT NULL,
  `opd_id` int(11) DEFAULT NULL,
  `sasaranopd_id` int(11) DEFAULT NULL,
  `bobot` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_opd`
--

CREATE TABLE `tbl_opd` (
  `id` int(11) NOT NULL,
  `urusan_id` int(11) UNSIGNED NOT NULL,
  `bidang_id` int(11) UNSIGNED NOT NULL,
  `nama_opd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kepala_opd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pemda`
--

CREATE TABLE `tbl_pemda` (
  `id` int(11) NOT NULL,
  `tahun` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_pemda` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kepala_daerah` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_proses`
--

CREATE TABLE `tbl_proses` (
  `id` int(11) NOT NULL,
  `nama_proses` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `tbl_proses`
--

INSERT INTO `tbl_proses` (`id`, `nama_proses`) VALUES
(1, 'Perencanaan'),
(2, 'Pelaksanaan'),
(3, 'Penata Usahaan'),
(4, 'Pertanggung Jawaban'),
(5, 'Pemeriksaan'),
(6, 'Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` int(11) NOT NULL,
  `nama_role` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `nama_role`) VALUES
(1, 'Admin Pemda'),
(2, 'User Pemda 1'),
(3, 'User Pemda 2'),
(4, 'Admin OPD'),
(5, 'User OPD 1'),
(6, 'User OPD 2'),
(7, 'User OPD Kegiatan 1'),
(8, 'User OPD Kegiatan 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `opd_id` int(11) UNSIGNED DEFAULT NULL,
  `role_id` int(11) UNSIGNED NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `nama`, `username`, `opd_id`, `role_id`, `password`, `remember_token`) VALUES
(1, 'Admin pemda', 'adminpemda', NULL, 1, '$2y$10$eFsKffrP4OCPGoZfswmhoeYkNm/FQur/stQSsPi3bhSJS3/iQV2/W', 'unjK2K42HetSzI9YHbHspqNgy2ybwjxrOzxUMb201tqwkmWYxNP4SgPgz94E');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tujuan_opd`
--

CREATE TABLE `tujuan_opd` (
  `id` int(11) NOT NULL,
  `opd_id` int(11) UNSIGNED NOT NULL,
  `misi_id` int(11) UNSIGNED NOT NULL,
  `nama_tujuan` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tujuan_pemda`
--

CREATE TABLE `tujuan_pemda` (
  `id` int(11) NOT NULL,
  `misi_id` int(11) UNSIGNED NOT NULL,
  `nama_tujuan` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `visi_pemda`
--

CREATE TABLE `visi_pemda` (
  `id` int(11) NOT NULL,
  `nama_visi` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_opd`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vw_opd` (
`id` int(11)
,`nama_sasaran` varchar(255)
,`nama_risiko` varchar(255)
,`nama_proses` varchar(255)
,`tingkat_risiko` int(11)
,`bobot` int(11)
,`risiko_id` int(11) unsigned
,`sasaran_id` int(11) unsigned
,`proses_id` int(11) unsigned
,`tk1` decimal(45,2)
,`opd_id` int(11) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_pemda`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vw_pemda` (
`id` int(11)
,`nama_sasaran` varchar(255)
,`nama_risiko` varchar(255)
,`nama_proses` varchar(255)
,`tingkat_risiko` int(11)
,`bobot` int(11)
,`sasaran_id` int(11)
,`risiko_id` int(11)
,`proses_id` int(11)
,`tk2` decimal(46,3)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_opd`
--
DROP TABLE IF EXISTS `vw_opd`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_opd`  AS  select `a`.`id` AS `id`,`p`.`nama_sasaran` AS `nama_sasaran`,`b`.`nama_risiko` AS `nama_risiko`,`tp`.`nama_proses` AS `nama_proses`,`a`.`tingkat_risiko` AS `tingkat_risiko`,`o`.`bobot` AS `bobot`,`i`.`risiko_id` AS `risiko_id`,`i`.`sasaran_id` AS `sasaran_id`,`i`.`proses_id` AS `proses_id`,sum(((`a`.`tingkat_risiko` * `o`.`bobot`) * 0.01)) AS `tk1`,`i`.`opd_id` AS `opd_id` from (((((`analisis_kegiatan` `a` join `identifikasi_kegiatan` `i` on((`i`.`id` = `a`.`identifikasi_id`))) join `kegiatan_opd` `o` on((`o`.`id` = `i`.`kegiatan_id`))) join `tbl_baganrisiko` `b` on((`b`.`id` = `i`.`risiko_id`))) join `tbl_proses` `tp` on((`tp`.`id` = `i`.`proses_id`))) join `sasaran_opd` `p` on((`p`.`id` = `i`.`sasaran_id`))) group by `b`.`nama_risiko` order by sum(((`a`.`tingkat_risiko` * `o`.`bobot`) * 0.01)) desc ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_pemda`
--
DROP TABLE IF EXISTS `vw_pemda`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_pemda`  AS  select `ao`.`id` AS `id`,`sp`.`nama_sasaran` AS `nama_sasaran`,`tb`.`nama_risiko` AS `nama_risiko`,`tp`.`nama_proses` AS `nama_proses`,`ao`.`tingkat_risiko` AS `tingkat_risiko`,`tm`.`bobot` AS `bobot`,`io`.`sasaran_id` AS `sasaran_id`,`io`.`risiko_id` AS `risiko_id`,`io`.`risiko_id` AS `proses_id`,sum(((`ao`.`tingkat_risiko` * `tm`.`bobot`) * 0.001)) AS `tk2` from ((((((`analisis_opd` `ao` join `identifikasi_opd` `io` on((`ao`.`identifikasi_id` = `io`.`id`))) join `tbl_baganrisiko` `tb` on((`io`.`risiko_id` = `tb`.`id`))) join `sasaran_opd` `so` on((`io`.`sasaran_id` = `so`.`id`))) join `tbl_proses` `tp` on((`io`.`proses_id` = `tp`.`id`))) join `tbl_maping` `tm` on((`tm`.`sasaranopd_id` = `so`.`id`))) join `sasaran_pemda` `sp` on((`tm`.`sasaranpemda_id` = `sp`.`id`))) group by `tb`.`nama_risiko` order by sum(((`ao`.`tingkat_risiko` * `tm`.`bobot`) * 0.001)) desc ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analisis_kegiatan`
--
ALTER TABLE `analisis_kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identifikasi_id` (`identifikasi_id`),
  ADD KEY `analisis_kegiatan_kemungkinan_id_foreign` (`kemungkinan_id`),
  ADD KEY `analisis_kegiatan_dampak_id_foreign` (`dampak_id`);

--
-- Indexes for table `analisis_opd`
--
ALTER TABLE `analisis_opd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `analisis_pemda`
--
ALTER TABLE `analisis_pemda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `identifikasi_kegiatan`
--
ALTER TABLE `identifikasi_kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `identifikasi_opd`
--
ALTER TABLE `identifikasi_opd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `identifikasi_pemda`
--
ALTER TABLE `identifikasi_pemda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan_opd`
--
ALTER TABLE `kegiatan_opd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `misi_pemda`
--
ALTER TABLE `misi_pemda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemantauan_kegiatan`
--
ALTER TABLE `pemantauan_kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemantauan_opd`
--
ALTER TABLE `pemantauan_opd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemantauan_pemda`
--
ALTER TABLE `pemantauan_pemda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_opd`
--
ALTER TABLE `program_opd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_pemda`
--
ALTER TABLE `program_pemda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_bidang`
--
ALTER TABLE `ref_bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_dampak`
--
ALTER TABLE `ref_dampak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_kemungkinan`
--
ALTER TABLE `ref_kemungkinan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_urusan`
--
ALTER TABLE `ref_urusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rtp_kegiatan`
--
ALTER TABLE `rtp_kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rtp_opd`
--
ALTER TABLE `rtp_opd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rtp_pemda`
--
ALTER TABLE `rtp_pemda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sasaran_opd`
--
ALTER TABLE `sasaran_opd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sasaran_pemda`
--
ALTER TABLE `sasaran_pemda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_baganrisiko`
--
ALTER TABLE `tbl_baganrisiko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_maping`
--
ALTER TABLE `tbl_maping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_opd`
--
ALTER TABLE `tbl_opd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pemda`
--
ALTER TABLE `tbl_pemda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_proses`
--
ALTER TABLE `tbl_proses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tujuan_opd`
--
ALTER TABLE `tujuan_opd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tujuan_pemda`
--
ALTER TABLE `tujuan_pemda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visi_pemda`
--
ALTER TABLE `visi_pemda`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analisis_kegiatan`
--
ALTER TABLE `analisis_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `analisis_opd`
--
ALTER TABLE `analisis_opd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `analisis_pemda`
--
ALTER TABLE `analisis_pemda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `identifikasi_kegiatan`
--
ALTER TABLE `identifikasi_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `identifikasi_opd`
--
ALTER TABLE `identifikasi_opd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `identifikasi_pemda`
--
ALTER TABLE `identifikasi_pemda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kegiatan_opd`
--
ALTER TABLE `kegiatan_opd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `misi_pemda`
--
ALTER TABLE `misi_pemda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemantauan_kegiatan`
--
ALTER TABLE `pemantauan_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemantauan_opd`
--
ALTER TABLE `pemantauan_opd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemantauan_pemda`
--
ALTER TABLE `pemantauan_pemda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program_opd`
--
ALTER TABLE `program_opd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program_pemda`
--
ALTER TABLE `program_pemda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_bidang`
--
ALTER TABLE `ref_bidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `ref_dampak`
--
ALTER TABLE `ref_dampak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ref_kemungkinan`
--
ALTER TABLE `ref_kemungkinan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ref_urusan`
--
ALTER TABLE `ref_urusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rtp_kegiatan`
--
ALTER TABLE `rtp_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rtp_opd`
--
ALTER TABLE `rtp_opd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rtp_pemda`
--
ALTER TABLE `rtp_pemda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sasaran_opd`
--
ALTER TABLE `sasaran_opd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sasaran_pemda`
--
ALTER TABLE `sasaran_pemda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_baganrisiko`
--
ALTER TABLE `tbl_baganrisiko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=353;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_maping`
--
ALTER TABLE `tbl_maping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_opd`
--
ALTER TABLE `tbl_opd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pemda`
--
ALTER TABLE `tbl_pemda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_proses`
--
ALTER TABLE `tbl_proses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tujuan_opd`
--
ALTER TABLE `tujuan_opd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tujuan_pemda`
--
ALTER TABLE `tujuan_pemda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visi_pemda`
--
ALTER TABLE `visi_pemda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
