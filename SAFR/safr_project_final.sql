-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2026 at 10:47 PM
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
-- Database: `safr_project_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `aid`
--

CREATE TABLE `aid` (
  `Item_name` varchar(100) NOT NULL,
  `Category` varchar(50) DEFAULT NULL,
  `Unit` int(11) DEFAULT NULL,
  `Camp_id` varchar(20) NOT NULL,
  `NGO_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aid`
--

INSERT INTO `aid` (`Item_name`, `Category`, `Unit`, `Camp_id`, `NGO_name`) VALUES
('Baby Food', 'Food', 500, 'CAMP008', 'Care Intl'),
('Blankets', 'Shelter', 1000, 'CAMP003', 'IRC'),
('Blankets', 'Shelter', 1000, 'CAMP008', 'Care Intl'),
('Blood Bags', 'Medical', 100, 'CAMP007', 'ICRC'),
('Cooking Oil', 'Food', 1000, 'CAMP005', 'WFP'),
('First Aid Kits', 'Medical', 200, 'CAMP007', 'ICRC'),
('Food Rations', 'Food', 10000, 'CAMP001', 'UNHCR'),
('Food Rations', 'Food', 3000, 'CAMP006', 'Oxfam'),
('Hygiene Kits', 'Sanitation', 1000, 'CAMP006', 'Oxfam'),
('Rice', 'Food', 5000, 'CAMP004', 'WFP'),
('School Kits', 'Education', 200, 'CAMP004', 'Save Children'),
('Surgical Kits', 'Medical', 100, 'CAMP002', 'MSF'),
('Tents', 'Shelter', 500, 'CAMP001', 'UNHCR'),
('Tents', 'Shelter', 3000, 'CAMP004', 'ICRC'),
('Tents', 'Shelter', 400, 'CAMP008', 'Care Intl'),
('Vaccines', 'Medical', 2000, 'CAMP002', 'MSF'),
('Water Filters', 'Other', 100, 'CAMP003', 'IRC'),
('Water Purification', 'Sanitation', 50, 'CAMP006', 'Oxfam');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `Assignment_ID` varchar(20) NOT NULL,
  `Volunteer_id` varchar(20) NOT NULL,
  `Assigned_Date` date DEFAULT NULL,
  `Camp_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`Assignment_ID`, `Volunteer_id`, `Assigned_Date`, `Camp_id`) VALUES
('ASGN001', 'VOL001', '2024-01-05', 'CAMP001'),
('ASGN002', 'VOL002', '2024-01-10', 'CAMP004'),
('ASGN003', 'VOL003', '2024-01-15', 'CAMP002'),
('ASGN004', 'VOL004', '2024-02-01', 'CAMP003'),
('ASGN005', 'VOL005', '2024-02-05', 'CAMP005'),
('ASGN006', 'VOL001', '2024-03-01', 'CAMP001'),
('ASGN007', 'VOL002', '2024-03-10', 'CAMP004'),
('ASGN008', 'VOL017', '2026-05-05', 'CAMP009'),
('ASGN009', 'VOL018', '2026-05-05', 'CAMP009'),
('ASGN010', 'VOL017', '2026-05-05', 'CAMP009');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_required_skill`
--

CREATE TABLE `assignment_required_skill` (
  `Assignment_ID` varchar(20) NOT NULL,
  `Skill_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assignment_required_skill`
--

INSERT INTO `assignment_required_skill` (`Assignment_ID`, `Skill_name`) VALUES
('ASGN001', 'Medical Aid'),
('ASGN002', 'Translation'),
('ASGN003', 'Logistics'),
('ASGN004', 'Medical Aid'),
('ASGN005', 'Counselling'),
('ASGN006', 'Food Distribution'),
('ASGN007', 'Education'),
('ASGN008', 'Mechanic'),
('ASGN009', 'Medical Worker'),
('ASGN010', 'Mechanic');

-- --------------------------------------------------------

--
-- Table structure for table `camp`
--

CREATE TABLE `camp` (
  `Camp_id` varchar(20) NOT NULL,
  `Location` varchar(100) NOT NULL,
  `Capacity` int(11) DEFAULT NULL,
  `Volunteer_id` varchar(20) DEFAULT NULL,
  `Evareq_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `camp`
--

