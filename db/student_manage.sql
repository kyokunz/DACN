-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2023 at 12:58 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_manage`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `PageDescription` varchar(50) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`) VALUES
(1, 'aboutus', 'About Us', 'PHP', NULL, NULL, NULL),
(2, 'contactus', 'Contact Us', 'TP. Vinh', 'kyokunzxy@gmail.com', 363080284, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblstudent`
--

CREATE TABLE `tblstudent` (
  `ID` int(10) NOT NULL,
  `StudentName` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `StudentEmail` varchar(200) DEFAULT NULL,
  `StudentClass` varchar(100) DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `StuID` varchar(200) DEFAULT NULL,
  `ContactNumber` bigint(10) DEFAULT NULL,
  `Address` mediumtext DEFAULT NULL,
  `UserName` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `Image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblstudent`
--

INSERT INTO `tblstudent` (`ID`, `StudentName`, `StudentEmail`, `StudentClass`, `Gender`, `DOB`, `StuID`, `ContactNumber`, `Address`, `UserName`, `Password`, `Image`) VALUES
(13, 'Nguyễn Khánh', 'khanh123', '11', 'Nam', '2000-09-09', '123', 123, 'Vinh', 'khanh123', 'e10adc3949ba59abbe56e057f20f883e', '484b98916dbf2a0fe1d963148c2e2d741675415448.jpg'),
(14, 'Hoàng Cường', 'cuong124', '12', 'Nam', '2000-01-01', '124', 123456, 'Vinh', 'cuong123', 'e10adc3949ba59abbe56e057f20f883e', '677f62b52a06cb431ff12dacfc209f8d1675416299.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ketqua`
--

CREATE TABLE `tbl_ketqua` (
  `id` int(10) NOT NULL,
  `masv` int(10) NOT NULL,
  `mamon` int(10) NOT NULL,
  `diem` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ketqua`
--

INSERT INTO `tbl_ketqua` (`id`, `masv`, `mamon`, `diem`) VALUES
(11, 13, 5, 9),
(13, 13, 6, 8),
(14, 13, 7, 8),
(15, 14, 5, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_khoa`
--

CREATE TABLE `tbl_khoa` (
  `id` int(10) NOT NULL,
  `tenkhoa` varchar(255) NOT NULL,
  `ghichu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_khoa`
--

INSERT INTO `tbl_khoa` (`id`, `tenkhoa`, `ghichu`) VALUES
(8, 'Công nghệ thông tin', 'CNTT'),
(9, 'Cơ khí ô tô', 'CKOT'),
(11, 'Luật', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lophoc`
--

CREATE TABLE `tbl_lophoc` (
  `id` int(10) NOT NULL,
  `tenlop` varchar(255) NOT NULL,
  `khoa` int(10) NOT NULL,
  `ghichu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_lophoc`
--

INSERT INTO `tbl_lophoc` (`id`, `tenlop`, `khoa`, `ghichu`) VALUES
(11, '59K1', 8, ''),
(12, '59K2', 8, ''),
(13, '59K3', 8, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_monhoc`
--

CREATE TABLE `tbl_monhoc` (
  `id` int(10) NOT NULL,
  `tenmon` varchar(255) NOT NULL,
  `sotc` int(10) NOT NULL,
  `khoa` int(10) NOT NULL,
  `ghichu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_monhoc`
--

INSERT INTO `tbl_monhoc` (`id`, `tenmon`, `sotc`, `khoa`, `ghichu`) VALUES
(5, 'An toàn thông tin', 3, 8, ''),
(6, 'Cơ sở dữ liệu nâng cao', 3, 8, ''),
(7, 'Khai phá dữ liệu', 3, 8, ''),
(8, 'Lập trình Web', 3, 8, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nguoidung`
--

CREATE TABLE `tbl_nguoidung` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(8) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_nguoidung`
--

INSERT INTO `tbl_nguoidung` (`id`, `name`, `username`, `password`, `email`, `role`) VALUES
(1, 'Admin', 'admin', '123456', 'admin@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sinhvien`
--

CREATE TABLE `tbl_sinhvien` (
  `id` int(10) NOT NULL,
  `hoten` varchar(100) NOT NULL,
  `msv` varchar(14) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sodienthoai` varchar(12) DEFAULT NULL,
  `gioitinh` varchar(10) NOT NULL,
  `ngay_sinh` date NOT NULL,
  `dantoc` varchar(255) NOT NULL,
  `lop` int(10) NOT NULL,
  `diachi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblstudent`
--
ALTER TABLE `tblstudent`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_ketqua`
--
ALTER TABLE `tbl_ketqua`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_khoa`
--
ALTER TABLE `tbl_khoa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lophoc`
--
ALTER TABLE `tbl_lophoc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_monhoc`
--
ALTER TABLE `tbl_monhoc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_nguoidung`
--
ALTER TABLE `tbl_nguoidung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sinhvien`
--
ALTER TABLE `tbl_sinhvien`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblstudent`
--
ALTER TABLE `tblstudent`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_ketqua`
--
ALTER TABLE `tbl_ketqua`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_khoa`
--
ALTER TABLE `tbl_khoa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_lophoc`
--
ALTER TABLE `tbl_lophoc`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_monhoc`
--
ALTER TABLE `tbl_monhoc`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_nguoidung`
--
ALTER TABLE `tbl_nguoidung`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_sinhvien`
--
ALTER TABLE `tbl_sinhvien`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
