-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 04, 2026 at 01:35 PM
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
-- Database: `himansh3_shipperrjdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `AdminLoginID` int(5) NOT NULL,
  `AdminEmail` varchar(100) NOT NULL,
  `AdminPassword` varchar(100) NOT NULL,
  `AdminName` varchar(100) NOT NULL,
  `LastLoginDate` varchar(50) NOT NULL,
  `LastLoginTime` varchar(50) NOT NULL,
  `CurrentStatus` varchar(50) NOT NULL,
  `LastLogoutDate` varchar(50) NOT NULL,
  `LastLogoutTime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`AdminLoginID`, `AdminEmail`, `AdminPassword`, `AdminName`, `LastLoginDate`, `LastLoginTime`, `CurrentStatus`, `LastLogoutDate`, `LastLogoutTime`) VALUES
(1, 'admin@gmail.com', '123456', 'Shipper RJ', '12-03-2026', '11:24:59am', 'true', '25-02-2026', '12:08:55pm');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(10) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `receiver` varchar(100) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `sender_address` text NOT NULL,
  `receiver_address` text NOT NULL,
  `length` varchar(100) NOT NULL,
  `width` varchar(100) NOT NULL,
  `height` varchar(100) NOT NULL,
  `sender_pincode` varchar(100) NOT NULL,
  `receiver_pincode` varchar(100) NOT NULL,
  `package_contents` text NOT NULL,
  `sender_mobile` varchar(100) NOT NULL,
  `receiver_mobile` varchar(100) NOT NULL,
  `order_status` enum('Placed','Confirmed','Dispatched','In Transit','Out for Delivery','Delivered','Cancelled') NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `delivery_boy_id` varchar(100) NOT NULL,
  `payment_session_id` text NOT NULL,
  `payment_status` enum('pending','success','failed') NOT NULL,
  `payment_res` text NOT NULL,
  `amount` varchar(50) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `delivery_proof` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `sender`, `receiver`, `weight`, `sender_address`, `receiver_address`, `length`, `width`, `height`, `sender_pincode`, `receiver_pincode`, `package_contents`, `sender_mobile`, `receiver_mobile`, `order_status`, `user_id`, `delivery_boy_id`, `payment_session_id`, `payment_status`, `payment_res`, `amount`, `date`, `time`, `delivery_proof`) VALUES
