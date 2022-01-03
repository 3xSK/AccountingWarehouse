-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 03, 2022 at 12:34 PM
-- Server version: 10.3.32-MariaDB-log-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theazsjv_accounting`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `aid` int(11) NOT NULL,
  `acctCode` int(11) NOT NULL,
  `assets` text NOT NULL,
  `debit` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`aid`, `acctCode`, `assets`, `debit`) VALUES
(1, 102, 'Cash', '10000.00'),
(2, 122, 'Accounts Receivable', '1500.00'),
(3, 141, 'Supplies', '1250.00'),
(4, 142, 'Office Equipment', '7500.00'),
(5, 143, 'Prepaid Rent', '4500.00'),
(6, 144, 'Prepaid Insurance', '1800.00'),
(7, 201, 'Unearned Revenue', '3000.00');

-- --------------------------------------------------------

--
-- Table structure for table `balancesheet`
--

CREATE TABLE `balancesheet` (
  `assets` text NOT NULL,
  `liabilities` text NOT NULL,
  `equities` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coa`
--

CREATE TABLE `coa` (
  `id` int(11) NOT NULL,
  `acctCode` int(11) NOT NULL,
  `acctName` text NOT NULL,
  `acctCategory` text NOT NULL,
  `term` text NOT NULL,
  `normalside` text NOT NULL,
  `initbalance` varchar(150) NOT NULL,
  `datecreated` date NOT NULL,
  `acctStatus` text NOT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `statement` varchar(10) DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coa`
--

INSERT INTO `coa` (`id`, `acctCode`, `acctName`, `acctCategory`, `term`, `normalside`, `initbalance`, `datecreated`, `acctStatus`, `user_id`, `statement`, `comment`) VALUES
(31, 102, 'Cash', 'Asset', 'Current', 'Debit', '10000', '0000-00-00', 'Active', NULL, NULL, NULL),
(32, 122, 'Accounts Receivable', 'Asset', 'Current', 'Debit', '1500', '0000-00-00', 'Active', NULL, NULL, NULL),
(33, 141, 'Supplies', 'Asset', 'Current', 'Debit', '1250', '0000-00-00', 'Active', NULL, NULL, NULL),
(34, 142, 'Office Equipment', 'Asset', 'Long-term', 'Debit', '7500', '0000-00-00', 'Active', NULL, NULL, NULL),
(35, 301, 'Contributed Capitol', 'Equity', 'Current', 'Credit', '20250', '0000-00-00', 'Active', NULL, NULL, NULL),
(38, 143, 'Prepaid Rent', 'Asset', 'Current', 'Debit', '4500', '0000-00-00', 'Active', NULL, NULL, NULL),
(39, 144, 'Prepaid Insurance', 'Asset', 'Current', 'Debit', '1800', '0000-00-00', 'Active', NULL, NULL, NULL),
(40, 201, 'Unearned Revenue', 'Liability', 'Current', 'Debit', '1500', '0000-00-00', 'Active', NULL, NULL, NULL),
(42, 202, 'Account Payable', 'Liability', 'Current', 'Credit', '1800', '0000-00-00', 'Active', NULL, NULL, NULL),
(43, 512, 'Advertising Expense', 'Expense', 'Current', 'Debit', '120', '0000-00-00', 'Active', NULL, NULL, NULL),
(44, 401, 'Service Revenue', 'Revenue', 'Current', 'Debit', '2250', '0000-00-00', 'Active', NULL, NULL, NULL),
(46, 522, 'Salaries Expense', 'Expense', 'Current', 'Debit', '400', '0000-00-00', 'Active', NULL, NULL, NULL),
(47, 525, 'Telephone Expenses', 'Expense', 'Current', 'Debit', '130', '0000-00-00', 'Active', NULL, NULL, NULL),
(48, 533, 'Utilities Expense', 'Expense', 'Current', 'Debit', '200', '0000-00-00', 'Active', NULL, NULL, NULL),
(49, 535, 'Insurance Expense', 'Expense', 'Current', 'Debit', '150', '0000-00-00', 'Active', NULL, NULL, NULL),
(50, 523, 'Supplies Expense', 'Expense', 'Current', 'Debit', '980', '0000-00-00', 'Active', NULL, NULL, NULL),
(51, 541, 'Deprecation Expense', 'Expense', 'Current', 'Debit', '500', '0000-00-00', 'Active', NULL, NULL, NULL),
(52, 543, 'Accumulated Deprecation', 'Asset', 'Current', 'Credit', '', '0000-00-00', 'Inactive', NULL, NULL, NULL),
(53, 521, 'Rent Expense', 'Expense', 'Current', 'Debit', '1500', '0000-00-00', 'Active', NULL, NULL, NULL),
(54, 219, 'Salaries Payable', 'Liability', 'Current', 'Credit', '20', '0000-00-00', 'Active', NULL, NULL, NULL),
(59, 121, 'Notes Receivable', 'Asset', 'Current', 'Debit', '0.00', '2021-09-12', 'Active', '95', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `coa_log`
--

CREATE TABLE `coa_log` (
  `event_id` int(11) NOT NULL,
  `acctCode` int(11) NOT NULL,
  `acctName` text NOT NULL,
  `acctCategory` text NOT NULL,
  `term` text NOT NULL,
  `normalside` text NOT NULL,
  `initbalance` varchar(150) NOT NULL,
  `datecreated` date NOT NULL,
  `acctStatus` text NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `statement` varchar(10) DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `Status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coa_log`
--

INSERT INTO `coa_log` (`event_id`, `acctCode`, `acctName`, `acctCategory`, `term`, `normalside`, `initbalance`, `datecreated`, `acctStatus`, `user_id`, `statement`, `comment`, `Status`) VALUES
(8, 201, '', '', '', '', '', '0000-00-00', '', '0', '', '', 'Activated_Record'),
(9, 201, '', '', '', '', '', '2021-09-12', '', '0', '', '', 'Deactivated_Record'),
(10, 201, '', '', '', '', '', '0000-00-00', '', '0', '', '', 'Activated_Record'),
(11, 201, '', '', '', '', '', '2021-09-12', '', '', '', '', 'Deactivated_Record'),
(12, 201, '', '', '', '', '', '0000-00-00', '', '0', '', '', 'Activated_Record'),
(13, 201, '', '', '', '', '', '2021-09-12', '', '', '', '', 'Deactivated_Record'),
(14, 201, '', '', '', '', '', '2021-09-12', '', '0', '', '', 'Activated_Record'),
(15, 102, 'Cash', 'Asset', 'Current', 'Debit', '', '2021-09-12', 'Active', '0', '', '', 'Updated_Record'),
(16, 122, 'Accounts Receivable', 'Asset', 'Current', 'Debit', '', '2021-09-12', 'Active', '0', '', '', 'Updated_Record');

-- --------------------------------------------------------

--
-- Table structure for table `credit_side`
--

CREATE TABLE `credit_side` (
  `credits.journal_id` int(11) NOT NULL,
  `credits` double NOT NULL,
  `accounts_involved` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equities`
--

CREATE TABLE `equities` (
  `eqid` int(11) NOT NULL,
  `acctCode` int(11) NOT NULL,
  `equities` text NOT NULL,
  `credit` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equities`
--

INSERT INTO `equities` (`eqid`, `acctCode`, `equities`, `credit`) VALUES
(1, 301, 'Contributed Capitol', '20250.00');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `eid` int(11) NOT NULL,
  `acctCode` int(11) NOT NULL,
  `expenses` text NOT NULL,
  `debit` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`eid`, `acctCode`, `expenses`, `debit`) VALUES
(1, 512, 'Advertising Expense', '120.00'),
(2, 522, 'Salaries Expense', '400.00'),
(3, 525, 'Telephone Expenses', '130.00'),
(4, 533, 'Utilities Expense', '200.00'),
(5, 535, 'Insurance Expense', '150.00'),
(6, 523, 'Supplies Expense', '980.00'),
(7, 541, 'Deprecation Expense', '500.00'),
(8, 543, 'Accumulated Deprecation', '500.00'),
(9, 521, 'Rent Expense', '1500.00');

-- --------------------------------------------------------

--
-- Table structure for table `general_ledger`
--

CREATE TABLE `general_ledger` (
  `lid` int(11) NOT NULL,
  `datecreated` date NOT NULL,
  `description` varchar(150) NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `balance` double DEFAULT NULL,
  `PR` varchar(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `incomestatement`
--

CREATE TABLE `incomestatement` (
  `isid` int(11) NOT NULL,
  `revenues` double NOT NULL,
  `expenses` double NOT NULL,
  `netincome` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE `journal` (
  `JMID` int(11) NOT NULL,
  `datecreated` date NOT NULL,
  `ID` int(11) NOT NULL,
  `creator` varchar(150) NOT NULL,
  `accType` text NOT NULL,
  `acc_id` int(11) NOT NULL,
  `accounts` text NOT NULL,
  `description` text NOT NULL,
  `PR` varchar(150) NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `journal`
--

INSERT INTO `journal` (`JMID`, `datecreated`, `ID`, `creator`, `accType`, `acc_id`, `accounts`, `description`, `PR`, `debit`, `credit`) VALUES
(26, '0000-00-00', 93, '1', 'Asset', 38, 'Prepaid Rent', '', 'DR', 4500, 0),
(25, '0000-00-00', 99, '1', 'Asset', 31, 'Cash', '', 'DR', 10000, 0),
(25, '0000-00-00', 98, '1', 'Asset', 32, 'Accounts Receivable', '', 'DR', 1500, 0),
(25, '0000-00-00', 97, '1', 'Asset', 33, 'Supplies', '', 'DR', 1250, 0),
(25, '0000-00-00', 96, '1', 'Asset', 34, 'Office Equipment', '', 'DR', 7500, 0),
(25, '0000-00-00', 95, '1', 'Equity', 35, 'Contributed Capitol', '', 'CR', 0, 20250),
(47, '0000-00-00', 165, '1', 'Expense', 48, 'Utilities Expense', '', 'DR', 200, 0),
(46, '0000-00-00', 164, '1', 'Asset', 31, 'Cash', '', 'CR', 0, 130),
(26, '0000-00-00', 94, '1', 'Asset', 31, 'Cash', '', 'CR', 0, 4500),
(27, '0000-00-00', 102, '1', 'Asset', 39, 'Prepaid Insurance', '', 'DR', 1800, 0),
(27, '0000-00-00', 103, '1', 'Asset', 31, 'Cash', '', 'CR', 0, 1800),
(28, '0000-00-00', 194, '1', 'Revenue', 40, 'Unearned Revenue', '', 'J-', 0, 3000),
(28, '0000-00-00', 193, '1', 'Asset', 31, 'Cash', '', 'J-', 3000, 0),
(29, '0000-00-00', 106, '1', 'Asset', 34, 'Office Equipment', '', 'DR', 1800, 0),
(29, '0000-00-00', 107, '1', 'Liability', 42, 'Account Payable', '', 'CR', 0, 1800),
(30, '0000-00-00', 108, '1', 'Asset', 31, 'Cash', '', 'DR', 800, 0),
(30, '0000-00-00', 109, '1', 'Asset', 32, 'Accounts Receivable', '', 'CR', 0, 800),
(46, '0000-00-00', 163, '1', 'Expense', 47, 'Telephone Expenses', '', 'DR', 130, 0),
(45, '0000-00-00', 162, '1', 'Asset', 31, 'Cash', '', 'CR', 0, 400),
(45, '0000-00-00', 161, '1', 'Expense', 46, 'Salaries Expense', '', 'DR', 400, 0),
(44, '0000-00-00', 160, '1', 'Asset', 32, 'Accounts Receivable', '', 'CR', 0, 1600),
(44, '0000-00-00', 159, '1', 'Asset', 31, 'Cash', '', 'DR', 1600, 0),
(43, '0000-00-00', 158, '1', 'Revenue', 44, 'Service Revenue', '', 'CR', 0, 1850),
(43, '0000-00-00', 157, '1', 'Asset', 31, 'Cash', '', 'DR', 1850, 0),
(31, '0000-00-00', 156, '1', 'Asset', 31, 'Cash', '', 'J-', 0, 120),
(31, '0000-00-00', 155, '1', 'Expense', 43, 'Advertising Expense', '', 'J-', 120, 0),
(32, '0000-00-00', 131, '1', 'Asset', 31, 'Cash', '', 'DR', 700, 0),
(32, '0000-00-00', 132, '1', 'Liability', 31, 'Cash', '', 'CR', 0, 700),
(33, '0000-00-00', 133, '1', 'Asset', 31, 'Cash', '', 'DR', 800, 0),
(33, '0000-00-00', 134, '1', 'Asset', 35, 'Contributed Capitol', '', 'DR', 800, 0),
(33, '0000-00-00', 135, '1', 'Liability', 54, 'Salaries Payable', '', 'CR', 0, 800),
(33, '0000-00-00', 136, '1', 'Liability', 54, 'Salaries Payable', '', 'CR', 0, 800),
(34, '0000-00-00', 137, '1', 'Asset', 31, 'Cash', '', 'DR', 800, 0),
(34, '0000-00-00', 138, '1', 'Asset', 35, 'Contributed Capitol', '', 'DR', 800, 0),
(34, '0000-00-00', 139, '1', 'Liability', 54, 'Salaries Payable', '', 'CR', 0, 800),
(35, '0000-00-00', 140, '1', 'Asset', 31, 'Cash', '', 'DR', 800, 0),
(36, '0000-00-00', 141, '1', 'Asset', 31, 'Cash', '', 'DR', 800, 0),
(36, '0000-00-00', 142, '1', 'Liability', 54, 'Salaries Payable', '', 'CR', 0, 800),
(37, '0000-00-00', 143, '1', 'Liability', 42, 'Account Payable', '', 'DR', 800, 0),
(37, '0000-00-00', 144, '1', 'Asset', 31, 'Cash', '', 'CR', 0, 800),
(38, '0000-00-00', 145, '1', 'Asset', 32, 'Accounts Receivable', '', 'DR', 2250, 0),
(38, '0000-00-00', 146, '1', 'Revenue', 44, 'Service Revenue', '', 'CR', 0, 2250),
(39, '0000-00-00', 147, '1', 'Expense', 46, 'Salaries Expense', '', 'DR', 400, 0),
(39, '0000-00-00', 148, '1', 'Asset', 31, 'Cash', '', 'CR', 0, 400),
(40, '0000-00-00', 149, '1', 'Asset', 31, 'Cash', '', 'DR', 3175, 0),
(40, '0000-00-00', 150, '1', 'Revenue', 44, 'Service Revenue', '', 'CR', 0, 3175),
(41, '0000-00-00', 151, '1', 'Asset', 33, 'Supplies', '', 'DR', 750, 0),
(41, '0000-00-00', 152, '1', 'Asset', 31, 'Cash', '', 'CR', 0, 750),
(42, '0000-00-00', 153, '1', 'Asset', 32, 'Accounts Receivable', '', 'DR', 1100, 0),
(42, '0000-00-00', 154, '1', 'Revenue', 44, 'Service Revenue', '', 'CR', 0, 1100),
(47, '0000-00-00', 166, '1', 'Asset', 31, 'Cash', '', 'CR', 0, 200),
(52, '0000-00-00', 197, '1', 'Expense', 50, 'Supplies Expense', '', 'DR', 980, 0),
(51, '0000-00-00', 196, '1', 'Asset', 39, 'Prepaid Insurance', '', 'CR', 0, 150),
(51, '0000-00-00', 195, '1', 'Expense', 49, 'Insurance Expense', '', 'DR', 150, 0),
(49, '0000-00-00', 192, '1', 'Asset', 32, 'Accounts Receivable', '', 'J-', 1000, 0),
(49, '0000-00-00', 191, '1', 'Revenue', 44, 'Service Revenue', '', 'J-', 0, 1000),
(50, '0000-00-00', 177, '1', 'Expense', 46, 'Salaries Expense', '', 'DR', 4500, 0),
(50, '0000-00-00', 178, '1', 'Asset', 31, 'Cash', '', 'CR', 0, 4500),
(52, '0000-00-00', 198, '1', 'Asset', 33, 'Supplies', '', 'CR', 0, 980),
(53, '0000-00-00', 199, '1', 'Expense', 51, 'Deprecation Expense', '', 'DR', 500, 0),
(53, '0000-00-00', 200, '1', 'Asset', 52, 'Accumulated Deprecation', '', 'CR', 0, 500),
(54, '0000-00-00', 201, '1', 'Expense', 46, 'Salaries Expense', '', 'DR', 20, 0),
(54, '0000-00-00', 202, '1', 'Liability', 54, 'Salaries Payable', '', 'CR', 0, 20),
(55, '0000-00-00', 203, '1', 'Expense', 53, 'Rent Expense', '', 'DR', 1500, 0),
(55, '0000-00-00', 204, '1', 'Asset', 38, 'Prepaid Rent', '', 'CR', 0, 1500),
(56, '0000-00-00', 205, '1', 'Liability', 40, 'Unearned Revenue', '', 'DR', 2000, 0),
(56, '0000-00-00', 206, '1', 'Revenue', 44, 'Service Revenue', '', 'CR', 0, 2000),
(64, '0000-00-00', 225, '1', 'Asset', 31, 'Cash', '', 'DR', 900, 0),
(63, '0000-00-00', 224, '1', 'Liability', 54, 'Salaries Payable', '', 'CR', 0, 800),
(63, '0000-00-00', 223, '1', 'Asset', 31, 'Cash', '', 'DR', 800, 0),
(62, '0000-00-00', 222, '1', 'Liability', 59, 'Notes Receivable', '', 'CR', 0, 600),
(62, '0000-00-00', 221, '1', 'Asset', 31, 'Cash', '', 'DR', 600, 0),
(61, '0000-00-00', 220, '1', 'Liability', 54, 'Salaries Payable', '', 'CR', 0, 600),
(61, '0000-00-00', 219, '1', 'Asset', 31, 'Cash', '', 'DR', 600, 0),
(64, '0000-00-00', 226, '1', 'Liability', 54, 'Salaries Payable', '', 'CR', 0, 900),
(65, '0000-00-00', 230, '1', 'Liability', 54, 'Salaries Payable', '', 'J-', 0, 600),
(65, '0000-00-00', 229, '1', 'Asset', 31, 'Cash', '', 'J-', 600, 0),
(66, '0000-00-00', 231, '1', 'Asset', 59, 'Notes Receivable', '', 'DR', 700, 0),
(66, '0000-00-00', 232, '1', 'Liability', 54, 'Salaries Payable', '', 'CR', 0, 700);

-- --------------------------------------------------------

--
-- Table structure for table `journalmaster`
--

CREATE TABLE `journalmaster` (
  `ID` int(11) NOT NULL,
  `JournalDate` date NOT NULL,
  `AccType` text NOT NULL,
  `WorkFlowTypeID` int(11) NOT NULL,
  `WorkFlowStateID` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `journalmaster`
--

INSERT INTO `journalmaster` (`ID`, `JournalDate`, `AccType`, `WorkFlowTypeID`, `WorkFlowStateID`, `CreatedDate`, `description`) VALUES
(27, '2021-04-04', '', 1, 1, '2021-12-04 13:25:49', 'Premium on property and casualty insurance'),
(26, '2021-04-04', '', 1, 1, '2021-12-04 13:20:53', 'Three month rent on lease'),
(25, '2021-12-04', '', 1, 1, '2021-12-04 13:16:19', 'Assets received from John Addams'),
(28, '2021-04-06', '', 1, 1, '2021-12-04 13:30:31', 'Advanced payment from clients'),
(29, '2021-04-07', '', 1, 1, '2021-12-04 13:35:52', 'Office Furniture'),
(30, '2021-04-08', '', 1, 1, '2021-12-04 13:37:29', 'Cash from clients'),
(31, '2021-04-11', '', 1, 1, '2021-12-04 13:39:43', 'Newspaper advertisement '),
(37, '2021-04-12', '', 1, 1, '2021-12-05 12:48:47', 'Morrilton Company debt'),
(38, '2021-04-15', '', 1, 1, '2021-12-05 12:52:41', ''),
(39, '2021-04-15', '', 1, 1, '2021-12-05 12:54:52', ''),
(40, '2021-04-15', '', 1, 1, '2021-12-05 12:57:43', ''),
(41, '2021-04-18', '', 1, 1, '2021-12-05 13:03:06', 'Paid for supplies'),
(42, '2021-04-22', '', 1, 1, '2021-12-05 13:05:37', ''),
(43, '2021-04-22', '', 1, 1, '2021-12-05 13:13:36', ''),
(44, '2021-04-25', '', 1, 1, '2021-12-05 13:15:50', 'Cash received from clients'),
(45, '2021-04-27', '', 1, 1, '2021-12-05 13:17:43', 'Paid receptionist two week salary'),
(46, '2021-04-28', '', 1, 1, '2021-12-05 13:26:46', 'Telephone bill'),
(47, '2021-04-29', '', 1, 1, '2021-12-05 13:28:14', 'Electric bill'),
(49, '1969-12-31', '', 1, 1, '2021-12-05 13:31:03', ''),
(50, '2021-04-29', '', 1, 1, '2021-12-05 13:41:38', 'Johns salary'),
(51, '2021-04-30', '', 1, 1, '2021-12-05 15:31:07', ''),
(52, '2021-04-30', '', 1, 1, '2021-12-05 15:32:31', 'Supplies on hand'),
(53, '2021-04-30', '', 1, 1, '2021-12-05 15:36:27', 'Deprecation for the office equipment'),
(54, '2021-04-30', '', 1, 1, '2021-12-05 15:39:18', 'Accrued receptionist salary'),
(55, '2021-04-30', '', 1, 1, '2021-12-05 15:41:07', 'Expired rent'),
(56, '2021-04-30', '', 1, 1, '2021-12-05 15:46:02', ''),
(63, '2021-12-09', '', 1, 2, '2021-12-09 18:30:06', ''),
(64, '2021-12-09', '', 1, 1, '2021-12-09 18:50:30', ''),
(65, '2021-12-11', '', 1, 1, '2021-12-11 07:43:00', ''),
(66, '2021-12-12', '', 1, 1, '2021-12-12 10:51:09', '');

-- --------------------------------------------------------

--
-- Table structure for table `liabilities`
--

CREATE TABLE `liabilities` (
  `lbid` int(11) NOT NULL,
  `acctCode` int(11) NOT NULL,
  `liabilities` text NOT NULL,
  `credit` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `liabilities`
--

INSERT INTO `liabilities` (`lbid`, `acctCode`, `liabilities`, `credit`) VALUES
(1, 202, 'Account Payable', '1800.00'),
(2, 219, 'Salaries Payable', '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) NOT NULL,
  `module` varchar(10) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `notification` varchar(500) DEFAULT NULL,
  `log_date` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `text` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `name`, `title`, `text`) VALUES
(1, 'About us', 'About Us', '<strong>About us<br />\r\n<br />\r\nits About Us</strong><br />\r\n'),
(2, 'Contact Us', 'Contact Us', 'Contact Us');

-- --------------------------------------------------------

--
-- Table structure for table `revenues`
--

CREATE TABLE `revenues` (
  `rid` int(11) NOT NULL,
  `acctCode` int(11) NOT NULL,
  `revenues` text NOT NULL,
  `credit` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `revenues`
--

INSERT INTO `revenues` (`rid`, `acctCode`, `revenues`, `credit`) VALUES
(1, 401, 'Service Revenue', '2250.00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setting_id` int(11) NOT NULL,
  `meta_key` text DEFAULT NULL,
  `meta_value` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `meta_key`, `meta_value`) VALUES
(1, 'google_analytics', 'analytics codes'),
(2, 'tag_manager', 'Google tag managers'),
(3, 'fb_pixel', 'Facebook Pixels'),
(4, 'Favicon', 'favicon'),
(5, 'logo', 'logo.png'),
(6, 'google_map', 'google map code'),
(7, 'contact_email', 'info@test.com'),
(8, 'email_subject', 'Email subject'),
(9, 'phone', '4535345346'),
(10, 'address', '123 Road , Main Highway , Florida');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `code` char(2) NOT NULL DEFAULT '',
  `name` varchar(128) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `code`, `name`) VALUES
