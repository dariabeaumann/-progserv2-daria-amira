-- Active: 1793139001056@@127.0.0.1@3306@my_database
-- PARTIE 1 : LES TABLES DE BASE (elles ne dépendent de personne)


-- UTILISATEUR : une ligne par personne qui crée un compte.
-- L'application la remplit toute seule à l'inscription.
CREATE TABLE utilisateur (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'user',
    langue VARCHAR(2) NOT NULL DEFAULT 'fr',
    date_creation DATE NOT NULL DEFAULT (CURRENT_DATE)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- KITTY : les 6 personnalités possibles (Boss Kitty, Lazy Kitty...).
-- priorite_departage : en cas d'égalité, la Kitty avec le PLUS PETIT numéro gagne.
CREATE TABLE kitty (
    id_kitty INT AUTO_INCREMENT PRIMARY KEY,
    nom_fr VARCHAR(50) NOT NULL,
    nom_en VARCHAR(50) NOT NULL,
    description_fr TEXT,
    description_en TEXT,
    illustration_svg MEDIUMTEXT,
    priorite_departage INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- TRAIT : les 6 qualités de personnalité (Ambition, Calme...).
CREATE TABLE trait (
    id_trait INT AUTO_INCREMENT PRIMARY KEY,
    nom_fr VARCHAR(50) NOT NULL,
    nom_en VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- QUESTION : les questions du quiz.
-- ordre : position dans le quiz (1 = posée en premier).
CREATE TABLE question (
    id_question INT AUTO_INCREMENT PRIMARY KEY,
    texte_fr TEXT NOT NULL,
    texte_en TEXT NOT NULL,
    ordre INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Tables qui dépendent des précédentes

-- REPONSE : les 4 réponses proposées pour chaque question.
CREATE TABLE reponse (
    id_reponse INT AUTO_INCREMENT PRIMARY KEY,
    texte_fr TEXT NOT NULL,
    texte_en TEXT NOT NULL,
    id_question INT NOT NULL,
    FOREIGN KEY (id_question) REFERENCES question(id_question) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- KITTY_TRAIT : quels traits DÉCRIVENT chaque Kitty (juste une description, pas de score).
-- La clé primaire est le COUPLE (kitty, trait) : on ne peut pas mettre deux fois la même paire.
CREATE TABLE kitty_trait (
    id_kitty INT NOT NULL,
    id_trait INT NOT NULL,
    PRIMARY KEY (id_kitty, id_trait),
    FOREIGN KEY (id_kitty) REFERENCES kitty(id_kitty) ON DELETE CASCADE,
    FOREIGN KEY (id_trait) REFERENCES trait(id_trait) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- TENTATIVE : un quiz terminé par un utilisateur (un résultat).
-- L'application la remplit toute seule à la fin de chaque quiz.
CREATE TABLE tentative (
    id_tentative INT AUTO_INCREMENT PRIMARY KEY,
    date_heure DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_utilisateur INT NOT NULL,
    id_kitty INT NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (id_kitty) REFERENCES kitty(id_kitty)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Tables de liaison (la "grille de correction" et les pourcentages)


-- POINTS_KITTY : la "grille de correction" pour les Kitty.
-- Exemple : la réponse 1 donne +2 points à Travel Kitty.
-- je la remplis, et elle ne change pas quand les gens jouent.
CREATE TABLE points_kitty (
    id_reponse INT NOT NULL,
    id_kitty INT NOT NULL,
    points INT NOT NULL,
    PRIMARY KEY (id_reponse, id_kitty),
    FOREIGN KEY (id_reponse) REFERENCES reponse(id_reponse) ON DELETE CASCADE,
    FOREIGN KEY (id_kitty) REFERENCES kitty(id_kitty) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- POINTS_TRAIT : la "grille de correction" pour les traits.
-- Exemple : la réponse 1 donne +2 points au trait Aventure.
-- je la remplis, comme points_kitty.
CREATE TABLE points_trait (
    id_reponse INT NOT NULL,
    id_trait INT NOT NULL,
    points INT NOT NULL,
    PRIMARY KEY (id_reponse, id_trait),
    FOREIGN KEY (id_reponse) REFERENCES reponse(id_reponse) ON DELETE CASCADE,
    FOREIGN KEY (id_trait) REFERENCES trait(id_trait) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- RESULTAT_TRAIT : les pourcentages finaux d'un quiz, un par trait.
-- Exemple : quiz n°12, Ambition = 89.
-- L'application la remplit toute seule à la fin du quiz (6 lignes par quiz).
CREATE TABLE resultat_trait (
    id_tentative INT NOT NULL,
    id_trait INT NOT NULL,
    pourcentage INT NOT NULL CHECK (pourcentage BETWEEN 0 AND 100),
    PRIMARY KEY (id_tentative, id_trait),
    FOREIGN KEY (id_tentative) REFERENCES tentative(id_tentative) ON DELETE CASCADE,
    FOREIGN KEY (id_trait) REFERENCES trait(id_trait) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO trait (nom_fr, nom_en) VALUES
('Ambition', 'Ambition'),
('Sociabilité', 'Sociability'),
('Organisation', 'Organization'),
('Créativité', 'Creativity'),
('Aventure', 'Adventure'),
('Calme', 'Calm');

