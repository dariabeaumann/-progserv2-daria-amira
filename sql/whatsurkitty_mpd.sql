CREATE TABLE question (
    id_question INT AUTO_INCREMENT PRIMARY KEY,
    texte TEXT
);

CREATE TABLE reponse (
    id_reponse INT AUTO_INCREMENT PRIMARY KEY,
    texte TEXT,
    id_question INT,
    FOREIGN KEY (id_question) REFERENCES question(id_question)
    );

CREATE TABLE kitty (
    id_kitty INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    description TEXT
);

CREATE TABLE utilisateur (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,wwwwww
    pseudo VARCHAR(50),
    email VARCHAR(100),
    mot_de_passe VARCHAR(255)
);

CREATE TABLE tentative (
    id_tentative INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT,
    id_kitty INT,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur),
    FOREIGN KEY (id_kitty) REFERENCES kitty(id_kitty)
);
