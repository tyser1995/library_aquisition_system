-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2022 at 03:24 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lib_aqui`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `activity_ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `identifier` varchar(45) DEFAULT NULL,
  `is_read` tinyint(4) DEFAULT '0',
  `time` timestamp(1) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`activity_ID`, `user_id`, `identifier`, `is_read`, `time`) VALUES
(9, 8, 'books-to-verify', 1, NULL),
(10, 8, 'books-to-verify', 1, NULL),
(11, 8, 'books-to-verify', 1, NULL),
(12, 8, 'books-to-verify', 1, NULL),
(13, 8, 'books-to-verify', 1, NULL),
(14, 8, 'books-to-verify', 1, NULL),
(15, 8, 'books-to-verify', 1, NULL),
(16, 8, 'books-to-verify', 1, NULL),
(17, 8, 'books-to-verify', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `add_budget`
--

CREATE TABLE `add_budget` (
  `budgetID` int(11) NOT NULL,
  `budget` varchar(45) DEFAULT NULL,
  `selectDepartment` varchar(45) DEFAULT NULL,
  `dateAdded` date DEFAULT NULL,
  `libFee` varchar(45) DEFAULT NULL,
  `Filipiniana` varchar(45) DEFAULT NULL,
  `Reference` varchar(45) DEFAULT NULL,
  `Semester` int(11) DEFAULT NULL,
  `remarks` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `add_budget`
--

INSERT INTO `add_budget` (`budgetID`, `budget`, `selectDepartment`, `dateAdded`, `libFee`, `Filipiniana`, `Reference`, `Semester`, `remarks`) VALUES
(1, '50000', 'Filipiniana', '2022-03-28', '', NULL, NULL, NULL, ''),
(2, '50000', 'Reference', '2022-03-28', 'null', NULL, NULL, NULL, ''),
(3, '65000', 'College of Computer Studies', '2022-03-28', '650', NULL, NULL, NULL, ''),
(4, '65000', 'College of Business & Accountancy', '2022-03-28', '650', NULL, NULL, NULL, ''),
(5, '65000', 'College of Theology', '2022-03-28', '650', NULL, NULL, NULL, ''),
(6, '130000', 'College of Medical Laboratory Science', '2022-03-28', '650', NULL, NULL, NULL, ''),
(7, '6500', 'College of Medical Laboratory Science', '2022-03-28', '650', NULL, NULL, NULL, ''),
(8, '500', 'College of Medical Laboratory Science', '2022-03-28', '500', NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `entry_books`
--

CREATE TABLE `entry_books` (
  `entryBooksID` int(11) NOT NULL,
  `BookID` varchar(10) NOT NULL,
  `EntryDate` date DEFAULT NULL,
  `Author` varchar(45) DEFAULT NULL,
  `Title` varchar(45) DEFAULT NULL,
  `NumberOfCopies` varchar(45) DEFAULT NULL,
  `Edition` varchar(45) DEFAULT NULL,
  `noteEntry` varchar(100) DEFAULT NULL,
  `PublicationDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entry_books`
--

INSERT INTO `entry_books` (`entryBooksID`, `BookID`, `EntryDate`, `Author`, `Title`, `NumberOfCopies`, `Edition`, `noteEntry`, `PublicationDate`) VALUES
(1, 'MAR231', '2021-06-08', 'Marion Puzo', 'The God Father', '123', 'New', 'Mafia', '1995-01-31'),
(2, 'TLD324', '2021-06-08', 'Mario Puzo', 'The Last Don', '23', '2', 'Sicillian Base Mafia, Trying a shot in Vast land of America', '1986-03-24'),
(3, 'F42', '2021-06-13', 'Justin Blake', 'Friends', '2', 'New', 'Friendships', '1995-03-20'),
(4, 'sample22', '2021-06-13', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', '2021-06-13'),
(6, 'RESTY1', '2021-06-13', 'Resty', 'Resty', 'Resty', 'New', 'Resty', '2021-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `requestform`
--

CREATE TABLE `requestform` (
  `requestID` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `rushornrush` varchar(45) DEFAULT NULL,
  `authorName` varchar(45) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `edition` varchar(45) DEFAULT NULL,
  `copvol` varchar(45) DEFAULT NULL,
  `pubdate` date DEFAULT NULL,
  `pubName` varchar(45) DEFAULT NULL,
  `pubAddress` varchar(45) DEFAULT NULL,
  `recomby` varchar(45) DEFAULT NULL,
  `position` varchar(45) DEFAULT NULL,
  `chargeto` varchar(45) DEFAULT NULL,
  `subject` varchar(45) DEFAULT NULL,
  `enumtitle` varchar(45) DEFAULT NULL,
  `notereqform` varchar(45) DEFAULT NULL,
  `dealer` varchar(45) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `dated` varchar(45) DEFAULT NULL,
  `sinumb` varchar(45) DEFAULT NULL,
  `addedAs` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `entryDate` date DEFAULT NULL,
  `bookRef` varchar(45) DEFAULT NULL,
  `selectDepartment` varchar(45) DEFAULT NULL,
  `approval` tinyint(4) DEFAULT '0',
  `signature` tinyblob,
  `approvalVpaa` tinyint(4) DEFAULT '0',
  `vpaaName` varchar(400) DEFAULT NULL,
  `approvalDean` tinyint(4) DEFAULT '0',
  `deanName` varchar(45) DEFAULT NULL,
  `requestee` varchar(45) DEFAULT NULL,
  `userID` varchar(45) DEFAULT NULL,
  `selectPosition` varchar(45) DEFAULT NULL,
  `approvalDateDean` date DEFAULT NULL,
  `approvalDateVPAA` date DEFAULT NULL,
  `approvalFinanceDate` date DEFAULT NULL,
  `approvalFinance` tinyint(4) DEFAULT '0',
  `financeName` varchar(400) DEFAULT NULL,
  `approvalAcqui` tinyint(4) DEFAULT '0',
  `acquisitionName` varchar(45) DEFAULT NULL,
  `statusPass` tinyint(4) DEFAULT '0',
  `approvalPresident` tinyint(4) DEFAULT '0',
  `approvalDatePresident` date DEFAULT NULL,
  `verifytocustodian` tinyint(4) DEFAULT '0',
  `verified` tinyint(4) DEFAULT '0',
  `verifiedDate` date DEFAULT NULL,
  `sendToCustodianDate` date DEFAULT NULL,
  `sendtoDirector` tinyint(4) DEFAULT '0',
  `sendDatetoDirector` date DEFAULT NULL,
  `approvalDirector` tinyint(4) DEFAULT '0',
  `directorName` varchar(400) DEFAULT NULL,
  `approvalDateDirector` date DEFAULT NULL,
  `approvalVpaaPayment` tinyint(4) DEFAULT '0',
  `apporvalVpaaDatePayment` date DEFAULT NULL,
  `signtureDirector` varchar(100) DEFAULT NULL,
  `signatureFinance` varchar(100) DEFAULT NULL,
  `signatureVPAA` varchar(100) DEFAULT NULL,
  `signatureDean` varchar(100) DEFAULT NULL,
  `signatureAcquisition` varchar(100) DEFAULT NULL,
  `approvalFinancePayment` tinyint(4) DEFAULT '0',
  `approvalFinanceDatePayment` date DEFAULT NULL,
  `updateDate` date DEFAULT NULL,
  `saveDate` date DEFAULT NULL,
  `savePub` tinyint(4) DEFAULT '0',
  `approveBooksPublisher` int(11) DEFAULT '0',
  `pubID` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requestform`
--

INSERT INTO `requestform` (`requestID`, `date`, `rushornrush`, `authorName`, `title`, `edition`, `copvol`, `pubdate`, `pubName`, `pubAddress`, `recomby`, `position`, `chargeto`, `subject`, `enumtitle`, `notereqform`, `dealer`, `price`, `dated`, `sinumb`, `addedAs`, `status`, `entryDate`, `bookRef`, `selectDepartment`, `approval`, `signature`, `approvalVpaa`, `vpaaName`, `approvalDean`, `deanName`, `requestee`, `userID`, `selectPosition`, `approvalDateDean`, `approvalDateVPAA`, `approvalFinanceDate`, `approvalFinance`, `financeName`, `approvalAcqui`, `acquisitionName`, `statusPass`, `approvalPresident`, `approvalDatePresident`, `verifytocustodian`, `verified`, `verifiedDate`, `sendToCustodianDate`, `sendtoDirector`, `sendDatetoDirector`, `approvalDirector`, `directorName`, `approvalDateDirector`, `approvalVpaaPayment`, `apporvalVpaaDatePayment`, `signtureDirector`, `signatureFinance`, `signatureVPAA`, `signatureDean`, `signatureAcquisition`, `approvalFinancePayment`, `approvalFinanceDatePayment`, `updateDate`, `saveDate`, `savePub`, `approveBooksPublisher`, `pubID`) VALUES
(1, '2022-03-28', 'Rush', 'Ivan Sample', 'Data Sci1', 'E2', '50', '2022-03-28', 'Ivan Raymundo', 'iLOILO', NULL, NULL, 'College of Computer Studies', 'Computer', '0', 'aa', 'undefined', '50000', 'undefined', 'undefined', 'undefined', 2, '2022-03-28', NULL, 'College of Computer Studies', 0, NULL, 1, 'Nino Z Poe', 1, 'sloppy chicken joe', 'FacultyFaculty', '1', 'Faculty', '2022-03-28', '2022-03-28', '2022-03-28', 1, 'Carl J Cruz', 1, 'Jenn B Bode', 1, 0, NULL, 1, 1, '2022-03-28', '2022-03-28', 1, '2022-03-28', 1, 'Paullene J Santos', '2022-03-28', 1, '2022-03-28', '/uploads/f44b643d-28b3-43fd-8c22-adef099bfeec.jpg', '/uploads/5c87bddc-eabb-4c35-84e9-9b00f1e8bce6.jpg', '/uploads/ccaafa83-b438-4ff7-a16b-c8b4b8624c53.jpg', '/uploads/ae17c0a2-43ff-4390-acdf-3ec40751653f.jpg', '/uploads/883aba24-7931-4052-b46e-e3a0fffafa98.jpg', 1, '2022-03-28', '2022-03-28', NULL, 0, 0, NULL),
(2, '2022-03-28', 'Rush', 'Carl Jezzo Calatcat', 'Data Sci 2', 'E2', '20', '2022-03-28', 'Ivan Raymundo', 'iLOILO', NULL, NULL, 'College of Computer Studies', 'Computer', '0', 'aa', 'undefined', '20000', 'undefined', 'undefined', 'undefined', 2, '2022-03-28', NULL, 'College of Computer Studies', 0, NULL, 1, 'Nino Z Poe', 1, 'Raizen M Alintana', 'IvanRaymundo', '1', 'Faculty', '2022-03-28', '2022-03-28', '2022-03-28', 1, 'Carl J Cruz', 1, 'Jenn B Bode', 0, 0, NULL, 1, 1, '2022-03-28', '2022-03-28', 1, '2022-03-28', 1, 'Paullene J Santos', '2022-03-28', 1, '2022-03-28', '/uploads/743bb09f-058a-4756-90c5-7599d0256517.jpg', '/uploads/5cb7f2ea-5ed5-463b-89e9-1c8a29ac51ba.jpg', '/uploads/84946d87-b305-44a3-a500-e47b7852777d.jpg', '/uploads/a2fdd7d6-a2cc-4fa2-9606-2ebcdc80abe4.jpg', '/uploads/60a82455-3483-4b6a-a872-a293c35cbfa1.jpg', 1, '2022-03-28', '2022-03-28', NULL, 0, 0, NULL),
(3, '2022-03-28', 'Rush', 'Carl Jezzo Calatcat', 'Data Science', 'E2', '2', '2022-03-28', 'Ivan Raymundo', 'ILOILO', NULL, NULL, 'College of Computer Studies', 'Computer', '0', 'Notes', 'undefined', '5000', 'undefined', 'undefined', 'undefined', 2, '2022-03-28', NULL, 'College of Computer Studies', 0, NULL, 1, 'Nino Z Poe', 1, 'Raizen M Alintana', 'IvanRaymundo', '1', 'Faculty', '2022-03-28', '2022-03-28', '2022-03-28', 1, 'Carl J Cruz', 1, 'Jenn B Bode', 0, 0, NULL, 1, 1, '2022-03-28', '2022-03-28', 1, '2022-03-28', 1, 'Paullene J Santos', '2022-03-28', 1, '2022-03-28', '/uploads/d66ae0aa-5bd0-4865-a4aa-f936e19d9413.jpg', '/uploads/9c629df7-e8de-4f08-b6e6-bb6b1848535d.jpg', '/uploads/63d77d1e-40ef-4498-ad84-333372c60fff.jpg', '/uploads/3fe6e1a4-80cd-468b-8c8d-2bdd35c563d8.jpg', '/uploads/bd376650-e7d8-4d8e-a54c-b705a1d35b00.jpg', 1, '2022-03-28', '2022-03-28', NULL, 0, 0, NULL),
(4, '2022-04-01', 'Rush', 'Sample', 'Sample', 'Sample', '2', '2022-04-01', 'Sample', 'Sample', NULL, NULL, 'College of Computer Studies', 'Sample', '0', 'Sample', 'undefined', '500', 'undefined', 'undefined', 'undefined', 2, '2022-04-01', NULL, 'College of Computer Studies', 0, NULL, 1, 'Nino Z Poe', 1, 'Raizen M Alintana', 'IvanRaymundo', '1', 'Faculty', '2022-04-01', '2022-04-01', '2022-04-01', 1, 'Carl J Cruz', 1, 'Jenn B Bode', 0, 0, NULL, 1, 1, '2022-04-01', '2022-04-01', 1, '2022-04-01', 1, 'Paullene J Santos', '2022-04-01', 1, '2022-04-01', '/uploads/7492f8ba-80f6-41e4-8c17-253b58a38c14.jpg', '/uploads/6762a519-9bdf-4153-bd2e-ed22ac2f5103.jpg', '/uploads/bb0a40da-5373-44f3-914c-383e176e31f2.jpg', '/uploads/23f3087d-91db-4068-a5c3-151c28cce08b.jpg', '/uploads/b94bbd41-e08c-4ae5-9e6d-24e8d2100021.jpg', 1, '2022-04-01', '2022-04-01', NULL, 0, 0, NULL),
(5, '2022-06-17', 'Rush', 'sample', 'sample', 'sample', '1', '2022-06-17', 'sample', 'sample', NULL, NULL, 'College of Computer Studies', 'sample', 'undefined', 'sample', 'undefined', '500', 'undefined', 'undefined', 'undefined', 0, '2022-06-17', NULL, 'College of Computer Studies', 0, NULL, 1, NULL, 1, 'Raizen M Alintana', 'IvanRaymundo', '1', 'Faculty', '2022-06-17', '2022-06-17', '2022-06-17', 1, NULL, 1, NULL, 0, 0, NULL, 0, 0, NULL, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, '/uploads/5988bf87-f47f-45da-ac4b-3db1d728dd99.jpg', NULL, 0, NULL, NULL, NULL, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uname` varchar(45) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `mname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `pnumber` varchar(45) DEFAULT NULL,
  `selectDepartment` varchar(45) DEFAULT NULL,
  `selectPosition` varchar(45) DEFAULT NULL,
  `pubAddress` varchar(45) DEFAULT NULL,
  `pubName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `fname`, `mname`, `lname`, `password`, `email`, `pnumber`, `selectDepartment`, `selectPosition`, `pubAddress`, `pubName`) VALUES
(1, 'Faculty', 'Ivan', 'A', 'Raymundo', 'Faculty', 'Faculty@gmail.com', 'Faculty', 'College of Computer Studies', 'Faculty', NULL, NULL),
(2, 'DeanCCS', 'Raizen', 'M', 'Alintana', 'DeanCCS', 'sloppy@gmail.com', '0966167218', 'College of Computer Studies', 'Dean', NULL, NULL),
(3, 'VPAA', 'Nino', 'Z', 'Poe', 'VPAA', 'vpaa@gmaiil.com', '0966167218', 'VPAA', 'VPAA', NULL, NULL),
(7, 'admin', 'admin', 'admin', 'admin', 'admin', 'admin@gm2aiil.com', '1234', 'College of Theology', 'Admin', NULL, NULL),
(8, 'Acquisition', 'Jenn', 'B', 'Bode', 'Acquisition', 'andrew@gmail.com', '333', 'Library', 'Acquisition', NULL, NULL),
(9, 'President', 'President', 'President', 'President', 'President', 'President@qaweq', '123', 'President', 'President', NULL, NULL),
(10, 'Faculty1', 'Faculty1', 'Faculty1', 'Faculty1', 'Faculty1', 'Faculty1@qweqw', '12344', 'College of Theology', 'Faculty1', NULL, NULL),
(11, 'DeanTheo', 'DeanTheo', 'DeanTheo', 'DeanTheo', 'DeanTheo', 'DeanTheo', 'DeanTheo', 'College of Theology', 'Dean', NULL, NULL),
(12, 'Finance', 'Carl', 'J', 'Cruz', 'Finance', 'Finance@Finance', '12323', 'Finance', 'Finance', NULL, NULL),
(13, 'Custodian', 'Vicente', 'E', 'One', 'Custodian', 'Custodian', 'Custodian', 'Custodian', 'Custodian', NULL, NULL),
(18, 'DirectorLibraries', 'Paullene', 'J', 'Santos', 'DirectorLibraries', 'directoroflibraries@gmailc.ocm', '2', 'Director of Libraries', 'Director of Libraries', NULL, NULL),
(19, 'Publisher', 'Publisher', 'Publisher', 'Publisher', 'Publisher', 'Publisher@Publisher.com', 'Publisher', 'Publisher', 'Publisher', NULL, NULL),
(20, 'new', '123', '123', '123', '1234', 'stalinsteam06@gmail.com', '1233', 'College of Computer Studies', '>Director of Library', NULL, NULL),
(21, 'Publisher1', NULL, NULL, NULL, 'Publisher1', 'Publisher1@Publisher1', '312312', NULL, 'Publisher', 'Jaro', 'Tabun Aks'),
(22, 'Publisher2', NULL, NULL, NULL, 'Publisher2', 'Publisher2@Publisher2', '32', NULL, NULL, 'Publisher2', 'Publisher2'),
(23, 'Publisher3', NULL, NULL, NULL, 'Publisher3', 'Publishe@Publisher32', '12312', NULL, 'Publisher', 'Publisher3', 'Publisher3'),
(26, 'Publisher23', NULL, NULL, NULL, 'Publisher', 'stalinsteam06@gmail.com', '1233', NULL, 'Publisher', 'm2_bs_body_s.dds', 'sigtesta');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activity_ID`);

--
-- Indexes for table `add_budget`
--
ALTER TABLE `add_budget`
  ADD PRIMARY KEY (`budgetID`);

--
-- Indexes for table `entry_books`
--
ALTER TABLE `entry_books`
  ADD PRIMARY KEY (`entryBooksID`),
  ADD UNIQUE KEY `BookID_UNIQUE` (`BookID`);

--
-- Indexes for table `requestform`
--
ALTER TABLE `requestform`
  ADD PRIMARY KEY (`requestID`),
  ADD UNIQUE KEY `requestID_UNIQUE` (`requestID`),
  ADD UNIQUE KEY `bookID_UNIQUE` (`bookRef`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`uname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `activity_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `add_budget`
--
ALTER TABLE `add_budget`
  MODIFY `budgetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `entry_books`
--
ALTER TABLE `entry_books`
  MODIFY `entryBooksID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requestform`
--
ALTER TABLE `requestform`
  MODIFY `requestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