(1, 'Troy Glenn', 'Ivana Garner', '95', 'Qui voluptate tempor', 'Tenetur ut lorem por', '91', '44', '64', '226004', '226020', 'Eos labore minim sim', '+1 (965) 781-3467', '+1 (728) 763-1838', 'Delivered', '1', '1', '', 'pending', '', '0', '08-06-2024', '04:42:44pm', NULL),
(2, 'Lilah Orr', 'Nayda Garza', '46', 'Beatae voluptate ius', 'Voluptate minim quib', '72', '71', '80', '226004', '226024', 'Maxime non anim qui ', '+1 (867) 479-5637', '+1 (212) 842-4817', 'Delivered', '1', '1', '', 'pending', '', '0', '08-06-2024', '05:02:46pm', NULL),
(4, 'Hillary Hunter', 'Myra Townsend', '66', 'Maiores est exercita', 'Provident similique', '80', '21', '96', 'Explicabo Eligendi ', 'Ex itaque voluptas e', 'Eum ut ab necessitat', '+1 (219) 696-3745', '+1 (483) 957-6945', 'Delivered', '1', '1', '', 'pending', '', '0', '19-07-2024', '04:44:20pm', NULL),
(5, 'Yardley Gutierrez', 'Haley Norton', '6', 'Adipisci ipsam sit ', 'Perferendis pariatur', '70', '17', '78', 'Officia porro eu adi', 'Molestias neque nihi', 'Sed quo harum sunt l', '+1 (453) 756-5993', '+1 (387) 372-5129', 'Placed', '1', '1', '', 'pending', '', '0', '19-07-2024', '05:12:34pm', NULL),
(6, 'A', 'B', '2', 'Lucknow', 'Kanpur', '80', '100', '150', '226020', '226024', 'Rajma Chawal', '9999999999', '8888888888', 'Placed', '1', '', 'session_2Pu2E7ktLy2ZFY32AAkb710PJEjKx_9HsByl80IUF8AqopXAOqUxTBjMkSi8EjXIURPOVYBiDCrDUcam1j7zp9kgf8_4JA80hEPYcW206ydg', 'pending', '', '0', '07-11-2024', '04:23:35pm', NULL),
(7, 'A', 'B', '2', 'Lucknow', 'Kanpur', '80', '100', '150', '226020', '226024', 'Rajma Chawal', '9999999999', '8888888888', 'Placed', '1', '', 'session_5klAx8f1O1jXHN1C0HzhsnniaPYd0NL5bGoJYlzwByCHQQpJMB8s4p5jomALiAbCazl0oH-91VC-mJ2xbJvIWpURTHLptcYgLfTrsf0Vq_YE', 'success', '{\"cforder_id\":\"order_103287562oWERzIAVdqiS3cOwnKTAP2oDzK\",\"order_amount\":10,\"referenceId\":\"2187929891\",\"txtStatus\":\"success\"}', '0', '07-11-2024', '04:26:20pm', NULL),
(8, 'A', 'B', '2', 'Lucknow', 'Kanpur', '100', '150', '200', '226020', '226001', 'Lucknow', '9999999999', '8888888888', 'Placed', '1', '', 'session_RND45R1cxi9nK6IG7TulFv9o2CCEh8_jh3IMFKn86uqG3n9AzZzcOq_WXhDSQieWaIFf6iHp_ArquDUrE2E4msh50JZX17dD1CHegCoYhmNF', 'success', '{\"cforder_id\":\"order_103287562oWHdLgR1y9ChKzTDlFlcJzA3Zg\",\"order_amount\":10,\"referenceId\":\"2187931796\",\"txtStatus\":\"success\"}', '10', '07-11-2024', '04:52:31pm', NULL),
(9, 'A', 'B', '4', 'Lucknow', 'Kanpur', '100', '200', '150', '226020', '226001', 'Lucknow', '9999999999', '8888888888', 'Placed', '1', '3', 'session_7JyMDv2lFo9UGw14PYMN7MUeLTibUF_i2_V8rjRDzNr6FvF6s8u9aTTx1FQcVpTbCYynynsgraSR8OT9TiAA83LokUj1zWyGmpOQPRroiQVC', 'success', '{\"cforder_id\":\"order_103287562oWIHOpaNQdWsJxqaeInHqPHA02\",\"order_amount\":10,\"referenceId\":\"2187931907\",\"txtStatus\":\"success\"}', '10', '07-11-2024', '04:57:49pm', NULL),
(10, 'A', 'B', '2', 'Lucknow', 'Kanpur', '100', '150', '200', '226020', '226001', 'Lucknow', '9999999999', '8888888888', 'Placed', '1', '', 'session_VjpdC02FZpxz8SQMDJMTK88HWyLQ7jenEkDpfidrYkqo1Pn3pKh4m3ApmkKqHPRvi6RTMn2yi9oF5FRJMb1SXKNDixP9lV4DVGs3SPYJ6Hcn', 'success', '{\"cforder_id\":\"order_103287562oWJb2sXiaMznLv4MI5PPHSpsfw\",\"order_amount\":10,\"referenceId\":\"2187933176\",\"txtStatus\":\"success\"}', '10', '07-11-2024', '05:08:39pm', NULL),
(11, 'A', 'B', '55', 'Kapoorthala , Aliganj , Lucknow', 'etrettttet', '20', '10', '30', '226004', '226024', 'ttrtrrtrttrt', '9999999999', '9999999999', 'Placed', '1', '', 'session_gHP92MPVEBbZ9Xivu88NZjIhuBZC9QuPwYO8B4MS5vVHdYqxKXrndOn-Tsot3961GHWh4bz22Tp8tlGrVzKE-EYs1w6jbH460svcQqQ4eIR2jr2hCqHY6gKkEwpaymentpayment', 'pending', '', '10', '09-12-2024', '12:49:09pm', NULL),
(12, 'A', 'B', '55', 'Kapoorthala , Aliganj , Lucknow', 'etrettttet', '20', '10', '30', '226004', '226024', 'ttrtrrtrttrt', '9999999999', '9999999999', 'Placed', '1', '', 'session_x9HOQEsbaZb_SHp3FS4Eu0t7DjA6Lhfu8QKKxPi38Er97iTyXqn-od-tHC2uDE9dQzGdC4bBqb9f4hZfbrD10IiHC79F8y8R3VHFV7axp5_lmPqIq_uOk6CHUQpaymentpayment', 'pending', '', '10', '09-12-2024', '12:49:32pm', NULL),
(13, 'A', 'B', '55', 'Kapoorthala , Aliganj , Lucknow', 'etrettttet', '20', '10', '30', '226004', '226024', 'ttrtrrtrttrt', '9999999999', '9999999999', 'Delivered', '1', '1', 'session_bQwiER3C-kGZ97GzfcwGA-jSUBykpTHnMODtcAmYzQWiLFcQKxGaTKvItlXwfMOt6glMBdWpMu6dxdKWo--C9nLxdep8IHXE0YaDgLKOYovO5rhSwC4lYt0Zvgpaymentpayment', 'success', '{\"cforder_id\":\"order_103287562pyCQrL2mpEuqL2hwTdtKRP2gIp\",\"order_amount\":32,\"referenceId\":\"2188456608\",\"txtStatus\":\"success\"}', '32', '09-12-2024', '12:51:53pm', NULL),
(14, 'A', 'B', '20', 'wee', 'ewe', '10', '10', '19', '222222', '333333', 'eeeeee', '9999999999', '9999999999', 'Placed', '1', '', 'session_gfzsurPTZMf9fi2OxKJ04f67NewGVrmlqXEbxS7Hi8LPdJ-8D_JHHQ27-rdF6cdtlr3LCb9s4qeZy5U_ZHbFiN8Dz-PXj6yvCMjmebRj_uPN76wQt7_PaJnlagpaymentpayment', 'success', '{\"cforder_id\":\"order_103287562pyEAGm2TaaczzQYJIyqyL8thWK\",\"order_amount\":78,\"referenceId\":\"2188456782\",\"txtStatus\":\"success\"}', '78', '09-12-2024', '01:06:07pm', NULL),
(15, 'Shopping club India ', 'Shiva ', '1', 'Bah bus stand gwalior road near by tixy tample etawah ', 'Near by tixy tample etawah ', '15', '10', '15', '206001', '206001', 'Please safe delevery ', '7454905462', '7454905462', 'Delivered', '2', '3', 'session_0JBmyBSaI-FRXj0Gf_l2RGhdxrSMeq9jgnKgyZjwwm5Rjt7C4QueouVWOhANNjBRB4zOuXMgjsJaDW5DR_SMU3Jve1sL0FC9TdfjlxNCWKeWKslujGNZrGssbQpaymentpayment', 'success', '{\"cforder_id\":\"order_103287562qnTPImQ8yTwFLljnnUkUmJMTD1\",\"order_amount\":49,\"referenceId\":\"2188781613\",\"txtStatus\":\"success\"}', '49', '27-12-2024', '04:31:52pm', NULL),
(16, 'Shopping club India ', 'Shiva', '1', 'Etawah ', 'Delhi ', '15', '10', '15', '206001', '110005', 'Safe ', '7088213888', '7454905462', 'Delivered', '2', '1', 'session_4mFnMyk5eRRDDJ37mpY6qKOT_vbA-PGfiJ6tJ_vvLYS1MQ8JQC6IDZdq4c1soTAMXHrT94jrwTERGCXf4PUSattAd0MmnMK4q5mFXf0RzLY7aza7e5FaSoY7xQpaymentpayment', 'pending', '', '15', '01-01-2025', '11:00:15pm', NULL),
(17, 'Ramesh ', 'Vinay ', '1', 'Etawah ', 'Dhuman pura ', '10', '10', '10', '206001', '206002', 'Mix accessories ', '6395064866', '7465078539', 'Placed', '2', '', 'session_tL6bkHzpRKt0H6ft-O3X4kdAszX15wWaLwgsVileGWDLp12_EifL2v28d8EASj6KdGQzlfRiDDT8nqYvUQLtR_RrkUjZNf0PgBkPAu-IptPDWkE-XRU48zj5whvCRQpaymentpayment', 'success', '{\"cforder_id\":\"order_103287562vyitsIupEshU0y1h8yhOoe7sTG\",\"order_amount\":94,\"referenceId\":\"2192296258\",\"txtStatus\":\"success\"}', '94', '20-04-2025', '10:08:49am', NULL),
(18, 'Shopping club India ', 'RJ ', '2', 'Etawah ', 'Etawah ', '10', '10', '10', '206001', '206001', 'Mix product ', '7454905462', '7454905462', 'Delivered', '2', '3', 'session__xDz0Pevqe8YXWNu4z0ggXPBsfn6ukCJJZBFYkmVCREeusTWYPuWqkz-21R-vLba5NwxETkJh1H6X-FAnDhs4CCtEIkrc7485dwsWRS4cSJ41I1oN3I5R1HItf8Qzgpaymentpayment', 'success', '{\"cforder_id\":\"order_1032875630u93QLAYPfb5eZrjb84yEVQiu2\",\"order_amount\":37,\"referenceId\":\"2195633973\",\"txtStatus\":\"success\"}', '37', '06-08-2025', '01:16:27pm', NULL),
(19, 'Rr', 'Rjb', '2', 'Sci', 'Hisj', '20', '20', '20', '206001', '206002', 'Box ', '7946764965', '7017946866', 'Delivered', '2', '1', 'session_MW-oK1lAgPXpOa6XYok0of9ZmKs2m5rNUMoyjqEv86Oo49joie2O0f__bin2XueIgbOKaNfK9vMR1-4UfnNSHSI6lL2Wgjz0NrRLoUcn96RIPcFQ4_9z7BNSMs4hnQpaymentpayment', 'success', '{\"cforder_id\":\"order_1032875630uJku6aWJvRzJdXzRNrdT8ugs7\",\"order_amount\":30,\"referenceId\":\"2195636949\",\"txtStatus\":\"success\"}', '30', '06-08-2025', '02:44:26pm', NULL),
(20, 'Rj ', 'Rj ', '2', 'Etawah ', 'Etawah ', '20', '20', '20', '206001', '206001', 'Bjan', '7047858589', '664649967', 'Placed', '2', '', 'session_Q6Lttgwr44sWxDq5ntxAMYF8YeTfBGWsIGHRg-LpYDxxuYUYIxNqTr1qE_i3WXgCz_VTp1uKpxVKmLXDq3YEcrD3FYDwgP8IuPzVRWrWhWHkuFlXFOk1fKWffOt7Qgpaymentpayment', 'pending', '', '69', '07-08-2025', '01:06:00am', NULL),
(21, 'Hritik Nishad', 'Gaurav Gupta', '2', 'iamhritiknishad@gmail.com\r\n', 'admin@gmail.com\r\n', '1000', '1000', '300', '226020', '226022', 'Books', '9305189742', '8707312632', 'Placed', '3', '', 'session_0gi76V0_eEu5gVTS4C1jGo9ukvE4IH7yML1IrOpwXvjUyKhUx0RXaK002bYp7BGunYz1_ypVUSDhA9v-uOD73s_Jqzkyee8xdIAUyXHjL_Ef2RIAGyN9y5US0E3t0wpaymentpayment', 'pending', '', '91', '11-08-2025', '11:13:32am', NULL),
(22, 'Hritik Nishad', 'Gaurav Gupta', '2', 'iamhritiknishad@gmail.com\r\n', 'admin@gmail.com\r\n', '1000', '1000', '300', '226020', '226022', 'Books', '9305189742', '8707312632', 'Placed', '3', '3', 'session_4_77rnXTddVCfkBoYwsllXs8vDCchPJdQE4Y2fd7ZnVCHCJa91o1g4M7FdzZ78bY4KwJHr-ZIh3B34b9tGQKngIEgmSl1zBOO9_bUB4RI9hbJvr8odiDvyip1WVkkgpaymentpayment', 'pending', '', '49', '11-08-2025', '11:14:09am', NULL),
(23, 'Hritik Nishad', 'Gaurav Gupta', '2', 'iamhritiknishad@gmail.com\r\n', 'admin@gmail.com\r\n', '1000', '1000', '300', '226020', '226022', 'Books', '9305189742', '8707312632', 'Out for Delivery', '3', '1', 'session_Zfppcc3je8U0FAX_5r7oMN-KRFYnGLrKrG76P9SPv0z4XqkGjeBVhx1F5GaUmATn8-mjJ40yhUYngXdRoHbT6M9ctn-u-Ydl8ixjyn5T2dPMdm4oSigIU5uqjNHWMQpaymentpayment', 'pending', '', '18', '11-08-2025', '11:14:21am', NULL),
(24, 'Sk mobile ', 'Shjkd', '5', 'Gsidb d', 'Buds ', '20', '20', '20', '206001', '206001', 'Kach ka saman ', '7054648499', '7069464994', 'Placed', '2', '3', 'session_0bLXrZ9Gtsxn58ygJZQ_WPq5iELCMK1_y5rt4WQbLFw04KEpM80xiSr8wTlHUjgUvxMrrO3oU3PRVfZgezzgMFGLYYhxgntGQD9IXIZ7QR7c3oIcaQ0ptM9UljKaxQpaymentpayment', 'pending', '', '18', '01-09-2025', '03:27:06pm', NULL),
(25, 'test', 'test', '10', 'Bhua Pathkauli, Sultanpur, Uttar Pradesh, Sultanpur, Uttar Pradesh', 'Ajhara, Pratapgarh, Uttar Pradesh, Pratapgarh, Uttar Pradesh', '120', '40', '30', '222303', '230132', 'tv', '4444444444', '5555555555', 'Delivered', '5', '1', 'session_XT8488BIMdQz9g5_xlLYN_8tSV-3nWVhl35UK3Lm2ZpVRKYCCOck1XvSRYs2xDVehvyiygDWtT4NvmMvbTNDIr7vQMfFCzS0-YhmGA3zO2NglIN62G16IbKK3VOFYwpaymentpayment', 'success', '{\"cforder_id\":\"order_103287563A7OuNCsZblpBZLggXgjVGuv2VW\",\"order_amount\":1152,\"referenceId\":\"2204824630\",\"txtStatus\":\"success\"}', '1152', '24-02-2026', '07:09:19pm', NULL),
(26, 'test', 'Saurabh Kumar', '10', 'Jagdishpur\r\nPooranpur, Sultanpur, Uttar Pradesh', 'Dhindhui, Pratapgarh, Uttar Pradesh, Pratapgarh, Uttar Pradesh', '120', '40', '30', '222180', '230138', 'tv', '4444444444', '1111111111', 'Delivered', '5', '1', 'session_7t9GNGq3yHL2eld_wCFz_bqa4B43JkkHAcqAxF4D_CzgtXdZboZkYfZFdHVQDUABP9sey3bth0vykd_ag1Lfd_ISjGUU_r5uZEyRHMjKk13S9g76pKte_UPboMflcwpaymentpayment', 'pending', '', '2304', '25-02-2026', '12:39:51pm', NULL),
(27, 'test', 'test', '4', 'Ahmadpur, Jaunpur, Uttar Pradesh, Jaunpur, Uttar Pradesh', 'Dhindhui, Pratapgarh, Uttar Pradesh, Pratapgarh, Uttar Pradesh', '90', '76', '23', '222180', '230138', 'tv', '1222222222', '1222222222', 'In Transit', '5', '3', 'BOK63EEFFF9', 'success', 'Paid from Wallet', '2518', '26-02-2026', '11:20:45am', NULL),
(28, 'Saurabh Kumar', 'Saurabh Kumar', '1', 'Jagdishpur\r\nPooranpur, Sultanpur, Uttar Pradesh', 'Jagdishpur\r\nPooranpur, Pratapgarh, Uttar Pradesh', '12', '11', '12', '222303', '230132', 'tv', '7996562556', '7797995656', 'Dispatched', '5', '3', 'BOKC8FA3AD6', 'success', 'Paid from Wallet', '40', '26-02-2026', '01:57:54pm', 'proof_28_1772101808.jpg'),
(29, 'Saurabh Kumar', 'Saurabh Kumar', '10', 'Jagdishpur\r\nPooranpur, Jaunpur, Uttar Pradesh', 'Jagdishpur\r\nPooranpur, Pratapgarh, Uttar Pradesh', '12', '100', '13', '222180', '230138', 'tv', '9745646543', '6565656556', 'Confirmed', '7', '3', 'BOKE312E956', 'success', 'Paid from Wallet', '800', '26-02-2026', '03:27:10pm', NULL),
(30, 'Saurabh Kumar', 'Saurabh Kumar', '2', 'Jagdishpur\r\nPooranpur, Jaunpur, Uttar Pradesh', 'Jagdishpur\r\nPooranpur, Pratapgarh, Uttar Pradesh', '12', '15', '10', '222180', '230138', 'tv', '7454654654', '6546594654', 'Placed', '5', '3', 'BOK4AE3FCFF', 'success', 'Paid from Wallet', '160', '27-02-2026', '02:13:30pm', NULL),
(31, 'Saurabh Kumar', 'Saurabh Kumar', '2', 'Jagdishpur\r\nPooranpur, Sultanpur, Uttar Pradesh', 'Jagdishpur\r\nPooranpur, Pratapgarh, Uttar Pradesh', '30', '20', '20', '222303', '230132', 'tb', '7546564654', '7974354546', 'Out for Delivery', '5', '3', 'BOKBEEF8977', 'success', 'Paid from Wallet', '96', '27-02-2026', '02:16:10pm', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_inquiry`
--

CREATE TABLE `contact_inquiry` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_inquiry`
--

INSERT INTO `contact_inquiry` (`id`, `name`, `email`, `mobile`, `subject`, `message`, `created_at`) VALUES
(3, 'Saurabh Kumar', 'saurabhkumarssp@gmail.com', '9154654646', 'hii', 'done', '2026-02-27 09:07:18');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_boy`
--

CREATE TABLE `delivery_boy` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `aadharno` varchar(100) NOT NULL,
  `status` enum('true','false') NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_boy`
--

INSERT INTO `delivery_boy` (`id`, `name`, `mobile`, `password`, `email`, `address`, `aadharno`, `status`, `date`, `time`) VALUES
(1, 'R', '7764545343', '12345', 'r1@gmail.com', 'Kapoorthala , Aliganj , Lucknow', '12345678910', 'true', '08-06-2024', '04:41:44pm'),
(3, 'Neeraj ', '9045593816', 'Neeraj@123', 'neeraj.123@gmail.com', 'etawah', '123456789000', 'true', '27-02-2026', '01:47:03pm');

-- --------------------------------------------------------

--
-- Table structure for table `disputes`
--

CREATE TABLE `disputes` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `dispute_type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `evidence` text DEFAULT NULL,
  `status` enum('Pending','Resolved') NOT NULL DEFAULT 'Pending',
  `admin_remark` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `disputes`
--

INSERT INTO `disputes` (`id`, `user_id`, `booking_id`, `dispute_type`, `description`, `evidence`, `status`, `admin_remark`, `created_at`) VALUES
(1, 5, 31, 'Damage', 'product damage hai', '[\"dispute_1772189502_0.jpeg\"]', 'Resolved', 'hi', '2026-02-27 10:51:42'),
(2, 5, 31, 'Wrong Item', 'hii', '[\"dispute_1773294838_0.jpg\"]', 'Resolved', 'hi', '2026-03-12 05:53:58');

-- --------------------------------------------------------

--
-- Table structure for table `logindetails`
--

CREATE TABLE `logindetails` (
  `id` int(10) NOT NULL,
  `LoginID` varchar(100) NOT NULL,
  `IP` varchar(100) NOT NULL,
  `MAC` varchar(100) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `BrowserName` varchar(100) NOT NULL,
  `OSName` varchar(100) NOT NULL,
  `Date` varchar(100) NOT NULL,
  `Time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `logindetails`
--

INSERT INTO `logindetails` (`id`, `LoginID`, `IP`, `MAC`, `UserName`, `BrowserName`, `OSName`, `Date`, `Time`) VALUES
(1, '1', '::1', '68-F7-28-09-D7-8B', 'HimanshuKashyap', 'Chrome', 'Windows 10', '08-06-2024', '04:40:58pm'),
(2, '1', '::1', '68-F7-28-09-D7-8B', 'HimanshuKashyap', 'Chrome', 'Windows 10', '08-06-2024', '07:05:15pm'),
(3, '1', '::1', '68-F7-28-09-D7-8B', 'HimanshuKashyap', 'Chrome', 'Windows 10', '14-06-2024', '03:35:26pm'),
(4, '1', '::1', '68-F7-28-09-D7-8B', 'HimanshuKashyap', 'Chrome', 'Windows 10', '14-06-2024', '03:45:08pm'),
(5, '1', '106.215.100.202', '', 'abts-north-dynamic-202.100.215.106.airtelbroadband.in', 'Firefox', 'Mac OS X', '02-07-2024', '04:47:37pm'),
(6, '1', '122.161.72.53', '', 'abts-north-dynamic-053.72.161.122.airtelbroadband.in', 'Chrome', 'Windows 10', '05-07-2024', '01:00:35pm'),
(7, '1', '223.188.235.183', '', '223.188.235.183', 'Chrome', 'Windows 10', '05-07-2024', '06:48:23pm'),
(8, '1', '106.213.78.218', '', '106.213.78.218', 'Chrome', 'Windows 10', '19-07-2024', '01:45:07pm'),
(9, '1', '110.226.205.32', '', '110.226.205.32', 'Chrome', 'Windows 10', '19-07-2024', '04:36:34pm'),
(10, '1', '110.226.205.32', '', '110.226.205.32', 'Chrome', 'Windows 10', '19-07-2024', '04:39:07pm'),
(11, '1', '106.213.78.218', '', '106.213.78.218', 'Chrome', 'Windows 10', '19-07-2024', '04:46:14pm'),
(12, '1', '110.226.205.32', '', '110.226.205.32', 'Handheld Browser', 'Android', '19-07-2024', '04:48:59pm'),
(13, '1', '106.213.78.218', '', '106.213.78.218', 'Chrome', 'Windows 10', '19-07-2024', '05:09:15pm'),
(14, '1', '183.82.161.198', '', 'broadband.actcorp.in', 'Chrome', 'Windows 10', '23-07-2024', '02:06:22pm'),
(15, '1', '183.82.161.198', '', 'broadband.actcorp.in', 'Chrome', 'Windows 10', '23-07-2024', '06:11:38pm'),
(16, '1', '::1', '', 'HimanshuKashyap', 'Chrome', 'Windows 10', '07-11-2024', '11:06:15am'),
(17, '1', '::1', '', 'HimanshuKashyap', 'Chrome', 'Windows 10', '07-11-2024', '01:52:43pm'),
(18, '1', '::1', '', 'HimanshuKashyap', 'Chrome', 'Windows 10', '08-11-2024', '11:10:18am'),
(19, '1', '::1', '', 'HimanshuKashyap', 'Chrome', 'Windows 10', '08-11-2024', '06:37:18pm'),
(20, '1', '::1', '', 'HimanshuKashyap', 'Chrome', 'Windows 10', '09-11-2024', '10:28:28am'),
(21, '1', '183.82.161.124', '', 'broadband.actcorp.in', 'Chrome', 'Windows 10', '07-12-2024', '06:38:55pm'),
(22, '1', '106.221.230.125', '', '106.221.230.125', 'Handheld Browser', 'Android', '07-12-2024', '07:14:24pm'),
(23, '1', '45.118.156.43', '', '45.118.156.43', 'Chrome', 'Windows 10', '09-12-2024', '12:41:43pm'),
(24, '1', '45.118.156.43', '', '45.118.156.43', 'Chrome', 'Windows 10', '09-12-2024', '12:53:27pm'),
(25, '1', '117.98.21.52', '', '117.98.21.52', 'Handheld Browser', 'Android', '27-12-2024', '03:42:56pm'),
(26, '1', '117.98.21.52', '', '117.98.21.52', 'Chrome', 'Linux', '27-12-2024', '03:43:16pm'),
(27, '1', '117.98.21.52', '', '117.98.21.52', 'Handheld Browser', 'Android', '27-12-2024', '04:34:35pm'),
(28, '1', '117.98.21.52', '', '117.98.21.52', 'Chrome', 'Linux', '27-12-2024', '04:34:51pm'),
(29, '1', '152.58.117.199', '', '152.58.117.199', 'Chrome', 'Linux', '06-08-2025', '02:05:24pm'),
(30, '1', '183.82.162.122', '', 'broadband.actcorp.in', 'Chrome', 'Windows 10', '11-08-2025', '10:50:55am'),
(31, '1', '183.82.163.49', '', 'broadband.actcorp.in', 'Chrome', 'Windows 10', '18-08-2025', '03:11:11pm'),
(32, '1', '157.49.40.145', '', '157.49.40.145', 'Chrome', 'Linux', '25-08-2025', '03:15:47pm'),
(33, '1', '::1', '', 'Dell', 'Chrome', 'Windows 10', '22-01-2026', '01:16:26pm'),
(34, '1', '::1', '', 'Dell', 'Chrome', 'Windows 10', '24-02-2026', '01:43:29pm'),
(35, '1', '::1', '', 'Dell', 'Chrome', 'Windows 10', '24-02-2026', '04:27:41pm'),
(36, '1', '::1', '', 'Dell', 'Chrome', 'Windows 10', '25-02-2026', '10:43:57am'),
(37, '1', '::1', '', 'Dell', 'Chrome', 'Windows 10', '25-02-2026', '11:26:02am'),
(38, '1', '::1', '', 'Dell', 'Chrome', 'Windows 10', '25-02-2026', '12:09:30pm'),
(39, '1', '::1', '', 'Dell', 'Chrome', 'Windows 10', '26-02-2026', '11:22:28am'),
(40, '1', '::1', '', 'Dell', 'Chrome', 'Windows 10', '26-02-2026', '11:53:07am'),
(41, '1', '::1', '', 'Dell', 'Chrome', 'Windows 10', '26-02-2026', '02:39:19pm'),
(42, '1', '::1', '', 'Dell', 'Chrome', 'Windows 10', '26-02-2026', '02:40:11pm'),
(43, '1', '::1', '', 'Dell', 'Chrome', 'Windows 10', '26-02-2026', '03:28:20pm'),
(44, '1', '::1', '', 'Dell', 'Chrome', 'Windows 10', '26-02-2026', '04:06:38pm'),
(45, '1', '::1', '', 'Dell', 'Chrome', 'Windows 10', '27-02-2026', '11:03:58am'),
(46, '1', '::1', '', 'Dell', 'Chrome', 'Windows 10', '27-02-2026', '02:26:29pm'),
(47, '1', '::1', '', 'Dell', 'Chrome', 'Windows 10', '27-02-2026', '02:36:43pm'),
(48, '1', '::1', '', 'Dell', 'Chrome', 'Windows 10', '28-02-2026', '11:12:05am'),
(49, '1', '::1', '', 'Dell', 'Chrome', 'Windows 10', '12-03-2026', '11:24:59am');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` text DEFAULT NULL,
  `aadhar_number` varchar(20) DEFAULT NULL,
  `status` enum('true','false') NOT NULL DEFAULT 'true',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`id`, `name`, `email`, `password`, `mobile`, `address`, `aadhar_number`, `status`, `created_at`) VALUES
(1, 'Saurabh Kumar', 'saurabhkumarlba@gmail.com', '123456', '9632145666', 'Jagdishpur\r\nPooranpur', '446546546546', 'true', '2026-02-28 05:43:47');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id` int(11) UNSIGNED NOT NULL,
  `from_pin` varchar(10) NOT NULL,
  `to_pin` varchar(10) NOT NULL,
  `weight_slot_id` int(11) DEFAULT NULL,
  `price_per_kg` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` varchar(10) NOT NULL DEFAULT 'true',
  `date` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id`, `from_pin`, `to_pin`, `weight_slot_id`, `price_per_kg`, `status`, `date`, `time`) VALUES
