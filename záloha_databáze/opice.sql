-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Čtv 25. lis 2021, 22:15
-- Verze serveru: 10.4.21-MariaDB
-- Verze PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `opice`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `clanky`
--

CREATE TABLE `clanky` (
  `clanek_id` int(11) NOT NULL,
  `clanek_autor` int(11) NOT NULL,
  `clanek_nazev` varchar(120) NOT NULL,
  `clanek_obsah` varchar(150) NOT NULL,
  `clanek_vydany` bit(1) NOT NULL DEFAULT b'0',
  `clanek_schvaleny` bit(1) NOT NULL DEFAULT b'0',
  `clanek_stav` int(11) NOT NULL DEFAULT 1,
  `clanek_verze` int(11) NOT NULL DEFAULT 1,
  `clanek_vydani` int(11) DEFAULT NULL,
  `clanek_zpravaRedaktora` text NOT NULL DEFAULT 'Zatím bez posudku',
  `clanek_zpravaSefredaktora` text DEFAULT NULL,
  `clanek_zpravaRecenzenta` text NOT NULL DEFAULT 'Zatím bez posudku'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `clanky`
--

INSERT INTO `clanky` (`clanek_id`, `clanek_autor`, `clanek_nazev`, `clanek_obsah`, `clanek_vydany`, `clanek_schvaleny`, `clanek_stav`, `clanek_verze`, `clanek_vydani`, `clanek_zpravaRedaktora`, `clanek_zpravaSefredaktora`, `clanek_zpravaRecenzenta`) VALUES
(16, 13, 'Článek 1', 'Francouzská-revoluce-2.docx', b'0', b'0', 1, 1, NULL, 'Nedostatečné', '', 'Dostatečné'),
(17, 13, 'Článek 2', 'Francouzská-revoluce-2.docx', b'1', b'1', 5, 1, 1, 'Zatím bez posudku', NULL, 'Zatím bez posudku'),
(18, 13, 'Článek 3', 'Francouzská-revoluce-2.docx', b'0', b'1', 4, 1, NULL, 'V pořádku', 'V pořádku', 'V pořádku'),
(19, 16, 'Francouzská revoluce', 'Francouzská-revoluce-2.docx', b'0', b'0', 2, 2, NULL, 'Dostatečné', NULL, 'Zatím bez posudku'),
(20, 15, 'Šachy', 'cv5 (3).docx', b'1', b'1', 5, 1, 1, 'Dobré', '', 'Dobré'),
(21, 17, 'Release 1', 'predn6-2-2021 (1).docx', b'0', b'0', 2, 1, NULL, 'hh', '', 'dobré'),
(22, 24, 'Kybernetika v praxi', 'WT2 cv2.docx', b'0', b'1', 4, 1, NULL, 'Zatím bez posudku', 'Dobré', 'Zatím bez posudku'),
(23, 24, 'Člověk a informační technologie', 'posudek.pdf', b'0', b'0', 2, 1, NULL, 'Velmi dobré', NULL, 'Zatím bez posudku');

-- --------------------------------------------------------

--
-- Struktura tabulky `files`
--

CREATE TABLE `files` (
  `file_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(2, 'Administrátor'),
(3, 'Autor'),
(5, 'Člen redakční rady'),
(4, 'Recenzent'),
(6, 'Redaktor'),
(7, 'Šéfredaktor');

-- --------------------------------------------------------

--
-- Struktura tabulky `stavy`
--

CREATE TABLE `stavy` (
  `stav_id` int(11) NOT NULL,
  `stav_popis` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `stavy`
--

INSERT INTO `stavy` (`stav_id`, `stav_popis`) VALUES
(1, 'Poslán redaktorovi'),
(2, 'Poslán recenzentovi'),
(3, 'Vrácen autorovi'),
(4, 'Schválen'),
(5, 'Vydaný');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_sname` varchar(30) NOT NULL,
  `user_login` varchar(40) NOT NULL,
  `user_passwd` varchar(150) NOT NULL,
  `user_role` int(11) NOT NULL DEFAULT 3,
  `user_email` varchar(50) NOT NULL,
  `user_img` varchar(60) NOT NULL DEFAULT 'user.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_sname`, `user_login`, `user_passwd`, `user_role`, `user_email`, `user_img`) VALUES
(1, 'Administátor', 'Systému', 'admin', '7eaf9d7ab9e3fe91c079ef9c6a52702cf6d851ffad4a0d23bd0f7097428496ca', 2, 'admin@uzivatel.cz', 'admin.jpg'),
(3, 'Autor', 'Článků', 'autor', 'b7ab92005037306d519ed9c14ffbcdb484efe030d6df97eaadd28185156b40e1', 3, 'autor@uzivatel.cz', 'user.jpg'),
(4, 'Recenzent', 'Článků', 'recenzent', '0bba93201f3c9a1d4f8b9dba3b33f6cdc83bc9f06db6857466809a1430819fa4', 4, 'recenzent@uzivatel.cz', 'user.jpg'),
(5, 'Člen', 'Rady', 'clenrady', '636223496d497020e161a1f5649ff87be81c497a87197946ad71b0c994d57e99', 5, 'clenrady@uzivatel.cz', 'user.jpg'),
(6, 'Redaktor', 'Časopisu', 'redaktor', 'a6b7e82879f1ce16de446eb85d20379aad38a7a250ac7b4b88ac25097e096a00', 6, 'redaktor@uzivatel.cz', 'user.jpg'),
(7, 'Šéfredaktor', 'Časopisu', 'sefredaktor', '1fb82e8a12df6288b4415800aa2085210d8ce442f04951bab393547deb10c817', 7, 'sefredaktor@uzivatel.cz', 'user.jpg'),
(13, 'Daniel', 'Brož', 'broz', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 3, 'broz.daniel.123@gmail.com', 'user.jpg'),
(15, 'Lukáš', 'Hanek', 'hanek', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 3, 'hanek@uzivatel.cz', 'user.jpg'),
(16, 'Michael', 'Kočí', 'koci', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 6, 'koci@uzivatel.cz', 'user.jpg'),
(17, 'Petr', 'Novák', 'novak', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 3, 'novak@uzivatel.cz', 'user.jpg'),
(19, 'Tomáš', 'Milota', 'milota', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 2, 'milota@uzivatel.cz', 'user.jpg'),
(22, 'Karel', 'Lédl', 'ledl', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 7, 'ledl@uzivatel.cz', 'user.jpg'),
(23, 'Ondřej', 'Boček', 'bocek', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 4, 'bocek@uzivatel.cz', 'user.jpg'),
(24, 'Pavel', 'Novotný', 'novotny', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 3, 'novotny@uzivatel.cz', 'user.jpg');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `clanky`
--
ALTER TABLE `clanky`
  ADD PRIMARY KEY (`clanek_id`),
  ADD KEY `clanek_autor` (`clanek_autor`),
  ADD KEY `clanek_stav` (`clanek_stav`);

--
-- Indexy pro tabulku `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_name`);

--
-- Indexy pro tabulku `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexy pro tabulku `stavy`
--
ALTER TABLE `stavy`
  ADD PRIMARY KEY (`stav_id`);

--
-- Indexy pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_login` (`user_login`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `user_role` (`user_role`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `clanky`
--
ALTER TABLE `clanky`
  MODIFY `clanek_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pro tabulku `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `stavy`
--
ALTER TABLE `stavy`
  MODIFY `stav_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `clanky`
--
ALTER TABLE `clanky`
  ADD CONSTRAINT `clanky_ibfk_1` FOREIGN KEY (`clanek_autor`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clanky_ibfk_2` FOREIGN KEY (`clanek_stav`) REFERENCES `stavy` (`stav_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_role`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
