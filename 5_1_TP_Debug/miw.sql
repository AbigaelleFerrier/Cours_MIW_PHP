-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 24 Juin 2019 à 14:53
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `miw`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `image` varchar(255) NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `contenu`, `id_user`, `datetime`, `image`) VALUES
(1, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin iaculis ultrices lorem, id tincidunt ligula feugiat ut. Donec in aliquet arcu. Vivamus eu lorem ut erat rhoncus maximus. Quisque non quam a libero posuere aliquam. Etiam pharetra non sapien ac euismod. Cras justo metus, maximus vitae rhoncus sed, dapibus ac turpis. Nulla turpis lacus, blandit quis elementum non, bibendum a erat. Aenean sollicitudin vitae arcu et dapibus. Duis quis nisi in ligula vulputate ullamcorper. Morbi malesuada elit a iaculis varius. Aliquam dapibus ac ex quis egestas. Integer quam velit, venenatis nec nibh in, porta pharetra sapien. Sed non nibh auctor, blandit nisl nec, pulvinar erat. Suspendisse potenti. Cras pretium rutrum suscipit. Aenean tincidunt vehicula velit, vel ornare nisl mollis in.\n\nInteger posuere felis at turpis mattis luctus. Donec iaculis metus ut elit rutrum consequat. Vestibulum condimentum vulputate urna, vel condimentum nisl cursus id. In hac habitasse platea dictumst. Aenean eu nulla dolor. Nullam congue a nunc pulvinar blandit. Praesent maximus accumsan ultricies.', 1, '2018-09-10 04:16:35', ''),
(2, 'Sed molestie commodo erat', 'Sed molestie commodo erat, at commodo velit auctor nec. Vestibulum vestibulum purus a erat scelerisque, nec imperdiet lectus sodales. Morbi enim enim, dignissim ut iaculis quis, hendrerit eu quam. Maecenas sit amet condimentum lacus, ut pulvinar nulla. Quisque pharetra a urna ac porttitor. Sed in erat dui. Cras quam libero, pellentesque fermentum venenatis non, sodales nec est. Maecenas vehicula augue quis nulla faucibus gravida. Donec sodales interdum est ac elementum. Sed condimentum magna eu leo commodo tempus nec vel orci. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Integer libero felis, mattis et risus vitae, facilisis dictum enim. Aenean elit est, efficitur ut vehicula ac, sagittis at nisl. Duis sed feugiat eros. Cras quis rutrum ex. Curabitur a risus hendrerit, ornare nibh porttitor, luctus orci.\r\n\r\nCras sit amet tincidunt ligula. Praesent gravida purus sit amet massa dapibus, a scelerisque leo fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse consequat pulvinar lacus, ac efficitur est luctus id. Cras libero dolor, pharetra at ante vitae, feugiat blandit turpis. Phasellus ut enim eget leo molestie gravida nec at nunc. Donec quis orci fringilla, sollicitudin augue at, dictum felis. Sed volutpat massa et nisl rutrum mollis. Mauris feugiat imperdiet imperdiet. Curabitur feugiat auctor dolor, nec interdum quam vestibulum at.', 2, '2018-10-05 20:31:14', '');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `titre`, `contenu`, `id_user`, `id_article`, `datetime`) VALUES
(1, 'Comment', 'Mon commentaire.\r\nLigne 2.', 2, 1, '2018-10-08 04:21:10'),
(2, 'Comment', 'test', 2, 1, '2019-06-24 13:40:19'),
(3, 'Comment', 'test', 2, 1, '2019-06-24 13:42:07'),
(4, 'Comment', 'test', 1, 1, '2019-06-24 13:47:29'),
(5, 'Comment', 'test', 1, 2, '2019-06-24 13:47:43'),
(6, 'Comment', 'test', 1, 2, '2019-06-24 13:48:20'),
(7, 'Comment', 'req', 1, 1, '2019-06-24 13:48:44'),
(8, 'Comment', 'test', 2, 1, '2019-06-24 13:54:09');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `name`, `email`) VALUES
(2, 'Jean Bono', 'j.bono@email.com'),
(1, 'Jean Bonbeure', 'j.bonbeure@email.com');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
