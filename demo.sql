-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 28. 04 2020 kl. 17:43:46
-- Serverversion: 10.4.11-MariaDB
-- PHP-version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `bøder`
--

CREATE TABLE `bøder` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL DEFAULT 0,
  `bøde` int(11) NOT NULL,
  `navn` varchar(255) NOT NULL DEFAULT '',
  `beskrivelse` varchar(255) NOT NULL DEFAULT '',
  `kategori` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `bøder`
--

INSERT INTO `bøder` (`id`, `tid`, `bøde`, `navn`, `beskrivelse`, `kategori`) VALUES
(1, 20, 1000, 'Færden i et ikke funktionelt køretøj', 'Kører i et ikke-funktionelt køretøj, f.eks. ødelagte vinduer eller døre.', 'misdemeanor'),
(2, 0, 500, 'Kørsel uden hjelm', '', 'felony'),
(3, 0, 1000, 'Manglende overholdelse af lysregulering', 'Ikke at overholde regulrende skilte og signaler, Manglende overholdelse af lysregulering straf ligger hos politidiskretion, eller bøde på 1000 kr. (Klip i kørekortet)', 'felony'),
(4, 0, 1000, 'Ulovlig parkering', 'Du må ikke holde parkeret ved farvede kantsten', 'misdemeanor'),
(5, 0, 1000, 'Ulovlig modificering af køretøj (Horn, Neonlys, Ruder)', '', 'felony'),
(6, 0, 1000, 'Kørsel uden den nødvendige licens', 'Brug af køretøj uden den nødvendige licens. Straf ligger hos politidiskretion', 'misdemeanor'),
(7, 0, 1000, 'Upassende opførsel i køretøj (Støj/Røg mm.)', '', 'felony'),
(8, 15, 10000, 'Undgå anholdelse', 'Flygter fra en embedsmand for at undgå, at blive anholdt eller tilbageholdt. Straffes med fængsel op til 15 dage.', 'felony'),
(9, 10, 5000, 'Uansvarlig kørsel', 'Kører på en måde, der er uagtsom uden hensyn til grundlæggende trafikregler. Kørekørt vil blive fjernet og bøde ligger hos politidiskretion', 'felony'),
(10, 5, 5000, 'Kørsel der forvolder fysisk skade', 'Uforsvarligt kørsel der forbolder fysisk skade, kører uforsigtigt og ingen respekt for menneskeliv. Kørekort vil blive fjernet', 'felony'),
(11, 0, 1000, 'Upassende opførelse', '', 'felony'),
(12, 5, 5000, 'Følger ikke en embedsmands anvisninger', 'Følger ikke en embedsmands anvisninger, bevidst nægter at følge ordrer, signaler eller retninger af embedsmand straffes med 5 dage i fængsel', 'felony'),
(13, 0, 5000, 'Bære maskering', 'Den, der i forbindelse med møder, forsamlinger, optog eller lignende på offentligt sted færdes med ansigtet helt eller delvis tildækket med hætte, maske, bemaling eller lignende på en måde, der er egnet til at hindre identifikation, straffes med bøe eller', 'felony'),
(14, 5, 5000, 'Stalking', '', 'felony'),
(15, 10, 0, 'Brugstyveri (Frakendelse af kørekort)', 'Ulovligt tager et køretøj der tilhører en anden person, eller kører køretøjet uden ejermandens tilladelse, med intentioner om at permanent eller midlertidligt fratage ejeren af køretøjet. Straffes med fængselsstraf på 10 dage og for frataget kørekortet.', 'felony'),
(16, 5, 1000, 'Chikane', 'Intimidere eller presser en anden person aggressiv med uvelkomme ord, gerninger handlinger eller fagter gentagne gange (3 - 5 gange) straffes med op til 5 dage i fængsel', 'felony'),
(17, 5, 5000, 'Bestikkelse', 'Bestikkelse, der gives til en embedsmand eller anden magthaver eller kommende magthaver for at magthaveren skal særbehandles giveren eller personer eller virksomheder, som giveren har interesse i, eller som en tak for udførte tjenester. Straffes med fængs', 'felony'),
(18, 10, 5000, 'Ulovlig indtrængelse', '', 'felony'),
(19, 10, 10000, 'Udgive sig for at være embedsmand', 'Det er ulovligt at færde på privatejet grund, uden tilladelse. Du kan herefter blive straffes for §95. Straf/bøde ligger hos politidiskretion', 'misdemeanor'),
(20, 5, 2500, 'Trusler (Civil)', '', 'felony'),
(21, 10, 3000, 'Trusler (Embedsmand)', '', 'felony'),
(22, 5, 5000, 'Hærværk', '', 'felony'),
(23, 10, 5000, 'Indbrud', 'Går bevidst/opholder sig i en bygning med intention om at begå kriminalitet. Straffes med op til 10 dage.', 'felony'),
(24, 15, 7500, 'Overfald', 'Overfald eller forsøgt på at begå en voldelig skade mod en anden person. Kan medføre straf af fængsel på op til 10 dage.', 'felony'),
(25, 20, 10000, 'Overfald m. våben (Frakendelse af våbenlicens)', 'Overfald med et dødelig våben eller forsøg på at begå en voldelig skade mod en anden person med et dødelig våben. Straffes med op til 20 dage i fængsel', 'felony'),
(26, 5, 7500, 'Påvirket kørsel', 'Kører imens personen er påvirket af alkohol eller stoffer. Straffes med fængsel op til 10 dage og for fratages kørekortet', 'felony'),
(27, 30, 15000, 'Mord (Civil)', 'Dræber en anden person med intentioner om at dræbe med forsætlighed og overvejelse.', 'felony'),
(28, 35, 20000, 'Mord (Embedsmand)', 'Dræber en anden person med intentioner om at dræbe med forsætlighed og overvejelse.', 'felony'),
(29, 20, 15000, 'Kidnapning (Civil)', 'Kidnapper en anden person og holder dem imod deres egen vilje.', 'felony'),
(30, 25, 20000, 'Kidnapning (Embedsmand)', 'Kidnapper en dommer eller anden form for embedsmand og holder dem imod deres egen vilje.', 'felony'),
(31, 25, 10000, 'Butiksrøveri (Frakendelse af våbenlicens)', '', 'felony'),
(32, 35, 15000, 'Bankrøveri (Frakendelse af våbenlicens)', '', 'felony'),
(33, 35, 15000, 'Smykke røveri (Frakendelse af våbenlicens)', '', 'felony'),
(34, 0, 5000, 'Besiddelse af slagvåben', '', 'felony'),
(35, 15, 15000, 'Besiddelse af ulovlig skydevåben', '', 'felony'),
(36, 10, 10000, 'Besiddelse af tyvekoster', 'Besiddelse af stjålet ejendom f.eks. penge eller våben', 'felony'),
(37, 1, 500, 'Hash pr. 10', '', 'felony'),
(38, 1, 2000, 'Kokain pr. 10', '', 'felony'),
(39, 1, 1500, 'Amfatamin pr. 10', '', 'felony'),
(40, 1, 1000, 'Meth pr. 10', '', 'felony'),
(41, 1, 10000, 'Hvidvaskning pr. 10.000', '', 'felony'),
(42, 0, 1000, 'Ulovlig vognbane skift', '', 'felony'),
(43, 0, 1000, 'Fuld optrukket linje', '', 'felony'),
(44, 0, 1000, 'Ulovlig uvending', '', 'felony'),
(45, 0, 0, 'Fangeflugt', 'Bryder ind i et fængsel, med intentionerne om, at bryde en fange ud. Straffes med 30 dages fængsel.', 'felony'),
(46, 0, 0, 'Medvirken til flugt', 'Den der befrier en anholdt, såvel som den, der tilskynder eller hjælper en sådan person til at undvige eller holder den undvegne skjult. Straffes med fængsel op til 15 dage.', 'felony');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cprnr` varchar(255) NOT NULL,
  `charges` varchar(255) NOT NULL,
  `penalty` varchar(255) NOT NULL,
  `seized` varchar(255) NOT NULL,
  `incident` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `recognizing` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `permissions` text DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `permissions`, `role`) VALUES
(1, 'Administrator', '$2y$10$Qb6i7zDI3SSPsNU9rObomeDeFV6cwo7MWThESEBZl56LHuYXdY3tG', '2020-03-06 01:29:21', '\"[[`notes`,1],[`cop`,1],[`medic`,1],[`money`,1],[`IG-Admin`,1],[`editPlayer`,1],[`housing`,1],[`gangs`,1],[`vehicles`,1],[`logs`,1],[`steamView`,1],[`ban`,1],[`kick`,1],[`unban`,1],[`globalMessage`,1],[`restartServer`,1],[`stopServer`,1],[`superUser`,1]]\"', 'Admin'),
(3, 'Betjent', '$2y$10$rGfrT9j4B7oyZcQEqvOVk.Kqq5VmbfV2DPnJWtUbYap1RJ8o6rfMi', '2020-04-24 15:15:29', '\"[[`notes`,1],[`cop`,1],[`medic`,1],[`money`,1],[`IG-Admin`,1],[`editPlayer`,1],[`housing`,1],[`gangs`,1],[`vehicles`,1],[`logs`,1],[`steamView`,1],[`ban`,1],[`kick`,1],[`unban`,1],[`globalMessage`,1],[`restartServer`,1],[`stopServer`,1],[`superUser`,1]]\"', 'Betjent');

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `bøder`
--
ALTER TABLE `bøder`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `bøder`
--
ALTER TABLE `bøder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Tilføj AUTO_INCREMENT i tabel `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tilføj AUTO_INCREMENT i tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
