-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb9u2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 26 Octobre 2020 à 15:39
-- Version du serveur :  10.1.47-MariaDB-0+deb9u1
-- Version de PHP :  7.3.10-1+0~20191008.45+debian9~1.gbp365209

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dblogin4163`
--
CREATE DATABASE IF NOT EXISTS `dblogin4163` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dblogin4163`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `idProfil` int(11) NOT NULL,
  `titre` varchar(256) NOT NULL,
  `contenu` text NOT NULL,
  `dateCreation` date NOT NULL,
  `dateModif` date DEFAULT NULL,
  `nbVues` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `idProfil`, `titre`, `contenu`, `dateCreation`, `dateModif`, `nbVues`) VALUES
(3, 7, 'Bruh', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2020-05-27', NULL, 6),
(6, 8, 'Lorem ipsum', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2020-06-03', NULL, 4),
(7, 7, 'Test d\'article', 'Ceci est un test', '2020-10-26', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `article_tag`
--

CREATE TABLE `article_tag` (
  `idArticle` int(11) NOT NULL,
  `idTag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE `profil` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `idRole` int(11) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `dateInscription` date NOT NULL,
  `hideEmail` tinyint(1) NOT NULL DEFAULT '1',
  `nbArticles` int(20) DEFAULT NULL,
  `nbReplies` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `profil`
--

INSERT INTO `profil` (`id`, `pseudo`, `email`, `mdp`, `idRole`, `photo`, `dateInscription`, `hideEmail`, `nbArticles`, `nbReplies`) VALUES
(7, 'DemocraticGibbon', 'robettetom@gmail.com', '$2y$10$.NQjkHHJt6bUY8pBU7qVSekKjehX/QRby4xSfwHp3gho0HDNwYwXa', 1, 'surf.gif', '2020-05-01', 0, 1, NULL),
(8, 'Jean-Kevin', 'steve@outlook.com', '$2y$10$dE2c08teqFyz9xEBjSJEMOAaibBbZQxL/uRMtXGXHMXXTeEY4CBKu', 3, 'monkeythief.gif', '2020-05-21', 1, 1, NULL),
(9, 'Jean-Kevin', 'steve@outlook.com', '$2y$10$Ug2sXHVwe9l9TiYZksQjBOPwh877PfE0RmRws9AuokWHnZrWVb/K.', 3, 'meuh.gif', '2020-05-21', 1, NULL, NULL),
(10, 'BobbyBruh', 'bobbybruh@gmail.com', '$2y$10$hH0r5YFUfztAYuRoGwdX6u3nZ6iruTCH8eF399iHuchVNV8DPri1q', 3, NULL, '2020-05-21', 1, NULL, NULL),
(13, 'Robert', 'pepito@gmail.com', '$2y$10$eApOKavR4o66SbodAITL4OovzxrgQmClPMG1TTt8YZEtW10iDM.j6', 3, 'grumpy_grass.jpeg', '2020-06-17', 1, NULL, NULL),
(16, 'Ahenheimr', 'ah@ah.com', '', 3, NULL, '2020-07-01', 1, NULL, NULL),
(17, 'Jacky', 'matheo.robette@laposte.net', '$2y$10$Rjr5LgfVRsiQuDBFy7qBEu8TBEcTNvXG7oNdzgv8QXC8a/sAwuu4y', 3, NULL, '2020-09-27', 1, NULL, 1),
(20, 'Test2', 'test@test.com', '$2y$10$6CzpMGNK3sWcZAKYNN4AUekteNu.vnFdXd68kxup66cWWTxk7V86q', 3, 'MasD1Kw.jpg', '2020-09-27', 1, NULL, 2),
(21, 'TestTest', 'testtesttest@test.com', '$2y$10$PWZpQW9bkjknQMZpmdKc4OjyTUEAyY3Ftf2AYPYrHZBa9gtQ97HQa', 3, 'MasD1Kw.jpg', '2020-09-27', 1, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id` int(11) NOT NULL,
  `idProfil` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `dateCreation` date NOT NULL,
  `dateModif` date DEFAULT NULL,
  `idArticle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `reponse`
--

INSERT INTO `reponse` (`id`, `idProfil`, `contenu`, `dateCreation`, `dateModif`, `idArticle`) VALUES
(1, 7, 'Ceci est un message de réponse', '2020-05-27', NULL, 3),
(2, 9, 'Ceci est un autre message', '2020-05-27', NULL, 3),
(3, 7, 'Réponse ajoutée grâce au nouveau système', '2020-05-27', NULL, 3),
(4, 7, 'Réponse ajoutée grâce au nouveau système', '2020-05-27', NULL, 3),
(5, 10, 'Il fallait mettre une réponse ? Surprenant. Au moins c\'est fait.', '2020-05-27', NULL, 3),
(6, 17, 'Il est vrai mon cher', '2020-09-27', NULL, 3),
(7, 20, 'Test', '2020-09-27', NULL, 3),
(9, 21, 'Test', '2020-09-27', NULL, 6);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id`, `libelle`) VALUES
(1, 'Admin'),
(2, 'Client'),
(3, 'Bleu'),
(4, 'Utilisateur'),
(5, 'Connaisseur'),
(6, 'Modérateur');

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `idTag` int(11) NOT NULL,
  `libelle` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUtilisateur` (`idProfil`);

--
-- Index pour la table `article_tag`
--
ALTER TABLE `article_tag`
  ADD PRIMARY KEY (`idArticle`,`idTag`),
  ADD KEY `idArticle` (`idArticle`),
  ADD KEY `idProfil` (`idTag`);

--
-- Index pour la table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idRole` (`idRole`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUtilisateur` (`idProfil`),
  ADD KEY `idArticle` (`idArticle`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`idTag`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `idTag` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`idProfil`) REFERENCES `profil` (`id`);

--
-- Contraintes pour la table `article_tag`
--
ALTER TABLE `article_tag`
  ADD CONSTRAINT `article_tag_ibfk_1` FOREIGN KEY (`idArticle`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `article_tag_ibfk_2` FOREIGN KEY (`idTag`) REFERENCES `tag` (`idTag`);

--
-- Contraintes pour la table `profil`
--
ALTER TABLE `profil`
  ADD CONSTRAINT `profil_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `role` (`id`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`idArticle`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `reponse_ibfk_2` FOREIGN KEY (`idProfil`) REFERENCES `profil` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
