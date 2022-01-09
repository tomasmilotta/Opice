-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Ned 09. led 2022, 16:28
-- Verze serveru: 8.0.26
-- Verze PHP: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `brozlol1`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `clanky`
--

CREATE TABLE `clanky` (
  `clanek_id` int NOT NULL,
  `clanek_autor` int NOT NULL,
  `clanek_nazev` varchar(120) NOT NULL,
  `clanek_obsah` varchar(150) NOT NULL,
  `clanek_vydany` bit(1) NOT NULL DEFAULT b'0',
  `clanek_schvaleny` bit(1) NOT NULL DEFAULT b'0',
  `clanek_stav` int NOT NULL DEFAULT '1',
  `clanek_verze` int NOT NULL DEFAULT '1',
  `clanek_vydani` int DEFAULT NULL,
  `clanek_zpravaRedaktora` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Zatím bez posudku',
  `clanek_zpravaSefredaktora` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Zatím bez posudku',
  `clanek_zpravaRecenzenta` char(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Zatím bez posudku',
  `clanek_rok` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vypisuji data pro tabulku `clanky`
--

INSERT INTO `clanky` (`clanek_id`, `clanek_autor`, `clanek_nazev`, `clanek_obsah`, `clanek_vydany`, `clanek_schvaleny`, `clanek_stav`, `clanek_verze`, `clanek_vydani`, `clanek_zpravaRedaktora`, `clanek_zpravaSefredaktora`, `clanek_zpravaRecenzenta`, `clanek_rok`) VALUES
(16, 13, 'Článek 1', 'Francouzská-revoluce-2.docx', b'0', b'0', 2, 1, NULL, 'Zaslán ke kontrole', '', 'Dostatečné', NULL),
(17, 13, 'Článek 2', 'Francouzská-revoluce-2.docx', b'0', b'0', 3, 1, NULL, 'Zatím bez posudku', '', 'Zatím bez posudku', NULL),
(18, 13, 'Článek 3', 'Francouzská-revoluce-2.docx', b'0', b'0', 3, 1, NULL, 'V pořádku', 'V pořádku', 'V pořádku', NULL),
(19, 16, 'Francouzská revoluce', 'Francouzská-revoluce-2.docx', b'0', b'0', 2, 2, NULL, 'Dostatečné', NULL, 'Zatím bez posudku', NULL),
(20, 15, 'Šachy', 'cv5 (3).docx', b'0', b'0', 3, 1, NULL, 'Dobré', 'Velmi dobré', 'Dobré', NULL),
(21, 17, 'Release 1', 'predn6-2-2021 (1).docx', b'0', b'0', 2, 1, NULL, 'hh', '', 'dobré', NULL),
(22, 24, 'Kybernetika v praxi', 'WT2 cv2.docx', b'0', b'1', 4, 1, NULL, 'Zatím bez posudku', 'Dobré', 'Zatím bez posudku', NULL),
(23, 24, 'Člověk a informační technologie', 'posudek.pdf', b'0', b'0', 3, 1, NULL, 'Znovu a lépe', NULL, 'Zatím bez posudku', NULL),
(26, 29, 'Ekonomika v praxi', 'posudek.pdf', b'1', b'1', 5, 1, 2, 'Zatím bez posudku', 'Zatím bez posudku', 'Zatím bez posudku', 2021),
(27, 30, 'Revoluce', 'Francouzská-revoluce-2.docx', b'0', b'0', 3, 1, NULL, 'Nedostatečné', 'Zatím bez posudku', 'Zatím bez posudku', NULL),
(28, 30, 'Věda mezi námi', 'Francouzská-revoluce-2.docx', b'1', b'1', 5, 1, 3, 'test-oponentura', 'Zatím bez posudku', 'Zatím bez posudku', 2020),
(29, 30, 'Java a její využití', 'Francouzská-revoluce-2.docx', b'0', b'0', 2, 1, NULL, 'Za mě v pořádku', 'Zatím bez posudku', 'Zatím bez posudku', NULL),
(30, 31, 'Můj boj', 'meinkampf.pdf', b'1', b'1', 5, 1, 1, 'Certified hood classic', 'Nestárnoucí klasika', 'Mistrovské dílo', 2021),
(31, 30, 'Mein Kampf', 'meinkampf.pdf', b'1', b'1', 5, 1, 2, 'Velice v pořádku', 'Inspirující', 'Velmi dobré', 2021),
(32, 30, 'Java mezi námi', 'Definition of Done.docx', b'0', b'1', 4, 1, NULL, 'Dobré', 'Dobré', 'Dobré', NULL),
(33, 3, 'Test', 'symfony3-2021 (1).docx', b'0', b'0', 2, 1, NULL, 'pneumonoultramicroscopicsilicovolcanoconiosis', 'Zatím bez posudku', 'Zatím bez posudku', NULL),
(34, 32, 'asdasdasd', 'administratorska_dokumentace_opice.docx', b'1', b'1', 5, 1, 2, 'Zatím bez posudku', 'Zatím bez posudku', 'Zatím bez posudku', 2020),
(35, 13, 'Danko', 'Prehled_vzorcu.pdf', b'1', b'1', 5, 1, 1, 'Zatím bez posudku', 'Zatím bez posudku', 'Zatím bez posudku', 2022),
(36, 13, 'Technologie', 'RSP_opice_oponentura.docx', b'1', b'1', 5, 1, 3, 'Zatím bez posudku', 'Zatím bez posudku', 'Zatím bez posudku', 2021),
(37, 13, 'Sprint 1', 'Metodika tymove spol a tvorby tymu pro VS vzdel_1.pdf', b'1', b'1', 5, 1, 1, 'Zatím bez posudku', 'Zatím bez posudku', 'Zatím bez posudku', 2021),
(38, 13, 'Nekromancie', 'st_DSA.pdf', b'1', b'1', 5, 1, 4, 'Zatím bez posudku', 'Zatím bez posudku', 'Zatím bez posudku', 2021),
(39, 34, 'Nejlepší hudební počin 21. století', 'masked-wolf-astronaut-in-the-ocean.pdf', b'1', b'1', 5, 1, 1, 'Zatím bez posudku', 'Zatím bez posudku', 'Zatím bez posudku', 2020);

-- --------------------------------------------------------

--
-- Struktura tabulky `files`
--

CREATE TABLE `files` (
  `file_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `roles`
--

CREATE TABLE `roles` (
  `role_id` int NOT NULL,
  `role_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `stav_id` int NOT NULL,
  `stav_popis` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `user_id` int NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_sname` varchar(30) NOT NULL,
  `user_login` varchar(40) NOT NULL,
  `user_passwd` varchar(150) NOT NULL,
  `user_role` int NOT NULL DEFAULT '3',
  `user_email` varchar(50) NOT NULL,
  `user_img` varchar(60) NOT NULL DEFAULT 'user.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_sname`, `user_login`, `user_passwd`, `user_role`, `user_email`, `user_img`) VALUES
(1, 'Administátor', 'Systému', 'admin', '7eaf9d7ab9e3fe91c079ef9c6a52702cf6d851ffad4a0d23bd0f7097428496ca', 2, 'admin@broz.lol', 'admin.jpg'),
(3, 'Autor', 'Článků', 'autor', 'b7ab92005037306d519ed9c14ffbcdb484efe030d6df97eaadd28185156b40e1', 3, 'autor@uzivatel.cz', 'user.jpg'),
(4, 'Recenzent', 'Článků', 'recenzent', '0bba93201f3c9a1d4f8b9dba3b33f6cdc83bc9f06db6857466809a1430819fa4', 4, 'recenzent@uzivatel.cz', 'user.jpg'),
(5, 'Člen', 'Rady', 'clenrady', '636223496d497020e161a1f5649ff87be81c497a87197946ad71b0c994d57e99', 5, 'clenrady@uzivatel.cz', 'user.jpg'),
(6, 'Redaktor', 'Časopisu', 'redaktor', 'a6b7e82879f1ce16de446eb85d20379aad38a7a250ac7b4b88ac25097e096a00', 6, 'redaktor@uzivatel.cz', 'user.jpg'),
(7, 'Šéfredaktor', 'Časopisu', 'sefredaktor', '1fb82e8a12df6288b4415800aa2085210d8ce442f04951bab393547deb10c817', 7, 'sefredaktor@uzivatel.cz', 'user.jpg'),
(13, 'Daniel', 'Brož', 'broz', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 3, 'broz.daniel.123@gmail.com', 'user.jpg'),
(15, 'Lukáš', 'Hanek', 'hanek', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 6, 'hanek@uzivatel.cz', 'user.jpg'),
(16, 'Michael', 'Kočí', 'koci', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 6, 'koci@uzivatel.cz', 'user.jpg'),
(17, 'Petr', 'Novák', 'novak', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 3, 'novak@uzivatel.cz', 'user.jpg'),
(19, 'Tomáš', 'Milota', 'milota', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 2, 'milota@uzivatel.cz', 'user.jpg'),
(22, 'Karel', 'Lédl', 'ledl', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 7, 'ledl@uzivatel.cz', 'user.jpg'),
(23, 'Ondřej', 'Boček', 'bocek', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 4, 'bocek@uzivatel.cz', 'user.jpg'),
(24, 'Pavel', 'Novotný', 'novotny', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 3, 'novotny@uzivatel.cz', 'user.jpg'),
(28, 'Daniel', 'Brož', 'broz07', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 2, 'broz07@student.vspj.cz', 'user.jpg'),
(29, 'Chrudoš', 'Skočdopole', 'chruda', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 3, 'chruda@uzivatel.cz', 'user.jpg'),
(30, 'Lojza', 'Karamel', 'karamel', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 3, 'karamel@gmail.com', 'user.jpg'),
(31, 'Prokop', 'Včera Dveře', 'prokopek', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 3, 'testik@testik.cz', 'user.jpg'),
(32, 'test', 'test', 'test', '780fd6aed1df0cd52c6464daa8ebffafa78cbac62bcc43bc71063dcdeb51c8ee', 3, 'asdasd@seznam.cz', 'user.jpg'),
(34, 'Ondřej', 'Boček', 'dement01', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 3, 'ondrejbocik@seznam.cz', 'user.jpg');

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
  MODIFY `clanek_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pro tabulku `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `stavy`
--
ALTER TABLE `stavy`
  MODIFY `stav_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
