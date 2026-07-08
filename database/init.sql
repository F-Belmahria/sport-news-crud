-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 08, 2026 at 06:57 AM
-- Server version: 5.7.24
-- PHP Version: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sport_news_crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `auteur` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_publication` date NOT NULL,
  `match_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `contenu`, `auteur`, `image`, `date_publication`, `match_id`) VALUES
(1, 'Le PSG triomphe à domicile !', 'Le Paris Saint-Germain a réalisé une belle performance à domicile face à Marseille. Grâce à une attaque efficace et une bonne organisation, le PSG s’impose sur le score de 4-2 dans un match intense.', 'Faten', 'psg.png', '2025-10-12', 1),
(2, 'Monaco et Lyon se neutralisent', ' Monaco et Lyon ont offert un match intense avec plusieurs occasions de chaque côté. Les deux équipes se quittent sur un score nul de 2-2 après une rencontre très disputée.', 'Faten', 'monaco.png', '2024-10-21', 2),
(3, ' Le Real Madrid domine le Clasico', ' Le Real Madrid a réalisé une grande performance face au FC Barcelone. Grâce à une attaque efficace, Madrid remporte le match sur le score de 3-1.\r\n', 'Faten', 'real.png', '2025-04-12', 3),
(4, 'Les Lakers s’imposent face aux Bulls', 'Les Los Angeles Lakers ont remporté une victoire importante face aux Chicago Bulls. Après un match serré, l’équipe californienne a réussi à faire la différence dans les dernières minutes grâce à une défense solide et une attaque efficace.', 'Faten', 'lakers.png', '2025-05-08', 4),
(5, 'Test article', 'Ceci est un article de test.', 'Faten', 'test.png', '2026-07-04', 4);

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` int(11) NOT NULL,
  `equipe1` varchar(100) NOT NULL,
  `equipe2` varchar(100) NOT NULL,
  `score` varchar(20) NOT NULL,
  `lieu` varchar(100) NOT NULL,
  `date_match` date NOT NULL,
  `resume` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `equipe1`, `equipe2`, `score`, `lieu`, `date_match`, `resume`) VALUES
(1, 'PSG', 'Marseille', '4-2', 'Paris', '2025-10-03', 'Victoire du PSG à domicile après un match intense.'),
(2, 'Monaco', 'Lyon', ' 2-2', 'Monaco', '2024-10-21', 'Match nul très disputé entre Monaco et Lyon avec plusieurs occasions des deux côtés.'),
(3, 'Real Madrid', 'Barcelone', ' 3-1', 'Madrid', '2025-04-12', 'Le Real Madrid s’impose dans un grand classique du football espagnol.'),
(4, 'Los Angeles Lakers', 'Chicago Bulls', '0-1', ' Los Angeles', '2025-05-08', ' Les Lakers remportent un match intense face aux Bulls après une fin de rencontre très disputée.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `match_id` (`match_id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_articles_matches` FOREIGN KEY (`match_id`) REFERENCES `matches` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
