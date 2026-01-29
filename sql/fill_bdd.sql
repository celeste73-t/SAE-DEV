INSERT INTO edition (nom, debutNomination, debutVote, debutResultat, active) 
VALUES 
('edition test 2026', '2026-01-12 00:00:00', '2026-01-16 00:00:00', '2026-01-20 00:00:00', 1),
('edition 2026', '2025-04-01 00:00:00', '2025-04-15 00:00:00', '2025-04-30 00:00:00', 0);

INSERT INTO categorie (nom, description, image, type)
VALUES
("Musique de l'année", 'Votée pour la meilleure musique de l''année.', null, 'track'),
("Album de l'année", 'Votée pour le meilleur album de l''année.', null, 'album'),
("Artiste de l'année", 'Votée pour le meilleur artiste de l''année.', null, 'artist'),
("Musique Inovante", 'Votée pour la meilleure musique inovante de l''année.', null, 'track'),
("Revelation de l'année", 'Votée pour la révélation de l''année.', null, 'artist');

INSERT INTO edition_categorie (editionId, categorieId)
VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),

(2, 1),
(2, 2),
(2, 3);

INSERT INTO utilisateur (nom, email, motDePasse, userType) 
VALUES 
('test', 'test@tes.test', '$2y$10$0vHPn9Lw/c1RwDT9ObLOV.XsnXKKH.ySerCFk0FtxFQBIFuFrqkfS', 'membre'),
('candidat', 'candidat@test', '$2y$10$Tvvca2u/dmg7iQwjBA4CF.Z56jFxhg.QXALOxspx0O3fTFtmsssGa', 'membre'),
('admin', 'admin@test', '$2y$10$7.qutaF35Whxmlg5BM8DKeoblFn4YlCuzeBHlGX9G/2iSJVayBcL2', 'administrateur');

INSERT INTO candidat (utilisateurId) 
VALUES (2);