(1, '230138', '222302', NULL, 10.00, 'true', '24-02-2026', '05:40:23pm'),
(2, '222180', '230138', NULL, 80.00, 'true', '24-02-2026', '05:45:27pm'),
(3, '222303', '230132', 3, 110.00, 'true', '27-02-2026', '05:51:38pm'),
(4, '223622', '123645', 1, 40.00, 'true', '27-02-2026', '05:45:07pm'),
(7, '656465', '123213', 1, 15.00, 'true', '27-02-2026', '06:22:14pm'),
(8, '656465', '123213', 3, 65.00, 'true', '27-02-2026', '06:22:14pm'),
(14, '126542', '212316', 1, 10.00, 'true', '27-02-2026', '06:52:15pm'),
(15, '126542', '212316', 3, 50.00, 'true', '27-02-2026', '06:52:15pm'),
(16, '126542', '212316', 4, 5.00, 'true', '27-02-2026', '06:52:15pm'),
(17, '126542', '212316', 5, 150.00, 'true', '27-02-2026', '06:52:15pm'),
(18, '126542', '212316', 6, 300.00, 'true', '27-02-2026', '06:52:15pm');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `otp` varchar(100) NOT NULL,
  `wallet` varchar(100) NOT NULL DEFAULT '0',
  `status` enum('true','false') NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `name`, `email`, `mobile`, `password`, `otp`, `wallet`, `status`, `date`, `time`) VALUES
