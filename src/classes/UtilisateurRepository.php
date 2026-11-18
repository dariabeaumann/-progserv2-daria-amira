<?php

// Lit et enregistre les utilisateurs dans la base de données
class UtilisateurRepository implements RepositoryInterface {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    // Retourne un tableau d'objets Utilisateur
    public function findAll(): array {
        $stmt = $this->pdo->prepare(
            "SELECT id_utilisateur, pseudo, email, mot_de_passe, role, langue, date_creation
             FROM utilisateur
             ORDER BY id_utilisateur"
        );
        $stmt->execute();

        $utilisateurs = [];
        foreach ($stmt->fetchAll() as $row) {
            $utilisateurs[] = new Utilisateur(
                (int) $row['id_utilisateur'],
                $row['pseudo'],
                $row['email'],
                $row['mot_de_passe'],
                $row['role'],
                $row['langue'],
                $row['date_creation']
            );
        }

        return $utilisateurs;
    }

    // Retourne l'utilisateur, ou null s'il n'existe pas
    public function findById(int $id) {
        $stmt = $this->pdo->prepare(
            "SELECT id_utilisateur, pseudo, email, mot_de_passe, role, langue, date_creation
             FROM utilisateur
             WHERE id_utilisateur = :id"
        );
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch();
        if ($row === false) {
            return null;
        }

        return new Utilisateur(
            (int) $row['id_utilisateur'],
            $row['pseudo'],
            $row['email'],
            $row['mot_de_passe'],
            $row['role'],
            $row['langue'],
            $row['date_creation']
        );
    }

    // Retourne l'utilisateur, ou null s'il n'existe pas
    public function findByEmail(string $email) {
        $stmt = $this->pdo->prepare(
            "SELECT id_utilisateur, pseudo, email, mot_de_passe, role, langue, date_creation
             FROM utilisateur
             WHERE email = :email"
        );
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch();
        if ($row === false) {
            return null;
        }

        return new Utilisateur(
            (int) $row['id_utilisateur'],
            $row['pseudo'],
            $row['email'],
            $row['mot_de_passe'],
            $row['role'],
            $row['langue'],
            $row['date_creation']
        );
    }

    // true si l'e-mail est déjà utilisé, sinon false
    public function emailExiste(string $email): bool {
        return $this->findByEmail($email) !== null;
    }

    // Enregistre un objet Utilisateur (le mot de passe est déjà haché)
    // Retourne l'id du nouvel utilisateur
    public function save(Utilisateur $utilisateur): int {
        $stmt = $this->pdo->prepare(
            "INSERT INTO utilisateur (pseudo, email, mot_de_passe, role, langue)
             VALUES (:pseudo, :email, :mot_de_passe, :role, :langue)"
        );
        $stmt->bindValue(':pseudo', $utilisateur->getPseudo(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $utilisateur->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':mot_de_passe', $utilisateur->getMotDePasseHash(), PDO::PARAM_STR);
        $stmt->bindValue(':role', $utilisateur->getRole(), PDO::PARAM_STR);
        $stmt->bindValue(':langue', $utilisateur->getLangue(), PDO::PARAM_STR);
        $stmt->execute();

        return (int) $this->pdo->lastInsertId();
    }
}
