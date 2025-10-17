-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2025 at 04:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projecthms`
--
DROP DATABASE IF EXISTS `projecthms`;
CREATE DATABASE IF NOT EXISTS `projecthms` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `projecthms`;

-- --------------------------------------------------------

--
-- Table structure for table `apnts`
--

CREATE TABLE `apnts` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `spec_id` int(11) NOT NULL,
  `doct_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(100) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'active',
  `apnt_type` varchar(20) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apnts`
--

INSERT INTO `apnts` (`id`, `patient_id`, `spec_id`, `doct_id`, `date`, `time`, `status`, `apnt_type`, `creation_date`) VALUES
(1, 1, 2, 1, '2024-03-21', '11:30 - 12:00', 'attended', 'specific', '2024-04-13 08:58:26'),
(2, 1, 2, 1, '2024-04-01', '10:00 - 10:30', 'expired', '', '2024-04-12 13:52:00'),
(3, 1, 2, 2, '2024-03-29', '12:00 - 12:30', 'cancelled', '', '2024-03-30 10:15:45'),
(4, 1, 2, 2, '2024-04-05', '12:00 - 12:30', 'expired', '', '2024-04-12 13:52:00'),
(5, 1, 2, 1, '2024-03-30', '11:30 - 12:00', 'attended', 'specific', '2024-03-29 18:52:01'),
(6, 2, 2, 2, '2024-03-30', '10:30 - 11:00', 'attended', 'specific', '2024-03-30 11:22:39'),
(67, 46, 3, 11, '2024-03-21', '10:00-10:30', 'attended', 'specific', '2024-03-30 17:50:09'),
(89, 1, 1, 1, '2024-03-01', '10:00-10:30', 'attended', 'followup', '2024-03-30 17:11:22'),
(90, 2, 2, 2, '2024-03-02', '10:30-11:00', 'attended', 'followup', '2024-03-30 17:11:46'),
(91, 42, 3, 3, '2024-03-03', '11:00-11:30', 'attended', 'followup', '2024-03-30 17:11:56'),
(92, 43, 4, 4, '2024-03-04', '11:30-12:00', 'attended', 'followup', '2024-03-30 17:12:11'),
(93, 44, 5, 5, '2024-03-05', '12:00-12:30', 'attended', 'followup', '2024-03-30 17:12:22'),
(94, 45, 1, 6, '2024-03-06', '12:30-13:00', 'attended', 'followup', '2024-03-30 17:12:33'),
(95, 46, 2, 7, '2024-03-07', '13:00-13:30', 'attended', 'followup', '2024-03-30 17:12:44'),
(96, 47, 3, 8, '2024-03-08', '13:30-14:00', 'attended', 'followup', '2024-03-30 17:12:58'),
(97, 48, 4, 9, '2024-03-09', '14:00-14:30', 'attended', 'followup', '2024-03-30 17:13:15'),
(98, 49, 5, 10, '2024-03-10', '14:30-15:00', 'attended', 'followup', '2024-03-30 17:13:30'),
(99, 50, 1, 11, '2024-03-11', '15:00-15:30', 'attended', 'followup', '2024-03-30 17:13:45'),
(100, 51, 2, 12, '2024-03-12', '10:00-10:30', 'attended', 'followup', '2024-03-30 17:13:57'),
(105, 57, 3, 6, '2024-03-18', '13:00-13:30', 'attended', 'followup', '2024-03-30 17:15:56'),
(106, 58, 4, 7, '2024-03-19', '13:30-14:00', 'attended', 'followup', '2024-03-30 17:16:07'),
(107, 59, 5, 8, '2024-03-20', '14:00-14:30', 'attended', 'followup', '2024-03-30 17:16:16'),
(108, 46, 3, 11, '2024-03-21', '10:00-10:30', 'attended', 'specific', '2024-03-30 17:16:27'),
(109, 43, 1, 3, '2024-04-12', '11:30 - 12:00', 'expired', '', '2024-04-12 13:48:00'),
(110, 47, 1, 3, '2024-04-13', '12:00 - 12:30', 'expired', '', '2024-04-13 15:37:00'),
(111, 50, 1, 3, '2024-04-12', '14:30 - 15:00', 'expired', '', '2024-04-12 13:54:00'),
(112, 44, 2, 1, '2024-04-12', '12:00 - 12:30', 'attended', 'followup', '2024-04-12 16:00:26'),
(113, 1, 2, 1, '2024-04-13', '12:30 - 13:00', 'attended', 'followup', '2024-04-13 06:56:07'),
(114, 1, 2, 1, '2024-04-13', '14:00 - 14:30', 'attended', 'followup', '2024-04-13 07:05:44'),
(115, 50, 2, 1, '2024-04-13', '11:30 - 12:00', 'attended', 'followup', '2024-04-13 07:10:21'),
(116, 47, 2, 1, '2024-04-13', '10:30 - 11:00', 'attended', 'specific', '2024-04-13 07:13:47'),
(117, 1, 1, 3, '2024-04-13', '10:30 - 11:00', 'cancelled', '', '2024-04-13 08:03:35'),
(118, 46, 3, 7, '2024-04-13', '11:00 - 11:30', 'expired', '', '2024-04-13 15:37:00'),
(119, 51, 2, 1, '2024-04-13', '12:30 - 13:00', 'attended', 'specific', '2024-04-13 16:34:57'),
(120, 1, 4, 10, '2024-04-15', '12:00 - 12:30', 'expired', '', '2024-04-23 16:45:33'),
(121, 1, 3, 7, '2024-04-19', '12:00 - 12:30', 'expired', '', '2024-04-23 16:45:33'),
(122, 51, 2, 1, '2024-04-23', '14:00 - 14:30', 'expired', '', '2024-04-23 16:45:33'),
(123, 44, 2, 1, '2024-05-01', '12:00 - 12:30', 'expired', '', '2025-05-29 15:58:13'),
(124, 50, 2, 1, '2024-05-17', '11:30 - 12:00', 'expired', '', '2025-05-29 15:58:13'),
(125, 86, 2, 6, '2024-05-01', '11:30 - 12:00', 'expired', '', '2025-05-29 15:58:13'),
(126, 1, 4, 9, '2024-05-02', '11:30 - 12:00', 'cancelled', '', '2024-05-08 20:30:26'),
(127, 1, 3, 7, '2024-05-10', '11:00 - 11:30', 'cancelled', '', '2024-05-08 20:36:00'),
(128, 1, 3, 7, '2024-05-16', '12:00 - 12:30', 'expired', '', '2025-05-29 15:58:13'),
(129, 43, 2, 6, '2024-05-14', '14:00 - 14:30', 'expired', '', '2025-05-29 15:58:13'),
(130, 1, 2, 1, '2024-06-03', '12:00 - 12:30', 'attended', 'specific', '2024-06-03 16:00:06'),
(131, 1, 2, 1, '2024-06-02', '11:30 - 12:00', 'expired', '', '2025-05-29 15:58:13'),
(132, 45, 2, 1, '2024-06-03', '12:30 - 13:00', 'attended', 'followup', '2024-06-03 16:03:51'),
(133, 61, 2, 1, '2024-06-03', '11:30 - 12:00', 'attended', 'specific', '2024-06-03 16:15:04'),
(134, 1, 2, 1, '2024-09-10', '12:30 - 13:00', 'expired', '', '2025-05-29 15:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(15) NOT NULL,
  `education` varchar(10000) NOT NULL,
  `spec_id` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `img_src` varchar(1000) NOT NULL DEFAULT './Images/DoctorPassphoto/defaultDocDp.jpg',
  `address` varchar(1000) NOT NULL,
  `license_info` varchar(100) NOT NULL,
  `experience` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fees` int(11) NOT NULL DEFAULT 300,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updation_date` datetime DEFAULT NULL,
  `adminPass` varchar(50) NOT NULL DEFAULT 'fail'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `dob`, `gender`, `education`, `spec_id`, `phone`, `email`, `img_src`, `address`, `license_info`, `experience`, `password`, `fees`, `creation_date`, `updation_date`, `adminPass`) VALUES
(1, 'Bishnupriya Dash', '1984-05-16', 'female', 'MBA', 2, '8018262929', 'bishnu@gmail.com', './Images/DoctorPassphoto/compressjpgIMG20210719082015.jpg', 'At/Po-Suramani, Surada, Ganjam', '2345-66-78910', 5, '800800', 300, '2024-05-04 06:49:29', '2024-04-24 23:03:25', 'pass'),
(2, 'Tapan Kumar Sahu', '1971-03-17', 'male', 'MBBS', 3, '9439154713', 'tapan@gmail.com', './Images/DoctorPassphoto/WhatsApp Image 2023-10-09 at 21.27.18_31cb524c.jpg', 'At/Po-Suramani, Surada, Ganjam', 'NC76624', 6, '800800', 350, '2024-04-26 18:21:52', '2024-04-26 23:51:07', 'fail'),
(3, 'Dr. John Smith', '1980-03-15', 'Male', 'MD', 1, '123-456-7890', 'john.smith@example.com', './Images/DoctorPassphoto/defaultDocDp.jpg', '123 Main St, City', 'D1234567', 8, 'password1', 300, '2024-04-19 13:21:52', NULL, 'pass'),
(4, 'Dr. Emily Johnson', '1975-07-21', 'Female', 'PhD', 1, '234-567-8901', 'emily.johnson@example.com', './Images/DoctorPassphoto/defaultDocDp.jpg', '456 Elm St, Town', 'JL09876', 12, 'password2', 300, '2024-04-19 13:21:52', NULL, 'pass'),
(5, 'Dr. Michael Lee', '1983-11-05', 'Male', 'BDS', 2, '345-678-9012', 'michael.lee@example.com', './Images/DoctorPassphoto/defaultDocDp.jpg', '789 Oak St, Village', 'KQ56789', 6, 'password3', 300, '2024-04-26 18:34:16', NULL, 'fail'),
(6, 'Dr. Jessica Brown', '1978-05-30', 'Female', 'MS', 2, '456-789-0123', 'jessica.brown@example.com', './Images/DoctorPassphoto/defaultDocDp.jpg', '101 Pine St, County', 'BC34567890', 15, 'password4', 300, '2024-04-19 13:21:52', NULL, 'pass'),
(7, 'Dr. David Wilson', '1985-09-10', 'Male', 'MSc', 3, '567-890-1234', 'david.wilson@example.com', './Images/DoctorPassphoto/defaultDocDp.jpg', '222 Maple St, State', '0123456-7', 3, 'password5', 300, '2024-04-19 13:21:52', NULL, 'pass'),
(8, 'Dr. Sarah Garcia', '1973-02-18', 'Female', 'DPT', 3, '678-901-2345', 'sarah.garcia@example.com', './Images/DoctorPassphoto/defaultDocDp.jpg', '333 Cedar St, Country', 'FG-56789', 7, 'password6', 300, '2024-04-26 18:34:21', NULL, 'fail'),
(9, 'Dr. Christopher Martinez', '1982-08-25', 'Male', 'BSN', 4, '789-012-3456', 'christopher.martinez@example.com', './Images/DoctorPassphoto/defaultDocDp.jpg', '444 Walnut St, Province', 'LIC-123-ABC', 9, 'password7', 300, '2024-04-19 13:21:52', NULL, 'pass'),
(10, 'Dr. Amanda Robinson', '1970-12-12', 'Female', 'BPT', 4, '890-123-4567', 'amanda.robinson@example.com', './Images/DoctorPassphoto/defaultDocDp.jpg', '555 Birch St, Continent', '14275392', 4, 'password8', 300, '2024-04-26 18:59:28', '2024-04-27 00:29:28', 'pass'),
(11, 'Dr. Jason Taylor', '1988-04-03', 'Male', 'MEng', 5, '901-234-5678', 'jason.taylor@example.com', './Images/DoctorPassphoto/defaultDocDp.jpg', '666 Pineapple St, Island', 'XYZ4321', 11, 'password9', 300, '2024-04-26 18:34:30', NULL, 'fail'),
(12, 'Dr. Olivia Clark', '1976-10-28', 'Female', 'BBA', 5, '012-345-6789', 'olivia.clark@example.com', './Images/DoctorPassphoto/defaultDocDp.jpg', '777 Coconut St, Ocean', 'AB-12345-6', 2, 'password10', 300, '2024-04-19 13:21:52', NULL, 'pass'),
(51, 'doc1', '2024-04-02', '', '', 1, '5677890636', 'doc1@gmail.com', './Images/DoctorPassphoto/WhatsApp_Image_2024-04-25_at_14.15.33_a4573af5-removebg-preview.png', 'doc1 Addressss', '', 0, '800800', 300, '2024-04-25 18:29:45', NULL, 'fail');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `message` longtext NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `phone`, `message`, `creation_date`) VALUES
(1, 'Hari Nayak', '', '0000000000', 'I am really happy with your clean environment and interactive staffs.\nThank you.\nI recover form ill very soon.', '2024-03-30 10:34:34'),
(6, 'John Doe', 'john@example.com', '1234567890', 'Great service!', '2024-03-30 17:52:21'),
(7, 'Alice Smith', 'alice@example.com', '9876543210', 'The staff was very helpful and courteous.', '2024-03-30 17:52:21'),
(8, 'Bob Johnson', 'bob@example.com', '5551234567', 'I had a wonderful experience.', '2024-03-30 17:52:21'),
(9, 'Emily Brown', 'emily@example.com', '9998887776', 'Thank you for your excellent service.', '2024-03-30 17:52:21'),
(10, 'Michael Lee', 'michael@example.com', '1112223334', 'I appreciate the professionalism of your team.', '2024-03-30 17:52:21'),
(11, 'Sarah Wilson', 'sarah@example.com', '7776665554', 'Keep up the good work!', '2024-03-30 17:52:21'),
(12, 'David Taylor', 'david@example.com', '4445556667', 'Highly recommended.', '2024-03-30 17:52:21'),
(13, 'Jennifer Martinez', 'jennifer@example.com', '2223334445', 'Very satisfied with the treatment.', '2024-03-30 17:52:21'),
(14, 'Daniel White', 'daniel@example.com', '8887776665', 'Impressive service.', '2024-03-30 17:52:21'),
(15, 'Olivia Anderson', 'olivia@example.com', '6667778889', 'The doctors were very knowledgeable.', '2024-03-30 17:52:21'),
(16, 'Sophia Nguyen', 'sophia@example.com', '3334445556', 'I will definitely come back!', '2024-03-30 17:52:21'),
(17, 'William Rodriguez', 'william@example.com', '5554443332', 'Thank you for your care and attention.', '2024-03-30 17:52:21'),
(18, 'Emma Garcia', 'emma@example.com', '2224448887', 'Excellent experience overall.', '2024-03-30 17:52:21'),
(19, 'finalTesting', 'final@gmail.com', '7377402802', 'Final tesiting before hosting\r\n', '2024-05-04 06:39:32');

-- --------------------------------------------------------

--
-- Table structure for table `medi_hist`
--

CREATE TABLE `medi_hist` (
  `id` int(11) NOT NULL,
  `apnt_id` int(11) NOT NULL,
  `pat_id` int(11) NOT NULL,
  `blood_pressure` varchar(15) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `blood_sugar` varchar(10) NOT NULL,
  `temp` varchar(10) NOT NULL,
  `description` longtext NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medi_hist`