(1, 'R1', 'r1@gmail.com', '9999999999', '12345', '1234', '600', 'true', '08-06-2024', '04:39:26pm'),
(2, 'Rj Shiva ', 'shoppingclubindia1@gmail.com', '7454905462', 'Shiva@123', '1234', '100', 'true', '05-07-2024', '01:07:35pm'),
(3, 'Hritik Nishad', 'iamhritiknishad@gmail.com', '9305189742', '12345', '1234', '0', 'true', '11-08-2025', '10:56:52am'),
(4, 'ritesh', 'ry164464@gmail.com', '9569486986', 'Ritesh', '1234', '0', 'true', '18-08-2025', '03:18:33pm'),
(5, 'Saurabh Kumar', 'saurabhkumarssp@gmail.com', '7705839870', '1258', '1234', '180', 'true', '21-01-2026', '03:27:00pm'),
(6, 'Saurab Kumar', 'saurabhkumarsp@gmail.com', '6397969692', '123456', '1234', '13', 'true', '24-02-2026', '12:22:42pm'),
(7, 'saurabh', 'saurabh@gmail.com', '6387918051', '123456', '1234', '1000', 'true', '26-02-2026', '03:16:26pm');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delivery_options`
--

CREATE TABLE `tbl_delivery_options` (
  `id` int(11) UNSIGNED NOT NULL,
  `standard_price` varchar(100) DEFAULT NULL,
  `express_price` varchar(100) DEFAULT NULL,
  `overnight_price` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_delivery_options`
