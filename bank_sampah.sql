-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Jul 2024 pada 06.29
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank_sampah`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_tabungan` (IN `p_nasabah_id` INT, IN `p_jumlah` DECIMAL(10,2))   BEGIN
    DECLARE p_rank VARCHAR(100);
    IF p_jumlah >= 6000 THEN
        SET p_rank = 'Platinum';
    ELSEIF p_jumlah >= 40000 THEN
        SET p_rank = 'Gold';
    ELSEIF p_jumlah >= 20000 THEN
        SET p_rank = 'Silver';
    ELSE
        SET p_rank = 'Bronze';
    END IF;
    INSERT INTO tabungan (nasabah_id, jumlah, rank)
    VALUES (p_nasabah_id, p_jumlah, p_rank);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_tabungan` ()   BEGIN SELECT * FROM tabungan; 
END$$

--
-- Fungsi
--
CREATE DEFINER=`root`@`localhost` FUNCTION `calculate_total` (`Harga_per_Kg` DECIMAL(10,2), `jumlah_kg` INT(2)) RETURNS DECIMAL(10,2)  BEGIN
	RETURN harga_per_kg * jumlah_kg;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `total_transaksi` () RETURNS DECIMAL(10,2)  BEGIN
    DECLARE total_sum DECIMAL(10, 2);

    SELECT SUM(total) INTO total_sum FROM transaksi_nasabah;

    RETURN total_sum;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gudang`
--

CREATE TABLE `gudang` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gudang`
--

INSERT INTO `gudang` (`id`, `nama`) VALUES
(1, 'Gudang 1'),
(2, 'Gudang 2'),
(3, 'Gudang 3'),
(4, 'Gudang 4'),
(5, 'Gudang 5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gudang_sampah`
--

CREATE TABLE `gudang_sampah` (
  `gudang_id` int(11) NOT NULL,
  `sampah_id` int(11) NOT NULL,
  `berat` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gudang_sampah`
--

INSERT INTO `gudang_sampah` (`gudang_id`, `sampah_id`, `berat`) VALUES
(1, 1, 150.00),
(1, 2, 200.00),
(1, 3, 100.00),
(2, 4, 50.00),
(2, 5, 300.00),
(2, 6, 20.00),
(3, 1, 80.00),
(3, 3, 120.00),
(4, 2, 150.00),
(4, 5, 200.00),
(5, 4, 60.00),
(5, 6, 30.00);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `horizontal_view_transaksi`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `horizontal_view_transaksi` (
`transaksi_id` int(11)
,`pengurus_id` int(11)
,`pengepul_id` int(11)
,`sampah_id` int(11)
,`berat` decimal(10,2)
,`total` decimal(10,2)
,`tanggal` date
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `entity` varchar(50) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  `old_name` varchar(100) DEFAULT NULL,
  `new_name` varchar(100) DEFAULT NULL,
  `old_alamat` varchar(100) DEFAULT NULL,
  `new_alamat` varchar(100) DEFAULT NULL,
  `old_no_telp` varchar(13) DEFAULT NULL,
  `new_no_telp` varchar(13) DEFAULT NULL,
  `old_tipe` varchar(8) DEFAULT NULL,
  `new_tipe` varchar(8) DEFAULT NULL,
  `old_rt` int(11) DEFAULT NULL,
  `new_rt` int(11) DEFAULT NULL,
  `old_rw` int(11) DEFAULT NULL,
  `new_rw` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id`, `entity`, `entity_id`, `action`, `old_name`, `new_name`, `old_alamat`, `new_alamat`, `old_no_telp`, `new_no_telp`, `old_tipe`, `new_tipe`, `old_rt`, `new_rt`, `old_rw`, `new_rw`, `timestamp`) VALUES
