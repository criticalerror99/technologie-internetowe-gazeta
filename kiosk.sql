-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 21 Maj 2022, 12:16
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Baza danych: `kiosk`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `artykuly`
--

CREATE TABLE `artykuly` (
  `id` int(11) NOT NULL,
  `naglowek` varchar(64) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `tekst` varchar(4096) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `img` varchar(256) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `artykuly`
--

INSERT INTO `artykuly` (`id`, `naglowek`, `tekst`, `img`) VALUES
(1, 'Testowy', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eget neque pellentesque, condimentum nisi nec, maximus turpis. Donec nulla mi, lobortis a consectetur vitae, tristique vitae erat. Morbi velit risus, commodo ut lorem vel, molestie facilisis metus. Suspendisse ac blandit diam, quis laoreet nunc. Nullam vulputate blandit est et elementum. Cras dictum dolor nunc. Donec vitae dolor vitae nulla venenatis imperdiet ac et nisl. Ut vel augue quam. Phasellus turpis ante, posuere ut felis nec, condimentum porta urna. In volutpat eros id euismod venenatis. Praesent in ullamcorper ex. Quisque pellentesque, tellus in tempus vestibulum, arcu mauris rutrum orci, ut facilisis tortor purus et mi. Maecenas malesuada lobortis eros, a varius tellus sodales eget. Donec tincidunt tristique turpis at ullamcorper. Integer at varius lectus.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/71/Calico_tabby_cat_-_Savannah.jpg/1200px-Calico_tabby_cat_-_Savannah.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ustawienia`
--

CREATE TABLE `ustawienia` (
  `nazwa_szkoly` varchar(128) COLLATE utf8mb4_polish_ci NOT NULL DEFAULT 'Nazwa szko³y',
  `kolor_glowny` varchar(7) COLLATE utf8mb4_polish_ci NOT NULL,
  `komunikat` varchar(512) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `ustawienia`
--

INSERT INTO `ustawienia` (`nazwa_szkoly`, `kolor_glowny`, `komunikat`) VALUES
('Akademia Handlowa Nauk Stosowanych w Radomiu', '', 'Testowa');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `artykuly`
--
ALTER TABLE `artykuly`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `ustawienia`
--
ALTER TABLE `ustawienia`
  ADD PRIMARY KEY (`nazwa_szkoly`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `artykuly`
--
ALTER TABLE `artykuly`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;