--

INSERT INTO `tbl_delivery_options` (`id`, `standard_price`, `express_price`, `overnight_price`) VALUES
(1, '50', '150', '250');

-- --------------------------------------------------------

--
-- Table structure for table `track_order`
--

CREATE TABLE `track_order` (
  `id` int(10) NOT NULL,
  `booking_id` varchar(100) NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `msg` text NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `track_order`
--

INSERT INTO `track_order` (`id`, `booking_id`, `order_status`, `msg`, `date`, `time`) VALUES
(1, '1', 'Placed', 'Order Placed Successfully', '08-06-2024', '04:42:44pm'),
(2, '1', 'Confirmed', 'Order Confirmed Successfully', '08-06-2024', '04:43:23pm'),
(3, '1', 'Dispatched', 'Order Dispatched Successfully', '08-06-2024', '04:51:47pm'),
(4, '2', 'Placed', 'Order Placed Successfully', '08-06-2024', '05:02:46pm'),
(5, '1', 'In Transit', 'Order In Transit Successfully', '08-06-2024', '05:54:16pm'),
(6, '1', 'Out for Delivery', 'Order Out for Delivery Successfully', '08-06-2024', '05:57:36pm'),
(7, '1', 'Delivered', 'Order Delivered Successfully', '08-06-2024', '05:57:43pm'),
(8, '3', 'Placed', 'Order Placed Successfully', '05-07-2024', '01:11:22pm'),
(9, '4', 'Placed', 'Order Placed Successfully', '19-07-2024', '04:44:20pm'),
(10, '4', 'Confirmed', 'Order Confirmed Successfully', '19-07-2024', '04:45:01pm'),
(11, '4', 'Dispatched', 'Order Dispatched Successfully', '19-07-2024', '04:46:42pm'),
(12, '5', 'Placed', 'Order Placed Successfully', '19-07-2024', '05:12:34pm'),
(13, '5', 'Confirmed', 'Order Confirmed Successfully', '19-07-2024', '05:12:56pm'),
(14, '5', 'Dispatched', 'Order Dispatched Successfully', '19-07-2024', '05:13:21pm'),
(15, '5', 'In Transit', 'Order In Transit Successfully', '19-07-2024', '05:13:25pm'),
(16, '5', 'Out for Delivery', 'Order Out for Delivery Successfully', '19-07-2024', '05:16:20pm'),
(17, '5', 'Delivered', 'Order Delivered Successfully', '19-07-2024', '05:16:27pm'),
(18, '4', 'In Transit', 'Order In Transit Successfully', '19-07-2024', '05:33:12pm'),
(19, '4', 'Out for Delivery', 'Order Out for Delivery Successfully', '19-07-2024', '05:33:15pm'),
(20, '4', 'Delivered', 'Order Delivered Successfully', '19-07-2024', '05:33:20pm'),
(21, '6', 'Placed', 'Order Placed Successfully', '07-11-2024', '04:23:35pm'),
(22, '7', 'Placed', 'Order Placed Successfully', '07-11-2024', '04:26:20pm'),
(23, '8', 'Placed', 'Order Placed Successfully', '07-11-2024', '04:52:31pm'),
(24, '9', 'Placed', 'Order Placed Successfully', '07-11-2024', '04:57:49pm'),
(25, '10', 'Placed', 'Order Placed Successfully', '07-11-2024', '05:08:39pm'),
(26, '2', 'Confirmed', 'Order Confirmed Successfully', '07-12-2024', '10:11:51pm'),
(27, '2', 'Dispatched', 'Order Dispatched Successfully', '07-12-2024', '10:12:08pm'),
(28, '2', 'In Transit', 'Order In Transit Successfully', '07-12-2024', '10:12:17pm'),
(29, '2', 'Out for Delivery', 'Order Out for Delivery Successfully', '07-12-2024', '10:12:26pm'),
(30, '2', 'Delivered', 'Order Delivered Successfully', '07-12-2024', '10:12:53pm'),
(31, '11', 'Placed', 'Order Placed Successfully', '09-12-2024', '12:49:09pm'),
(32, '12', 'Placed', 'Order Placed Successfully', '09-12-2024', '12:49:32pm'),
(33, '13', 'Placed', 'Order Placed Successfully', '09-12-2024', '12:51:53pm'),
(34, '14', 'Placed', 'Order Placed Successfully', '09-12-2024', '01:06:07pm'),
(35, '15', 'Placed', 'Order Placed Successfully', '27-12-2024', '04:31:52pm'),
(36, '15', 'Confirmed', 'Order Confirmed Successfully', '27-12-2024', '04:41:38pm'),
(37, '15', 'Dispatched', 'Order Dispatched Successfully', '27-12-2024', '04:42:46pm'),
(38, '15', 'In Transit', 'Order In Transit Successfully', '27-12-2024', '04:43:32pm'),
(39, '15', 'Out for Delivery', 'Order Out for Delivery Successfully', '27-12-2024', '04:44:09pm'),
(40, '15', 'Delivered', 'Order Delivered Successfully', '27-12-2024', '04:45:01pm'),
(41, '16', 'Placed', 'Order Placed Successfully', '01-01-2025', '11:00:15pm'),
(42, '17', 'Placed', 'Order Placed Successfully', '20-04-2025', '10:08:49am'),
(43, '18', 'Placed', 'Order Placed Successfully', '06-08-2025', '01:16:27pm'),
(44, '18', 'Confirmed', 'Order Confirmed Successfully', '06-08-2025', '02:40:09pm'),
(45, '19', 'Placed', 'Order Placed Successfully', '06-08-2025', '02:44:26pm'),
(46, '20', 'Placed', 'Order Placed Successfully', '07-08-2025', '01:06:00am'),
(47, '21', 'Placed', 'Order Placed Successfully', '11-08-2025', '11:13:32am'),
(48, '22', 'Placed', 'Order Placed Successfully', '11-08-2025', '11:14:09am'),
(49, '23', 'Placed', 'Order Placed Successfully', '11-08-2025', '11:14:21am'),
(50, '24', 'Placed', 'Order Placed Successfully', '01-09-2025', '03:27:06pm'),
(51, '25', 'Placed', 'Order Placed Successfully', '24-02-2026', '07:09:19pm'),
(52, '19', 'Confirmed', 'Order Confirmed Successfully', '25-02-2026', '11:42:55am'),
(53, '19', 'Dispatched', 'Order Dispatched Successfully', '25-02-2026', '11:43:24am'),
(54, '19', 'In Transit', 'Order In Transit Successfully', '25-02-2026', '11:43:33am'),
(55, '19', 'Out for Delivery', 'Order Out for Delivery Successfully', '25-02-2026', '11:43:38am'),
(56, '19', 'Delivered', 'Order Delivered Successfully', '25-02-2026', '11:43:43am'),
(57, '16', 'Confirmed', 'Order Confirmed Successfully', '25-02-2026', '11:43:57am'),
(58, '16', 'Dispatched', 'Order Dispatched Successfully', '25-02-2026', '11:44:09am'),
(59, '16', 'In Transit', 'Order In Transit Successfully', '25-02-2026', '11:44:13am'),
(60, '16', 'Out for Delivery', 'Order Out for Delivery Successfully', '25-02-2026', '11:44:18am'),
(61, '16', 'Delivered', 'Order Delivered Successfully', '25-02-2026', '11:45:11am'),
(62, '13', 'Confirmed', 'Order Confirmed Successfully', '25-02-2026', '11:45:22am'),
(63, '13', 'Dispatched', 'Order Dispatched Successfully', '25-02-2026', '11:45:26am'),
(64, '13', 'In Transit', 'Order In Transit Successfully', '25-02-2026', '11:45:31am'),
(65, '13', 'Out for Delivery', 'Order Out for Delivery Successfully', '25-02-2026', '11:45:36am'),
(66, '13', 'Delivered', 'Order Delivered Successfully', '25-02-2026', '11:45:40am'),
(67, '25', 'Confirmed', 'Order Confirmed Successfully', '25-02-2026', '11:50:37am'),
(68, '25', 'Dispatched', 'Order Dispatched Successfully', '25-02-2026', '11:51:56am'),
(69, '25', 'In Transit', 'Order In Transit Successfully', '25-02-2026', '11:52:22am'),
(70, '25', 'Out for Delivery', 'Order Out for Delivery Successfully', '25-02-2026', '11:52:45am'),
(71, '25', 'Delivered', 'Order Delivered Successfully', '25-02-2026', '11:54:21am'),
(72, '26', 'Placed', 'Order Placed Successfully', '25-02-2026', '12:39:51pm'),
(73, '26', 'Confirmed', 'Order Confirmed Successfully', '25-02-2026', '04:37:45pm'),
(74, '26', 'Dispatched', 'Order Dispatched Successfully', '25-02-2026', '04:37:50pm'),
(75, '26', 'In Transit', 'Order In Transit Successfully', '25-02-2026', '04:37:55pm'),
(76, '26', 'Out for Delivery', 'Order Out for Delivery Successfully', '25-02-2026', '04:37:59pm'),
(77, '26', 'Delivered', 'Order Delivered Successfully', '25-02-2026', '04:38:05pm'),
(78, '27', 'Placed', 'Order Placed Successfully. Amount ₹2518 deducted from wallet.', '26-02-2026', '11:20:45am'),
(79, '18', 'Dispatched', 'Order Dispatched Successfully', '26-02-2026', '11:54:29am'),
(80, '18', 'In Transit', 'Order In Transit Successfully', '26-02-2026', '11:56:12am'),
(81, '27', 'Confirmed', 'Order status updated to: Confirmed', '26-02-2026', '12:05:07pm'),
(82, '27', 'Dispatched', 'Order status updated to: Dispatched', '26-02-2026', '12:05:34pm'),
(83, '18', 'Out for Delivery', 'Order status updated to: Out for Delivery', '26-02-2026', '12:14:28pm'),
(84, '18', 'Delivered', 'Order status updated to: Delivered', '26-02-2026', '12:14:56pm'),
(85, '27', 'In Transit', 'Order status updated to: In Transit', '26-02-2026', '12:15:15pm'),
(86, '27', 'Out for Delivery', 'Order status updated to: Out for Delivery', '26-02-2026', '12:15:26pm'),
(87, '27', 'Delivered', 'Order status updated to: Delivered', '26-02-2026', '12:15:42pm'),
(88, '28', 'Placed', 'Order Placed Successfully. Amount ₹40 deducted from wallet.', '26-02-2026', '01:57:54pm'),
(89, '29', 'Placed', 'Order Placed Successfully. Amount ₹800 deducted from wallet.', '26-02-2026', '03:27:10pm'),
(90, '29', 'Assigned', 'Shipment assigned to delivery boy: neeraj ', '26-02-2026', '03:31:17pm'),
(91, '29', 'Confirmed', 'Order status updated to: Confirmed', '26-02-2026', '03:34:26pm'),
(92, '29', 'Dispatched', 'Order status updated to: Dispatched', '26-02-2026', '03:34:46pm'),
(93, '29', 'In Transit', 'Order status updated to: In Transit', '26-02-2026', '03:35:00pm'),
(94, '29', 'Out for Delivery', 'Order status updated to: Out for Delivery', '26-02-2026', '03:35:15pm'),
(95, '29', 'Delivered', 'Order status updated to: Delivered', '26-02-2026', '03:35:31pm'),
(96, '28', 'Assigned', 'Shipment assigned to delivery boy: neeraj ', '26-02-2026', '03:59:00pm'),
(97, '28', 'Confirmed', 'Order status updated to: Confirmed', '26-02-2026', '03:59:16pm'),
(98, '28', 'Dispatched', 'Order status updated to: Dispatched', '26-02-2026', '03:59:21pm'),
(99, '28', 'In Transit', 'Order status updated to: In Transit', '26-02-2026', '03:59:25pm'),
(100, '28', 'Out for Delivery', 'Order status updated to: Out for Delivery', '26-02-2026', '03:59:29pm'),
(101, '28', 'Delivered', 'Order status updated to: Delivered', '26-02-2026', '04:00:08pm'),
(102, '9', 'Assigned', 'Shipment assigned to delivery boy: neeraj ', '27-02-2026', '11:24:26am'),
(103, '24', 'Assigned', 'Shipment assigned to delivery boy: neeraj ', '27-02-2026', '11:25:27am'),
(104, '23', 'Assigned', 'Shipment assigned to delivery boy: R', '27-02-2026', '12:09:58pm'),
(105, '23', 'Confirmed', 'Order status updated to: Confirmed', '27-02-2026', '12:11:42pm'),
(106, '23', 'Dispatched', 'Order status updated to: Dispatched', '27-02-2026', '12:18:59pm'),
(107, '23', 'In Transit', 'Order status updated to: In Transit', '27-02-2026', '12:19:04pm'),
(108, '23', 'Out for Delivery', 'Order status updated to: Out for Delivery', '27-02-2026', '12:19:19pm'),
(109, '30', 'Placed', 'Order Placed Successfully. Amount ₹160 deducted from wallet.', '27-02-2026', '02:13:30pm'),
(110, '31', 'Placed', 'Order Placed Successfully. Amount ₹96 deducted from wallet.', '27-02-2026', '02:16:10pm'),
(111, '31', 'Assigned', 'Shipment assigned to delivery boy: Neeraj ', '27-02-2026', '02:16:51pm'),
(112, '31', 'Confirmed', 'Order status updated to: Confirmed', '27-02-2026', '02:23:27pm'),
(113, '31', 'Dispatched', 'Order status updated to: Dispatched', '27-02-2026', '02:23:34pm'),
(114, '31', 'In Transit', 'Order status updated to: In Transit', '27-02-2026', '02:24:37pm'),
(115, '31', 'Out for Delivery', 'Order status updated to: Out for Delivery', '27-02-2026', '02:25:04pm'),
(116, '30', 'Assigned', 'Shipment assigned to delivery boy: Neeraj ', '27-02-2026', '02:26:56pm'),
(117, '31', 'Assigned', 'Assigned to delivery boy: Neeraj ', '28-02-2026', '11:42:24am'),
(118, '22', 'Assigned', 'Assigned to delivery boy: Neeraj ', '28-02-2026', '11:55:48am');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(10) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `txn_id` varchar(100) NOT NULL,
  `payment_utr` varchar(100) NOT NULL,
  `reciept` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `user_id`, `amount`, `status`, `txn_id`, `payment_utr`, `reciept`, `date`, `time`) VALUES
