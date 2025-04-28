-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 28 Apr 2025 pada 14.51
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kedaikopi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(12) NOT NULL,
  `id_detail_menu` text NOT NULL,
  `id_meja` int(12) NOT NULL,
  `nama_pemesan` varchar(250) NOT NULL,
  `nomor_hp` varchar(250) NOT NULL,
  `tanggal_pesan` datetime NOT NULL,
  `tanggal_reservasi` date NOT NULL,
  `total_pembayaran` int(12) NOT NULL,
  `total_sudah_dibayar` int(12) NOT NULL,
  `batas_pembayaran_dp` datetime NOT NULL,
  `status_pembayaran` varchar(250) NOT NULL DEFAULT 'Menunggu Pembayaran',
  `bukti_pembayaran` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`id_booking`, `id_detail_menu`, `id_meja`, `nama_pemesan`, `nomor_hp`, `tanggal_pesan`, `tanggal_reservasi`, `total_pembayaran`, `total_sudah_dibayar`, `batas_pembayaran_dp`, `status_pembayaran`, `bukti_pembayaran`) VALUES
(45, 'INV20250427000045', 3, 'asss', '12345', '2025-04-27 00:00:45', '2025-04-27', 50000, 50000, '2025-04-28 00:00:45', 'Sudah Bayar', 'Kosong'),
(46, 'INV20250427000202', 8, 'asss', '122', '2025-04-27 00:02:02', '2025-04-27', 30000, 0, '2025-04-28 00:02:02', 'Hangus', '27042025185523wallpaperflare-cropped.jpg'),
(47, 'INV20250427182806', 1, 'asss', '122333', '2025-04-27 18:28:06', '2025-04-27', 30000, 30000, '2025-04-28 18:28:06', 'Sudah Bayar', 'Kosong'),
(48, 'INV20250427184300', 4, 'aas', '222', '2025-04-27 18:43:00', '2025-04-27', 512000, 0, '2025-04-28 18:43:00', 'Hangus', 'Kosong'),
(49, 'INV20250428075456', 5, 'aaa', '1222', '2025-04-28 07:54:56', '2025-04-28', 20000, 0, '2025-04-29 07:54:56', 'Menunggu Pembayaran', 'Kosong'),
(50, 'INV20250428082135', 8, 'ada', '122', '2025-04-28 08:21:35', '2025-04-28', 300000, 0, '2025-04-29 08:21:35', 'Menunggu Pembayaran', 'Kosong'),
(51, 'INV20250428082310', 8, 'asdfg', '1222', '2025-04-28 08:23:10', '2025-04-28', 750000, 0, '2025-04-29 08:23:10', 'Menunggu Pembayaran', 'Kosong');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar_menu`
--

CREATE TABLE `gambar_menu` (
  `id_gambar` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `gambar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gambar_menu`
--

INSERT INTO `gambar_menu` (`id_gambar`, `id_menu`, `gambar`) VALUES
(2, 2, '22092021172127mie-ayam.jpg'),
(3, 2, '22092021174747miee2.jpg'),
(5, 2, '22092021175050mi2asd.jpg'),
(6, 1, '22092021180735Bakso_mi_bihun.jpg'),
(7, 1, '220920211807421140357898.jpg'),
(8, 8, '0610202109160311Jugosylicuadosquetequitanlaansiedadyteayudanabajardepeso.jpg'),
(9, 8, '06102021091612Esjerukphotography.jpg'),
(10, 7, '06102021091833Sips-KatieChrist.jpg'),
(12, 7, '06102021091907EsTehSerai-LemongrassIceTea.jpg'),
(14, 16, '06102021092328orange-coconutmilkshake.jpg'),
(16, 16, '06102021092756024b5b71-b655-4e9b-9f7e-fc37ed0eb720.jpg'),
(17, 16, '06102021092845TheBestStrawberryMilkshake-BakingMischief.jpg'),
(19, 12, '06102021093111NasiGoreng(IndonesianFriedRice).jpg'),
(20, 12, '06102021093206BrownRiceNasiGoreng(IndonesianFriedRice)IGeorgieEats.jpg'),
(21, 13, '061020210934115d4481d7-66a4-4e4a-82f6-de49b246e92d.jpg'),
(24, 13, '06102021093658SateKambingYangEmpuk.jpg'),
(25, 15, '06102021093836SopBuntut_IndonesianOxtailSoup.jpg'),
(26, 11, '06102021093956ResepSotoLamonganAsliJawaTimurDenganSuwiranAyamDanKuahKuning.jpg'),
(27, 17, '25042025123946125193312_p0.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lupa_password`
--