(1, 'AL', 'Alabama'),
(2, 'AK', 'Alaska'),
(3, 'AS', 'American Samoa'),
(4, 'AZ', 'Arizona'),
(5, 'AR', 'Arkansas'),
(6, 'CA', 'California'),
(7, 'CO', 'Colorado'),
(8, 'CT', 'Connecticut'),
(9, 'DE', 'Delaware'),
(10, 'DC', 'District of Columbia'),
(11, 'FM', 'Federated States of Micronesia'),
(12, 'FL', 'Florida'),
(13, 'GA', 'Georgia'),
(14, 'GU', 'Guam'),
(15, 'HI', 'Hawaii'),
(16, 'ID', 'Idaho'),
(17, 'IL', 'Illinois'),
(18, 'IN', 'Indiana'),
(19, 'IA', 'Iowa'),
(20, 'KS', 'Kansas'),
(21, 'KY', 'Kentucky'),
(22, 'LA', 'Louisiana'),
(23, 'ME', 'Maine'),
(24, 'MH', 'Marshall Islands'),
(25, 'MD', 'Maryland'),
(26, 'MA', 'Massachusetts'),
(27, 'MI', 'Michigan'),
(28, 'MN', 'Minnesota'),
(29, 'MS', 'Mississippi'),
(30, 'MO', 'Missouri'),
(31, 'MT', 'Montana'),
(32, 'NE', 'Nebraska'),
(33, 'NV', 'Nevada'),
(34, 'NH', 'New Hampshire'),
(35, 'NJ', 'New Jersey'),
(36, 'NM', 'New Mexico'),
(37, 'NY', 'New York'),
(38, 'NC', 'North Carolina'),
(39, 'ND', 'North Dakota'),
(40, 'MP', 'Northern Mariana Islands'),
(41, 'OH', 'Ohio'),
(42, 'OK', 'Oklahoma'),
(43, 'OR', 'Oregon'),
(44, 'PW', 'Palau'),
(45, 'PA', 'Pennsylvania'),
(46, 'PR', 'Puerto Rico'),
(47, 'RI', 'Rhode Island'),
(48, 'SC', 'South Carolina'),
(49, 'SD', 'South Dakota'),
(50, 'TN', 'Tennessee'),
(51, 'TX', 'Texas'),
(52, 'UT', 'Utah'),
(53, 'VT', 'Vermont'),
(54, 'VI', 'Virgin Islands'),
(55, 'VA', 'Virginia'),
(56, 'WA', 'Washington'),
(57, 'WV', 'West Virginia'),
(58, 'WI', 'Wisconsin'),
(59, 'WY', 'Wyoming');

