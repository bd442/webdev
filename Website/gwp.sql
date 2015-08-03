-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 26, 2014 at 04:29 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gwp`
--

-- --------------------------------------------------------

--
-- Table structure for table `gwp_LoginAttempts`
--

CREATE TABLE IF NOT EXISTS `gwp_LoginAttempts` (
  `id_attempts` int(11) NOT NULL AUTO_INCREMENT,
  `IP` varchar(20) NOT NULL,
  `Attempts` int(11) NOT NULL,
  `LastLogin` datetime NOT NULL,
  PRIMARY KEY (`id_attempts`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `gwp_LoginAttempts`
--

INSERT INTO `gwp_LoginAttempts` (`id_attempts`, `IP`, `Attempts`, `LastLogin`) VALUES
(1, '127.0.0.1', 0, '2014-09-08 18:02:57');

-- --------------------------------------------------------

--
-- Table structure for table `gwp_medway_campus_chp_data`
--

CREATE TABLE IF NOT EXISTS `gwp_medway_campus_chp_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Time_Stamp` datetime NOT NULL,
  `Engine_RPM` int(11) DEFAULT NULL,
  `Engine_Power_kWe` float DEFAULT NULL,
  `Oil_Pressure` float DEFAULT NULL,
  `Oil_Temperature` int(11) DEFAULT NULL,
  `Primary_Coolant_Temperature` int(11) DEFAULT NULL,
  `Primary_Coolant_Pressure` float DEFAULT NULL,
  `Water_Temperature_Pre_After_Cooler` float DEFAULT NULL,
  `Water_Temperature_Post_After_Cooler` float DEFAULT NULL,
  `Inlet_Air_Temperature_Pre_Turbocharger_Left` float DEFAULT NULL,
  `Inlet_Air_Temperature_Pre_Turbocharger_Right` float DEFAULT NULL,
  `Inlet_Air_Temperature_Pre_After_Cooler_Left` float DEFAULT NULL,
  `Inlet_Air_Temperature_Pre_After_Cooler_Right` float DEFAULT NULL,
  `Inlet_Air_Temperature_Post_After_Cooler_Left` float DEFAULT NULL,
  `Inlet_Air_Temperature_Post_After_Cooler_Right` float DEFAULT NULL,
  `Inlet_Air_Manifold_Pressure_Left` float DEFAULT NULL,
  `Inlet_Air_Manifold_Pressure_Right` float DEFAULT NULL,
  `Exhaust_Temperature_Pre_Turbo_Left` int(11) DEFAULT NULL,
  `Exhaust_Temperature_Pre_Turbo_Right` int(11) DEFAULT NULL,
  `Exhaust_Temperature_Post_Turbo_Left` int(11) DEFAULT NULL,
  `Exhaust_Temperature_Post_Turbo_Right` int(11) DEFAULT NULL,
  `Exhaust_Temperature_Post_Heat_Exchanger` float DEFAULT NULL,
  `Exhaust_Back_Pressure` float DEFAULT NULL,
  `Pre_SCR_Temperature` int(11) DEFAULT NULL,
  `Fuel_Pressure_Pre_Filter` float DEFAULT NULL,
  `Fuel_Pressure_Post_Filter` float DEFAULT NULL,
  `Fuel_Temperature_Pre_Fuel_Heater` int(11) DEFAULT NULL,
  `Fuel_Temperature_Post_Fuel_Heater` int(11) DEFAULT NULL,
  `Fuel_Tank_Temperature` int(11) DEFAULT NULL,
  `Main_Fuel_Tank_Level` int(11) DEFAULT NULL,
  `Start_Fuel_Tank_Level` int(11) DEFAULT NULL,
  `Total_kWh` int(11) DEFAULT NULL,
  `Tariff_1_kWh` int(11) DEFAULT NULL,
  `Tariff_2_kWh` int(11) DEFAULT NULL,
  `Tariff_3_kWh` int(11) DEFAULT NULL,
  `Mains_Voltage_L1` int(11) DEFAULT NULL,
  `Mains_Voltage_L2` int(11) DEFAULT NULL,
  `Mains_Voltage_L3` int(11) DEFAULT NULL,
  `Mains_Frequency` float DEFAULT NULL,
  `Generator_Voltage_L1` int(11) DEFAULT NULL,
  `Generator_Voltage_L2` int(11) DEFAULT NULL,
  `Generator_Voltage_L3` int(11) DEFAULT NULL,
  `Generator_Frequency` float DEFAULT NULL,
  `Generator_Amperage_L1` int(11) DEFAULT NULL,
  `Generator_Amperage_L2` int(11) DEFAULT NULL,
  `Generator_Amperage_L3` int(11) DEFAULT NULL,
  `Power_Factor_L1` float DEFAULT NULL,
  `Power_Factor_L2` float DEFAULT NULL,
  `Power_Factor_L3` float DEFAULT NULL,
  `Secondary_Coolant_Pressure` float DEFAULT NULL,
  `Secondary_Coolant_Post_Site_Heat_Exchanger_Temperature` float DEFAULT NULL,
  `Secondary_Coolant_Pre_Exhaust_Gas_Heat_Exchanger_Temperature` float DEFAULT NULL,
  `Secondary_Coolant_Post_Exhaust_Gas_Heat_Exchanger_Temperature` float DEFAULT NULL,
  `Kamstrup_kW` int(11) DEFAULT NULL,
  `Site_Flow_Temperature` float DEFAULT NULL,
  `Site_Return_Temperature` float DEFAULT NULL,
  `Site_Flow_Rate` int(11) DEFAULT NULL,
  `Acoustic_Chamber_N1_Temperature_Enclosure_1` int(11) DEFAULT NULL,
  `Acoustic_Chamber_N2_Temperature_Enclosure_1` int(11) DEFAULT NULL,
  `Acoustic_Chamber_Temperature_Enclosure_2` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gwp_users`
--

CREATE TABLE IF NOT EXISTS `gwp_users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone_number` varchar(16) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `accountactive` varchar(32) DEFAULT NULL,
  `adminrights` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `gwp_users`
--

INSERT INTO `gwp_users` (`id_user`, `name`, `email`, `phone_number`, `username`, `password`, `accountactive`, `adminrights`) VALUES
(1, 'Wim Melis', 'Wim.J.C.Melis@gre.ac.uk', '+441634883154', 'wimmelis', '$2y$10$DQyucFb9n.LLBtDb60hYzepeRvX7WX1CGPo4mlEAHWSfZrWizjFNq', 'y', 'y'),
(6, 'Wim Test', 'mw17@gre.ac.uk', '', 'wim', '$2y$10$Pl6.Zj8CsUKr57lEYdbBMOKsUHhed8wy7cAij7O/Mso1wIAA4uQ/C', 'y', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