(1, '1', '100', 'Accept', 'SHIPPERRJ45206', 'REDBLACK', '20240723040948_822205.png', '23-07-2024', '04:09:48pm'),
(2, '1', '200', 'Reject', 'SHIPPERRJ90285', 'REDBLACK', 'Payment_reciept704518.jpg', '23-07-2024', '04:12:37pm'),
(3, '1', '200', 'Accept', 'SHIPPERRJ59215', 'REDBLACK', 'Payment_reciept139640.png', '23-07-2024', '06:04:23pm'),
(4, '1', '300', 'Accept', 'SHIPPERRJ82841', 'REDBLACK', 'Payment_reciept170882.jpg', '23-07-2024', '06:07:59pm'),
(5, '2', '100', 'Accept', 'SHIPPERRJ96608', 'UTR4686488168486', 'Payment_reciept286612.jpg', '25-08-2025', '03:14:32pm'),
(6, '5', '2000', 'Accept', 'WAL9BC20315', 'order_103287563AAeBVoyqLeOXL37NmERsS8eY3Y', 'CashfreeTopup', '25-02-2026', '10:44:20pm'),
(7, '5', '1000', 'Accept', 'WAL0CD124A1', 'order_103287563AAexTP1e8DMBhs9sZbM27ysUWa', 'CashfreeTopup', '25-02-2026', '10:50:44pm'),
(8, '5', '2518', 'Deduct', 'BOK63EEFFF9', 'Booking Payment', '', '26-02-2026', '11:20:45am'),
(9, '5', '40', 'Deduct', 'BOKC8FA3AD6', 'Booking Payment', '', '26-02-2026', '01:57:54pm'),
(10, '7', '2000', 'Accept', 'WAL74EE3B1F', 'order_103287563ACbbbozTbAPYbCcHkU9oTw7Py2', 'CashfreeTopup', '26-02-2026', '03:22:48pm'),
(11, '7', '800', 'Deduct', 'BOKE312E956', 'Booking Payment', '', '26-02-2026', '03:27:10pm'),
(12, '5', '160', 'Deduct', 'BOK4AE3FCFF', 'Booking Payment', '', '27-02-2026', '02:13:30pm'),
(13, '5', '96', 'Deduct', 'BOKBEEF8977', 'Booking Payment', '', '27-02-2026', '02:16:10pm');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_notifications`
--

CREATE TABLE `wallet_notifications` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` enum('Credit','Debit') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `reason` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `wallet_notifications`
--

