-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 14 déc. 2024 à 18:53
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `nom_categorie` varchar(20) DEFAULT NULL,
  `description_categorie` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom_categorie`, `description_categorie`) VALUES
(1, 'categorie', 'categorie');

-- --------------------------------------------------------

--
-- Structure de la table `code_coupon`
--

CREATE TABLE `code_coupon` (
  `id_code` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `remise` float NOT NULL,
  `date_code` date NOT NULL DEFAULT current_timestamp(),
  `is_used` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `code_coupon`
--

INSERT INTO `code_coupon` (`id_code`, `code`, `remise`, `date_code`, `is_used`) VALUES
(1, '1-HTC-4739', 10, '2024-12-09', 0),
(2, '2-HTC-4802', 10, '2024-12-09', 0),
(3, '3-HTC-5017', 10, '2024-12-09', 0),
(4, '4-HTC-5018', 10, '2024-12-09', 0),
(12, '5-HTC-2846', 20, '2024-12-14', 0);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_commande` date DEFAULT current_timestamp(),
  `statut_commande` varchar(255) DEFAULT NULL,
  `montant_commande` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_user`, `date_commande`, `statut_commande`, `montant_commande`) VALUES
(34, 2, '2024-12-14', 'Payer', 152.00);

-- --------------------------------------------------------

--
-- Structure de la table `commande_produits`
--

CREATE TABLE `commande_produits` (
  `id_commande` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite_commande_produit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande_produits`
--

INSERT INTO `commande_produits` (`id_commande`, `id_produit`, `quantite_commande_produit`) VALUES
(34, 2, 1),
(34, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id_comment` int(11) NOT NULL,
  `message_comment` text NOT NULL,
  `date_comment` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_pub` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `statut_comment` enum('validÃ©','en attente de validation','supprimÃ©') DEFAULT 'en attente de validation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id_event` int(11) NOT NULL,
  `nom_event` varchar(20) NOT NULL,
  `date_event` date NOT NULL,
  `description_event` text NOT NULL,
  `nbr_place` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id_event`, `nom_event`, `date_event`, `description_event`, `nbr_place`, `image`, `type`) VALUES
(3, 'event onee', '2024-12-20', 'description description description description description', 2, 'news-350x223-2.jpg', 'Poterie'),
(8, 'event four', '2024-12-15', 'description description description description description description', 3, 'news-825x525.jpg', 'Poterie'),
(9, 'Event culture', '2024-12-13', 'description description description description description', 1, 'news-350x223-4.jpg', 'Poterie'),
(10, 'Event tech', '2024-12-08', 'description description description description description', 3, 'news-350x223-3.jpg', 'Tissage'),
(11, 'Event economie', '2024-12-07', 'description description description description description', 5, 'news-350x223-5.jpg', 'Broderie'),
(12, 'new one intg', '2024-12-26', 'description description description description description', 11, 'news-450x350-2.jpg', 'Tissage'),
(13, 'new twointg', '2024-12-29', 'description description description v=description', 10, 'news-350x223-4.jpg', 'Broderie'),
(14, 'new three intg', '2024-12-29', 'description description description description ', 0, 'news-825x525.jpg', 'Broderie'),
(15, 'sdfsdf', '2024-12-26', 'jdhb sdf bskjdf skjdfb skjdfbskdf skdjfsdf', 11, 'news-350x223-4.jpg', 'Tissage');

-- --------------------------------------------------------

--
-- Structure de la table `event_participants`
--

CREATE TABLE `event_participants` (
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_participation` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `event_participants`
--

INSERT INTO `event_participants` (`id_event`, `id_user`, `date_participation`) VALUES
(14, 2, '2024-12-14');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id_paiement` int(11) NOT NULL,
  `id_commande` int(11) DEFAULT NULL,
  `montant_paiement` decimal(10,2) DEFAULT NULL,
  `date_paiement` date DEFAULT current_timestamp(),
  `mode_paiement` varchar(255) DEFAULT NULL,
  `statut_paiement` varchar(255) DEFAULT NULL,
  `remise` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id_paiement`, `id_commande`, `montant_paiement`, `date_paiement`, `mode_paiement`, `statut_paiement`, `remise`) VALUES
