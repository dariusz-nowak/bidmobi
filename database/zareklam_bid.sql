-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 21 Wrz 2022, 15:02
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `zareklam_bid`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_type` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `account_type`) VALUES
(1, 'admin@bidmobi.com', 'test123', 'Test', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_billings`
--

CREATE TABLE `user_billings` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `amount` float NOT NULL,
  `time_added` datetime NOT NULL DEFAULT current_timestamp(),
  `time_withdrawed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_keys`
--

CREATE TABLE `user_keys` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `digital_turbine_publisher_id` text NOT NULL,
  `digital_turbine_consumer_key` text NOT NULL,
  `digital_turbine_consumer_secret` text NOT NULL,
  `digital_turbine_reporting_api` text NOT NULL,
  `digital_turbine_client_secret` text NOT NULL,
  `time_added` datetime NOT NULL DEFAULT current_timestamp(),
  `time_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `user_keys`
--

INSERT INTO `user_keys` (`id`, `user_id`, `digital_turbine_publisher_id`, `digital_turbine_consumer_key`, `digital_turbine_consumer_secret`, `digital_turbine_reporting_api`, `digital_turbine_client_secret`, `time_added`, `time_updated`) VALUES
(1, 1, '215310', 'd9fa4c41-2afe-467f-a048-21d8260389fe', '43e65f06-dfc7-4285-8128-c93633b75422', '3b54b65866b0868f84d4e07993ec5c00', 'cTanxdaog_eOTciqZFV-3EA9Jhx8U3Z1zEc8D92x2AhiZBFZ7a-ymzMiIgJqNVTLTGJTIMJbeg-fJT_nI8AZB9T-y5xissReHxGhK-Eg4q14YioOaT7mOeChV2-uekBHbnF66zd_uGOINNHEO7a5nZd1BKSPOlx9yprUFlRIUhqzKGgUvYqldQh8pvZxQ9YwuSq1HBQ3KTE4qw_Dckxjlp_UMaS5vCrHfrafjBSac_nWdGDzWLFdyvk3SSNqkcN9veSLBImKisSHAUWiPWwLhostqh29C9qgcs_ceJm4ONA0YCz0Oofvc5XpGYDYpOZHa1AGsLOT9fJSUpHJKGTJmg', '2022-08-07 00:58:55', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_payments`
--

CREATE TABLE `user_payments` (
  `id` int(20) NOT NULL,
  `user_id` int(10) NOT NULL,
  `transaction_value` int(10) NOT NULL,
  `bank_transaction` int(20) NOT NULL,
  `bank_details` varchar(20) NOT NULL,
  `bank_account_number` int(20) NOT NULL,
  `data_addded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `user_payments`
--

INSERT INTO `user_payments` (`id`, `user_id`, `transaction_value`, `bank_transaction`, `bank_details`, `bank_account_number`, `data_addded`) VALUES
(3, 1, 4000, 0, 'Santander Bank', 12312312, '2022-09-15 14:18:02');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_payments_bank`
--

CREATE TABLE `user_payments_bank` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `payments_type` int(1) NOT NULL,
  `bank_number` varchar(30) NOT NULL,
  `bank_swift` varchar(20) NOT NULL,
  `bank_name` varchar(58) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `user_payments_bank`
--

INSERT INTO `user_payments_bank` (`id`, `user_id`, `payments_type`, `bank_number`, `bank_swift`, `bank_name`, `date_added`, `date_updated`) VALUES
(50, 1, 0, '123', '123', '123', '2022-09-15 14:49:22', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_session`
--

CREATE TABLE `user_session` (
  `user_id` int(10) NOT NULL,
  `ip` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `time_added` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=FIXED;

--
-- Zrzut danych tabeli `user_session`
--

INSERT INTO `user_session` (`user_id`, `ip`, `device`, `status`, `time_added`) VALUES
(1, '62.3.38.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', 1, 1659811288),
(1, '62.3.38.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', 1, 1659815760),
(1, '62.3.38.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', 1, 1659822029),
(1, '62.3.38.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', 1, 1659827333),
(1, '62.3.38.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', 1, 1659829162),
(1, '62.3.38.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', 1, 1659889258),
(1, '62.3.38.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', 0, 1659891559),
(1, '62.3.38.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', 1, 1659891560),
(1, '62.3.38.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', 1, 1659910537),
(1, '62.3.38.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36', 1, 1661122371),
(1, '62.3.38.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36', 1, 1661126825),
(1, '62.3.38.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36', 0, 1661126833),
(1, '62.3.38.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36', 1, 1661126860),
(1, '62.3.38.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36', 1, 1661164214),
(1, '62.3.38.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36', 1, 1661164257),
(1, '62.3.38.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36', 1, 1661420469),
(1, '62.3.38.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36', 1, 1661765981),
(1, '62.3.38.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36', 0, 1661767435),
(1, '62.3.38.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36', 1, 1661767439),
(1, '62.3.38.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36', 1, 1661771245),
(1, '89.238.15.79', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 OPR/89.0.4447.104', 1, 1661775477),
(1, '89.238.15.79', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 OPR/89.0.4447.104', 1, 1661777739),
(1, '89.238.15.79', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 OPR/89.0.4447.104', 1, 1661786872),
(1, '89.238.15.79', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 OPR/89.0.4447.104', 1, 1661787768),
(1, '89.238.15.79', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 OPR/89.0.4447.104', 1, 1661791408),
(1, '89.238.15.79', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 OPR/89.0.4447.104', 1, 1661793918),
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 OPR/89.0.4447.104', 1, 1662437292),
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.5112.102 Safari/537.36 OPR/90.0.4480.78', 0, 1662541321),
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.5112.102 Safari/537.36 OPR/90.0.4480.78', 1, 1662541422),
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.5112.102 Safari/537.36 OPR/90.0.4480.78', 0, 1662561670),
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.5112.102 Safari/537.36 OPR/90.0.4480.78', 1, 1662561689),
(1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:104.0) Gecko/20100101 Firefox/104.0', 1, 1663233829);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeksy dla tabeli `user_billings`
--
ALTER TABLE `user_billings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `user_keys`
--
ALTER TABLE `user_keys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `user_payments_bank`
--
ALTER TABLE `user_payments_bank`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `user_session`
--
ALTER TABLE `user_session`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ip` (`ip`),
  ADD KEY `device` (`device`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `user_billings`
--
ALTER TABLE `user_billings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `user_keys`
--
ALTER TABLE `user_keys`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `user_payments`
--
ALTER TABLE `user_payments`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `user_payments_bank`
--
ALTER TABLE `user_payments_bank`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