(1, 'Nasabah', 11, 'DELETE', 'Budi', NULL, 'Kulon', NULL, '08127163191', NULL, 'Individu', NULL, 2, NULL, 3, NULL, '2024-07-24 16:48:44'),
(2, 'Nasabah', 10, 'UPDATE', 'Chris Green', 'Chris Blue', 'Jl. Jati No. 10', 'Jl. Jati No. 10', '081234567899', '081234567899', 'Individu', 'Individu', 10, 10, 10, 10, '2024-07-24 16:48:53'),
(3, 'Nasabah', 10, 'UPDATE', 'Chris Blue', 'Chris Green', 'Jl. Jati No. 10', 'Jl. Jati No. 10', '081234567899', '081234567899', 'Individu', 'Individu', 10, 10, 10, 10, '2024-07-24 16:49:07'),
(4, 'Nasabah', 10, 'UPDATE', 'Chris Green', 'Chris Red', 'Jl. Jati No. 10', 'Jl. Jati No. 10', '081234567899', '081234567899', 'Individu', 'Individu', 10, 10, 10, 10, '2024-07-24 16:49:49'),
(5, 'Nasabah', 10, 'UPDATE', 'Chris Red', 'Chris Green', 'Jl. Jati No. 10', 'Jl. Jati No. 10', '081234567899', '081234567899', 'Individu', 'Individu', 10, 10, 10, 10, '2024-07-24 16:49:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nasabah`
--

CREATE TABLE `nasabah` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `tipe` enum('Individu','Kolektif') NOT NULL,
  `rt` int(11) NOT NULL,
  `rw` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nasabah`
--

INSERT INTO `nasabah` (`id`, `name`, `alamat`, `no_telp`, `tipe`, `rt`, `rw`) VALUES
(1, 'John Doe', 'Jl. Mawar No. 1', '081234567890', 'Individu', 1, 1),
(2, 'Jane Smith', 'Jl. Melati No. 2', '081234567891', 'Individu', 2, 2),
(3, 'SMA 02', 'Jl. Kenanga No. 3', '081234567892', 'Kolektif', 3, 3),
(4, 'Michael Brown', 'Jl. Cempaka No. 4', '081234567893', 'Individu', 4, 4),
(5, 'Linda White', 'Jl. Kamboja No. 5', '081234567894', 'Individu', 5, 5),
(6, 'PKK Anggrek', 'Jl. Teratai No. 6', '081234567895', 'Kolektif', 6, 6),
(7, 'Sarah Johnson', 'Jl. Dahlia No. 7', '081234567896', 'Individu', 7, 7),
(8, 'David Wilson', 'Jl. Anggrek No. 8', '081234567897', 'Individu', 8, 8),
(9, 'PAUD Bahagia', 'Jl. Bougenville No. 9', '081234567898', 'Kolektif', 9, 9),
(10, 'Chris Green', 'Jl. Jati No. 10', '081234567899', 'Individu', 10, 10);

--
-- Trigger `nasabah`
--
DELIMITER $$
CREATE TRIGGER `after_delete_log` AFTER DELETE ON `nasabah` FOR EACH ROW BEGIN
    INSERT INTO Log (
        entity, entity_id, action, 
        old_name, old_alamat, 
        old_no_telp, old_tipe, 
        old_rt, old_rw, 
        timestamp
    )
    VALUES (
        'Nasabah', OLD.id, 'DELETE', 
        OLD.name, OLD.alamat, 
        OLD.no_telp, OLD.tipe, 
        OLD.rt, OLD.rw, 
        NOW()
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_nasabah_log` AFTER UPDATE ON `nasabah` FOR EACH ROW BEGIN
    INSERT INTO Log (
        entity, entity_id, action, 
        old_name, new_name, 
        old_alamat, new_alamat, 
        old_no_telp, new_no_telp, 
        old_tipe, new_tipe, 
        old_rt, new_rt, 
        old_rw, new_rw, 
        timestamp
    )
    VALUES (
        'Nasabah', NEW.id, 'UPDATE', 
        OLD.name, NEW.name, 
        OLD.alamat, NEW.alamat, 
        OLD.no_telp, NEW.no_telp, 
        OLD.tipe, NEW.tipe, 
        OLD.rt, NEW.rt, 
        OLD.rw, NEW.rw, 
        NOW()
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `validasi_telp` BEFORE UPDATE ON `nasabah` FOR EACH ROW BEGIN
    IF NEW.No_Telp NOT REGEXP '^[0-9]{10,13}$' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Nomor telepon tidak valid. Harus terdiri dari 10 hingga 13 digit angka.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengepul`
--

CREATE TABLE `pengepul` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `perusahaan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengepul`
--

INSERT INTO `pengepul` (`id`, `nama`, `no_telp`, `alamat`, `perusahaan`) VALUES
(1, 'Charlie Davis', '081234567910', 'Jl. Teratai No. 6', 'Recycling Inc'),
(2, 'Diana Evans', '081234567911', 'Jl. Dahlia No. 7', 'Eco Waste'),
(3, 'Edward Green', '081234567912', 'Jl. Jati No. 8', 'Green Solutions'),
(4, 'Fiona Harris', '081234567913', 'Jl. Kenanga No. 9', 'Waste Management Ltd'),
(5, 'George King', '081234567914', 'Jl. Melati No. 10', 'Recycle Corp'),
(6, 'Hannah Lewis', '081234567915', 'Jl. Cempaka No. 11', 'Eco Future'),
(7, 'Iris Moore', '081234567916', 'Jl. Bougenville No. 12', 'Clean Earth'),
(8, 'Jack Brown', '081234567917', 'Jl. Mawar No. 13', 'Recycling Solutions'),
(9, 'Kara Martin', '081234567918', 'Jl. Anggrek No. 14', 'Waste Wise'),
(10, 'Liam Walker', '081234567919', 'Jl. Kamboja No. 15', 'Planet Recycle');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengurus`
--

CREATE TABLE `pengurus` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `bagian` enum('Keuangan','Pergudangan','Transaksi') NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengurus`
--

INSERT INTO `pengurus` (`id`, `nama`, `bagian`, `no_telp`, `alamat`) VALUES
(1, 'Alice Johnson', 'Keuangan', '081234567900', 'Jl. Bougenville No. 4'),
(2, 'Bob Brown', 'Pergudangan', '081234567901', 'Jl. Anggrek No. 5'),
(3, 'Charlie Davis', 'Transaksi', '081234567902', 'Jl. Teratai No. 6'),
(4, 'Diana Evans', 'Keuangan', '081234567903', 'Jl. Dahlia No. 7'),
(5, 'Edward Green', 'Pergudangan', '081234567904', 'Jl. Jati No. 8'),
(6, 'Fiona Harris', 'Transaksi', '081234567905', 'Jl. Kenanga No. 9'),
(7, 'George King', 'Keuangan', '081234567906', 'Jl. Kamboja No. 10'),
(8, 'Helen Adams', 'Pergudangan', '081234567907', 'Jl. Cempaka No. 11'),
(9, 'Ian White', 'Transaksi', '081234567908', 'Jl. Mawar No. 12'),
(10, 'Jill Brown', 'Keuangan', '081234567909', 'Jl. Melati No. 13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sampah`
--

CREATE TABLE `sampah` (
  `id` int(11) NOT NULL,
  `jenis_sampah` varchar(50) NOT NULL,
  `harga_per_kg` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sampah`
--

INSERT INTO `sampah` (`id`, `jenis_sampah`, `harga_per_kg`) VALUES
(1, 'Alumunium', 5000.00),
(2, 'Kertas', 3000.00),
(3, 'Botol Plastik', 7000.00),
(4, 'Botol Kaca', 4000.00),
(5, 'Plastik', 2000.00),
(6, 'Electronik', 15000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabungan`
--

CREATE TABLE `tabungan` (
  `id` int(11) NOT NULL,
  `nasabah_id` int(11) DEFAULT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `rank` enum('Bronze','Silver','Gold','Platinum') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tabungan`
--

INSERT INTO `tabungan` (`id`, `nasabah_id`, `jumlah`, `rank`) VALUES
(1, 1, 15000.00, 'Bronze'),
(2, 2, 25000.00, 'Silver'),
(3, 3, 55000.00, 'Gold'),
(4, 4, 35000.00, 'Silver'),
(5, 5, 70000.00, 'Platinum'),
(6, 6, 18000.00, 'Bronze'),
(7, 7, 80000.00, 'Platinum'),
(8, 8, 32000.00, 'Silver'),
(9, 9, 45000.00, 'Gold'),
(10, 10, 70000.00, 'Platinum'),
(11, 2, 80000.00, 'Platinum');

--
-- Trigger `tabungan`
--
DELIMITER $$
CREATE TRIGGER `before_delete_tabungan` BEFORE DELETE ON `tabungan` FOR EACH ROW BEGIN
    -- Check if the balance (jumlah) is greater than zero
    IF OLD.jumlah > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Tidak bisa menghapus nasabah karena masih punya simpanan.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_nasabah`
--

CREATE TABLE `transaksi_nasabah` (
  `id` int(11) NOT NULL,
  `pengurus_id` int(11) DEFAULT NULL,
  `sampah_id` int(11) DEFAULT NULL,
  `nasabah_id` int(11) DEFAULT NULL,
  `berat` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `ditabung` tinyint(1) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_nasabah`
--

INSERT INTO `transaksi_nasabah` (`id`, `pengurus_id`, `sampah_id`, `nasabah_id`, `berat`, `total`, `ditabung`, `tanggal`) VALUES
(1, 1, 1, 1, 10.00, 50000.00, 0, '2023-01-01'),
(2, 2, 2, 2, 5.00, 15000.00, 0, '2023-02-01'),
(3, 3, 3, 3, 8.00, 56000.00, 0, '2023-03-01'),
(4, 4, 4, 4, 12.00, 48000.00, 0, '2023-04-01'),
(5, 5, 5, 5, 15.00, 30000.00, 0, '2023-05-01'),
(6, 6, 1, 6, 14.00, 70000.00, 0, '2023-06-01'),
(7, 7, 2, 7, 18.00, 54000.00, 0, '2023-07-01'),
(8, 8, 3, 8, 20.00, 140000.00, 0, '2023-08-01'),
(9, 9, 4, 9, 10.00, 40000.00, 0, '2023-09-01'),
(10, 10, 5, 10, 25.00, 50000.00, 0, '2023-10-01');

--
-- Trigger `transaksi_nasabah`
--
DELIMITER $$
CREATE TRIGGER `after_insert_update_tabungan` AFTER INSERT ON `transaksi_nasabah` FOR EACH ROW BEGIN
    DECLARE p_rank VARCHAR(100);
    DECLARE p_jumlah DECIMAL(10,2);

    IF NEW.ditabung = TRUE THEN 
        SELECT jumlah INTO p_jumlah
        FROM tabungan
        WHERE nasabah_id = NEW.nasabah_id;

        IF p_jumlah IS NULL THEN
            SET p_jumlah = 0;
        END IF;

        SET p_jumlah = p_jumlah + NEW.total;

        IF p_jumlah >= 60000 THEN
            SET p_rank = 'Platinum';
        ELSEIF p_jumlah >= 40000 THEN
            SET p_rank = 'Gold';
        ELSEIF p_jumlah >= 20000 THEN
            SET p_rank = 'Silver';
        ELSE
            SET p_rank = 'Bronze';
        END IF;

        UPDATE tabungan
        SET jumlah = p_jumlah,
            rank = p_rank
        WHERE nasabah_id = NEW.nasabah_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_pengepul`
--

CREATE TABLE `transaksi_pengepul` (
  `id` int(11) NOT NULL,
  `pengurus_id` int(11) DEFAULT NULL,
  `pengepul_id` int(11) DEFAULT NULL,
  `sampah_id` int(11) DEFAULT NULL,
  `berat` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_pengepul`
--

INSERT INTO `transaksi_pengepul` (`id`, `pengurus_id`, `pengepul_id`, `sampah_id`, `berat`, `total`, `tanggal`) VALUES
(1, 1, 1, 1, 20.00, 100000.00, '2023-11-01'),
(2, 2, 2, 2, 15.00, 45000.00, '2023-12-01'),
(3, 3, 3, 3, 25.00, 175000.00, '2023-11-15'),
(4, 4, 4, 4, 30.00, 120000.00, '2023-12-15'),
(5, 5, 5, 5, 40.00, 80000.00, '2023-11-20'),
(6, 6, 6, 1, 12.00, 60000.00, '2023-10-01'),
(7, 7, 7, 2, 22.00, 66000.00, '2023-09-15'),
(8, 8, 8, 3, 18.00, 126000.00, '2023-08-20'),
(9, 9, 9, 4, 14.00, 56000.00, '2023-07-25'),
(10, 10, 10, 5, 25.00, 50000.00, '2023-06-30');

--
-- Trigger `transaksi_pengepul`
--
DELIMITER $$
CREATE TRIGGER `before_transaksi_pengepul` BEFORE INSERT ON `transaksi_pengepul` FOR EACH ROW BEGIN
    DECLARE total_berat DECIMAL(10, 2);
    SELECT IFNULL(SUM(berat), 0) INTO total_berat
    FROM gudang_sampah
    WHERE sampah_id = NEW.sampah_id;
    IF total_berat < NEW.berat THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Jumlah barang di gudang tidak mencukupi.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_tabungan`
--

CREATE TABLE `transaksi_tabungan` (
  `id` int(11) NOT NULL,
  `tabungan_id` int(11) DEFAULT NULL,
  `nasabah_id` int(11) DEFAULT NULL,
  `pengurus_id` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jumlah` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_tabungan`
--

INSERT INTO `transaksi_tabungan` (`id`, `tabungan_id`, `nasabah_id`, `pengurus_id`, `tanggal`, `jumlah`) VALUES
(1, 1, 1, 1, '2023-11-01', 25000.00),
(2, 2, 2, 2, '2023-12-01', 10000.00),
(3, 3, 3, 3, '2023-12-15', 30000.00),
(4, 4, 4, 4, '2023-11-15', 15000.00),
(5, 5, 5, 5, '2023-12-20', 35000.00),
(6, 6, 6, 6, '2023-10-01', 20000.00),
(7, 7, 7, 7, '2023-09-01', 40000.00),
(8, 8, 8, 8, '2023-08-01', 12000.00),
(9, 9, 9, 9, '2023-07-01', 25000.00),
(10, 10, 10, 10, '2023-06-01', 50000.00);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vertical_view_gudang_sampah`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vertical_view_gudang_sampah` (
`gudang_id` int(11)
,`sampah_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_tabungan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_tabungan` (
`id` int(11)
,`nasabah_id` int(11)
,`jumlah` decimal(10,2)
,`rank` enum('Bronze','Silver','Gold','Platinum')
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vov_tabungan_platinum`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vov_tabungan_platinum` (
`id` int(11)
,`nasabah_id` int(11)
,`jumlah` decimal(10,2)
,`rank` enum('Bronze','Silver','Gold','Platinum')
);

-- --------------------------------------------------------

--
-- Struktur untuk view `horizontal_view_transaksi`
--
DROP TABLE IF EXISTS `horizontal_view_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `horizontal_view_transaksi`  AS SELECT `transaksi_pengepul`.`id` AS `transaksi_id`, `transaksi_pengepul`.`pengurus_id` AS `pengurus_id`, `transaksi_pengepul`.`pengepul_id` AS `pengepul_id`, `transaksi_pengepul`.`sampah_id` AS `sampah_id`, `transaksi_pengepul`.`berat` AS `berat`, `transaksi_pengepul`.`total` AS `total`, `transaksi_pengepul`.`tanggal` AS `tanggal` FROM `transaksi_pengepul` WHERE `transaksi_pengepul`.`berat` > 5 ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vertical_view_gudang_sampah`
--
DROP TABLE IF EXISTS `vertical_view_gudang_sampah`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vertical_view_gudang_sampah`  AS SELECT `gudang_sampah`.`gudang_id` AS `gudang_id`, `gudang_sampah`.`sampah_id` AS `sampah_id` FROM `gudang_sampah` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_tabungan`
--
DROP TABLE IF EXISTS `view_tabungan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_tabungan`  AS SELECT `tabungan`.`id` AS `id`, `tabungan`.`nasabah_id` AS `nasabah_id`, `tabungan`.`jumlah` AS `jumlah`, `tabungan`.`rank` AS `rank` FROM `tabungan` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vov_tabungan_platinum`
--
DROP TABLE IF EXISTS `vov_tabungan_platinum`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vov_tabungan_platinum`  AS SELECT `view_tabungan`.`id` AS `id`, `view_tabungan`.`nasabah_id` AS `nasabah_id`, `view_tabungan`.`jumlah` AS `jumlah`, `view_tabungan`.`rank` AS `rank` FROM `view_tabungan` WHERE `view_tabungan`.`rank` = 'Platinum'WITH CASCADED CHECK OPTION  ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gudang_sampah`
--
ALTER TABLE `gudang_sampah`
  ADD PRIMARY KEY (`gudang_id`,`sampah_id`),
  ADD KEY `sampah_id` (`sampah_id`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nasabah`
--
ALTER TABLE `nasabah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_name` (`name`),
  ADD KEY `idx_no_telp` (`no_telp`),
  ADD KEY `idx_rt_rw` (`rt`,`rw`);

--
-- Indeks untuk tabel `pengepul`
--
ALTER TABLE `pengepul`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sampah`
--
ALTER TABLE `sampah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tabungan`
--
ALTER TABLE `tabungan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nasabah_id` (`nasabah_id`);

--
-- Indeks untuk tabel `transaksi_nasabah`
--
ALTER TABLE `transaksi_nasabah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengurus_id` (`pengurus_id`),
  ADD KEY `sampah_id` (`sampah_id`),
  ADD KEY `nasabah_id` (`nasabah_id`);

--
-- Indeks untuk tabel `transaksi_pengepul`
--
ALTER TABLE `transaksi_pengepul`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengurus_id` (`pengurus_id`),
  ADD KEY `sampah_id` (`sampah_id`),
  ADD KEY `pengepul_id` (`pengepul_id`);

--
-- Indeks untuk tabel `transaksi_tabungan`
--
ALTER TABLE `transaksi_tabungan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tabungan_id` (`tabungan_id`),
  ADD KEY `nasabah_id` (`nasabah_id`),
  ADD KEY `pengurus_id` (`pengurus_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `nasabah`
--
ALTER TABLE `nasabah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pengepul`
--
ALTER TABLE `pengepul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `sampah`
--
ALTER TABLE `sampah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tabungan`
--
ALTER TABLE `tabungan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `transaksi_nasabah`
--
ALTER TABLE `transaksi_nasabah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksi_pengepul`
--
ALTER TABLE `transaksi_pengepul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksi_tabungan`
--
ALTER TABLE `transaksi_tabungan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `gudang_sampah`
--
ALTER TABLE `gudang_sampah`
  ADD CONSTRAINT `gudang_sampah_ibfk_1` FOREIGN KEY (`gudang_id`) REFERENCES `gudang` (`id`),
  ADD CONSTRAINT `gudang_sampah_ibfk_2` FOREIGN KEY (`sampah_id`) REFERENCES `sampah` (`id`);

--
-- Ketidakleluasaan untuk tabel `tabungan`
--
ALTER TABLE `tabungan`
  ADD CONSTRAINT `tabungan_ibfk_1` FOREIGN KEY (`nasabah_id`) REFERENCES `nasabah` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi_nasabah`
--
ALTER TABLE `transaksi_nasabah`
  ADD CONSTRAINT `transaksi_nasabah_ibfk_1` FOREIGN KEY (`pengurus_id`) REFERENCES `pengurus` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transaksi_nasabah_ibfk_2` FOREIGN KEY (`sampah_id`) REFERENCES `sampah` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transaksi_nasabah_ibfk_3` FOREIGN KEY (`nasabah_id`) REFERENCES `nasabah` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `transaksi_pengepul`
--
ALTER TABLE `transaksi_pengepul`
  ADD CONSTRAINT `transaksi_pengepul_ibfk_1` FOREIGN KEY (`pengurus_id`) REFERENCES `pengurus` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transaksi_pengepul_ibfk_2` FOREIGN KEY (`sampah_id`) REFERENCES `sampah` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transaksi_pengepul_ibfk_3` FOREIGN KEY (`pengepul_id`) REFERENCES `pengepul` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `transaksi_tabungan`
--
ALTER TABLE `transaksi_tabungan`
  ADD CONSTRAINT `transaksi_tabungan_ibfk_1` FOREIGN KEY (`tabungan_id`) REFERENCES `tabungan` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transaksi_tabungan_ibfk_2` FOREIGN KEY (`nasabah_id`) REFERENCES `nasabah` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transaksi_tabungan_ibfk_3` FOREIGN KEY (`pengurus_id`) REFERENCES `pengurus` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