INSERT INTO `camp` (`Camp_id`, `Location`, `Capacity`, `Volunteer_id`, `Evareq_id`) VALUES
('CAMP001', 'Aleppo', 50000, 'VOL001', NULL),
('CAMP002', 'Damascus', 80000, 'VOL003', NULL),
('CAMP003', 'Homs', 60000, 'VOL004', NULL),
('CAMP004', 'Latakia', 90000, 'VOL002', NULL),
('CAMP005', 'Daraa\r\n\r\n', 40000, 'VOL005', NULL),
('CAMP006', 'Deir ez-Zor\r\n\r\n', 270000, 'VOL006', NULL),
('CAMP007', 'Raqqa\r\n', 600000, 'VOL009', NULL),
('CAMP008', 'Idlib', 80000, 'VOL015', NULL),
('CAMP009', 'Hasakah', 70000, 'VOL007', 'EVAC008'),
('CAMP010', 'Hama', 19000, 'VOL008', 'EVAC009'),
('CAMP011', 'Tartus', 10000, 'VOL010', 'EVAC010'),
('CAMP012', 'Quneitra', 10000, 'VOL011', 'EVAC002'),
('CAMP013', 'Suwayda', 10000, 'VOL013', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `camp_medical_inventory`
--

CREATE TABLE `camp_medical_inventory` (
  `Inventory_id` varchar(20) NOT NULL,
  `Item_name` varchar(100) NOT NULL,
  `Camp_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `camp_medical_inventory`
--

INSERT INTO `camp_medical_inventory` (`Inventory_id`, `Item_name`, `Camp_id`) VALUES
('INV001', 'Bandages', 'CAMP001'),
('INV001', 'Oxygen Cylinders', 'CAMP001'),
('INV001', 'Paracetamol', 'CAMP001'),
('INV002', 'Oral Rehydration', 'CAMP002'),
('INV004', 'Antibiotics', 'CAMP002'),
('INV005', 'Insulin', 'CAMP003'),
('INV006', 'Syringes', 'CAMP003'),
('INV007', 'Paracetamol', 'CAMP004'),
('INV008', 'Bandages', 'CAMP005'),
('INV009', 'Blood Bags', 'CAMP005'),
('INV011', 'Paracetamol', 'CAMP006'),
('INV012', 'Oral Rehydration', 'CAMP006'),
('INV013', 'Malaria Tablets', 'CAMP006'),
('INV019', 'Blood Bags', 'CAMP006'),
('INV014', 'Bandages', 'CAMP007'),
('INV015', 'Antibiotics', 'CAMP007'),
('INV016', 'Vaccines', 'CAMP007'),
('INV020', 'Surgical Gloves', 'CAMP007'),
('INV017', 'Syringes', 'CAMP008'),
('INV018', 'Insulin', 'CAMP008');

-- --------------------------------------------------------

--
-- Table structure for table `camp_medical_inventory_asks_for`
--

CREATE TABLE `camp_medical_inventory_asks_for` (
  `Requesting_Inventory_id` varchar(20) NOT NULL,
  `Requested_Inventory_id` varchar(20) NOT NULL,
  `Item_needed` varchar(100) DEFAULT NULL,
  `Units` int(11) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `camp_request`
--

CREATE TABLE `camp_request` (
  `Camp_id` varchar(20) NOT NULL,
  `NGO_name` varchar(100) NOT NULL,
  `Item_Requested` varchar(100) DEFAULT NULL,
  `Item_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `camp_request`
--

INSERT INTO `camp_request` (`Camp_id`, `NGO_name`, `Item_Requested`, `Item_quantity`) VALUES
('CAMP001', 'MSF', 'Surgical Kits', 50),
('CAMP001', 'UNHCR', 'Tents', 1000),
('CAMP002', 'UNHCR', 'Food Rations', 5000),
('CAMP003', 'IRC', 'Water Filters', 100),
('CAMP003', 'WFP', 'Rice', 3000),
('CAMP004', 'IRC', 'Blankets', 500),
('CAMP005', 'Save Children', 'School Kits', 100),
('CAMP005', 'WFP', 'Cooking Oil', 2000),
('CAMP006', 'Oxfam', 'Hygiene Kits', 2000),
('CAMP007', 'ICRC', 'First Aid Kits', 500),
('CAMP008', 'Care Intl', 'Tents', 300);

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `Name` varchar(100) NOT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Payment_Method` varchar(50) DEFAULT NULL,
  `Total_Amount` decimal(12,2) DEFAULT 0.00,
  `Donation_type` varchar(50) DEFAULT NULL,
  `Donor_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`Name`, `Phone`, `Email`, `Payment_Method`, `Total_Amount`, `Donation_type`, `Donor_type`) VALUES
('Aiko Yamamoto', '+81-80-0707', 'aiko.y@email.com', 'Card', 60000.00, 'Recurring', 'Regular'),
('Aisha Rahman', '+880-171-0202', 'aisha.r@email.com', 'MFS', 5000.00, 'One-time', 'Occasional'),
('Amira Benali', '+213-55-0202', 'amira.b@email.com', 'Cash', 3000.00, 'One-time', 'Occasional'),
('Carlos Mendez', '+52-55-0606', 'carlos.m@email.com', 'Card', 10000.00, 'One-time', 'Occasional'),
('Emma Wilson', '+44-7-0505', 'emma.w@email.com', 'Card', 100000.00, 'Recurring', 'Regular'),
('Fatou Diallo', '01740096628', 'bhh@g.com', 'Credit Card', 100002100.00, 'general', 'one-time'),
('Grace Njoroge', '+254-722-0505', 'grace.n@email.com', 'MFS', 1500.00, 'One-time', 'Occasional'),
('Hassan Al-Ali', '+965-9-0606', 'hassan.a@email.com', 'Card', 15000.00, 'One-time', 'Occasional'),
('John Smith', '+1-555-0101', 'john.smith@email.com', 'Card', 50000.00, 'Recurring', 'Regular'),
('Liu Wei', '+86-138-0101', 'liu.wei@email.com', 'Card', 75000.00, 'Recurring', 'Regular'),
('Robert Chen', '+65-9-0303', 'r.chen@email.com', 'Card', 25000.00, 'Recurring', 'Regular'),
('Sadia Islam', '+880-171-0808', 'sadia.i@email.com', 'MFS', 8000.00, 'Recurring', 'Regular'),
('Sheikh hasina', '01533235925', 'tlkmajlis@gmail.com', 'Credit Card', 750.00, 'general', 'one-time'),
('Thomas Muller', '+49-151-0303', 'thomas.m@email.com', 'Card', 20000.00, 'Recurring', 'Regular'),
('Yuki Tanaka', '+81-90-0707', 'yuki.t@email.com', 'Card', 30000.00, 'Recurring', 'Regular'),
('Zara Ahmed', '+971-50-0404', 'zara.ahmed@email.com', 'Card', 45000.00, 'Recurring', 'Regular');

-- --------------------------------------------------------

--
-- Table structure for table `donor_credential`
--

CREATE TABLE `donor_credential` (
  `Full_name` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donor_credential`
--

INSERT INTO `donor_credential` (`Full_name`, `Password`) VALUES
('Aisha Rahman', 'aisha456'),
('Fatou Diallo', 'fatou321'),
('John Smith', 'johnsmith123'),
('Robert Chen', 'robert789');

-- --------------------------------------------------------

--
-- Table structure for table `donor_ngo`
--

CREATE TABLE `donor_ngo` (
  `NGO_name` varchar(100) NOT NULL,
  `Donor_Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donor_ngo`
--

INSERT INTO `donor_ngo` (`NGO_name`, `Donor_Name`) VALUES
('Care Intl', 'Grace Njoroge'),
('ICRC', 'Aiko Yamamoto'),
('ICRC', 'Liu Wei'),
('ICRC', 'Sadia Islam'),
('IRC', 'Carlos Mendez'),
('IRC', 'Hassan Al-Ali'),
('IRC', 'Robert Chen'),
('MSF', 'Emma Wilson'),
('MSF', 'John Smith'),
('MSF', 'Thomas Muller'),
('Oxfam', 'Liu Wei'),
('Oxfam', 'Thomas Muller'),
('Save Children', 'Fatou Diallo'),
('UNHCR', 'Aiko Yamamoto'),
('UNHCR', 'Aisha Rahman'),
('UNHCR', 'Amira Benali'),
('UNHCR', 'Emma Wilson'),
('UNHCR', 'John Smith'),
('UNHCR', 'Yuki Tanaka'),
('UNHCR', 'Zara Ahmed'),
('WFP', 'Emma Wilson'),
('WFP', 'Robert Chen'),
('WFP', 'Sadia Islam'),
('WFP', 'Zara Ahmed');

-- --------------------------------------------------------

--
-- Table structure for table `evac_request`
--

CREATE TABLE `evac_request` (
  `Evareq_id` varchar(20) NOT NULL,
  `Status` tinyint(1) DEFAULT 0,
  `Priority` varchar(20) DEFAULT NULL,
  `Request_date` date DEFAULT NULL,
  `Allocation_date` date DEFAULT NULL,
  `Safr_id` varchar(20) DEFAULT NULL,
  `Operating_areas` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evac_request`
--

INSERT INTO `evac_request` (`Evareq_id`, `Status`, `Priority`, `Request_date`, `Allocation_date`, `Safr_id`, `Operating_areas`) VALUES
('EVAC001', 1, 'Elder', '2024-02-05', '2024-02-05', 'SAFR-C1-20240101-001', 'Aleppo'),
('EVAC002', 1, 'Chronically Ill', '2024-02-10', '2024-02-10', 'SAFR-C3-20240201-001', 'Homs'),
('EVAC003', 0, 'Minor', '2024-03-01', NULL, 'SAFR-C2-20240115-002', 'Damascus'),
('EVAC004', 0, 'General', '2024-03-10', NULL, 'SAFR-C4-20240210-001', 'Latakia'),
('EVAC005', 1, 'Elder', '2024-03-15', '2024-03-15', 'SAFR-C5-20240220-001', 'Daraa'),
('EVAC006', 1, 'Minor', '2024-02-15', '2024-02-15', 'SAFR-C6-20240101-003', 'Deir ez-Zor'),
('EVAC007', 1, 'Elder', '2024-02-20', '2024-02-20', 'SAFR-C7-20240110-004', 'Raqqa'),
('EVAC008', 0, 'General', '2024-03-05', NULL, 'SAFR-C7-20240110-002', 'Raqqa'),
('EVAC009', 1, 'Chronically Ill', '2024-03-12', '2024-03-12', 'SAFR-C8-20240120-001', 'Idlib'),
('EVAC010', 0, 'Minor', '2024-03-20', NULL, 'SAFR-C6-20240101-003', 'Hama'),
('EVAC011', 1, 'General', '2024-04-01', '2024-04-01', 'SAFR-C7-20240315-005', 'Tartus'),
('EVAC012', 1, 'Minor', '2026-05-01', NULL, 'SAFR-C007-20260430-1', 'Daraa'),
('EVAC013', 0, 'Minor', '2026-05-01', NULL, 'SAFR-C005-20260501-1', 'Latakia'),
('EVAC014', 0, 'Minor', '2026-05-01', NULL, 'SAFR-C005-20260501-1', 'Homs'),
('EVAC015', 0, 'Elder', '2026-05-02', NULL, 'SAFR-C006-20260501-1', 'Idlib'),
('EVAC016', 1, 'Minor', '2026-05-02', NULL, 'SAFR-C007-20260430-1', 'Daraa'),
('EVAC017', 1, 'Chronically Ill', '2026-05-05', '2026-05-05', 'SAFR-C007-20260430-1', 'Aleppo'),
('EVAC018', 1, 'Elder', '2026-05-05', '2026-05-05', 'SAFR-C007-20260430-1', 'Aleppo'),
('EVAC019', 1, 'Elder', '2026-05-05', '2026-05-05', 'SAFR-C010-20260521-2', 'Aleppo');

-- --------------------------------------------------------

--
-- Table structure for table `identity_doc`
--

CREATE TABLE `identity_doc` (
  `Safr_id` varchar(20) NOT NULL,
  `Doc_number` varchar(50) NOT NULL,
  `Doc_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `identity_doc`
--

INSERT INTO `identity_doc` (`Safr_id`, `Doc_number`, `Doc_type`) VALUES
('SAFR-C005-20260501-1', '24101513', 'School/Office ID Card'),
('SAFR-C006-20260501-1', '241015188', 'School/Office ID Card'),
('SAFR260429A91DE182', '88017166599083322124455', 'National ID'),
('SAFR-C5-20240301-002', 'AFG-NID-800001', 'National ID'),
('SAFR-C5-20240220-001', 'AFG-PP-001122', 'Passport'),
('SAFR-C8-20240120-003', 'BDI-BC-300003', 'Birth Certificate'),
('SAFR-C005-20260501-1', 'DD-12323-5434', 'Driving License'),
('SAFR-C011-20260501-1', 'DID-111-22-3342', 'Driving License'),
('SAFR-C8-20240120-002', 'DRC-NID-300002', 'National ID'),
('SAFR-C8-20240120-001', 'DRC-PP-300001', 'Passport'),
('SAFR-C7-20240110-003', 'MYA-BC-200003', 'Birth Certificate'),
('SAFR-C1-20240101-002', 'MYA-NID-005678', 'National ID'),
('SAFR-C7-20240110-001', 'MYA-NID-200001', 'National ID'),
('SAFR-C7-20240110-004', 'MYA-NID-200004', 'National ID'),
('SAFR-C1-20240115-004', 'MYA-NID-400001', 'National ID'),
('SAFR-C7-20240315-005', 'MYA-NID-900002', 'National ID'),
('SAFR-C1-20240101-001', 'MYA-PP-001234', 'Passport'),
('SAFR-C1-20240301-003', 'MYA-PP-009988', 'Passport'),
('SAFR-C7-20240110-002', 'MYA-PP-200002', 'Passport'),
('SAFR-C1-20240115-005', 'MYA-PP-400002', 'Passport'),
('SAFR-C011-20260501-1', 'PID-888-777-222', 'Passport'),
('SAFR-C4-20240210-001', 'SDN-NID-003210', 'National ID'),
('SAFR-C4-20240220-003', 'SDN-NID-700002', 'National ID'),
('SAFR-C4-20240220-002', 'SDN-PP-700001', 'Passport'),
('SAFR260429A91DE182', 'SEARCH-DOC', 'Search Request'),
('SAFR-C3-20240215-003', 'SOM-NID-600001', 'National ID'),
('SAFR-C3-20240201-001', 'SOM-PP-007654', 'Passport'),
('SAFR-C6-20240101-003', 'SSD-BC-100003', 'Birth Certificate'),
('SAFR-C6-20240101-001', 'SSD-NID-100001', 'National ID'),
('SAFR-C6-20240101-002', 'SSD-NID-100002', 'National ID'),
('SAFR-C6-20240310-004', 'SSD-PP-900001', 'Passport'),
('SAFR-C2-20240115-002', 'SYR-DL-004321', 'Driving License'),
('SAFR-C2-20240305-003', 'SYR-NID-005544', 'National ID'),
('SAFR-C2-20240201-004', 'SYR-NID-500001', 'National ID'),
('SAFR-C2-20240115-001', 'SYR-PP-009876', 'Passport'),
('SAFR-C2-20240201-005', 'SYR-PP-500002', 'Passport');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_update`
--

CREATE TABLE `inventory_update` (
  `Inventory_id` varchar(20) NOT NULL,
  `Item_name` varchar(100) NOT NULL,
  `Last_updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory_update`
--

INSERT INTO `inventory_update` (`Inventory_id`, `Item_name`, `Last_updated`) VALUES
('INV001', 'Bandages', '2024-03-01'),
('INV001', 'Oxygen Cylinders', '2024-03-15'),
('INV001', 'Paracetamol', '2024-03-01'),
('INV002', 'Oral Rehydration', '2024-03-05'),
('INV004', 'Antibiotics', '2024-03-05'),
('INV005', 'Insulin', '2024-02-28'),
('INV006', 'Syringes', '2024-02-28'),
('INV007', 'Paracetamol', '2024-03-10'),
('INV008', 'Bandages', '2024-03-10'),
('INV009', 'Blood Bags', '2024-03-12'),
('INV011', 'Paracetamol', '2024-03-20'),
('INV012', 'Oral Rehydration', '2024-03-20'),
('INV013', 'Malaria Tablets', '2024-03-22'),
('INV014', 'Bandages', '2024-03-25'),
('INV015', 'Antibiotics', '2024-03-25'),
('INV016', 'Vaccines', '2024-03-28'),
('INV017', 'Syringes', '2024-04-01'),
('INV018', 'Insulin', '2024-04-01'),
('INV019', 'Blood Bags', '2024-04-02'),
('INV020', 'Surgical Gloves', '2024-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `item_amount`
--

CREATE TABLE `item_amount` (
  `Inventory_id` varchar(20) NOT NULL,
  `Item_name` varchar(100) NOT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_amount`
--

INSERT INTO `item_amount` (`Inventory_id`, `Item_name`, `Quantity`) VALUES
('INV001', 'Bandages', 2000),
('INV001', 'Oxygen Cylinders', 10),
('INV001', 'Paracetamol', 5000),
('INV002', 'Oral Rehydration', 1500),
('INV004', 'Antibiotics', 50),
('INV005', 'Insulin', 30),
('INV006', 'Syringes', 3000),
('INV007', 'Paracetamol', 800),
('INV008', 'Bandages', 400),
('INV009', 'Blood Bags', 100),
('INV011', 'Paracetamol', 3000),
('INV012', 'Oral Rehydration', 2000),
('INV013', 'Malaria Tablets', 1000),
('INV014', 'Bandages', 200),
('INV015', 'Antibiotics', 20),
('INV016', 'Vaccines', 5000),
('INV017', 'Syringes', 4000),
('INV018', 'Insulin', 15),
('INV019', 'Blood Bags', 50),
('INV020', 'Surgical Gloves', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `match_details`
--

CREATE TABLE `match_details` (
  `Safr_id` varchar(20) NOT NULL,
  `Camp_location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `match_details`
--

INSERT INTO `match_details` (`Safr_id`, `Camp_location`) VALUES
('SAFR-C1-20240115-005', 'Cox\'s Bazar Camp, Bangladesh'),
('SAFR-C2-20240305-003', 'Zaatari Camp, Jordan'),
('SAFR-C6-20240310-004', 'Unknown'),
('SAFR-C8-20240120-002', 'Nakivale Camp, Uganda');

-- --------------------------------------------------------

--
-- Table structure for table `ngo`
--

CREATE TABLE `ngo` (
  `NGO_name` varchar(100) NOT NULL,
  `Contact_Email` varchar(100) DEFAULT NULL,
  `Manager_name` varchar(100) DEFAULT NULL,
  `Operating_Areas` varchar(100) DEFAULT NULL,
  `Camp_id` varchar(20) DEFAULT NULL,
  `Item_req` varchar(40) DEFAULT NULL,
  `Item_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ngo`
--

INSERT INTO `ngo` (`NGO_name`, `Contact_Email`, `Manager_name`, `Operating_Areas`, `Camp_id`, `Item_req`, `Item_quantity`) VALUES
('BRAC', 'bracglobal@gmail.com', 'Tahmeed Labib', 'Syria', 'CAMP009', NULL, NULL),
('Care Intl', 'contact@care.org', 'Michelle Nunn', 'Asia', 'CAMP008', NULL, NULL),
('ICRC', 'contact@icrc.org', 'Mirjana Spoljaric', 'Global', 'CAMP007', NULL, NULL),
('IRC', 'contact@rescue.org', 'David Miliband', 'Africa', 'CAMP003', NULL, NULL),
('MSF', 'contact@msf.org', 'Christos Christou', 'Middle East', 'CAMP002', NULL, NULL),
('Oxfam', 'contact@oxfam.org', 'Gabriela Bucher', 'Africa', 'CAMP006', NULL, NULL),
('Save Children', 'info@savechildren.org', 'Inger Ashing', 'Asia', 'CAMP004', NULL, NULL),
('UNHCR', 'contact@unhcr.org', 'Filippo Grandi', 'Global', 'CAMP001', NULL, NULL),
('WFP', 'contact@wfp.org', 'Cindy McCain', 'Global', 'CAMP005', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ngo_credential`
--

CREATE TABLE `ngo_credential` (
  `NGO_name` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ngo_credential`
--

INSERT INTO `ngo_credential` (`NGO_name`, `Password`) VALUES
('BRAC', '1234567'),
('Care Intl', 'careintl222'),
('ICRC', 'icrc111'),
('IRC', 'irc789'),
('MSF', 'msf456'),
('Oxfam', 'oxfam987'),
('Save Children', 'savechildren321'),
('UNHCR', 'unhcr123'),
('WFP', 'wfp654');

-- --------------------------------------------------------

--
-- Table structure for table `ngo_inventory`
--

CREATE TABLE `ngo_inventory` (
  `NGO_name` varchar(100) NOT NULL,
  `Item_name` varchar(100) NOT NULL,
  `Category` varchar(50) DEFAULT NULL,
  `Unit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ngo_inventory`
--

INSERT INTO `ngo_inventory` (`NGO_name`, `Item_name`, `Category`, `Unit`) VALUES
('BRAC', 'Powdered Milk', 'Food', 3000),
('BRAC', 'Tents', 'Shelter', 100),
('Care Intl', 'Baby Food', 'Food', 2500),
('Care Intl', 'Blankets', 'Shelter', 3000),
('Care Intl', 'Tents', 'Shelter', 1500),
('ICRC', 'Blood Bags', 'Medical', 500),
('ICRC', 'First Aid Kits', 'Medical', 1000),
('ICRC', 'Surgical Kits', 'Medical', 200),
('IRC', 'Blankets', 'Shelter', 5000),
('IRC', 'Water Filters', 'Sanitation', 300),
('MSF', 'Surgical Kits', 'Medical', 500),
('MSF', 'Vaccines', 'Medical', 8000),
('Oxfam', 'Food Rations', 'Food', 8000),
('Oxfam', 'Hygiene Kits', 'Sanitation', 5000),
('Oxfam', 'Water Purification', 'Sanitation', 200),
('Save Children', 'Baby Food', 'Food', 2000),
('Save Children', 'School Kits', 'Education', 1000),
('UNHCR', 'Food Rations', 'Food', 10000),
('UNHCR', 'Powdered Milk', 'Food', 158),
('UNHCR', 'Tents', 'Shelter', 2000),
('WFP', 'Cooking Oil', 'Food', 10000),
('WFP', 'Rice', 'Food', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `refugee`
--

CREATE TABLE `refugee` (
  `Safr_id` varchar(20) NOT NULL,
  `Full_name` varchar(100) NOT NULL,
  `Date_of_Birth` date DEFAULT NULL,
  `Blood_Group` varchar(5) DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `Reg_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `refugee`
--

INSERT INTO `refugee` (`Safr_id`, `Full_name`, `Date_of_Birth`, `Blood_Group`, `Country`, `City`, `Reg_date`) VALUES
('SAFR-C005-20260501-1', 'TAHMEED LABIB KHAN MAJLIS', '2025-11-05', 'B-', 'Syria', 'Daraa', '2026-05-01'),
('SAFR-C006-20260501-1', 'tahmeed muaz', '2025-11-07', 'AB+', 'Syria', 'Deir ez-Zor', '2026-05-01'),
('SAFR-C007-20260430-1', 'Tahrim joy', '2026-04-08', 'B-', 'Syria', 'Raqqa', '2026-04-30'),
('SAFR-C010-20260501-1', 'Tahmeed Labib', '2026-05-30', 'B-', 'Syria', 'Hama', '2026-05-01'),
('SAFR-C010-20260521-2', 'faiy aziz', '2000-02-02', 'B+', 'Syria', 'Hama', '2026-05-21'),
('SAFR-C011-20260501-1', 'Amin Ahnaf', '2026-05-13', 'AB+', 'Syria', 'Tartus', '2026-05-01'),
('SAFR-C1-20240101-001', 'Mohammad Alam', '1985-03-15', 'B+', 'Myanmar', 'Rakhine', '2024-01-01'),
('SAFR-C1-20240101-002', 'Noor Alam', '1988-07-22', 'O+', 'Myanmar', 'Rakhine', '2024-01-01'),
('SAFR-C1-20240115-004', 'Salima Khanom', '1975-04-03', 'O+', 'Myanmar', 'Sittwe', '2024-01-15'),
('SAFR-C1-20240115-005', 'Abdul Karim', '1972-10-28', 'A+', 'Myanmar', 'Sittwe', '2024-01-15'),
('SAFR-C1-20240301-003', 'Karim Hossain', '1970-05-08', 'A+', 'Myanmar', 'Yangon', '2024-03-01'),
('SAFR-C2-20240115-001', 'Khalid Al-Souri', '1990-11-05', 'A+', 'Syria', 'Aleppo', '2024-01-15'),
('SAFR-C2-20240115-002', 'Amira Al-Souri', '1993-04-18', 'AB-', 'Syria', 'Aleppo', '2024-01-15'),
('SAFR-C2-20240201-004', 'Hassan Darwish', '1983-07-11', 'B+', 'Syria', 'Homs', '2024-02-01'),
('SAFR-C2-20240201-005', 'Maryam Darwish', '1985-09-23', 'O+', 'Syria', 'Homs', '2024-02-01'),
('SAFR-C2-20240305-003', 'Layla Mansour', '2005-08-19', 'B+', 'Syria', 'Damascus', '2024-03-05'),
('SAFR-C3-20240201-001', 'Abdi Hassan', '1978-09-30', 'O-', 'Somalia', 'Mogadishu', '2024-02-01'),
('SAFR-C3-20240201-002', 'Hodan Hassan', '1982-12-10', 'A-', 'Somalia', 'Mogadishu', '2024-02-01'),
('SAFR-C3-20240215-003', 'Ifrah Ahmed', '1998-03-14', 'A+', 'Somalia', 'Kismayo', '2024-02-15'),
('SAFR-C4-20240210-001', 'Amara Diallo', '1995-06-25', 'B-', 'Sudan', 'Khartoum', '2024-02-10'),
('SAFR-C4-20240220-002', 'Fatna Ibrahim', '1991-06-06', 'B-', 'Sudan', 'Darfur', '2024-02-20'),
('SAFR-C4-20240220-003', 'Yusuf Ibrahim', '1994-02-19', 'O-', 'Sudan', 'Darfur', '2024-02-20'),
('SAFR-C5-20240220-001', 'Yasmin Hassan', '2000-01-14', 'O+', 'Afghanistan', 'Kabul', '2024-02-20'),
('SAFR-C5-20240301-002', 'Zarghona Rahimi', '2001-11-30', 'AB-', 'Afghanistan', 'Kandahar', '2024-03-01'),
('SAFR-C6-20240101-001', 'Emmanuel Odong', '1980-02-14', 'A+', 'South Sudan', 'Juba', '2024-01-01'),
('SAFR-C6-20240101-002', 'Grace Akello', '1984-06-30', 'O+', 'South Sudan', 'Juba', '2024-01-01'),
('SAFR-C6-20240101-003', 'Peter Ladu', '2010-09-12', 'B+', 'South Sudan', 'Wau', '2024-01-01'),
('SAFR-C6-20240310-004', 'Adut Deng', '1977-08-25', 'A+', 'South Sudan', 'Malakal', '2024-03-10'),
('SAFR-C7-20240110-001', 'Rohima Begum', '1992-03-25', 'O-', 'Myanmar', 'Cox\'s Bazar', '2024-01-10'),
('SAFR-C7-20240110-002', 'Nur Islam', '1990-11-18', 'A+', 'Myanmar', 'Rakhine', '2024-01-10'),
('SAFR-C7-20240110-003', 'Ayesha Khatun', '2015-07-04', 'B-', 'Myanmar', 'Rakhine', '2024-01-10'),
('SAFR-C7-20240110-004', 'Rabia Begum', '1968-01-22', 'AB+', 'Myanmar', 'Maungdaw', '2024-01-10'),
('SAFR-C7-20240315-005', 'Hamida Sultana', '2003-05-05', 'O+', 'Myanmar', 'Teknaf', '2024-03-15'),
('SAFR-C8-20240120-001', 'Jean Pierre Habimana', '1986-05-17', 'O+', 'DRC', 'Goma', '2024-01-20'),
('SAFR-C8-20240120-002', 'Marie Claire Uwera', '1989-08-09', 'A-', 'DRC', 'Goma', '2024-01-20'),
('SAFR-C8-20240120-003', 'Pascal Niyonzima', '2008-12-31', 'B+', 'Burundi', 'Bujumbura', '2024-01-20'),
('SAFR007-20260430-1', 'abdul', '2026-04-14', 'O+', 'syria', 'Raqqa', '2026-04-30'),
('SAFR010-20260430-1', 'alim hassan', '2026-04-10', 'B-', 'Syria', 'Hama', '2026-04-30'),
('SAFR260429A91DE182', 'Tharim joy', '1994-10-12', '', 'Syria', 'Hama', '2026-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `refugee_credential`
--

CREATE TABLE `refugee_credential` (
  `Safr_id` varchar(20) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `refugee_credential`
--

INSERT INTO `refugee_credential` (`Safr_id`, `Password`) VALUES
('SAFR-C005-20260501-1', '123456'),
('SAFR-C006-20260501-1', '1234567'),
('SAFR-C007-20260430-1', '1234567'),
('SAFR-C010-20260501-1', '1234567'),
('SAFR-C010-20260521-2', '1234567890'),
('SAFR-C011-20260501-1', '1234567'),
('SAFR-C1-20240101-001', 'mohammad123'),
('SAFR-C2-20240115-001', 'khalid789'),
('SAFR-C3-20240201-001', 'abdi654'),
('SAFR-C4-20240210-001', 'amara111');

-- --------------------------------------------------------

--
-- Table structure for table `refugee_stay_in_camp`
--

CREATE TABLE `refugee_stay_in_camp` (
  `Safr_id` varchar(20) NOT NULL,
  `Camp_id` varchar(20) NOT NULL,
  `Arrival_date` date DEFAULT NULL,
  `Departure_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `refugee_stay_in_camp`
--

INSERT INTO `refugee_stay_in_camp` (`Safr_id`, `Camp_id`, `Arrival_date`, `Departure_date`) VALUES
('SAFR-C007-20260430-1', 'CAMP007', '2026-04-30', NULL),
('SAFR-C011-20260501-1', 'CAMP008', '2026-05-17', '2026-06-05'),
('SAFR-C011-20260501-1', 'CAMP011', '2026-05-01', '2026-05-15'),
('SAFR-C1-20240101-001', 'CAMP001', '2024-01-01', NULL),
('SAFR-C1-20240101-002', 'CAMP001', '2024-01-01', NULL),
('SAFR-C1-20240115-004', 'CAMP001', '2024-01-15', NULL),
('SAFR-C1-20240115-005', 'CAMP001', '2024-01-15', NULL),
('SAFR-C1-20240301-003', 'CAMP001', '2024-03-01', NULL),
('SAFR-C2-20240115-001', 'CAMP002', '2024-01-15', NULL),
('SAFR-C2-20240115-002', 'CAMP002', '2024-01-15', NULL),
('SAFR-C2-20240201-004', 'CAMP002', '2024-02-01', NULL),
('SAFR-C2-20240201-005', 'CAMP002', '2024-02-01', NULL),
('SAFR-C2-20240305-003', 'CAMP002', '2024-03-05', NULL),
('SAFR-C3-20240201-001', 'CAMP003', '2024-02-01', NULL),
('SAFR-C3-20240201-001', 'CAMP004', '2024-03-15', NULL),
('SAFR-C3-20240201-002', 'CAMP003', '2024-02-01', NULL),
('SAFR-C3-20240215-003', 'CAMP003', '2024-02-15', NULL),
('SAFR-C4-20240210-001', 'CAMP004', '2024-02-10', NULL),
('SAFR-C4-20240220-002', 'CAMP004', '2024-02-20', NULL),
('SAFR-C4-20240220-003', 'CAMP004', '2024-02-20', NULL),
('SAFR-C5-20240220-001', 'CAMP005', '2024-02-20', NULL),
('SAFR-C5-20240301-002', 'CAMP005', '2024-03-01', NULL),
('SAFR-C6-20240101-001', 'CAMP006', '2024-01-01', NULL),
('SAFR-C6-20240101-002', 'CAMP006', '2024-01-01', NULL),
('SAFR-C6-20240101-002', 'CAMP008', '2024-03-20', NULL),
('SAFR-C6-20240101-003', 'CAMP006', '2024-01-01', NULL),
('SAFR-C6-20240310-004', 'CAMP006', '2024-03-10', NULL),
('SAFR-C7-20240110-001', 'CAMP007', '2024-01-10', NULL),
('SAFR-C7-20240110-002', 'CAMP007', '2024-01-10', NULL),
('SAFR-C7-20240110-003', 'CAMP007', '2024-01-10', NULL),
('SAFR-C7-20240110-004', 'CAMP001', '2024-04-01', NULL),
('SAFR-C7-20240110-004', 'CAMP007', '2024-01-10', NULL),
('SAFR-C7-20240315-005', 'CAMP007', '2024-03-15', NULL),
('SAFR-C8-20240120-001', 'CAMP008', '2024-01-20', NULL),
('SAFR-C8-20240120-002', 'CAMP008', '2024-01-20', NULL),
('SAFR-C8-20240120-003', 'CAMP008', '2024-01-20', NULL),
('SAFR-C011-20260501-1', 'CAMP008', '2026-05-17', '2026-06-05'),
('SAFR-C011-20260501-1', 'CAMP008', '2026-05-17', '2026-06-05'),
('SAFR-C011-20260501-1', 'CAMP002', '2026-05-10', NULL),
('SAFR-C011-20260501-1', 'CAMP006', '2026-06-07', '2026-05-29'),
('SAFR-C011-20260501-1', 'CAMP012', '2026-05-31', NULL),
('SAFR-C010-20260501-1', 'CAMP010', '2026-05-01', NULL),
('SAFR-C005-20260501-1', 'CAMP005', '2026-05-01', '2026-05-15'),
('SAFR-C005-20260501-1', 'CAMP009', '2026-05-17', NULL),
('SAFR-C006-20260501-1', 'CAMP006', '2026-05-01', '2026-05-22'),
('SAFR-C006-20260501-1', 'CAMP011', '2026-05-24', NULL),
('SAFR-C010-20260521-2', 'CAMP010', '2026-05-21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `search_req`
--

CREATE TABLE `search_req` (
  `Safr_id` varchar(20) NOT NULL,
  `Status` tinyint(1) DEFAULT 0,
  `Missing_Name` varchar(100) DEFAULT NULL,
  `Doc_number` varchar(50) NOT NULL,
  `Match_Safr_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `search_req`
--

INSERT INTO `search_req` (`Safr_id`, `Status`, `Missing_Name`, `Doc_number`, `Match_Safr_id`) VALUES
('SAFR-C005-20260501-1', 0, 'Amin Ahnaf', '3223-12562-34332', NULL),
('SAFR-C007-20260430-1', 0, 'buhu', '121235643 ', NULL),
('SAFR-C007-20260430-1', 0, 'Noor Alam ', 'DL-8801716659908', NULL),
('SAFR-C007-20260430-1', 0, 'Tahmeed Muaz', 'PID-2410110023486', NULL),
('SAFR-C1-20240101-001', 0, 'Rashida Alam', 'MYA-PP-001234', NULL),
('SAFR-C1-20240115-004', 1, 'Abdul Karim', 'MYA-NID-400001', 'SAFR-C1-20240115-005'),
('SAFR-C2-20240115-001', 1, 'Layla Mansour', 'SYR-PP-009876', 'SAFR-C2-20240305-003'),
('SAFR-C2-20240201-004', 0, 'Lina Darwish', 'SYR-NID-500001', NULL),
('SAFR-C3-20240201-001', 0, 'Fadumo Hassan', 'SOM-PP-007654', NULL),
('SAFR-C4-20240210-001', 0, 'Omar Diallo', 'SDN-NID-003210', NULL),
('SAFR-C4-20240220-002', 0, 'Ibrahim Suleiman', 'SDN-PP-700001', NULL),
('SAFR-C5-20240220-001', 0, 'Tariq Hassan', 'AFG-PP-001122', NULL),
('SAFR-C6-20240101-001', 0, 'Anna Odong', 'SSD-NID-100001', NULL),
('SAFR-C7-20240110-001', 0, 'Karim Islam', 'MYA-NID-200001', NULL),
('SAFR-C7-20240110-002', 0, 'Hasina Begum', 'MYA-PP-200002', NULL),
('SAFR-C8-20240120-001', 1, 'Claudine Uwera', 'DRC-PP-300001', 'SAFR-C8-20240120-002');

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `Volunteer_id` varchar(20) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Home_Country` varchar(50) DEFAULT NULL,
  `skill` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`Volunteer_id`, `Name`, `Email`, `Phone`, `Home_Country`, `skill`) VALUES
('VOL001', 'Ahmed Hassan', 'ahmed.hassan@email.com', '+880-1711-111001', 'Bangladesh', NULL),
('VOL002', 'Maria Santos', 'maria.santos@email.com', '+63-917-222002', 'Philippines', NULL),
('VOL003', 'Fatima Al-Rashid', 'fatima.rashid@email.com', '+962-79-333003', 'Jordan', NULL),
('VOL004', 'James Okonkwo', 'james.okonkwo@email.com', '+234-803-444004', 'Nigeria', NULL),
('VOL005', 'Priya Sharma', 'priya.sharma@email.com', '+91-98765-55005', 'India', NULL),
('VOL006', 'Amina Yusuf', 'amina.yusuf@email.com', '+254-722-666006', 'Kenya', NULL),
('VOL007', 'Carlos Rivera', 'carlos.rivera@email.com', '+52-55-777007', 'Mexico', NULL),
('VOL008', 'Lena Fischer', 'lena.fischer@email.com', '+49-176-888008', 'Germany', NULL),
('VOL009', 'Omar Farouk', 'omar.farouk@email.com', '+20-100-999009', 'Egypt', NULL),
('VOL010', 'Sarah Mitchell', 'sarah.mitchell@email.com', '+1-617-100010', 'USA', NULL),
('VOL011', 'Tariq Mahmoud', 'tariq.mahmoud@email.com', '+966-50-111011', 'Saudi Arabia', NULL),
('VOL012', 'Hana Kim', 'hana.kim@email.com', '+82-10-222012', 'South Korea', NULL),
('VOL013', 'Blessing Eze', 'blessing.eze@email.com', '+234-806-333013', 'Nigeria', NULL),
('VOL014', 'Rania Aziz', 'rania.aziz@email.com', '+216-20-444014', 'Tunisia', NULL),
('VOL015', 'David Ochieng', 'david.ochieng@email.com', '+254-733-555015', 'Kenya', NULL),
('VOL016', 'Abdul Baquee Khan  Majlis', 'abkmajlis@gmail.com', '01716659908', 'Bangladesh', 'Translation'),
('VOL017', 'WAHID AL AMIN', 'wahid.al.amin@g.bracu.ac.bd', '0153323222', 'Bangladesh', 'Mechanic'),
('VOL018', 'WAHID AL AMIN', 'wahid.al.amin@g.bracu.ac.bd', '0153323222', 'Bangladesh', 'Medical Worker'),
('VOL019', 'WAHID AL AMIN', 'wahid.al.amin@g.bracu.ac.bd', '0153323222', 'Bangladesh', 'Mechanic');

-- --------------------------------------------------------

--
-- Table structure for table `volunteers_quota`
--

CREATE TABLE `volunteers_quota` (
  `Volunteer_id` varchar(20) NOT NULL,
  `Outcome` varchar(255) DEFAULT NULL,
  `Assignment_ID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `volunteers_quota`
--

INSERT INTO `volunteers_quota` (`Volunteer_id`, `Outcome`, `Assignment_ID`) VALUES
('VOL001', 'Successfully administered medical aid to 200 refugees', NULL),
('VOL004', 'Provided emergency medical care during outbreak', NULL),
('VOL005', 'Conducted 80 counselling sessions', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `volunteer_credential`
--

CREATE TABLE `volunteer_credential` (
  `Volunteer_id` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `volunteer_credential`
--

INSERT INTO `volunteer_credential` (`Volunteer_id`, `Password`) VALUES
('VOL001', 'ahmed123'),
('VOL002', 'maria456'),
('VOL003', 'fatima789'),
('VOL004', 'james321'),
('VOL016', '1234567'),
('VOL017', '12345678'),
('VOL018', '1234567'),
('VOL019', '12345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aid`
--
ALTER TABLE `aid`
  ADD PRIMARY KEY (`Item_name`,`Camp_id`,`NGO_name`),
  ADD KEY `Camp_id` (`Camp_id`),
  ADD KEY `NGO_name` (`NGO_name`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`Assignment_ID`,`Volunteer_id`),
  ADD KEY `Volunteer_id` (`Volunteer_id`),
  ADD KEY `Camp_id` (`Camp_id`);

--
-- Indexes for table `assignment_required_skill`
--
ALTER TABLE `assignment_required_skill`
  ADD PRIMARY KEY (`Assignment_ID`);

--
-- Indexes for table `camp`
--
ALTER TABLE `camp`
  ADD PRIMARY KEY (`Camp_id`),
  ADD KEY `Volunteer_id` (`Volunteer_id`),
  ADD KEY `fk_camp_evareq` (`Evareq_id`);

--
-- Indexes for table `camp_medical_inventory`
--
ALTER TABLE `camp_medical_inventory`
  ADD PRIMARY KEY (`Inventory_id`,`Item_name`),
  ADD KEY `Camp_id` (`Camp_id`);

--
-- Indexes for table `camp_medical_inventory_asks_for`
--
ALTER TABLE `camp_medical_inventory_asks_for`
  ADD PRIMARY KEY (`Requesting_Inventory_id`,`Requested_Inventory_id`),
  ADD KEY `Requested_Inventory_id` (`Requested_Inventory_id`);

--
-- Indexes for table `camp_request`
--
ALTER TABLE `camp_request`
  ADD PRIMARY KEY (`Camp_id`,`NGO_name`),
  ADD KEY `NGO_name` (`NGO_name`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`Name`);

--
-- Indexes for table `donor_credential`
--
ALTER TABLE `donor_credential`
  ADD PRIMARY KEY (`Full_name`);

--
-- Indexes for table `donor_ngo`
--
ALTER TABLE `donor_ngo`
  ADD PRIMARY KEY (`NGO_name`,`Donor_Name`),
  ADD KEY `Donor_Name` (`Donor_Name`);

--
-- Indexes for table `evac_request`
--
ALTER TABLE `evac_request`
  ADD PRIMARY KEY (`Evareq_id`),
  ADD KEY `Safr_id` (`Safr_id`);

--
-- Indexes for table `identity_doc`
--
ALTER TABLE `identity_doc`
  ADD PRIMARY KEY (`Doc_number`) USING BTREE,
  ADD KEY `Safr_id` (`Safr_id`,`Doc_number`) USING BTREE;

--
-- Indexes for table `inventory_update`
--
ALTER TABLE `inventory_update`
  ADD PRIMARY KEY (`Inventory_id`,`Item_name`);

--
-- Indexes for table `item_amount`
--
ALTER TABLE `item_amount`
  ADD PRIMARY KEY (`Inventory_id`,`Item_name`);

--
-- Indexes for table `match_details`
--
ALTER TABLE `match_details`
  ADD PRIMARY KEY (`Safr_id`);

--
-- Indexes for table `ngo`
--
ALTER TABLE `ngo`
  ADD PRIMARY KEY (`NGO_name`),
  ADD UNIQUE KEY `Camp_id` (`Camp_id`);

--
-- Indexes for table `ngo_credential`
--
ALTER TABLE `ngo_credential`
  ADD PRIMARY KEY (`NGO_name`);

--
-- Indexes for table `ngo_inventory`
--
ALTER TABLE `ngo_inventory`
  ADD PRIMARY KEY (`NGO_name`,`Item_name`);

--
-- Indexes for table `refugee`
--
ALTER TABLE `refugee`
  ADD PRIMARY KEY (`Safr_id`);

--
-- Indexes for table `refugee_credential`
--
ALTER TABLE `refugee_credential`
  ADD PRIMARY KEY (`Safr_id`);

--
-- Indexes for table `refugee_stay_in_camp`
--
ALTER TABLE `refugee_stay_in_camp`
  ADD KEY `Camp_id` (`Camp_id`),
  ADD KEY `fk_safr_id` (`Safr_id`);

--
-- Indexes for table `search_req`
--
ALTER TABLE `search_req`
  ADD PRIMARY KEY (`Safr_id`,`Doc_number`),
  ADD KEY `Safr_id` (`Safr_id`,`Doc_number`),
  ADD KEY `Match_Safr_id` (`Match_Safr_id`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD PRIMARY KEY (`Volunteer_id`);

--
-- Indexes for table `volunteers_quota`
--
ALTER TABLE `volunteers_quota`
  ADD PRIMARY KEY (`Volunteer_id`);

--
-- Indexes for table `volunteer_credential`
--
ALTER TABLE `volunteer_credential`
  ADD PRIMARY KEY (`Volunteer_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aid`
--
ALTER TABLE `aid`
  ADD CONSTRAINT `aid_ibfk_1` FOREIGN KEY (`Camp_id`) REFERENCES `camp` (`Camp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aid_ibfk_2` FOREIGN KEY (`NGO_name`) REFERENCES `ngo` (`NGO_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`Volunteer_id`) REFERENCES `volunteer` (`Volunteer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assignment_ibfk_2` FOREIGN KEY (`Camp_id`) REFERENCES `camp` (`Camp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assignment_required_skill`
--
ALTER TABLE `assignment_required_skill`
  ADD CONSTRAINT `assignment_required_skill_ibfk_1` FOREIGN KEY (`Assignment_ID`) REFERENCES `assignment` (`Assignment_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `camp`
--
ALTER TABLE `camp`
  ADD CONSTRAINT `camp_ibfk_1` FOREIGN KEY (`Volunteer_id`) REFERENCES `volunteer` (`Volunteer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_camp_evareq` FOREIGN KEY (`Evareq_id`) REFERENCES `evac_request` (`Evareq_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `camp_medical_inventory`
--
ALTER TABLE `camp_medical_inventory`
  ADD CONSTRAINT `camp_medical_inventory_ibfk_1` FOREIGN KEY (`Camp_id`) REFERENCES `camp` (`Camp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `camp_medical_inventory_asks_for`
--
ALTER TABLE `camp_medical_inventory_asks_for`
  ADD CONSTRAINT `camp_medical_inventory_asks_for_ibfk_1` FOREIGN KEY (`Requesting_Inventory_id`) REFERENCES `camp_medical_inventory` (`Inventory_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `camp_medical_inventory_asks_for_ibfk_2` FOREIGN KEY (`Requested_Inventory_id`) REFERENCES `camp_medical_inventory` (`Inventory_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `camp_request`
--
ALTER TABLE `camp_request`
  ADD CONSTRAINT `camp_request_ibfk_1` FOREIGN KEY (`Camp_id`) REFERENCES `camp` (`Camp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `camp_request_ibfk_2` FOREIGN KEY (`NGO_name`) REFERENCES `ngo` (`NGO_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `donor_credential`
--
ALTER TABLE `donor_credential`
  ADD CONSTRAINT `donor_credential_ibfk_1` FOREIGN KEY (`Full_name`) REFERENCES `donor` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `donor_ngo`
--
ALTER TABLE `donor_ngo`
  ADD CONSTRAINT `donor_ngo_ibfk_1` FOREIGN KEY (`NGO_name`) REFERENCES `ngo` (`NGO_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donor_ngo_ibfk_2` FOREIGN KEY (`Donor_Name`) REFERENCES `donor` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evac_request`
--
ALTER TABLE `evac_request`
  ADD CONSTRAINT `evac_request_ibfk_2` FOREIGN KEY (`Safr_id`) REFERENCES `refugee` (`Safr_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `identity_doc`
--
ALTER TABLE `identity_doc`
  ADD CONSTRAINT `identity_doc_ibfk_1` FOREIGN KEY (`Safr_id`) REFERENCES `refugee` (`Safr_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory_update`
--
ALTER TABLE `inventory_update`
  ADD CONSTRAINT `inventory_update_ibfk_1` FOREIGN KEY (`Inventory_id`,`Item_name`) REFERENCES `camp_medical_inventory` (`Inventory_id`, `Item_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_amount`
--
ALTER TABLE `item_amount`
  ADD CONSTRAINT `item_amount_ibfk_1` FOREIGN KEY (`Inventory_id`,`Item_name`) REFERENCES `camp_medical_inventory` (`Inventory_id`, `Item_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `match_details`
--
ALTER TABLE `match_details`
  ADD CONSTRAINT `match_details_ibfk_1` FOREIGN KEY (`Safr_id`) REFERENCES `refugee` (`Safr_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ngo`
--
ALTER TABLE `ngo`
  ADD CONSTRAINT `ngo_ibfk_1` FOREIGN KEY (`Camp_id`) REFERENCES `camp` (`Camp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ngo_credential`
--
ALTER TABLE `ngo_credential`
  ADD CONSTRAINT `ngo_credential_ibfk_1` FOREIGN KEY (`NGO_name`) REFERENCES `ngo` (`NGO_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ngo_inventory`
--
ALTER TABLE `ngo_inventory`
  ADD CONSTRAINT `ngo_inventory_ibfk_1` FOREIGN KEY (`NGO_name`) REFERENCES `ngo` (`NGO_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `refugee_credential`
--
ALTER TABLE `refugee_credential`
  ADD CONSTRAINT `refugee_credential_ibfk_1` FOREIGN KEY (`Safr_id`) REFERENCES `refugee` (`Safr_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `refugee_stay_in_camp`
--
ALTER TABLE `refugee_stay_in_camp`
  ADD CONSTRAINT `fk_camp_id` FOREIGN KEY (`Camp_id`) REFERENCES `camp` (`Camp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_safr_id` FOREIGN KEY (`Safr_id`) REFERENCES `refugee` (`Safr_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `search_req`
--
ALTER TABLE `search_req`
  ADD CONSTRAINT `search_req_ibfk_1` FOREIGN KEY (`Safr_id`) REFERENCES `refugee` (`Safr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `search_req_ibfk_3` FOREIGN KEY (`Match_Safr_id`) REFERENCES `match_details` (`Safr_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `volunteers_quota`
--
ALTER TABLE `volunteers_quota`
  ADD CONSTRAINT `volunteers_quota_ibfk_1` FOREIGN KEY (`Volunteer_id`) REFERENCES `assignment` (`Volunteer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `volunteer_credential`
--
ALTER TABLE `volunteer_credential`
  ADD CONSTRAINT `volunteer_credential_ibfk_1` FOREIGN KEY (`Volunteer_id`) REFERENCES `volunteer` (`Volunteer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
