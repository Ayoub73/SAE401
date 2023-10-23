-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 20 oct. 2023 à 00:18
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `portfolio`
--

-- --------------------------------------------------------

--
-- Structure de la table `a_propos`
--

CREATE TABLE `a_propos` (
  `id` int(11) NOT NULL,
  `titre` varchar(20) NOT NULL,
  `sous_titre` varchar(512) NOT NULL,
  `paragraphe` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `a_propos`
--

INSERT INTO `a_propos` (`id`, `titre`, `sous_titre`, `paragraphe`) VALUES
(3, 'À propos', 'Pr&eacute;sentation', 'Actuellement &eacute;tudiant dans une formation polyvalente en deuxi&egrave;me ann&eacute;e d&rsquo;un BUT MMI, dans le domaine du d&eacute;veloppement web. Le secteur du d&eacute;veloppement informatique m&rsquo;a toujours fascin&eacute;, je suis &agrave; la recherche d&rsquo;un stage de minimum 10 semaines &agrave; partir du 17 avril 2023, &eacute;tant donn&eacute; que je souhaite approfondir mes connaissances et mes comp&eacute;tences pour mieux comprendre le fonctionnement de certains langages de programmation.');

-- --------------------------------------------------------

--
-- Structure de la table `carte`
--

CREATE TABLE `carte` (
  `id` int(11) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `marqueur_icone` varchar(512) NOT NULL,
  `marqueur_ombre` varchar(512) NOT NULL,
  `titre_survol` varchar(512) NOT NULL,
  `titre` varchar(512) NOT NULL,
  `image` varchar(512) NOT NULL,
  `image_alt` varchar(512) NOT NULL,
  `adresse` varchar(512) NOT NULL,
  `site_web` varchar(512) NOT NULL,
  `telephone` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `carte`
--

INSERT INTO `carte` (`id`, `latitude`, `longitude`, `marqueur_icone`, `marqueur_ombre`, `titre_survol`, `titre`, `image`, `image_alt`, `adresse`, `site_web`, `telephone`) VALUES
(1, 48.9748, 2.37459, 'cyu-marqueur.png', 'cyu-marqueur-ombre.png', 'IUT de Cergy-Pontoise - site de Sarcelles', 'IUT de Cergy-Pontoise - site de Sarcelles', 'iut-cergy-sarcelles.jpg', 'Image de IUT de Cergy-Pontoise indisponible.', 'Site de, 34 Bd Henri Bergson, 95200 Sarcelles', 'https://cyiut.cyu.fr/', '01 34 38 26 00');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `objet` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date_envoi` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `prenom`, `email`, `objet`, `message`, `date_envoi`) VALUES
(135, 'test', 'test', 'test@gmail.com', 'test', 'test', '2023-04-11 11:25:19');

-- --------------------------------------------------------

--
-- Structure de la table `creations`
--

CREATE TABLE `creations` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image_alt` varchar(512) NOT NULL,
  `categorie` varchar(32) NOT NULL,
  `paragraphe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `creations`
--

INSERT INTO `creations` (`id`, `titre`, `image`, `image_alt`, `categorie`, `paragraphe`) VALUES
(1, 'SA&Eacute; 105', 'sae105.png', 'Image de la SA&Eacute; 105 indisponible.', 'D&eacute;veloppement web', 'Dans cette SA&Eacute; il nous est demand&eacute; de cr&eacute;er un site web d&eacute;di&eacute; &agrave; l&#039;universit&eacute; utilisant le langage de programmation Php et les langages de structure Html et Css.'),
(2, 'SAÉ 203', 'sae203.png', 'Image de la SAÉ 203 indisponible.', 'Développement web', 'Dans cette SAÉ il nous est demandé de créer une version améliorer de la SAÉ 105 qui utilise une base de donnée avec le langage Sql et qui est dynamique avec JavaScript.'),
(3, 'SA&Eacute; 303', 'sae303.png', 'Image de la SA&Eacute; 303 indisponible.', 'Développement web', 'Dans cette SA&Eacute; avec HTML, CSS et JavaScript. Il nous est demand&eacute; de cr&eacute;er un site web avec des graphiques ou une infographie, ainsi qu&#039;une carte interactif pour repr&eacute;senter des donn&eacute;es &agrave; l&#039;aide d&#039;un jeu de donn&eacute;es, ici il s&#039;agit de');

-- --------------------------------------------------------

--
-- Structure de la table `cv`
--

CREATE TABLE `cv` (
  `id` int(11) NOT NULL,
  `nom` varchar(512) NOT NULL,
  `photo_profil` varchar(200) NOT NULL,
  `photo_profil_alt` varchar(512) NOT NULL,
  `experience_professionelles` varchar(512) NOT NULL,
  `competences_techniques` varchar(512) NOT NULL,
  `parcours_academique` varchar(512) NOT NULL,
  `competences_comportementales` varchar(512) NOT NULL,
  `competences_linguistiques` varchar(512) NOT NULL,
  `contactez_moi` varchar(512) NOT NULL,
  `lien_pdf` varchar(255) NOT NULL,
  `nom_pdf` varchar(255) NOT NULL,
  `text_lien` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cv`
--

INSERT INTO `cv` (`id`, `nom`, `photo_profil`, `photo_profil_alt`, `experience_professionelles`, `competences_techniques`, `parcours_academique`, `competences_comportementales`, `competences_linguistiques`, `contactez_moi`, `lien_pdf`, `nom_pdf`, `text_lien`) VALUES
(1, 'Ayoub JABER D&eacute;veloppement Web', 'photo-profil.png', 'Photo de profil indisponible.', 'Cr&eacute;ation d&rsquo;un site web dynamique pour le projet SA&Eacute; 105 : Cr&eacute;ation d&rsquo;un  prototype de site Web pour l&rsquo;universit&eacute; avec l&rsquo;utilisation des langages de  programmation HTLM, CSS et PHP, qui va permettre l&rsquo;envoi de  formulaires, ce site web est accessible en ligne gr&acirc;ce &agrave; son  h&eacute;bergement. \r\n\r\nCr&eacute;er un Jeux-Vid&eacute;o : Cr&eacute;ation de jeux vid&eacute;os avec le langage de  programmation Python.', 'Ma&icirc;trise des langages et moteurs de jeu suivants : ', 'D&Eacute;VELOPPEMENT WEB ET DISPOSITIFS INTERACTIFS\r\n\r\n2021 &ndash; 2024 : BUT MMI (M&eacute;tiers du multim&eacute;dia et de l&rsquo;Internet) de Cyu.\r\n\r\n2020 &ndash; 2021 : Pr&eacute;paration du baccalaur&eacute;at &ndash; Sp&eacute;cialit&eacute;\r\nNum&eacute;rique et Sciences informatiques (NSI).', 'Travail d&rsquo;&eacute;quipe, Rigoureux, Curieux, Autonome, Motiv&eacute;, S&eacute;rieux.', 'Fran&ccedil;ais : lu, parl&eacute;, &eacute;crit. Anglais : lu, parl&eacute;, &eacute;crit.', 'E-mail : ayoubjaber075@gmail.com, T&eacute;l&eacute;phone : 07 49 58 06 63.', 'CV-JABER-Ayoub.pdf', 'CV-JABER-Ayoub.pdf', 'T&eacute;l&eacute;charger');

-- --------------------------------------------------------

--
-- Structure de la table `general`
--

CREATE TABLE `general` (
  `id` int(11) NOT NULL,
  `identifiant` varchar(512) NOT NULL,
  `mot_de_passe` varchar(512) NOT NULL,
  `nom_utilisateur` varchar(512) NOT NULL,
  `prenom_utilisateur` varchar(512) NOT NULL,
  `introduction_front_office` varchar(512) NOT NULL,
  `introduction_back_office` varchar(512) NOT NULL,
  `copyright` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `general`
--

INSERT INTO `general` (`id`, `identifiant`, `mot_de_passe`, `nom_utilisateur`, `prenom_utilisateur`, `introduction_front_office`, `introduction_back_office`, `copyright`) VALUES
(1, 'admin', '45730257', 'JABER', 'AYOUB', '&Eacute;TUDIANT AU BUT MMI DE CERGY-PONTOISE &Agrave; SARCELLES DANS LE PARCOURS D&Eacute;VELOPPEMENT WEB ET DISPOSITIFS INTERACTIFS.', 'BIENVENUE &Agrave; L&#039;ESPACE D&#039;ADMINISTRATION DU PORTFOLIO. ICI VOUS POUVEZ MODIFIER LE CONTENU DES PAGES &Agrave; PROPOS, CV ET CR&Eacute;ATION. AINSI QUE LES INFORMATIONS G&Eacute;N&Eacute;RALES DEPUIS LA PARTIE &quot;G&Eacute;N&Eacute;RAL&quot;. IL EST AUSSI POSSIBLE DE VOIR LES MESSAGES ENVOY&Eacute;S.', '&copy; AYOUB JABER TOUS DROIT R&Eacute;SERV&Eacute;S');

-- --------------------------------------------------------

--
-- Structure de la table `graphique`
--

CREATE TABLE `graphique` (
  `id` int(11) NOT NULL,
  `nom_formation` varchar(512) NOT NULL,
  `niveau` float NOT NULL,
  `couleur_arriere_plan` varchar(50) NOT NULL,
  `couleur_bordure` varchar(50) NOT NULL,
  `couleur_text` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `graphique`
--

INSERT INTO `graphique` (`id`, `nom_formation`, `niveau`, `couleur_arriere_plan`, `couleur_bordure`, `couleur_text`) VALUES
(1, 'Python', 60, '#c77a06', '#c77a06', '#ffffff'),
(2, 'Html', 60, '#b03a08', '#b03a08', '#ffffff'),
(3, 'Css', 60, '#045f1f', '#045f1f', '#ffffff'),
(4, 'JavaScript', 60, '#b39613', '#b39613', '#ffffff'),
(5, 'Php', 60, '#2f3757', '#2f3757', '#ffffff'),
(6, 'Sql', 60, '#780303', '#780303', '#ffffff'),
(7, 'C#', 10, '#48044f', '#48044f', '#ffffff'),
(8, 'Unity', 10, '#656565', '#656565', '#ffffff');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `a_propos`
--
ALTER TABLE `a_propos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `carte`
--
ALTER TABLE `carte`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `creations`
--
ALTER TABLE `creations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `general`
--
ALTER TABLE `general`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `graphique`
--
ALTER TABLE `graphique`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `a_propos`
--
ALTER TABLE `a_propos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `carte`
--
ALTER TABLE `carte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT pour la table `creations`
--
ALTER TABLE `creations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `cv`
--
ALTER TABLE `cv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `general`
--
ALTER TABLE `general`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `graphique`
--
ALTER TABLE `graphique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
