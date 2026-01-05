INSERT INTO constantes (startPremierTour, startSecondTour, endSecondTour) 
VALUES ('2025-03-01 00:00:00', '2025-03-15 00:00:00', '2025-03-30 00:00:00');

INSERT INTO utilisateur (nom, email, motDePasse, userType) 
VALUES ('test', 'test@tes.test', '$2y$10$0vHPn9Lw/c1RwDT9ObLOV.XsnXKKH.ySerCFk0FtxFQBIFuFrqkfS', 'votant');

INSERT INTO categorie (nom, description, image, type)
VALUES
("Musique de l'année", 'Votée pour la meilleure musique de l''année.', null, 'track'),
("Album de l'année", 'Votée pour le meilleur album de l''année.', null, 'album'),
("Artiste de l'année", 'Votée pour le meilleur artiste de l''année.', null, 'artist'),
("Musique Inovante", 'Votée pour la meilleure musique inovante de l''année.', null, 'track'),
("Revelation de l'année", 'Votée pour la révélation de l''année.', null, 'artist');