INSERT INTO `wallet_notifications` (`id`, `user_id`, `type`, `amount`, `reason`, `created_at`) VALUES
(1, 7, 'Debit', 200.00, 'security reason', '2026-02-27 10:56:52'),
(2, 5, 'Debit', 6.00, 'security reason', '2026-02-27 10:58:41'),
(3, 6, 'Credit', 1.00, 'e', '2026-03-12 07:58:24');

-- --------------------------------------------------------

--
-- Table structure for table `weight_slots`
--

CREATE TABLE `weight_slots` (
  `id` int(11) UNSIGNED NOT NULL,
  `slot_name` varchar(255) NOT NULL,
  `min_weight` decimal(10,2) NOT NULL,
  `max_weight` decimal(10,2) NOT NULL,
  `status` varchar(10) DEFAULT 'true',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `weight_slots`
--

INSERT INTO `weight_slots` (`id`, `slot_name`, `min_weight`, `max_weight`, `status`, `created_at`) VALUES
(1, ' 1 kg to 5 kg', 1.00, 5.00, 'true', NULL),
(3, '500 g to 1 kg', 0.50, 1.00, 'true', NULL),
(4, '1 g to 500 g', 0.01, 0.50, 'true', NULL),
(5, '5 kg to 10 kg', 5.00, 10.00, 'true', NULL),
(6, '10 kg to 30 kg', 10.00, 30.00, 'true', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`AdminLoginID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_inquiry`
--
ALTER TABLE `contact_inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disputes`
--
ALTER TABLE `disputes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logindetails`
--
ALTER TABLE `logindetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_delivery_options`
--
ALTER TABLE `tbl_delivery_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `track_order`
--
ALTER TABLE `track_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_notifications`
--
ALTER TABLE `wallet_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weight_slots`
--
ALTER TABLE `weight_slots`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `AdminLoginID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `contact_inquiry`
--
ALTER TABLE `contact_inquiry`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `disputes`
--
ALTER TABLE `disputes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logindetails`
--
ALTER TABLE `logindetails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_delivery_options`
--
ALTER TABLE `tbl_delivery_options`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `track_order`
--
ALTER TABLE `track_order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wallet_notifications`
--
ALTER TABLE `wallet_notifications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `weight_slots`
--
ALTER TABLE `weight_slots`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
