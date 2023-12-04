-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 11 Gru 2022, 22:06
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `dane_kino`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bilet`
--

CREATE TABLE `bilet` (
  `id` int(11) NOT NULL,
  `cena` int(11) NOT NULL,
  `rodzaj` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `bilet`
--

INSERT INTO `bilet` (`id`, `cena`, `rodzaj`) VALUES
(1, 10, 'ulgowy'),
(2, 14, 'normalny');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `tytul` text NOT NULL,
  `gatunek` text NOT NULL,
  `czas_trwania` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `film`
--

INSERT INTO `film` (`id`, `tytul`, `gatunek`, `czas_trwania`) VALUES
(1, 'Bond', 'Akcja', '90'),
(2, 'Titanic', 'Dramat', '120'),
(3, 'Incepcja', 'Akcja', '90'),
(4, 'Bullet train', 'Akcja / Komedia', '130'),
(7, 'Pszczoły', 'Obyczajowy', '260'),
(8, 'Elektronik', 'Dramat', '5'),
(9, 'Dolce', 'Triller', '90'),
(10, 'Blyatman', 'Akcja', '86');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `login`
--

CREATE TABLE `login` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sala`
--

CREATE TABLE `sala` (
  `id` int(11) NOT NULL,
  `ilosc_rzedow` int(11) NOT NULL,
  `miejsca_w_rzedach` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `sala`
--

INSERT INTO `sala` (`id`, `ilosc_rzedow`, `miejsca_w_rzedach`) VALUES
(3, 8, 20),
(4, 1, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `seans`
--

CREATE TABLE `seans` (
  `id` int(11) NOT NULL,
  `id_sali` int(11) NOT NULL,
  `id_filmu` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `jezyk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `seans`
--

INSERT INTO `seans` (`id`, `id_sali`, `id_filmu`, `data`, `jezyk`) VALUES
(4, 4, 4, '2022-12-09 23:08:15', 'angielski'),
(10, 4, 3, '2022-12-01 23:08:44', 'polski'),
(52, 3, 4, '2022-12-30 16:55:32', 'polski'),
(54, 3, 3, '2022-12-31 21:47:10', 'francuski'),
(55, 4, 7, '2022-12-21 21:47:10', 'rosyjski'),
(58, 3, 9, '2022-12-24 00:57:00', 'marokański');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienie`
--

CREATE TABLE `zamowienie` (
  `id` int(11) NOT NULL,
  `id_seansu` int(11) NOT NULL,
  `imie` varchar(50) NOT NULL,
  `nazwisko` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `telefon` int(11) NOT NULL,
  `status` text NOT NULL,
  `bilet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `bilet`
--
ALTER TABLE `bilet`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `seans`
--
ALTER TABLE `seans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_filmu` (`id_filmu`),
  ADD KEY `id_sali` (`id_sali`);

--
-- Indeksy dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_seansu` (`id_seansu`),
  ADD KEY `bilet_id` (`bilet_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `bilet`
--
ALTER TABLE `bilet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `login`
--
ALTER TABLE `login`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `sala`
--
ALTER TABLE `sala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `seans`
--
ALTER TABLE `seans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `seans`
--
ALTER TABLE `seans`
  ADD CONSTRAINT `seans_ibfk_1` FOREIGN KEY (`id_filmu`) REFERENCES `film` (`id`),
  ADD CONSTRAINT `seans_ibfk_2` FOREIGN KEY (`id_sali`) REFERENCES `sala` (`id`);

--
-- Ograniczenia dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  ADD CONSTRAINT `zamowienie_ibfk_1` FOREIGN KEY (`id_seansu`) REFERENCES `seans` (`id`),
  ADD CONSTRAINT `zamowienie_ibfk_2` FOREIGN KEY (`bilet_id`) REFERENCES `bilet` (`id`);

DELIMITER $$
--
-- Zdarzenia
--
CREATE DEFINER=`root`@`localhost` EVENT `del_seans` ON SCHEDULE EVERY 1 DAY STARTS '2022-12-07 00:00:00' ENDS '2030-01-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM `seans` WHERE data < CURDATE()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
