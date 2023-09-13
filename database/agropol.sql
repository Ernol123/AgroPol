-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 13 Wrz 2023, 14:30
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `agropol`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cart`
--

CREATE TABLE `cart` (
  `product_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `price_per_kilomiter` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`id`, `name`, `price_per_kilomiter`) VALUES
(1, 'Traktory', 0.94),
(2, 'Kombajny', 0.97),
(3, 'Siewniki', 0.83),
(4, 'Opryskiwacze', 0.83),
(5, 'Pługi', 0.84),
(6, 'Kultywatory', 0.84),
(7, 'Przyczepy', 0.87),
(8, 'Kosiarki Rolnicze', 0.86),
(9, 'Prasy do siana', 0.87),
(10, 'Uprawa Ziemniaków', 0.9),
(11, 'Uprawa buraków', 0.9),
(12, 'Paszowozy', 0.91),
(13, 'Rozrzutniki', 0.89),
(14, 'Rozsiewacze', 0.89),
(15, 'Nawozy', 0.82),
(16, 'Rośliny', 0.82);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `engine`
--

CREATE TABLE `engine` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `engine_power` int(11) UNSIGNED NOT NULL,
  `displacement` int(11) UNSIGNED NOT NULL,
  `number_of_cylinders` int(6) UNSIGNED NOT NULL,
  `fuel_tank` int(6) UNSIGNED NOT NULL,
  `price_of_  specification` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `mark` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `model` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `from_country` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `price_netto` float UNSIGNED NOT NULL,
  `price_brutto` float UNSIGNED NOT NULL,
  `photo_1` longblob NOT NULL,
  `photo_2` longblob NOT NULL,
  `photo_3` longblob NOT NULL,
  `photo_4` longblob NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `specification`
--

CREATE TABLE `specification` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `car_seat_version` varchar(80) COLLATE utf8mb4_polish_ci NOT NULL,
  `lighting_version` varchar(80) COLLATE utf8mb4_polish_ci NOT NULL,
  `equipment_version` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `price_of_specification` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `zip_code` varchar(10) COLLATE utf8mb4_polish_ci NOT NULL,
  `city` varchar(60) COLLATE utf8mb4_polish_ci NOT NULL,
  `street` varchar(70) COLLATE utf8mb4_polish_ci NOT NULL,
  `house_number` int(11) UNSIGNED NOT NULL,
  `apartment_number` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cart`
--
ALTER TABLE `cart`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `engine`
--
ALTER TABLE `engine`
  ADD KEY `product_id` (`product_id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- Indeksy dla tabeli `specification`
--
ALTER TABLE `specification`
  ADD KEY `product_id` (`product_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `engine`
--
ALTER TABLE `engine`
  ADD CONSTRAINT `engine_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ograniczenia dla tabeli `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`);

--
-- Ograniczenia dla tabeli `specification`
--
ALTER TABLE `specification`
  ADD CONSTRAINT `specification_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