(29, 34, 152.00, '2024-12-14', 'Par carte', 'Accepter', 0);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id_produit` int(11) NOT NULL,
  `nom_produit` varchar(255) NOT NULL,
  `description_produit` text DEFAULT NULL,
  `prix_produit` decimal(10,2) NOT NULL,
  `stock_produit` int(11) NOT NULL,
  `date_produit` date DEFAULT NULL,
  `categorie_produit` int(11) DEFAULT NULL,
  `status_produit` varchar(50) DEFAULT NULL,
  `images_produit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `nom_produit`, `description_produit`, `prix_produit`, `stock_produit`, `date_produit`, `categorie_produit`, `status_produit`, `images_produit`) VALUES
(1, 'Produit 1', 'Produit 1', 30.00, 10, '2024-12-01', 1, 'disponible', 'product-1.jpg.jpeg'),
(2, 'produit 2', 'produit 2', 65.00, 30, '2024-12-01', 1, 'disponible', 'product-2.jpg.jpeg'),
(3, 'Produit 3', 'Produit 3', 87.00, 10, '2024-12-01', 1, 'disponible', 'product-3.jpg.jpeg'),
(4, 'produit 4', 'produit 4', 45.00, 30, '2024-12-01', 1, 'disponible', 'product-4.jpg.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `publications`
--

CREATE TABLE `publications` (
  `id_pub` int(11) NOT NULL,
  `titre_pub` varchar(255) NOT NULL,
  `description_pub` text NOT NULL,
  `date_pub` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) DEFAULT NULL,
  `statut_pub` enum('actif','supprimÃ©','en attente de validation') DEFAULT 'actif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nom_user` varchar(20) NOT NULL,
  `email_user` varchar(30) NOT NULL,
  `adresse_user` varchar(30) NOT NULL,
  `role` enum('admin','client','artisan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_user` int(11) NOT NULL,
  `nom_user` varchar(255) NOT NULL,
  `prenom_user` varchar(255) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `tel_user` int(11) NOT NULL,
  `adresse_user` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_user` varchar(255) NOT NULL,
  `role_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_user`, `nom_user`, `prenom_user`, `email_user`, `tel_user`, `adresse_user`, `username`, `password_user`, `role_user`) VALUES
(1, 'mohamed', 'mohamed', 'mohamedouerfelli3@gmail.com', 96726127, 'esprit', 'mohamedouerfelli', 'd4134fd691d7b113a9bc28668bd26bf3', 'ADMIN_ROLE'),
(2, 'mohamed', 'mohamed', 'mohamedouerfelli2@gmail.com', 96726127, 'esprit', 'mohamedouerfellii', 'd4134fd691d7b113a9bc28668bd26bf3', 'USER_ROLE');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `code_coupon`
--
ALTER TABLE `code_coupon`
  ADD PRIMARY KEY (`id_code`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `user` (`id_user`);

--
-- Index pour la table `commande_produits`
--
ALTER TABLE `commande_produits`
  ADD PRIMARY KEY (`id_commande`,`id_produit`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_pub` (`id_pub`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`);

--
-- Index pour la table `event_participants`
--
ALTER TABLE `event_participants`
  ADD PRIMARY KEY (`id_event`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id_paiement`),
  ADD KEY `id_commande` (`id_commande`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `fk_categorie_produit` (`categorie_produit`);

--
-- Index pour la table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id_pub`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `code_coupon`
--
ALTER TABLE `code_coupon`
  MODIFY `id_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id_paiement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `publications`
--
ALTER TABLE `publications`
  MODIFY `id_pub` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `user` FOREIGN KEY (`id_user`) REFERENCES `utilisateurs` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commande_produits`
--
ALTER TABLE `commande_produits`
  ADD CONSTRAINT `commande_produits_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_produits_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id_produit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`id_pub`) REFERENCES `publications` (`id_pub`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Contraintes pour la table `event_participants`
--
ALTER TABLE `event_participants`
  ADD CONSTRAINT `event_participants_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `event` (`id_event`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_participants_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `utilisateurs` (`id_user`) ON DELETE CASCADE;

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`) ON DELETE CASCADE;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `fk_categorie_produit` FOREIGN KEY (`categorie_produit`) REFERENCES `categorie` (`id_categorie`);

--
-- Contraintes pour la table `publications`
--
ALTER TABLE `publications`
  ADD CONSTRAINT `publications_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
