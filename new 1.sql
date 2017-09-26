-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 13, 2017 at 05:41 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `bit pros`
--

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `Buyer_ID` int(11) NOT NULL,
  `License` int(20) NOT NULL,
  `Insurance` varchar(11) NOT NULL,
  `Buyer/Leaseholder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`Buyer_ID`, `License`, `Insurance`, `Buyer/Leaseholder`) VALUES
(1, 1, 'GEICO', 1),
(2, 2, 'GEICO', 2),
(3, 3, 'State Farm', 1),
(4, 4, 'all state', 1),
(5, 5, 'all state', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Dealer`
--

CREATE TABLE `Dealer` (
  `Employee_ID` int(11) NOT NULL,
  `HiredDate` date NOT NULL,
  `UserID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Dealer`
--

INSERT INTO `Dealer` (`Employee_ID`, `HiredDate`, `UserID`) VALUES
(1, '2017-02-02', 1),
(2, '2016-02-04', 2),
(3, '2017-02-05', 3),
(4, '2013-02-01', 4),
(5, '2010-03-02', 5);

-- --------------------------------------------------------

--
-- Table structure for table `leasedatabase`
--

CREATE TABLE `leasedatabase` (
  `Renter_ID` int(100) NOT NULL,
  `Renter_Transaction_ID` int(100) NOT NULL,
  `Renter_Transaction_Date` date NOT NULL,
  `Employee_ID` int(100) NOT NULL,
  `VIN` varchar(100) NOT NULL,
  `Cost` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leasedatabase`
--

INSERT INTO `leasedatabase` (`Renter_ID`, `Renter_Transaction_ID`, `Renter_Transaction_Date`, `Employee_ID`, `VIN`, `Cost`) VALUES
(1, 1, '2010-04-19', 1, '392FJEI877', 1000),
(2, 2, '2017-01-09', 2, '898FEJI899', 500),
(3, 3, '2017-04-14', 3, '777FJEI999', 400),
(4, 4, '2017-01-09', 4, '777JFIE999', 6000),
(5, 5, '2010-12-01', 5, '878JFIE999', 700);

-- --------------------------------------------------------

--
-- Table structure for table `leasetransaction`
--

CREATE TABLE `leasetransaction` (
  `VIN` varchar(100) NOT NULL,
  `Renter_ID` int(100) NOT NULL,
  `Renter_Transaction_ID` int(100) NOT NULL,
  `Renter_Transaction_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leasetransaction`
--

INSERT INTO `leasetransaction` (`VIN`, `Renter_ID`, `Renter_Transaction_ID`, `Renter_Transaction_Date`) VALUES
('392FJEI877', 1, 1, '2010-04-19'),
('898FEJI899', 2, 2, '2017-01-09'),
('777FJEI999', 3, 3, '2017-04-14'),
('777JFIE999', 4, 4, '2017-01-09'),
('878JFIE999', 5, 5, '2010-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `salesdatabase`
--

CREATE TABLE `salesdatabase` (
  `VIN` varchar(11) NOT NULL,
  `Cost` int(11) NOT NULL,
  `Employee_ID` int(11) NOT NULL,
  `Buyer_ID` int(11) NOT NULL,
  `Sales_Transaction_ID` int(11) NOT NULL,
  `Sales_Transaction_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salesdatabase`
--

INSERT INTO `salesdatabase` (`VIN`, `Cost`, `Employee_ID`, `Buyer_ID`, `Sales_Transaction_ID`, `Sales_Transaction_Date`) VALUES
('123HEFD123', 10, 1, 1, 1, '2017-04-10'),
('387BFEF234', 37, 2, 2, 2, '2010-04-17'),
('376BNEF099', 30, 3, 3, 3, '2010-02-07'),
('272FNEF999', 70, 4, 4, 4, '2017-01-12'),
('777FJEI999', 90, 5, 5, 5, '2016-12-19');

-- --------------------------------------------------------

--
-- Table structure for table `salestransaction`
--

CREATE TABLE `salestransaction` (
  `Buyer_ID` int(11) NOT NULL,
  `Sales_Transaction_ID` int(11) NOT NULL,
  `Sales_Transaction_Date` date NOT NULL,
  `VIN` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salestransaction`
--

INSERT INTO `salestransaction` (`Buyer_ID`, `Sales_Transaction_ID`, `Sales_Transaction_Date`, `VIN`) VALUES
(1, 1, '2017-04-10', '123HEFD123'),
(2, 2, '2010-04-17', '387BFEF234'),
(3, 3, '2010-02-07', '376BNEF099'),
(4, 4, '2017-01-12', '272FNEH999'),
(5, 5, '2016-12-19', '777FJEI999');

-- --------------------------------------------------------

--
-- Table structure for table `Trader`
--

CREATE TABLE `Trader` (
  `Trader_ID` int(11) NOT NULL,
  `Credit_History` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Trader`
--

INSERT INTO `Trader` (`Trader_ID`, `Credit_History`) VALUES
(1, 650),
(2, 700),
(3, 600),
(4, 550),
(5, 719);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `F_name` varchar(100) NOT NULL,
  `L_name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone_Number` bigint(100) NOT NULL,
  `Gender` varchar(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`F_name`, `L_name`, `Email`, `Phone_Number`, `Gender`, `UserID`) VALUES
('Mike', 'Smith', 'mike@gmail.com', 238472928, 'Male', 1),
('Caithlyn', 'Brown', 'brown@gmail.com', 398269876, 'Female', 2),
('Sean', 'Sony', 'Sony34@yahoo.com', 193383612937, 'Male', 3),
('Ian', 'Cucumber', 'Cucumber@hotmail.com', 54099936752, 'Male', 4),
('Tracy', 'Smith', 'Tsmith@gmail.com', 3820483746, 'Female', 5),
('Emily', 'Johnson', 'johnson@gmail.com', 3764824766, 'Female', 6),
('Sally', 'Williams', 'Sally@hotmail.com', 3829482746, 'Female', 7),
('Daniel', 'Clark', 'clark@gmail.com', 5409873625, 'Male', 8),
('Kevin', 'Moore', 'moore@gmail.com', 5409873666, 'Male', 9),
('Robert', 'Robinson', 'Robinson@gmail.com', 8042836565, 'Male', 10),
('Anderew', 'Anderson', 'Anderson@gmail.com', 5408764857, 'Male', 11),
('Moore', 'Lee', 'Lee@hotmail.com', 8054730000, 'Male', 12),
('Allen', 'Young', 'ayoung@gmail.com', 8057368898, 'Male', 13),
('Malloy', 'Henson', 'Henson@gmail.com', 5409827777, 'Female', 14),
('Rachel', 'Park', 'white@gmail.com', 5406857622, 'Female', 15);

-- --------------------------------------------------------

--
-- Table structure for table `Vehicle`
--

CREATE TABLE `Vehicle` (
  `Car_ID` int(11) NOT NULL,
  `Employee_ID` int(11) NOT NULL,
  `Model` varchar(100) NOT NULL,
  `Mileage` int(100) NOT NULL,
  `Engine` int(11) NOT NULL,
  `VIN` varchar(100) NOT NULL,
  `option` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Vehicle`
--

INSERT INTO `Vehicle` (`Car_ID`, `Employee_ID`, `Model`, `Mileage`, `Engine`, `VIN`, `option`) VALUES
(6, 6, 'Hyundai', 0, 6, '123HEFD123', 'Yes'),
(7, 7, 'Toyota', 0, 7, '377BFEF234', 'No'),
(8, 8, 'Honda', 0, 8, '376BNEF099', 'No'),
(9, 9, 'Honda', 0, 9, '272FNEF999', 'Yes'),
(10, 10, 'Honda', 0, 10, '777FJEI999', 'No'),
(1, 1, 'Honda', 10000, 1, '392FJEI877', 'Yes'),
(2, 2, 'Toyota', 19000, 2, '898FEJI899', 'No'),
(3, 3, 'Honda', 50000, 3, '777FJEI999', 'No'),
(4, 4, 'Toyota', 20900, 4, '777JFIE999', 'No'),
(5, 5, 'Hyundai', 10000, 5, '878JFIE999', 'Yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`Buyer_ID`);

--
-- Indexes for table `User`