--

INSERT INTO `medi_hist` (`id`, `apnt_id`, `pat_id`, `blood_pressure`, `weight`, `blood_sugar`, `temp`, `description`, `date_updated`) VALUES
(1, 5, 1, '34', '34', '65', '98', '<b>Condition(Symtoms):</b> <br>dsf<br><br><b>Diagnosis Status:</b><br>asdf<br><br><b>Medicines & Advices:</b><br>asdf<br><br>Next Check Up Date:<b>2024-04-06</b>', '2024-03-29 18:30:00'),
(2, 6, 2, '34', '43', '65', '98', '<b>Condition(Symtoms):</b> <br>l;kasdf<br><br><b>Diagnosis Status:</b><br>NA<br><br><b>Medicines & Advices:</b><br>l;jasd<br><br>Next Check Up Date:<b>2024-04-05</b>', '2024-03-29 18:30:00'),
(4, 1, 1, '120/80  ', '70  ', '90  ', '98.6 ', '<b>Condition(Symptoms):</b> <br>Frequent headaches and fatigue.<br><br><b>Diagnosis Status:</b><br>Diagnosed with mild hypertension.<br><br><b>Medicines & Advices:</b><br>Prescribed to take blood pressure medication regularly and advised to reduce salt intake.', '2024-03-20 18:30:00'),
(10, 67, 46, '123/81  ', '69  ', '89  ', '98.4 ', '<b>Condition(Symptoms):</b> <br>Back pain and muscle weakness.<br><br><b>Diagnosis Status:</b><br>Diagnosed with lumbar disc herniation.<br><br><b>Medicines & Advices:</b><br>Prescribed muscle relaxants and advised on back exercises.', '2024-03-20 18:30:00'),
(11, 89, 1, '128/84  ', '74  ', '93  ', '98.9 ', '<b>Condition(Symptoms):</b> <br>Migraine headaches and sensitivity to light.<br><br><b>Diagnosis Status:</b><br>Diagnosed with migraine.<br><br><b>Medicines & Advices:</b><br>Prescribed triptans for acute attacks and advised on migraine triggers.', '2024-02-29 18:30:00'),
(12, 90, 2, '115/75  ', '66  ', '87  ', '98.3 ', '<b>Condition(Symptoms):</b> <br>High fever and cough.<br><br><b>Diagnosis Status:</b><br>Diagnosed with upper respiratory tract infection.<br><br><b>Medicines & Advices:</b><br>Prescribed antibiotics for bacterial infection and advised on rest and hydration.', '2024-03-01 18:30:00'),
(13, 91, 42, '120/80  ', '70  ', '90  ', '98.6 ', '<b>Condition(Symptoms):</b> <br>Abnormal heart rhythm and dizziness.<br><br><b>Diagnosis Status:</b><br>Diagnosed with arrhythmia.<br><br><b>Medicines & Advices:</b><br>Prescribed antiarrhythmic medication and advised on lifestyle modifications.', '2024-03-02 18:30:00'),
(14, 92, 43, '110/70  ', '65  ', '85  ', '98.2 ', '<b>Condition(Symptoms):</b> <br>Acute abdominal pain and vomiting.<br><br><b>Diagnosis Status:</b><br>Diagnosed with acute gastritis.<br><br><b>Medicines & Advices:</b><br>Prescribed proton pump inhibitors and advised on dietary restrictions.', '2024-03-03 18:30:00'),
(15, 93, 44, '130/85  ', '75  ', '95  ', '99.0 ', '<b>Condition(Symptoms):</b> <br>Fatigue and weakness.<br><br><b>Diagnosis Status:</b><br>Diagnosed with anemia.<br><br><b>Medicines & Advices:</b><br>Prescribed iron supplements and advised on dietary changes.', '2024-03-04 18:30:00'),
(16, 94, 45, '125/82  ', '72  ', '88  ', '98.5 ', '<b>Condition(Symptoms):</b> <br>Severe headache and nausea.<br><br><b>Diagnosis Status:</b><br>Diagnosed with migraine with aura.<br><br><b>Medicines & Advices:</b><br>Prescribed migraine-specific medication and advised on migraine triggers.', '2024-03-05 18:30:00'),
(17, 95, 46, '118/78  ', '68  ', '92  ', '98.8 ', '<b>Condition(Symptoms):</b> <br>Difficulty breathing and wheezing.<br><br><b>Diagnosis Status:</b><br>Diagnosed with asthma exacerbation.<br><br><b>Medicines & Advices:</b><br>Prescribed bronchodilators and advised on asthma action plan.', '2024-03-06 18:30:00'),
(18, 96, 47, '122/80  ', '71  ', '86  ', '98.7 ', '<b>Condition(Symptoms):</b> <br>Joint swelling and tenderness.<br><br><b>Diagnosis Status:</b><br>Diagnosed with rheumatoid arthritis.<br><br><b>Medicines & Advices:</b><br>Prescribed disease-modifying antirheumatic drugs and advised on joint protection techniques.', '2024-03-07 18:30:00'),
(19, 97, 48, '123/81  ', '69  ', '89  ', '98.4 ', '<b>Condition(Symptoms):</b> <br>Chronic cough and sputum production.<br><br><b>Diagnosis Status:</b><br>Diagnosed with chronic bronchitis.<br><br><b>Medicines & Advices:</b><br>Prescribed bronchodilators and advised on smoking cessation.', '2024-03-08 18:30:00'),
(20, 98, 49, '128/84  ', '74  ', '93  ', '98.9 ', '<b>Condition(Symptoms):</b> <br>Skin rash and itching.<br><br><b>Diagnosis Status:</b><br>Diagnosed with allergic reaction.<br><br><b>Medicines & Advices:</b><br>Prescribed antihistamines and advised on allergen avoidance.', '2024-03-09 18:30:00'),
(21, 99, 50, '115/75  ', '66  ', '87  ', '98.3 ', '<b>Condition(Symptoms):</b> <br>Difficulty swallowing and throat pain.<br><br><b>Diagnosis Status:</b><br>Diagnosed with pharyngitis.<br><br><b>Medicines & Advices:</b><br>Prescribed antibiotics for bacterial infection and advised on gargling with warm saline water.', '2024-03-10 18:30:00'),
(22, 100, 51, '120/80  ', '70  ', '90  ', '98.6 ', '<b>Condition(Symptoms):</b> <br>Abdominal cramps and diarrhea.<br><br><b>Diagnosis Status:</b><br>Diagnosed with gastroenteritis.<br><br><b>Medicines & Advices:</b><br>Prescribed antidiarrheal medication and advised on fluid replacement therapy.', '2024-03-11 18:30:00'),
(32, 105, 57, '122/80  ', '71  ', '86  ', '98.7 ', '<b>Condition(Symptoms):</b> <br>Swollen lymph nodes and fatigue.<br><br><b>Diagnosis Status:</b><br>Diagnosed with viral infection.<br><br><b>Medicines & Advices:</b><br>Prescribed symptomatic treatment and advised on rest and hydration.', '2024-03-17 18:30:00'),
(33, 106, 58, '123/81  ', '69  ', '89  ', '98.4 ', '<b>Condition(Symptoms):</b> <br>Difficulty concentrating and memory problems.<br><br><b>Diagnosis Status:</b><br>Diagnosed with attention deficit hyperactivity disorder.<br><br><b>Medicines & Advices:</b><br>Prescribed stimulant medication and advised on behavioral therapy.', '2024-03-18 18:30:00'),
(34, 107, 59, '128/84  ', '74  ', '93  ', '98.9 ', '<b>Condition(Symptoms):</b> <br>Severe abdominal pain and vomiting.<br><br><b>Diagnosis Status:</b><br>Diagnosed with acute pancreatitis.<br><br><b>Medicines & Advices:</b><br>Admitted to hospital for intravenous fluids and pain management.', '2024-03-19 18:30:00'),
(35, 108, 46, '115/75  ', '66  ', '87  ', '98.3 ', '<b>Condition(Symptoms):</b> <br>Excessive thirst and frequent urination.<br><br><b>Diagnosis Status:</b><br>Diagnosed with diabetes insipidus.<br><br><b>Medicines & Advices:</b><br>Prescribed desmopressin and advised on fluid intake regulation.', '2024-03-20 18:30:00'),
(36, 112, 44, '34', '56', '65', '98', '<b>Condition(Symtoms):</b> <br>na<br><br><b>Diagnosis Status:</b><br>na<br><br><b>Medicines & Advices:</b><br>na<br><br>Next Check Up Date:<b>2024-04-24</b>', '2024-04-12 16:00:26'),
(37, 113, 1, '34', '23', '65', '98', '<b>Condition(Symtoms):</b> <br>asdf<br><br><b>Diagnosis Status:</b><br> asdf <br><br><b>Medicines & Advices:</b><br> asdf asdf<br><br>Next Check Up Date:<b></b>', '2024-04-13 06:56:07'),
(38, 114, 1, '34', '53', '65', '98', '<b>Condition(Symtoms):</b> <br>dfg sdf <br><br><b>Diagnosis Status:</b><br> dfg gh  sd<br><br><b>Medicines & Advices:</b><br>dfdfg s<br><br>Next Check Up Date:<b>2024-05-02</b>', '2024-04-13 07:05:44'),
(39, 115, 50, '34', '74', '65', '98', '<b>Condition(Symtoms):</b> <br>hjdf sdsg<br><br><b>Diagnosis Status:</b><br>as fr bv<br><br><b>Medicines & Advices:</b><br> sdg vbser<br><br>Next Check Up Date:<b></b>', '2024-04-13 07:10:21'),
(40, 116, 47, '34', '443', '65', '98', '<b>Condition(Symtoms):</b> <br> asdf<br><br><b>Diagnosis Status:</b><br> asdf <br><br><b>Medicines & Advices:</b><br>asd fasd <br><br>Next Check Up Date:<b></b>', '2024-04-13 07:13:47'),
(41, 119, 51, '76', '34', '84', '44', '<b>Condition(Symtoms):</b> <br>rough<br><br><b>Diagnosis Status:</b><br>tough<br><br><b>Medicines & Advices:</b><br>freeup', '2024-04-13 16:34:57'),
(42, 130, 1, '34', '34', '65', '98', '<b>Condition(Symtoms):</b> <br>qwertyuiop<br><br><b>Diagnosis Status:</b><br>asdfghjkl<br><br><b>Medicines & Advices:</b><br>zxcvbnm', '2024-06-03 16:00:06'),
(43, 132, 45, '34', '65', '65', '98', '<b>Condition(Symtoms):</b> <br>not weell lkasdf <br><br><b>Diagnosis Status:</b><br>who are yout<br><br><b>Medicines & Advices:</b><br>non of your business', '2024-06-03 16:03:51'),
(44, 133, 61, '34', '34', '65', '98', '<b>Condition(Symtoms):</b> <br>sdghfjk<br><br><b>Diagnosis Status:</b><br>rdxhfcjgvbm<br><br><b>Medicines & Advices:</b><br>szdxfcgvhbnm', '2024-06-03 16:14:39');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `emergency_contact` varchar(15) NOT NULL,
  `address` varchar(400) NOT NULL,
  `password` varchar(30) NOT NULL,
  `disease` varchar(100) NOT NULL DEFAULT 'fresh',
  `treatment_status` varchar(20) NOT NULL DEFAULT 'ongoing',
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updation_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `fname`, `dob`, `gender`, `phone`, `email`, `emergency_contact`, `address`, `password`, `disease`, `treatment_status`, `creation_date`, `updation_date`) VALUES
(1, 'Chandan Kumar Sahu', 'Tapan Kumar Sahu', '2002-10-12', 'male', '7377402802', '890@gmail.com', '5677890637', 'At/Po-Suramani, P.S-Surada, Ganjam', '890890', 'fever', 'ongoing', '2024-06-02 09:21:52', '2024-04-25 13:21:52'),
(2, 'Ravi Barik', '', '1221-10-12', 'male', '', 'test@gmail.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'test1221m', 'fever', 'ongoing', '2024-03-29 18:42:28', NULL),
(42, 'Alice Smith', 'John Smith', '1995-03-12', 'Female', '123-456-7890', 'alice.smith@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password1', 'Cold', 'ongoing', '2024-03-30 16:23:20', NULL),
(43, 'Bob Johnson', 'Michael Johnson', '1988-07-25', 'Male', '234-567-8901', 'bob.johnson@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password2', 'Fever', 'ongoing', '2024-03-30 16:23:39', NULL),
(44, 'Charlie Brown', 'David Brown', '1976-11-05', 'Male', '345-678-9012', 'charlie.brown@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password3', 'Headache', 'ongoing', '2024-04-12 16:00:23', NULL),
(45, 'Diana Martinez', 'Christopher Martinez', '1990-05-30', 'Female', '456-789-0123', 'diana.martinez@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password4', 'Stomachache', 'closed', '2024-06-03 16:03:02', NULL),
(46, 'Eva Clark', 'Jason Clark', '1983-09-10', 'Female', '567-890-1234', 'eva.clark@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password5', 'Allergy', 'ongoing', '2024-03-30 16:24:21', NULL),
(47, 'Frank Taylor', 'Oliver Taylor', '1992-02-18', 'Male', '678-901-2345', 'frank.taylor@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password6', 'Asthma', 'ongoing', '2024-03-30 16:24:31', NULL),
(48, 'Grace Wilson', 'Samuel Wilson', '1985-08-25', 'Female', '789-012-3456', 'grace.wilson@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password7', 'Diabetes', 'ongoing', '2024-03-30 16:24:43', NULL),
(49, 'Hannah Garcia', 'Daniel Garcia', '1970-12-12', 'Female', '890-123-4567', 'hannah.garcia@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password8', 'Hypertension', 'ongoing', '2024-03-30 16:24:57', NULL),
(50, 'Ian Lee', 'Nathan Lee', '1998-04-03', 'Male', '901-234-5678', 'ian.lee@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password9', 'Arthritis', 'closed', '2024-04-13 07:10:17', NULL),
(51, 'Julia Robinson', 'Robert Robinson', '1981-10-28', 'Female', '012-345-6789', 'julia.robinson@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password10', 'Migraine', 'closed', '2024-04-13 16:34:30', NULL),
(56, 'Victoria Turner', 'David Turner', '1982-02-28', 'Female', '111-222-3333', 'victoria.turner@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password21', 'Indigestion', 'ongoing', '2024-03-30 16:29:08', NULL),
(57, 'William Harris', 'Michael Harris', '1977-07-10', 'Male', '222-333-4444', 'william.harris@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password22', 'Vertigo', 'ongoing', '2024-03-30 16:29:08', NULL),
(58, 'Xavier Martin', 'John Martin', '1990-09-15', 'Male', '333-444-5555', 'xavier.martin@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password23', 'Conjunctivitis', 'ongoing', '2024-03-30 16:29:08', NULL),
(59, 'Yvonne Nelson', 'James Nelson', '1985-04-22', 'Female', '444-555-6666', 'yvonne.nelson@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password24', 'Osteoporosis', 'ongoing', '2024-03-30 16:29:08', NULL),
(60, 'Zoe Thompson', 'Robert Thompson', '1993-11-05', 'Female', '555-666-7777', 'zoe.thompson@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password25', 'Acne', 'ongoing', '2024-03-30 16:29:08', NULL),
(61, 'Alexander King', 'Daniel King', '1980-03-17', 'Male', '666-777-8888', 'alexander.king@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password26', 'Eczema', 'ongoing', '2024-03-30 16:29:08', NULL),
(62, 'Bella Scott', 'Matthew Scott', '1998-08-30', 'Female', '777-888-9999', 'bella.scott@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password27', 'Psoriasis', 'ongoing', '2024-03-30 16:29:08', NULL),
(63, 'Caleb Phillips', 'Christopher Phillips', '1972-01-08', 'Male', '888-999-0000', 'caleb.phillips@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password28', 'Sciatica', 'ongoing', '2024-03-30 16:29:08', NULL),
(64, 'Daisy Carter', 'David Carter', '1991-05-18', 'Female', '999-000-1111', 'daisy.carter@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password29', 'Rheumatism', 'ongoing', '2024-03-30 16:29:08', NULL),
(65, 'Ethan Brooks', 'Andrew Brooks', '1987-10-01', 'Male', '000-111-2222', 'ethan.brooks@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password30', 'Gout', 'ongoing', '2024-03-30 16:29:08', NULL),
(66, 'Fiona Wright', 'Steven Wright', '1976-12-05', 'Female', '111-222-3334', 'fiona.wright@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password31', 'Tinnitus', 'ongoing', '2024-03-30 16:29:08', NULL),
(67, 'Gavin Murphy', 'Timothy Murphy', '1995-06-20', 'Male', '222-333-4445', 'gavin.murphy@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password32', 'Hypothyroidism', 'ongoing', '2024-03-30 16:29:08', NULL),
(68, 'Holly Green', 'Mark Green', '1983-08-12', 'Female', '333-444-5556', 'holly.green@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password33', 'Hemorrhoids', 'ongoing', '2024-03-30 16:29:08', NULL),
(69, 'Ian Foster', 'Kevin Foster', '1979-02-27', 'Male', '444-555-6667', 'ian.foster@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password34', 'Atherosclerosis', 'ongoing', '2024-03-30 16:29:08', NULL),
(70, 'Jasmine Bell', 'Joseph Bell', '1992-10-10', 'Female', '555-666-7778', 'jasmine.bell@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password35', 'Hypoglycemia', 'ongoing', '2024-03-30 16:29:08', NULL),
(71, 'Kyle Howard', 'George Howard', '1986-04-15', 'Male', '666-777-8889', 'kyle.howard@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password36', 'Tonsillitis', 'ongoing', '2024-03-30 16:29:08', NULL),
(72, 'Luna Evans', 'Larry Evans', '1974-07-08', 'Female', '777-888-9990', 'luna.evans@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password37', 'Gastritis', 'ongoing', '2024-03-30 16:29:08', NULL),
(73, 'Mason Gray', 'Charles Gray', '1997-01-25', 'Male', '888-999-0001', 'mason.gray@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password38', 'Insomnia', 'ongoing', '2024-03-30 16:29:08', NULL),
(74, 'Natalie Cox', 'Brian Cox', '1981-05-28', 'Female', '999-000-1112', 'natalie.cox@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password39', 'Migraine', 'ongoing', '2024-03-30 16:29:08', NULL),
(75, 'Oscar Adams', 'Paul Adams', '1977-09-14', 'Male', '000-111-2223', 'oscar.adams@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password40', 'Arthritis', 'ongoing', '2024-03-30 16:29:08', NULL),
(76, 'Penelope White', 'Donald White', '1994-11-30', 'Female', '111-222-3335', 'penelope.white@example.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'password41', 'Bronchitis', 'ongoing', '2024-03-30 16:29:08', NULL),
(79, 'supriya', 'bilasini', '2005-04-10', 'female', '5677890636', 'supriya@gmail.com', '5677890638', 'At/Po-Suramani, P.S-Surada, Ganjam', 'supriya', 'fresh', 'ongoing', '2024-04-14 06:34:35', '2024-04-14 12:04:35'),
(82, 'testing', '', '2024-04-09', 'male', '5678909873', 'testing1@gmail.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'test2024m', 'fever', 'ongoing', '2024-04-27 13:18:41', NULL),
(83, 'sri ka', '', '2003-01-29', 'female', '9090808090', 'sri@gmail.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 'sri 2003f', 'asdf', 'ongoing', '2024-04-30 17:37:38', NULL),
(84, 's  ksr', '', '2012-02-23', 'male', '6783652904', 's@gmail.com', '', 'At/Po-Suramani, P.S-Surada, Ganjam', 's  k2012m', 'asdf', 'ongoing', '2024-04-30 17:38:53', NULL),
(85, 'trying', 'trying father', '2321-12-31', 'female', '7626925402', 'trying@gmail.com', '7626925402', 'at/po- tryingg', 'trying', 'fresh', 'ongoing', '2024-05-01 08:43:42', '2024-05-01 14:13:42'),
(86, 'try2', '', '3322-02-21', 'male', '6986207352', 'try2@gami.com', '', 'bargarh', 'try23322m', 'fever', 'ongoing', '2024-05-01 09:01:00', NULL),
(88, 'try3', 'try3 father', '3211-02-23', 'Male', '2342342323', 'try3@gamil.com', '2342342323', 'try3 address', 'try33211M', 'fresh', 'ongoing', '2024-05-01 09:20:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE `queries` (
  `id` int(11) NOT NULL,
  `pat_id` int(11) NOT NULL,
  `query_text` varchar(15000) NOT NULL,
  `posted_time` datetime NOT NULL,
  `intended_dept_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `query_response` longtext NOT NULL,
  `answered_time` datetime NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`id`, `pat_id`, `query_text`, `posted_time`, `intended_dept_id`, `doc_id`, `query_response`, `answered_time`, `status`) VALUES
(1, 1, 'need some advice on what to eat to recovery quickly.', '2024-05-02 12:25:00', 2, 1, 'You can consider VitaminC, protein, Omega 3, Fiber, Antixidants for better health and recover quickly.', '2024-05-02 22:31:37', 'answered'),
(2, 1, 'A patient’s lab results show a high blood pressure reading, but the doctor’s note does not mention it', '2024-05-02 15:20:57', 2, 0, '', '0000-00-00 00:00:00', 'pending'),
(3, 1, 'A patient’s medication list shows a medication that was not mentioned in the doctor’s note. ', '2024-05-02 15:34:41', 2, 0, '', '0000-00-00 00:00:00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `spec_list`
--

CREATE TABLE `spec_list` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `spec_desc` varchar(5000) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spec_list`
--

INSERT INTO `spec_list` (`id`, `name`, `spec_desc`, `creation_date`) VALUES
(1, 'Orthopedics', 'Specializes in the diagnosis and treatment of musculoskeletal system disorders, including bones, joints, ligaments, tendons, and muscles.', '2024-03-29 10:24:18'),
(2, 'Neurology', 'Focuses on the diagnosis and treatment of diseases related to the nervous system, including the brain, spinal cord, nerves, and muscles.', '2024-03-29 10:24:18'),
(3, 'Ophthalmology', 'Specializes in the diagnosis and treatment of eye diseases, vision disorders, and conditions affecting the visual system.', '2024-03-29 10:24:18'),
(4, 'Pediatrics', 'Focuses on the medical care of infants, children, and adolescents, including preventive healthcare, developmental assessments, and treatment of childhood illnesses.', '2024-03-29 10:24:18'),
(5, 'Dermatology', 'Specializes in the diagnosis and treatment of skin disorders, including dermatitis, eczema, psoriasis, acne, skin cancer, and cosmetic dermatological procedures.', '2024-03-29 10:24:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apnts`
--
ALTER TABLE `apnts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PatientForeignKey` (`patient_id`),
  ADD KEY `specForeignKey` (`spec_id`),
  ADD KEY `doctForeignKey` (`doct_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `doctorEmail` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `ForeignKey` (`spec_id`) USING BTREE;

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medi_hist`
--
ALTER TABLE `medi_hist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `apnt_id` (`apnt_id`),
  ADD KEY `PatientMediHistForeignKey` (`pat_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `queries`
--
ALTER TABLE `queries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pat_foreignkey` (`pat_id`);

--
-- Indexes for table `spec_list`
--
ALTER TABLE `spec_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departmentName` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apnts`
--
ALTER TABLE `apnts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `medi_hist`
--
ALTER TABLE `medi_hist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `spec_list`
--
ALTER TABLE `spec_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apnts`
--
ALTER TABLE `apnts`
  ADD CONSTRAINT `PatientForeignKey` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `doctForeignKey` FOREIGN KEY (`doct_id`) REFERENCES `doctor` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `specForeignKey` FOREIGN KEY (`spec_id`) REFERENCES `spec_list` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `ForeignKey` FOREIGN KEY (`spec_id`) REFERENCES `spec_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medi_hist`
--
ALTER TABLE `medi_hist`
  ADD CONSTRAINT `PatientMediHistForeignKey` FOREIGN KEY (`pat_id`) REFERENCES `patient` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `apntForeignKey` FOREIGN KEY (`apnt_id`) REFERENCES `apnts` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `queries`
--
ALTER TABLE `queries`
  ADD CONSTRAINT `pat_foreignkey` FOREIGN KEY (`pat_id`) REFERENCES `patient` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