-- --------------------------------------------------------

--
-- Table structure for table `tblrole`
--

CREATE TABLE `tblrole` (
  `ID` int(11) NOT NULL,
  `Role` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblworkflow`
--

CREATE TABLE `tblworkflow` (
  `ID` int(11) NOT NULL,
  `WorkFlow` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblworkflow`
--

INSERT INTO `tblworkflow` (`ID`, `WorkFlow`) VALUES
(1, 'JournalEntries'),
(2, '');

-- --------------------------------------------------------

--
-- Table structure for table `tblworkflowstate`
--

CREATE TABLE `tblworkflowstate` (
  `ID` int(11) NOT NULL,
  `WorkFlowState` text NOT NULL,
  `WorkFlowID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblworkflowstate`
--

INSERT INTO `tblworkflowstate` (`ID`, `WorkFlowState`, `WorkFlowID`, `RoleID`) VALUES
(1, 'Approved', 1, 1),
(2, 'Pending', 1, 1),
(3, 'Rejected', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trialbalance`
--

CREATE TABLE `trialbalance` (
  `tbid` int(11) NOT NULL,
  `accountTitles` text NOT NULL,
  `debit` double DEFAULT NULL,
  `credit` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trialbalance`
--

INSERT INTO `trialbalance` (`tbid`, `accountTitles`, `debit`, `credit`) VALUES
(112, '', 0, 0),
(111, '', 0, 0),
(106, 'Cash', 0, 120),
(105, 'Advertising Expense', 120, 0),
(104, 'Accounts Receivable', 0, 800),
(103, 'Cash', 800, 0),
(102, 'Account Payable', 0, 1800),
(101, 'Office Equipment', 1800, 0),
(100, 'Cash', 3000, 3000),
(99, 'Prepaid Insurance', 1800, 1800),
(98, 'Prepaid Rent', 4500, 4500),
(97, 'Office Equipment', 7500, 0),
(96, 'Contributed Capitol', 0, 20250),
(95, 'Cash', 0, 20250),
(94, 'Office Equipment', 0, 20250),
(93, 'Supplies', 1250, 0),
(92, 'Accounts Receivable', 1500, 0),
(110, '', 0, 0),
(109, 'Office Equipment', 1234.56, 200000),
(108, 'Supplies', 5000, 20250),
(107, 'Cash', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `register_id` varchar(200) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `username` varchar(60) DEFAULT NULL,
  `password` varchar(150) NOT NULL,
  `old_password` varchar(100) NOT NULL,
  `password_date` datetime DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `profile_image` varchar(400) DEFAULT NULL,
  `dob` varchar(25) DEFAULT NULL,
  `code` varchar(500) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `zipcode` varchar(10) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `seq1` text NOT NULL,
  `asw1` varchar(150) NOT NULL,
  `seq2` text NOT NULL,
  `asw2` varchar(150) NOT NULL,
  `seq3` text NOT NULL,
  `asw3` varchar(150) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `added_date` datetime DEFAULT current_timestamp(),
  `expiry_date` datetime DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `block_date` date DEFAULT NULL,
  `IsExpiryNotification` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `register_id`, `group_id`, `username`, `password`, `old_password`, `password_date`, `first_name`, `last_name`, `email`, `profile_image`, `dob`, `code`, `address`, `zipcode`, `state`, `seq1`, `asw1`, `seq2`, `asw2`, `seq3`, `asw3`, `last_login`, `added_date`, `expiry_date`, `added_by`, `status`, `block_date`, `IsExpiryNotification`) VALUES
(73, NULL, 0, 'Manager1', '2c9341ca4cf3d87b9e4eb905d6a3ec45', '', NULL, 'Manager', 'test', 'manager@gmail.com', NULL, '', NULL, 'fake address 94', '30023', 2, '', '', '', '', '', '', '2021-11-23 18:17:02', '2021-11-23 18:16:49', '0000-00-00 00:00:00', NULL, 'Active', '0000-00-00', 0),
(74, NULL, 1, 'Admintest1121', 'c6975969073bfb50a50749c437bb13df', 'c6975969073bfb50a50749c437bb13df', '2022-03-23 00:00:00', 'Admin', 'test', 'admin@yahoo.com', NULL, '09/12/1987', '0dec2942956a74956fdbb8c43936f9fa', 'fake address', '30075', 13, '', '', '', '', '', '', '2022-01-02 18:45:58', '2021-11-23 18:21:47', NULL, NULL, 'Active', NULL, 0),
(75, NULL, 2, 'Manager2232021', 'd6d6abfbcf4dc0c326ed1269f80c6ed9', '', NULL, 'Manager2', 'Test2', 'manager3@yahoo.com', NULL, '', NULL, 'fake address', '30012', 2, '', '', '', '', '', '', NULL, '2021-11-23 18:27:45', '0000-00-00 00:00:00', NULL, 'Active', NULL, 0),
(81, NULL, 1, 'ImanM1121', '9ac08a99294e87e6c15ebb75a65e78e7', '', NULL, 'Iman', 'Mogh', 'imanmoghaddas@yahoo.com', NULL, '1999-11-28', NULL, '666 R. Kelly St', '30144', 13, '', '', '', '', '', '', '2021-12-07 10:28:27', '2021-11-28 11:25:35', '2021-12-12 00:00:00', NULL, 'Active', NULL, 0),
(77, NULL, 4, 'TARENBridges1121', '6bebdf841d3b6f7773954f85c01bc0d7', '6bebdf841d3b6f7773954f85c01bc0d7', '2022-03-23 00:00:00', 'TAREN', 'Bridges', 'tarenbridges@gmail.com', NULL, '1998-11-23', '6ef587022e4d6e7036077dc3edef4aff', '3225 Ivey Ridge Rd', '30519', 13, '', '', '', '', '', '', '2021-11-30 03:32:15', '2021-11-23 19:34:31', NULL, NULL, 'Active', NULL, 0),
(94, NULL, 4, 'sammyaccountant1221', '6bebdf841d3b6f7773954f85c01bc0d7', '6bebdf841d3b6f7773954f85c01bc0d7', '2022-04-05 00:00:00', 'sammy', 'accountant', 'sammanthaking789@gmail.com', NULL, '1999-12-05', '859eb5df165b335d8265beb3a846363c', '1234 Tucson Rd', '30096', 2, '', '', '', '', '', '', '2021-12-07 16:49:11', '2021-12-05 21:18:18', '0000-00-00 00:00:00', NULL, 'Active', NULL, 0),
(80, NULL, 4, 'Admin2Test1121', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', '2022-03-27 00:00:00', 'Admin2', 'Test', 'admin2@yahoo.com', NULL, '', '9e378dd68c12938b287c55a7312c57b6', 'fake adress', '30012', 2, '', '', '', '', '', '', NULL, '2021-11-27 21:43:23', '0000-00-00 00:00:00', NULL, 'Active', NULL, 0),
(95, NULL, 1, 'sammyking1221', '6bebdf841d3b6f7773954f85c01bc0d7', '6bebdf841d3b6f7773954f85c01bc0d7', '2022-04-05 00:00:00', 'sammy', 'king', 'randomuserfall2021@gmail.com', NULL, '1999-12-05', 'f494a0640e1f03e67cb7552e317fe984', '666 R. Kelly Street', '12345', 2, '', '', '', '', '', '', '2022-01-02 18:45:29', '2021-12-05 21:45:58', '0000-00-00 00:00:00', NULL, 'Active', NULL, 0),
(82, NULL, 2, 'Manager1121', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', '', NULL, 'Manager', 'test', 'fake@yahoo.com', NULL, '10/15/1987', NULL, '1012 fake address', '30012', 5, '', '', '', '', '', '', '2021-12-09 18:14:56', '2021-12-02 10:42:49', '2021-12-16 00:00:00', NULL, 'Active', NULL, 0),
(83, NULL, 2, 'sammymanager1221', '5a0a49ba9df38caebe455a4b532e263d', '5a0a49ba9df38caebe455a4b532e263d', '2022-04-03 00:00:00', 'sammy', 'manager', 'samm1wamm12199@gmail.com', '719download.jpg', '1999-12-03', 'f6f3d196dc916d92145ab0be6d36f834', '666 R. Kelly Street', '30092', 2, '', '', '', '', '', '', '2021-12-28 19:41:05', '2021-12-03 19:32:30', '0000-00-00 00:00:00', NULL, 'Active', NULL, 0),
(96, NULL, 2, 'ManagerUser', '2ac9cb7dc02b3c0083eb70898e549b63', '', NULL, 'Manager', 'User', 'manageruser@gmail.com', NULL, '1998-12-12', NULL, '123', '12345', 2, '', '', '', '', '', '', '2021-12-07 10:29:01', '2021-12-05 21:59:45', '0000-00-00 00:00:00', NULL, 'Active', NULL, 0),
(97, NULL, 4, 'AccountantUser', '2ac9cb7dc02b3c0083eb70898e549b63', '', NULL, 'acct', 'user', 'acctuser@aol.com', NULL, '1998-12-12', NULL, '123', '12345', 2, '', '', '', '', '', '', '2022-01-02 18:49:30', '2021-12-05 23:22:23', '0000-00-00 00:00:00', NULL, 'Active', NULL, 0),
(104, NULL, 4, 'RyanHollar1221', '0d7cc04c9ca711ca720dd5d3a975f14d', '0d7cc04c9ca711ca720dd5d3a975f14d', '2022-04-09 00:00:00', 'Ryan', 'Hollar', 'ryanhollaratme@gmail.com', NULL, '2000-12-09', '7e4254054bff70148913dcda34ec87d2', '666 R. Kelly Street', '30096', 2, 'What is your mother\'s maiden name?', 'Lee', 'What college did/do you go to?', 'KSU', 'What was the first video game you ever played?', 'Halo', NULL, '2021-12-09 10:50:57', '0000-00-00 00:00:00', NULL, 'Active', NULL, 0),
(105, NULL, 4, 'JovannyGomez1221', '0cef1fb10f60529028a71f58e54ed07b', '0cef1fb10f60529028a71f58e54ed07b', '2022-04-12 00:00:00', 'Jovanny', 'Gomez', 'jovanny17.gomez@gmail.com', NULL, '2021-12-12', '1628f37571b83cf0e6ec8420808b503b', '900 showalter ave', '30721', 13, 'What college did/do you go to?', 'dsc', 'What city was your first job in?', 'Dalton', 'What is your mother\'s maiden name?', 'idk', NULL, '2021-12-12 15:06:41', NULL, NULL, 'Pending', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`group_id`, `group_name`) VALUES
(1, 'Admin'),
(2, 'Manager'),
(4, 'Accountant');

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `session_id` varchar(400) DEFAULT NULL,
  `user_id` varchar(40) DEFAULT NULL,
  `session_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sessions`
--

INSERT INTO `user_sessions` (`session_id`, `user_id`, `session_date`) VALUES
('6fd2c300679489e0d1586a5e1c57772c', '82', '2021-12-09 18:14:56'),
('ab94c9e79e0c6005517da7f9e14b5956', '95', '2021-12-09 17:35:02'),
('cad07d453f941297dc6e97192ada6f96', '83', '2021-12-09 17:25:12'),
('352a6ec9cc2910e2be6e1851f524f8b8', '95', '2021-12-09 17:18:57'),
('b842d935b381169adb30c91e2bd003d1', '95', '2021-12-09 14:38:05'),
('f6428183aaaebbf1c2f3c75002c72a8d', '95', '2021-12-09 14:20:38'),
('055b364a43a5a34e06c14948d7eb6501', '83', '2021-12-09 13:41:20'),
('c98f18b82b54cbd0b83a5b41db6208e0', '95', '2021-12-09 12:31:26'),
('649ea5bf030f740542677d9e9f8c3e7d', '95', '2021-12-09 12:17:10'),
('da4ec6ee4cd91f1a2c006f2e07884231', '83', '2021-12-09 12:15:41'),
('8b33a3f3019914f96b5516391fcaa484', '95', '2021-12-09 11:17:36'),
('dfb2f84659a5ab570546c1c37602e2da', '83', '2021-12-09 11:09:45'),
('eadb9a5d5b000aa327745613d0e05581', '95', '2021-12-09 07:21:27'),
('53aa9bb029a00a8e87df37544a8f00fe', '95', '2021-12-09 06:39:28'),
('0f67a99441e1be9854be926715a8213b', '83', '2021-12-09 06:38:10'),
('73e45622712b3113bcc281e25d9af6a2', '95', '2021-12-09 06:04:34'),
('60b07d3bd207cedb40d22ce1e7ec73c8', '83', '2021-12-09 06:04:13'),
('a2b377cb4d05fd32d78f203cd28d46d8', '82', '2021-12-08 19:22:09'),
('9ec19f9b844d17c2033ba0f20ef39e5f', '83', '2021-12-08 17:55:30'),
('377c8f0dea77e7201b02d2f14d3b06ca', '95', '2021-12-08 16:35:32'),
('86773aeb9a416f3052cc6b74ba9b1b28', '82', '2021-12-08 16:23:53'),
('6517c0506b34bfe563c90d4e50226a3c', '82', '2021-12-08 16:21:30'),
('dda95cb970cf8b9a84d3501c159d1b39', '83', '2021-12-08 15:13:58'),
('3c97b93a18d6931c4c0b07c2a3d1d082', '83', '2021-12-08 14:58:08'),
('f322cbae61720a5ebdbc746386459772', '83', '2021-12-08 13:13:13'),
('44e14b0e3d6c496e7c231cf39662be37', '82', '2021-12-08 11:41:05'),
('8fdafe57bfbbd69e6a13acb7b1015be3', '83', '2021-12-08 08:36:21'),
('c907596de1c8385ea8cd0ab61593c1d3', '83', '2021-12-07 22:18:26'),
('94336755b9d712740f0d499d08d37fab', '83', '2021-12-07 16:52:00'),
('0371ab95267adfbeb5f74422fe8cde02', '94', '2021-12-07 16:49:11'),
('ec82088b64066ca4fba7db6f61a6ed82', '83', '2021-12-07 16:46:50'),
('0c67dd710d7cca393bcf7cd6a2ebb079', '83', '2021-12-07 15:16:09'),
('a3f47e9b4d1a6239da13f373cb499ca4', '94', '2021-12-07 15:11:36'),
('00b092f4420baa40043831c754c4dac6', '82', '2021-12-07 15:07:03'),
('28543687300664f66cc82e05a6e6271b', '95', '2021-12-07 13:39:22'),
('a1e9bfb26003e3d5d8baf34a12c783ac', '97', '2021-12-07 10:29:11'),
('e1afa25b5fc4442fa701751c649a8db4', '96', '2021-12-07 10:29:01'),
('273a675b5efee15559997e5b8419f210', '81', '2021-12-07 10:28:27'),
('ba7a0b28d1b32bc2c3b04182925f2543', '82', '2021-12-07 10:27:50'),
('d7b57b9cc557043d2b4703f58775df3c', '81', '2021-12-07 10:27:12'),
('ef19831703638dadb115c3fb0e2f89e4', '82', '2021-12-07 10:09:32'),
('065f7a125237809f16fbdaa50047d577', '82', '2021-12-05 23:43:36'),
('cb1016b8e903d05b98669aa80263ce3c', '81', '2021-12-05 23:43:02'),
('45d5a89d6fdd2d43052c785f04519fcb', '82', '2021-12-05 23:30:25'),
('a8738d53f6b924c1b80054adfa07a807', '81', '2021-12-05 23:21:29'),
('83ceee3fb5135dcd75c5dedc95b1f2b1', '95', '2021-12-05 22:22:55'),
('f617fec338eacf0aec472f5862aa53b1', '95', '2021-12-05 22:21:36'),
('a5e9ebb0747978cd9f0986cf7a085f6f', '83', '2021-12-05 22:19:10'),
('82a1033c7e6f1266e55af243b3e3f8f4', '94', '2021-12-05 22:16:18'),
('39eabf7b1ffba95b936254e17f4a9f80', '95', '2021-12-05 22:16:01'),
('572a09921b4ebcce0d220beee85236dc', '95', '2021-12-05 22:00:07'),
('5940f2bfdf7d5285d6224a5a613efc5c', '96', '2021-12-05 22:00:03'),
('afff8fa635edbb47f6722f036ab306e2', '83', '2021-12-05 21:59:28'),
('4b71bb79900e04f8b19312901dc301b3', '94', '2021-12-05 21:58:24'),
('04b4fabc1daeefea44498369bbc9ed13', '83', '2021-12-05 21:57:59'),
('b8077deaffa59f87e92efe97e9ec2f65', '95', '2021-12-05 21:54:22'),
('75cc6b10e5e0f70475574c59d5aa1a16', '94', '2021-12-05 21:53:36'),
('204fe7e6d046350953b8eefbd171e770', '95', '2021-12-05 21:50:44'),
('d249a10944df6db4a4c55f26da70a662', '81', '2021-12-05 21:42:09'),
('6fbbd3242ef0735c13bb0301ce52125c', '81', '2021-12-05 21:41:34'),
('93478d7c4417140d20f0f0222dcd702a', '78', '2021-12-05 21:19:22'),
('9d72d6ccb756bae02e210fc4c09d81a6', '83', '2021-12-05 20:41:08'),
('f2a0420f30f31aa0bab285a3fb97416d', '81', '2021-12-05 20:38:10'),
('41b9fe85b4407e9aac89a684cdee7284', '81', '2021-12-05 20:37:47'),
('c8f0ae4217ce4845f081568dda937597', '81', '2021-12-05 20:36:42'),
('b7837fbeee49b50a1301f440781d207d', '81', '2021-12-05 19:32:15'),
('a836758bd0c49058de6b92aa5214723a', '83', '2021-12-05 18:18:40'),
('9bf6b0ebdada9c9028a85265b699e719', '83', '2021-12-05 17:01:33'),
('25c175019c78c02524672943ce1931fe', '82', '2021-12-05 16:37:40'),
('e4f985135fe7d2175eac1010755ac5fb', '82', '2021-12-05 15:45:05'),
('806006cbcbfc55a9de0e9a5ef541ed73', '81', '2021-12-05 15:44:16'),
('117f7abca2cfc87933d89fe1f1fbf6ba', '82', '2021-12-05 15:36:58'),
('41d8c0d3525b9cdb649e16fe98b6d1e2', '81', '2021-12-05 15:35:34'),
('228142b717bbb46d1647e1c032f2220a', '82', '2021-12-05 15:28:57'),
('e6d9ae3926ea65abd53dc3f99735ea5b', '83', '2021-12-05 14:21:00'),
('e96ebf7c10970fa9567dabc680d40447', '81', '2021-12-05 12:43:40'),
('db50d25094e1ce9dd64644c9809931f9', '83', '2021-12-05 12:42:10'),
('4ad4fbad604634706146808c9b817e59', '82', '2021-12-05 11:59:09'),
('57f66773db0015aba6a7c803b36c17d6', '83', '2021-12-05 11:04:13'),
('1e745b5e419bdb79a4bac80b935913d9', '83', '2021-12-05 09:02:41'),
('8bb95905dbbd02702cdff92539da3e78', '83', '2021-12-05 07:29:49'),
('6b91f63c627e2fc9e0f0f1d34ce71f89', '78', '2021-12-05 07:19:03'),
('a8a80dd094ecf85671bcfc4f816fcfd0', '83', '2021-12-05 06:29:20'),
('592789a9b9aad8713535abf362e5107b', '83', '2021-12-05 04:09:58'),
('b8e66a86e308d98be43020b85805be8d', '83', '2021-12-05 03:26:44'),
('f355fc67440dba01dc04b011d736a534', '83', '2021-12-05 01:54:15'),
('42a60445253811d90a4592b29e8e9f07', '81', '2021-12-05 01:18:52'),
('d938bdbba4f10a67c2e952db5e43543a', '82', '2021-12-05 00:58:46'),
('e90dc346058471b84b6ca8c98596b2ce', '81', '2021-12-05 00:21:29'),
('77dfe1d8c1354bb2b73ce0f27c844022', '81', '2021-12-05 00:12:57'),
('3442787bd3c9c400cbd2231a32f3f4f0', '81', '2021-12-04 23:54:05'),
('c3bb00dccbe427b535a8b04ea1a17957', '81', '2021-12-04 23:20:41'),
('9dd3e0cf6cccc1cbc35e6a13aaff8e1e', '83', '2021-12-04 23:04:16'),
('89fa150df3463a150c1709fe356459aa', '82', '2021-12-04 23:00:52'),
('763dd5717711cad95a02218093c1749a', '83', '2021-12-04 20:48:56'),
('ea1ed1405a333ab8e22ac895e6207f59', '81', '2021-12-04 20:36:36'),
('c96d978127f64199459d84ab93bcdf3d', '81', '2021-12-04 20:02:47'),
('ad1aa13dd66bd151af0fa54ce4b8a1ef', '83', '2021-12-04 17:46:49'),
('bc04e6479eb15913aae7278b74d03697', '83', '2021-12-04 15:55:18'),
('95fdf18c35f87c14d49183bcc1a2a677', '82', '2021-12-04 13:55:41'),
('593c1274dd2e5c342845b232cb586f71', '83', '2021-12-04 13:34:32'),
('b4d6784ec888a92edf640afbaa41504c', '82', '2021-12-04 13:06:48'),
('d9e40326abeeef75fbe96e0063c4baf1', '83', '2021-12-04 10:24:11'),
('65cb0016866100fe4255f11de6623d42', '79', '2021-12-04 10:14:34'),
('53ca86dce5940737232295fc19efab43', '83', '2021-12-04 10:14:20'),
('c0fcd60f99112cbabd5d5a338f2f31f3', '83', '2021-12-04 09:11:59'),
('cc6aca36bb013b647d78919b2ad10dcd', '83', '2021-12-04 07:15:05'),
('c1d07b53c51bbe26c4e48fcf48361723', '83', '2021-12-03 21:45:24'),
('689ffbd9a95c1a4732d8b7b64a136504', '83', '2021-12-03 20:28:48'),
('84aee9b959a6b287546c9f6bf9e64cdf', '78', '2021-12-03 19:38:31'),
('1033f1b90d5d162c41230d0a83b7eb81', '78', '2021-12-03 19:32:41'),
('0741b0ebabc8a5e4a333d44e649b21da', '78', '2021-12-03 19:31:14'),
('f1179152381ca1a440b2d48a745c615f', '79', '2021-12-03 18:46:40'),
('df96c722413052fb090dc2c4352d3e95', '79', '2021-12-03 17:18:46'),
('6de9ea80879b19f7abb564cf15e17096', '78', '2021-12-03 17:18:17'),
('17e819c97745b132cd6d220a202905ee', '82', '2021-12-02 10:45:13'),
('bc9f7140f58c4cec2a581579e4822ff0', '81', '2021-12-02 10:44:49'),
('057f7ab89bd582ff5ce4216a2f7397f9', '81', '2021-12-02 10:39:02'),
('aac356f6a5a0fef62af65911d2bc3178', '81', '2021-12-02 10:38:53'),
('25caa4a2124cdb37dc0930fa7726c0bd', '81', '2021-12-02 03:53:07'),
('3c528b782cfdc642158e9519eabee3b2', '81', '2021-12-01 20:10:37'),
('c79622e9e5a96b083e018b53421a91ea', '97', '2022-01-02 18:49:30'),
('8ee421840f58e3871214f64b337d0074', '74', '2022-01-02 18:45:58'),
('a8504dab45263f48b5f794558b85b3c0', '95', '2022-01-02 18:45:29'),
('aa96433f81e22991f8d037cb3ee2fd3f', '81', '2021-12-01 00:46:13'),
('e2295757e852036b8df1c05b0167ac31', '95', '2021-12-09 18:23:29'),
('0fd3c4b19436117c108a815cd6d155ee', '83', '2021-12-09 18:23:47'),
('0d39ca01e08c7560cbc9b0be4558bb04', '95', '2021-12-11 07:40:30'),
('8fe240fefa355b8dc0ef2a8e2ac08c82', '83', '2021-12-11 07:41:34'),
('d2a6e81f3f838b0e439de413fe2ed95f', '83', '2021-12-11 14:23:36'),
('d1a328131ad9bd62b42af083c00b6ae4', '83', '2021-12-11 17:30:00'),
('64d54bdca560dceb366c6f8ec86489bb', '83', '2021-12-12 05:40:52'),
('a5d07146fdb2ddd1407a87f06e7ffad8', '83', '2021-12-12 07:31:38'),
('accb7c365950a1bc6c0b66a744ca48cb', '83', '2021-12-12 08:01:12'),
('3b2543e34ff6b449f034a0cdb1a91e69', '83', '2021-12-12 10:21:23'),
('e2d4fd008b8745711ae4140f825fc8a6', '83', '2021-12-12 17:54:49'),
('5e8ff1f07c67b31bd5fe80fb2a3c0e01', '83', '2021-12-12 19:48:36'),
('df1d1e93a98267d306c315f6d0fb6307', '83', '2021-12-15 09:37:42'),
('12bb6c9003e8267112e07d29a820a250', '95', '2021-12-23 14:05:07'),
('a15234060ed5c4697c10488dfc77c40f', '95', '2021-12-25 13:52:56'),
('c17f243644632c8724bb1f8ab0fe600e', '83', '2021-12-25 13:54:08'),
('e4997b469427685f89ad92ef8376ba9a', '95', '2021-12-27 11:23:22'),
('9c56aee68cb663e9e40543f5e8b385f6', '83', '2021-12-28 19:41:05'),
('9dd22a0be515465efa9440451f221623', '95', '2021-12-28 19:43:10'),
('8a330a462bd196f901551d6a5e3902cc', '95', '2022-01-02 18:24:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_tasks`
--

CREATE TABLE `user_tasks` (
  `user_task_id` int(11) NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tasks`
--

INSERT INTO `user_tasks` (`user_task_id`, `task_id`, `user_id`) VALUES
(14, 17, 4),
(15, 18, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`aid`),
  ADD UNIQUE KEY `UNIQUE` (`acctCode`);

--
-- Indexes for table `coa`
--
ALTER TABLE `coa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ACC-CODE` (`acctCode`);

--
-- Indexes for table `coa_log`
--
ALTER TABLE `coa_log`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `equities`
--
ALTER TABLE `equities`
  ADD PRIMARY KEY (`eqid`),
  ADD UNIQUE KEY `UNIQUE` (`acctCode`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`eid`),
  ADD UNIQUE KEY `UNIQUE` (`acctCode`);

--
-- Indexes for table `general_ledger`
--
ALTER TABLE `general_ledger`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `incomestatement`
--
ALTER TABLE `incomestatement`
  ADD PRIMARY KEY (`isid`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `journalmaster`
--
ALTER TABLE `journalmaster`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `liabilities`
--
ALTER TABLE `liabilities`
  ADD PRIMARY KEY (`lbid`),
  ADD UNIQUE KEY `UNIQUE` (`acctCode`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `revenues`
--
ALTER TABLE `revenues`
  ADD PRIMARY KEY (`rid`),
  ADD UNIQUE KEY `UNIQUE` (`acctCode`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblrole`
--
ALTER TABLE `tblrole`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblworkflow`
--
ALTER TABLE `tblworkflow`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblworkflowstate`
--
ALTER TABLE `tblworkflowstate`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `trialbalance`
--
ALTER TABLE `trialbalance`
  ADD PRIMARY KEY (`tbid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `user_tasks`
--
ALTER TABLE `user_tasks`
  ADD PRIMARY KEY (`user_task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `coa`
--
ALTER TABLE `coa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `coa_log`
--
ALTER TABLE `coa_log`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `equities`
--
ALTER TABLE `equities`
  MODIFY `eqid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `general_ledger`
--
ALTER TABLE `general_ledger`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `incomestatement`
--
ALTER TABLE `incomestatement`
  MODIFY `isid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journal`
--
ALTER TABLE `journal`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `journalmaster`
--
ALTER TABLE `journalmaster`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `liabilities`
--
ALTER TABLE `liabilities`
  MODIFY `lbid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `revenues`
--
ALTER TABLE `revenues`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tblrole`
--
ALTER TABLE `tblrole`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblworkflow`
--
ALTER TABLE `tblworkflow`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblworkflowstate`
--
ALTER TABLE `tblworkflowstate`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trialbalance`
--
ALTER TABLE `trialbalance`
  MODIFY `tbid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_tasks`
--
ALTER TABLE `user_tasks`
  MODIFY `user_task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
