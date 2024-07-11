-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 11 Ιουλ 2024 στις 03:06:36
-- Έκδοση διακομιστή: 10.4.28-MariaDB
-- Έκδοση PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `ds_estate`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `listings`
--

CREATE TABLE `listings` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `area` varchar(100) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `rooms` int(11) NOT NULL,
  `price_per_night` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `listings`
--

INSERT INTO `listings` (`id`, `title`, `area`, `photo`, `rooms`, `price_per_night`, `created_at`) VALUES
(1, 'A Few Days in Athens', 'City Center', '../images/Athens1.png', 2, 85, '2024-06-22 03:55:54'),
(2, 'Cozy Apartment in Larissa', 'North Suburbs', '../images/Larissa2.png', 3, 150, '2024-06-22 04:07:19'),
(3, 'Great Apartment in Ioannina', 'Outskirts', 'https://www.apartments.com/blog/sites/default/files/styles/x_large_hq/public/image/2023-06/ParkLine-apartment-in-Miami-FL.jpg?itok=kQmw64UU', 3, 70, '2024-06-23 21:58:04'),
(4, 'The Perfect Flat in Thessaloniki ', 'Toumpa', 'https://mapartments.co.uk/uploads/transforms/b235c4646ab36ef9ae959de20fa459fc/11257/401_topRenders_b_7abbbb2796f27c91ef535646dc2c5299.webp', 4, 160, '2024-06-23 22:00:28'),
(5, 'Student Dorm Room in Chicago', 'Lakeview', 'https://media.newyorker.com/photos/590974c9ebe912338a3778c0/master/pass/Greenspan-MicroApartments.jpg', 1, 300, '2024-06-24 01:54:34'),
(15, 'Safe Apartment in New York', 'Bronx', '../images/NewYork3.png', 1, 450, '2024-06-24 03:12:35');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `first_name` varchar(100) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `listing_id`, `start_date`, `end_date`, `total_amount`, `created_at`, `first_name`, `surname`, `email`) VALUES
(25, 1, 1, '2024-07-18', '2024-07-20', 146.20, '2024-07-11 01:00:21', 'Alex', 'Nikas', 'alex@google.com');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `username`, `email`, `password`) VALUES
(1, 'Alex', 'Nikas', 'Alex123', 'alex@google.com', 'alex123'),
(2, 'Nikos', 'Alexis', 'Nikos123', 'nikos@google.com', 'nikos123'),
(3, 'nikh', 'nika', 'Nikh123', 'nikh123@google.com', 'nikh123'),
(4, 'Axilleas', 'Nikas', 'Axilleas123', 'axilleas@google.com', 'Axilleas1@'),
(5, 'Giorgos', 'Nikas', 'Giorgos123', 'giorgos@gmail.com', 'Giorgos1@#'),
(6, 'Giannis', 'Nikas', 'Giannis123', 'giannis@google.com', 'giannis123'),
(7, 'Eleni', 'Nika', 'Eleni123!@', 'eleni@google.com', 'Eleni1@#');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `listings`
--
ALTER TABLE `listings`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `listing_id` (`listing_id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `listings`
--
ALTER TABLE `listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT για πίνακα `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