CREATE TABLE `lupa_password` (
  `id_lupa_password` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `pertanyaankeamanan1` varchar(255) NOT NULL,
  `pertanyaankeamanan2` varchar(255) NOT NULL,
  `jawabankeamanan1` varchar(255) NOT NULL,
  `jawabankeamanan2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lupa_password`
--

INSERT INTO `lupa_password` (`id_lupa_password`, `id_pegawai`, `pertanyaankeamanan1`, `pertanyaankeamanan2`, `jawabankeamanan1`, `jawabankeamanan2`) VALUES
(1, 1, 'Berapa angka favorit anda?(Contoh: 99)', 'Siapakah nama hewan peliharaan anda?', '7', 'alfan'),
(2, 3, 'Apa hewan kesayangan anda?', 'Apa cita-cita anda semasa kecil?', 'Harimau Sumatra', 'Progamer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `meja`
--

CREATE TABLE `meja` (
  `id_meja` int(11) NOT NULL,
  `nomor_meja` varchar(50) NOT NULL,
  `kapasitas_meja` int(11) NOT NULL,
  `status_tersedia` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Tersedia, 0=Tidak Tersedia',
  `lokasi` enum('indoor','outdoor') NOT NULL DEFAULT 'indoor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `meja`
--

INSERT INTO `meja` (`id_meja`, `nomor_meja`, `kapasitas_meja`, `status_tersedia`, `lokasi`) VALUES
(1, '1', 4, 1, 'indoor'),
(3, '5', 10, 1, 'indoor'),
(4, '3', 6, 1, 'indoor'),
(5, '2', 2, 1, 'indoor'),
(6, '4', 10, 1, 'indoor'),
(8, '6', 20, 1, 'indoor'),
(11, '7', 8, 1, 'indoor'),
(12, '9', 2, 1, 'indoor'),
(14, '10', 6, 1, 'indoor'),
(15, '11', 2, 1, 'indoor'),
(16, '12', 2, 1, 'indoor'),
(17, '13', 4, 1, 'indoor'),
(18, '14', 4, 1, 'indoor'),
(19, '15', 4, 1, 'indoor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `detail_menu` text NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `stok` varchar(50) NOT NULL DEFAULT 'Tersedia',
  `harga` int(100) NOT NULL,
  `status_delete` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `detail_menu`, `kategori`, `stok`, `harga`, `status_delete`) VALUES
(1, 'Bakso', 'Bakso Daging', 'Makanan', 'Tidak Tersedia', 20000, 0),
(2, 'Mie Ayam', 'Topping Ayam, Topping Jamur ', 'Makanan', 'Tersedia', 15000, 0),
(7, 'Es Teh', 'Jasmine, Lychee, Oolong', 'Minuman', 'Tersedia', 8000, 0),
(8, 'Es Jeruk', 'Nipis, Lemon, Jeruk Asli', 'Minuman', 'Tersedia', 10000, 0),
(11, 'Soto Lamongan ', 'Nikmati kehangatan Soto Lamongan dengan kuah kaldu ayam yang gurih, ayam suwir, taoge, dan ketupat. Disajikan dengan sambal, emping, dan perasan jeruk nipis untuk rasa yang segar dan nikmat.', 'Makanan', 'Tersedia', 15000, 0),
(12, 'Nasi Goreng', 'Jawa, Mawut, Seafood', 'Makanan', 'Tersedia', 25000, 0),
(13, 'Sate Daging', 'Ayam asli, Kambing, Sapi', 'Makanan', 'Tersedia', 25000, 0),
(15, 'Sop Buntut', 'Buntut Sapi', 'Makanan', 'Tersedia', 35000, 0),
(16, 'Milkshake', 'Coklat, Vanila, Greentea, Strawberry', 'Minuman', 'Tersedia', 15000, 0),
(17, 'kopi', 'jahe', 'Minuman', 'Tersedia', 12000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_dibooking`
--

CREATE TABLE `menu_dibooking` (
  `id_menu_dibooking` int(12) NOT NULL,
  `id_detail_menu` text NOT NULL,
  `nama_makanan` varchar(250) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `sub_total` int(12) NOT NULL,
  `status_order` varchar(255) NOT NULL DEFAULT 'success'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu_dibooking`
--

INSERT INTO `menu_dibooking` (`id_menu_dibooking`, `id_detail_menu`, `nama_makanan`, `jumlah`, `sub_total`, `status_order`) VALUES
(78, 'INV20250427182806', 'Soto Lamongan ', 2, 30000, 'success'),
(79, 'INV20250427184300', 'Es Teh', 22, 176000, 'success'),
(80, 'INV20250427184300', 'kopi', 28, 336000, 'success'),
(81, 'INV20250428075456', 'Es Jeruk', 2, 20000, 'success'),
(82, 'INV20250428082135', 'Soto Lamongan ', 10, 150000, 'success'),
(83, 'INV20250428082135', 'Milkshake', 10, 150000, 'success'),
(84, 'INV20250428082310', 'Sate Daging', 30, 750000, 'success');

-- --------------------------------------------------------

--
-- Struktur dari tabel `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id_metode` int(12) NOT NULL,
  `nama_merchant` varchar(250) NOT NULL,
  `atas_nama` varchar(250) NOT NULL,
  `kode_pembayaran` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id_metode`, `nama_merchant`, `atas_nama`, `kode_pembayaran`) VALUES
(1, 'Dana', 'Afriza Morales', '081222333444'),
(2, 'Bank BCA', 'Nazril Santiago', '8222333444'),
(4, 'LinkAja', 'Ridho Hernández', '081222333444'),
(5, 'GoPay', 'Himmati Martínez', '081222333444');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `jabatan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `email`, `alamat`, `password`, `telepon`, `jenis_kelamin`, `jabatan`) VALUES
(3, 'Bos Admin', 'admin@gmail.com', 'Jl. Anggrek 51 Malang', '21232f297a57a5a743894a0e4a801fc3', '081222333444', 'Pria', 'admin'),
(6, 'Budi', 'pegawai@gmail.com', 'Jl. Magelang', '047aeeb234644b9e2d4138ed3bc7976a', '082333444555', 'Laki-laki', 'pegawai'),
(8, 'Rahmat', 'rahmat@gmail.com', 'Daerah Istimewa Yogyakarta', 'af2a4c9d4c4956ec9d6ba62213eed568', '087888999000', 'Laki-laki', 'pegawai'),
(9, 'Mamat', 'mamat@gmail.com', 'Daerah Istimewa Yogyakarta', '24b65fcef95d94b6d41ecaa85a70e46f', '089000999000', 'Laki-laki', 'pegawai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL,
  `nama_pengaturan` varchar(100) NOT NULL,
  `nilai` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `nama_pengaturan`, `nilai`, `keterangan`) VALUES
(1, 'status_pemesanan', 'aktif', 'Status fitur pemesanan (aktif/nonaktif)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil_usaha`
--

CREATE TABLE `profil_usaha` (
  `id` int(12) NOT NULL,
  `nama_usaha` varchar(250) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `nomor_telepon` varchar(17) NOT NULL,
  `jam_operasional` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `instagram` varchar(50) NOT NULL,
  `facebook` varchar(250) NOT NULL,
  `maps_link` text NOT NULL,
  `foto_usaha_1` text NOT NULL,
  `foto_usaha_2` text NOT NULL,
  `foto_usaha_3` text NOT NULL,
  `notifikasi_aktif` tinyint(1) NOT NULL DEFAULT 1,
  `pesan_notifikasi` text DEFAULT NULL,
  `last_updated` int(11) DEFAULT 0,
  `foto_usaha_4` text DEFAULT NULL,
  `foto_usaha_5` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `profil_usaha`
--

INSERT INTO `profil_usaha` (`id`, `nama_usaha`, `deskripsi`, `alamat`, `nomor_telepon`, `jam_operasional`, `email`, `instagram`, `facebook`, `maps_link`, `foto_usaha_1`, `foto_usaha_2`, `foto_usaha_3`, `notifikasi_aktif`, `pesan_notifikasi`, `last_updated`, `foto_usaha_4`, `foto_usaha_5`) VALUES
(1, 'POS CAFE', 'Pos Cafe adalah tempat yang pas buat kamu menikmati kopi dalam suasana hangat dan nyaman. Dengan desain yang simpel dan cozy, kami menyajikan berbagai pilihan kopi spesial dan camilan lezat yang cocok untuk menemani ngobrol santai atau mengerjakan tugas. Mulai dari racikan klasik sampai kreasi kekinian, semua disiapkan dengan perhatian penuh pada rasa dan kualitas. Dengan pelayanan yang ramah, setiap kunjungan ke Pos Cafe dijamin jadi pengalaman yang seru dan berkesan.\r\n', 'JL. Raya ketintang selatan no:1 Surabaya', '081222333455', 'Senin-Sabtu: 09.00 - 23.00', 'poscafesby@gmail.com', 'pos_cafesby', 'pos_cafesby', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.320104376785!2d112.7231775743149!3d-7.317893071956464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb654b6b51d1%3A0x2b6bd242d8a4a88d!2sPOS%20Cafe!5e0!3m2!1sid!2sid!4v1745837782716!5m2!1sid!2sid', '28042025140524GambarKedaiKopiKecilDenganMejaDanKerusiKayu,KafeKedaiKopiInstoreTanpaOrangBahanGambarKafeteria,GambarFotografiHd,HartaBendaLatarbelakanguntukMuatturunPercuma.jpg', '28042025143642gambarwebsite.jpg', '28042025140236FreshgourmetmealbeeftacosaladplategeneratedbyAI_AI-generatedimage.jpg', 1, 'Selamat datang di kedai kami!', 1745840737, '28042025140427CupOfLatteOnWoodenTableBackground,CoffeePictureAesthetic,CoffeePowerpoint,CoffeeBackgroundImageAndWallpaperforFreeDownload.jpg', '28042025135658Cinnamoncoffee.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saran_kritik`
--

CREATE TABLE `saran_kritik` (
  `id_saran` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `saran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `saran_kritik`
--

INSERT INTO `saran_kritik` (`id_saran`, `nama_pelanggan`, `email`, `tanggal`, `saran`) VALUES
(15, 'Subekan', 'subekan@gmail.com', '2021-09-20', 'Rumah makan atau restoran adalah istilah umum untuk menyebut usaha gastronomi yang menyajikan hidangan kepada masyarakat dan menyediakan tempat untuk menikmati hidangan tersebut serta menetapkan tarif tertentu untuk makanan dan pelayanannya. Meski pada umumnya rumah makan menyajikan makanan di tempat, tetapi ada juga beberapa yang menyediakan layanan take-out dining dan delivery service sebagai salah satu bentuk pelayanan kepada konsumennya. Rumah makan biasanya memiliki spesialisasi dalam jenis makanan yang dihidangkannya. Sebagai contoh yaitu rumah makan chinese food, rumah makan Padang, rumah makan cepat saji (fast food restaurant) dan sebagainya.'),
(16, 'Bambang', 'bambang@gmail.com', '2021-10-01', 'Restoran ini tempatnya nyaman dan bersih. Pelayanannya pun sangat baik dan ramah. Dan tentunya menu yang ditawarkan juga enak. '),
(17, 'Yordi', 'yordiii022@gmail.com', '2021-10-04', 'Tolong kebersihan ditingkatkan'),
(23, 'Ardan', 'ardannn@gmail.com', '2021-11-09', 'Tolong kebersihan sampahnya dijaga'),
(24, 'asss', 'admin@gmail.com', '2025-04-27', 'ass');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indeks untuk tabel `gambar_menu`
--
ALTER TABLE `gambar_menu`
  ADD PRIMARY KEY (`id_gambar`);

--
-- Indeks untuk tabel `lupa_password`
--
ALTER TABLE `lupa_password`
  ADD PRIMARY KEY (`id_lupa_password`);

--
-- Indeks untuk tabel `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`id_meja`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `menu_dibooking`
--
ALTER TABLE `menu_dibooking`
  ADD PRIMARY KEY (`id_menu_dibooking`);

--
-- Indeks untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id_metode`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `profil_usaha`
--
ALTER TABLE `profil_usaha`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `saran_kritik`
--
ALTER TABLE `saran_kritik`
  ADD PRIMARY KEY (`id_saran`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `gambar_menu`
--
ALTER TABLE `gambar_menu`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `lupa_password`
--
ALTER TABLE `lupa_password`
  MODIFY `id_lupa_password` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `meja`
--
ALTER TABLE `meja`
  MODIFY `id_meja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `menu_dibooking`
--
ALTER TABLE `menu_dibooking`
  MODIFY `id_menu_dibooking` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id_metode` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `profil_usaha`
--
ALTER TABLE `profil_usaha`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `saran_kritik`
--
ALTER TABLE `saran_kritik`
  MODIFY `id_saran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
