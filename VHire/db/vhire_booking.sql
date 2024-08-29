-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2022 at 07:45 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vhire_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `MiddleName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `ContactNumber` char(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `AdminType` enum('SuperAdmin','Admin') DEFAULT 'Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `FirstName`, `MiddleName`, `LastName`, `ContactNumber`, `Email`, `Username`, `Password`, `DateOfBirth`, `AdminType`) VALUES
(1, 'test', 'test', 'test', '09876543210', 'test@email.com', 'test', '827ccb0eea8a706c4c34a16891f84e7b', '1995-01-10', 'SuperAdmin'),
(2, 'tester', 'tester', 'tester', '09123456789', 'tester@email.com', 'tester', '827ccb0eea8a706c4c34a16891f84e7b', '2000-09-09', 'Admin'),
(3, 'Jom', 'Gil', 'Barce', '09123456789', 'jom@email.com', 'jom', 'barcenilla', '2000-02-24', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `MiddleName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `ContactNumber` char(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `ProfilePicture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `FirstName`, `MiddleName`, `LastName`, `ContactNumber`, `Email`, `Username`, `Password`, `DateOfBirth`, `ProfilePicture`) VALUES
(1, 'Jomer', 'Gilig', 'Barcenilla', '09567826962', 'jomer@email.com', 'jom', '827ccb0eea8a706c4c34a16891f84e7b', '2000-02-24', ''),
(2, 'Mary', 'Faustine', 'Gozon', '09123456789', 'mary@email.com', 'mary24', 'e10adc3949ba59abbe56e057f20f883e', '2001-08-18', ''),
(3, 'Niko', 'Gilig', 'Barcenilla', '09987654321', 'niko@email.com', 'niko10', '01cfcd4f6b8770febfb40cb906715822', '1998-10-10', ''),
(5, 'John', 'Joe', 'Doe', '09456789123', 'john@email.com', 'johndoe', '6c44e5cd17f0019c64b042e4a745412a', '1997-03-27', ''),
(6, 'Joe', 'Doe', 'John', '09987321654', 'joe@email.com', 'joejoe', '6c44e5cd17f0019c64b042e4a745412a', '1995-07-12', ''),
(7, 'Sam', 'Mas', 'Sam', '09963852741', 'sam@email.com', 'sammas', '6c44e5cd17f0019c64b042e4a745412a', '1991-05-30', ''),
(8, 'Mat', 'Tam', 'Matty', '09753951468', 'mattam@email.com', 'matty', 'e10adc3949ba59abbe56e057f20f883e', '1996-11-13', ''),
(9, 'Ana', 'Moe', 'Ama', '09638527419', 'ana@email.com', 'anamoe', 'e10adc3949ba59abbe56e057f20f883e', '1993-01-29', ''),
(10, 'Ina', 'Moe', 'Mama', '09784512963', 'inamama@email.com', 'inamoe', '827ccb0eea8a706c4c34a16891f84e7b', '1992-04-23', ''),
(11, 'Marie', 'Dizon', 'Ruiz', '09546213879', 'marie@email.com', 'marier', '01cfcd4f6b8770febfb40cb906715822', '2021-09-23', ''),
(12, 'Daniel', 'Dan', 'Cruz', '09586947123', 'daniel@email.com', 'dandan', '6c44e5cd17f0019c64b042e4a745412a', '2000-06-09', ''),
(13, 'Carl', 'Mael', 'Invoker', '09968523741', 'invoker@email.com', 'invoker', 'e10adc3949ba59abbe56e057f20f883e', '1991-10-31', ''),
(14, 'Clark', 'Mael', 'Injoker', '09968523741', 'injoker@email.com', 'injoker', '01cfcd4f6b8770febfb40cb906715822', '1992-08-22', ''),
(15, 'Mia', 'Ng', 'Co', '09695874231', 'mia@email.com', 'miang', '827ccb0eea8a706c4c34a16891f84e7b', '1989-06-15', ''),
(16, 'Abby', 'So', 'Tan', '09695874123', 'abby@email.com', 'abby', '6c44e5cd17f0019c64b042e4a745412a', '1994-04-12', ''),
(17, 'Juan', 'Cardo', 'Dalisay', '09645823179', 'juancardo@email.com', 'dalisay', 'e10adc3949ba59abbe56e057f20f883e', '1995-04-15', ''),
(18, 'Allan', 'Nalan', 'Sy', '0936251478', 'allansy@email.com', 'allans', '827ccb0eea8a706c4c34a16891f84e7b', '1992-07-02', ''),
(19, 'Lina', 'Ty', 'Inverse', '0947365821', 'lina@email.com', 'linainverse', '6c44e5cd17f0019c64b042e4a745412a', '2000-12-31', ''),
(20, 'Gab', 'Sy', 'Ty', '09147963258', 'gabty@email.com', 'gabby', '01cfcd4f6b8770febfb40cb906715822', '2002-11-01', ''),
(21, 'test', 'tester', 'testing', '09123456789', 'test@email.com', 'test', '827ccb0eea8a706c4c34a16891f84e7b', '2000-01-01', './images/users/ArietyBG1.jpg'),
(22, 'Jomer', 'Gilig', 'Barcenilla', '09369358060', '17101189@usc.edu.ph', 'jomer', '7710888c0e9abecfc0cb38025608728b', '2000-02-24', './images/users/wallpaperflare.com_wallpaper.jpg'),
(24, 'Jomer', 'Gilig', 'Barcenilla', '09369358060', 'jomerbarcenilla@gmail.com', 'jomerok', '7710888c0e9abecfc0cb38025608728b', '2000-02-24', '');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `DriverID` int(11) NOT NULL,
  `LicenseNumber` char(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `MiddleName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `ContactNumber` char(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `ProfilePicture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`DriverID`, `LicenseNumber`, `FirstName`, `MiddleName`, `LastName`, `ContactNumber`, `Email`, `Username`, `Password`, `DateOfBirth`, `ProfilePicture`) VALUES
(1, 'A1234567890', 'John', 'Juan', 'Cruz', '09123456785', 'cardo@email.com', 'cardo', '827ccb0eea8a706c4c34a16891f84e7b', '1995-11-01', ''),
(2, 'A0987654321', 'George', 'Jungle', 'Tarzan', '09098765432', 'g_tarzan@email.com', 'jungleboy', 'e10adc3949ba59abbe56e057f20f883e', '1990-09-14', ''),
(3, 'A1234567899', 'testing', 'tester', 'tests', '09876543212', 'test@test.com', 'test', '827ccb0eea8a706c4c34a16891f84e7b', '2000-01-01', './images/drivers/Keyboard1.jpg'),
(4, 'A1234567321', 'Manny', 'Pacman', 'Pacquiao', '09123456788', 'pacman@email.com', 'pacman', '827ccb0eea8a706c4c34a16891f84e7b', '1978-12-17', ''),
(5, 'A1234567816', 'Floyd', 'Money', 'Mayweather', '09123456756', 'money@email.com', 'money', '827ccb0eea8a706c4c34a16891f84e7b', '1977-02-24', ''),
(6, 'A9834767888', 'Mike', 'Iron', 'Tyson', '09432156756', 'iron@email.com', 'iron', '827ccb0eea8a706c4c34a16891f84e7b', '1966-05-30', ''),
(7, 'A9834754313', 'Kobe', 'Mamba', 'Bryant', '09432098732', 'mamba@email.com', 'mamba', '827ccb0eea8a706c4c34a16891f84e7b', '1978-08-23', ''),
(8, 'A9834873456', 'Lebron', 'King', 'James', '09432156756', 'king@email.com', 'king', '827ccb0eea8a706c4c34a16891f84e7b', '1984-12-30', ''),
(9, 'A9834709871', 'Stephen', 'Steph', 'Curry', '09432156756', 'steph@email.com', 'steph', '827ccb0eea8a706c4c34a16891f84e7b', '1988-03-14', ''),
(10, 'A9834128745', 'Allen', 'Answer', 'Iverson', '09432156756', 'answer@email.com', 'answer', '827ccb0eea8a706c4c34a16891f84e7b', '1975-05-27', ''),
(11, 'A1181007075', 'Niko', 'Gilig', 'Barcenilla', '09369768312', 'niko@gmail.com', 'niko', '7710888c0e9abecfc0cb38025608728b', '1998-10-10', '');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `ReservationID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `TripID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `BookedDate` datetime NOT NULL,
  `R_Status` enum('Accepted','Cancelled','Pending') DEFAULT 'Pending',
  `ConfirmationDate` datetime NOT NULL,
  `TotalFare` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`ReservationID`, `CustomerID`, `TripID`, `Quantity`, `BookedDate`, `R_Status`, `ConfirmationDate`, `TotalFare`) VALUES
(1, 21, 2, 2, '2022-06-11 00:00:00', 'Accepted', '2022-06-11 06:24:51', '40.00'),
(2, 21, 1, 1, '2022-06-11 00:00:00', 'Cancelled', '2022-06-11 07:00:00', '20.00'),
(3, 1, 1, 2, '2022-06-11 00:00:00', 'Accepted', '2022-06-11 07:00:00', '40.00'),
(4, 2, 1, 1, '2022-06-11 00:00:00', 'Accepted', '2022-06-11 07:00:00', '20.00'),
(5, 3, 1, 2, '2022-06-11 00:00:00', 'Accepted', '2022-06-11 07:00:00', '40.00'),
(6, 6, 10, 1, '2022-06-11 00:00:00', 'Accepted', '2022-06-11 07:00:00', '20.00'),
(7, 7, 18, 1, '2022-06-11 00:00:00', 'Accepted', '2022-06-11 07:00:00', '40.00'),
(8, 8, 7, 1, '2022-06-11 00:00:00', 'Accepted', '2022-06-11 07:00:00', '30.00'),
(9, 9, 14, 1, '2022-06-11 00:00:00', 'Accepted', '2022-06-11 07:00:00', '20.00'),
(10, 10, 3, 1, '2022-06-11 00:00:00', 'Accepted', '2022-06-11 07:00:00', '20.00'),
(11, 11, 3, 1, '2022-06-11 00:00:00', 'Accepted', '2022-06-11 06:24:51', '20.00'),
(12, 12, 3, 1, '2022-06-11 00:00:00', 'Accepted', '2022-06-11 06:27:30', '20.00'),
(13, 13, 3, 1, '2022-06-11 00:00:00', 'Accepted', '2022-06-11 06:30:12', '20.00'),
(14, 14, 3, 1, '2022-06-11 00:00:00', 'Cancelled', '2022-06-11 07:02:43', '20.00'),
(15, 15, 3, 2, '2022-06-11 00:00:00', 'Accepted', '2022-06-11 03:30:20', '40.00'),
(16, 16, 3, 1, '2022-06-11 00:00:00', 'Accepted', '2022-06-11 08:24:51', '20.00'),
(17, 17, 3, 1, '2022-06-11 00:00:00', 'Cancelled', '2022-06-11 09:48:00', '20.00'),
(18, 18, 3, 1, '2022-06-11 00:00:00', 'Accepted', '2022-06-11 10:30:00', '20.00'),
(19, 19, 3, 1, '2022-06-11 00:00:00', 'Accepted', '2022-06-11 11:11:00', '20.00'),
(20, 22, 3, 1, '2022-06-10 19:05:47', 'Accepted', '2022-06-11 01:41:57', '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `RouteID` int(11) NOT NULL,
  `OriginalTerminalID` int(11) NOT NULL,
  `DestinationTerminalID` int(11) NOT NULL,
  `Fare` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`RouteID`, `OriginalTerminalID`, `DestinationTerminalID`, `Fare`) VALUES
(1, 1, 2, '20.00'),
(2, 1, 3, '20.00'),
(3, 1, 4, '20.00'),
(4, 1, 5, '30.00'),
(5, 1, 6, '30.00'),
(6, 1, 7, '30.00'),
(7, 2, 1, '20.00'),
(8, 2, 3, '20.00'),
(9, 2, 4, '20.00'),
(10, 2, 5, '30.00'),
(11, 2, 6, '30.00'),
(12, 2, 7, '30.00'),
(13, 3, 1, '20.00'),
(14, 3, 2, '20.00'),
(15, 3, 4, '20.00'),
(16, 3, 5, '35.00'),
(17, 3, 6, '35.00'),
(18, 3, 7, '35.00'),
(19, 4, 1, '20.00'),
(20, 4, 2, '20.00'),
(21, 4, 3, '20.00'),
(22, 4, 5, '40.00'),
(23, 4, 6, '40.00'),
(24, 4, 7, '40.00'),
(25, 5, 1, '30.00'),
(26, 5, 2, '30.00'),
(27, 5, 3, '35.00'),
(28, 5, 4, '40.00'),
(29, 6, 1, '30.00'),
(30, 6, 2, '30.00'),
(31, 6, 3, '35.00'),
(32, 6, 4, '40.00'),
(33, 7, 1, '30.00'),
(34, 7, 2, '30.00'),
(35, 7, 3, '35.00'),
(36, 7, 4, '40.00');

-- --------------------------------------------------------

--
-- Table structure for table `terminal`
--

CREATE TABLE `terminal` (
  `TerminalID` int(11) NOT NULL,
  `AdminID` int(11) NOT NULL,
  `LocationName` varchar(300) NOT NULL,
  `City` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `terminal`
--

INSERT INTO `terminal` (`TerminalID`, `AdminID`, `LocationName`, `City`) VALUES
(1, 2, 'SM City Cebu Terminal', 'Cebu City'),
(2, 2, 'Ayala Center Cebu Terminal', 'Cebu City'),
(3, 2, 'Kamagayan UV Express Terminal', 'Cebu City'),
(4, 2, 'Cebu City South Terminal GT Express', 'Cebu City'),
(5, 2, 'Gaisano Island Mall Terminal', 'Lapu-Lapu City'),
(6, 2, 'Super Metro Gaisano Lapu-Lapu Terminal', 'Lapu-Lapu City'),
(7, 2, 'Gaisano Savers Mart Lapu-Lapu Terminal', 'Lapu-Lapu City');

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `TripID` int(11) NOT NULL,
  `VehicleID` int(11) NOT NULL,
  `RouteID` int(11) NOT NULL,
  `AvailableSeats` int(11) NOT NULL,
  `EstimatedTimeDeparture` datetime NOT NULL,
  `EstimatedTimeArrival` datetime NOT NULL,
  `Status` enum('Upcoming','Ongoing','Arrived') DEFAULT 'Upcoming',
  `DriverID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`TripID`, `VehicleID`, `RouteID`, `AvailableSeats`, `EstimatedTimeDeparture`, `EstimatedTimeArrival`, `Status`, `DriverID`) VALUES
(1, 1, 1, 14, '2022-06-11 20:13:22', '2022-06-11 22:41:55', 'Upcoming', 2),
(2, 2, 1, 14, '2022-06-11 20:31:25', '2022-06-11 20:31:31', 'Upcoming', 1),
(3, 1, 1, 14, '2022-06-11 20:31:35', '2022-06-11 22:00:00', 'Arrived', 3),
(4, 3, 7, 14, '2022-06-11 07:00:00', '2022-06-11 09:00:00', 'Upcoming', 5),
(5, 4, 8, 14, '2022-06-11 03:48:00', '2022-06-11 04:48:00', 'Upcoming', 4),
(6, 5, 9, 14, '2022-06-11 13:35:00', '2022-06-11 14:35:00', 'Upcoming', 4),
(7, 6, 10, 14, '2022-06-11 12:41:00', '2022-06-11 12:41:00', 'Upcoming', 6),
(8, 7, 10, 14, '2022-06-11 21:00:00', '2022-06-11 22:55:00', 'Upcoming', 7),
(9, 8, 11, 14, '2022-06-11 07:30:00', '2022-06-11 09:00:00', 'Upcoming', 7),
(10, 9, 15, 14, '2022-06-11 20:30:22', '2022-06-08 23:00:00', 'Upcoming', 8),
(11, 10, 16, 14, '2022-06-11 20:00:00', '2022-06-11 22:50:00', 'Upcoming', 5),
(12, 11, 17, 14, '2022-06-11 08:13:32', '2022-06-11 09:00:00', 'Upcoming', 8),
(13, 12, 19, 14, '2022-06-11 07:30:00', '2022-06-11 09:00:00', 'Upcoming', 9),
(14, 13, 20, 14, '2022-06-11 07:00:00', '2022-06-11 09:00:00', 'Upcoming', 4),
(15, 14, 21, 14, '2022-06-11 03:48:00', '2022-06-11 04:48:00', 'Upcoming', 9),
(16, 15, 25, 14, '2022-06-11 13:35:00', '2022-06-11 14:35:00', 'Upcoming', 6),
(17, 16, 27, 14, '2022-06-11 12:41:00', '2022-06-11 12:41:00', 'Upcoming', 5),
(18, 17, 28, 14, '2022-06-11 21:00:00', '2022-06-11 22:55:00', 'Upcoming', 6),
(19, 18, 29, 14, '2022-06-11 21:00:00', '2022-06-11 22:55:00', 'Upcoming', 10),
(20, 19, 36, 14, '2022-06-11 07:30:00', '2022-06-11 09:00:00', 'Upcoming', 10);

-- --------------------------------------------------------

--
-- Table structure for table `vhire`
--

CREATE TABLE `vhire` (
  `VehicleID` int(11) NOT NULL,
  `PlateNumber` char(8) NOT NULL,
  `Brand` varchar(50) NOT NULL,
  `Model` varchar(50) NOT NULL,
  `Capacity` int(11) NOT NULL,
  `Weight` decimal(6,2) NOT NULL,
  `Status` enum('In-Use','Available') DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vhire`
--

INSERT INTO `vhire` (`VehicleID`, `PlateNumber`, `Brand`, `Model`, `Capacity`, `Weight`, `Status`) VALUES
(1, 'ABC-1234', 'Toyota', 'Hiace', 14, '1700.00', 'Available'),
(2, 'ADC-1243', 'Toyota', 'Hiace', 14, '1700.00', 'Available'),
(3, 'ABC-2345', 'Toyota', 'Hiace', 14, '1700.00', 'Available'),
(4, 'ABC-3456', 'Toyota', 'Hiace', 14, '1700.00', 'Available'),
(5, 'ADC-4567', 'Toyota', 'Hiace', 14, '1700.00', 'Available'),
(6, 'KJL-5678', 'Toyota', 'Hiace', 14, '1700.00', 'Available'),
(7, 'BLM-6789', 'Toyota', 'Hiace', 14, '1700.00', 'Available'),
(8, 'DCQ-9876', 'Toyota', 'Hiace', 14, '1700.00', 'Available'),
(9, 'PSG-8765', 'Toyota', 'Hiace', 14, '1700.00', 'Available'),
(10, 'LGD-7654', 'Toyota', 'Hiace', 14, '1700.00', 'Available'),
(11, 'BFG-3124', 'Nissan', 'Urvan', 14, '1750.00', 'Available'),
(12, 'ACD-7698', 'Nissan', 'Urvan', 14, '1750.00', 'Available'),
(13, 'BCE-2031', 'Nissan', 'Urvan', 14, '1750.00', 'Available'),
(14, 'DAC-1803', 'Nissan', 'Urvan', 14, '1750.00', 'Available'),
(15, 'ABC-9358', 'Nissan', 'Urvan', 14, '1750.00', 'Available'),
(16, 'GIL-8734', 'Nissan', 'Urvan', 14, '1750.00', 'Available'),
(17, 'YTR-8096', 'Nissan', 'Urvan', 14, '1750.00', 'Available'),
(18, 'FGH-6734', 'Nissan', 'Urvan', 14, '1750.00', 'Available'),
(19, 'TYU-1287', 'Nissan', 'Urvan', 14, '1750.00', 'Available'),
(20, 'WEH-3874', 'Nissan', 'Urvan', 14, '1750.00', 'Available'),
(21, 'ADC-8436', 'Toyota', 'Hiace', 14, '1700.00', 'Available');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`DriverID`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`ReservationID`),
  ADD KEY `Reservation_FK1` (`CustomerID`),
  ADD KEY `Reservation_FK2` (`TripID`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`RouteID`),
  ADD KEY `Route_FK1` (`OriginalTerminalID`),
  ADD KEY `Route_FK2` (`DestinationTerminalID`);

--
-- Indexes for table `terminal`
--
ALTER TABLE `terminal`
  ADD PRIMARY KEY (`TerminalID`),
  ADD KEY `Terminal_FK` (`AdminID`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`TripID`),
  ADD KEY `Trip_FK1` (`VehicleID`),
  ADD KEY `Trip_FK2` (`RouteID`);

--
-- Indexes for table `vhire`
--
ALTER TABLE `vhire`
  ADD PRIMARY KEY (`VehicleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `DriverID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `ReservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `RouteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `terminal`
--
ALTER TABLE `terminal`
  MODIFY `TerminalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `TripID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `vhire`
--
ALTER TABLE `vhire`
  MODIFY `VehicleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `Reservation_FK1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`),
  ADD CONSTRAINT `Reservation_FK2` FOREIGN KEY (`TripID`) REFERENCES `trip` (`TripID`);

--
-- Constraints for table `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `Route_FK1` FOREIGN KEY (`OriginalTerminalID`) REFERENCES `terminal` (`TerminalID`),
  ADD CONSTRAINT `Route_FK2` FOREIGN KEY (`DestinationTerminalID`) REFERENCES `terminal` (`TerminalID`);

--
-- Constraints for table `terminal`
--
ALTER TABLE `terminal`
  ADD CONSTRAINT `Terminal_FK` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`);

--
-- Constraints for table `trip`
--
ALTER TABLE `trip`
  ADD CONSTRAINT `Trip_FK1` FOREIGN KEY (`VehicleID`) REFERENCES `vhire` (`VehicleID`),
  ADD CONSTRAINT `Trip_FK2` FOREIGN KEY (`RouteID`) REFERENCES `route` (`RouteID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
