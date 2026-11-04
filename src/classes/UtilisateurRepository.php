<?php

/**
 * Lit et enregistre les utilisateurs dans la base de données.
 * Toutes les requêtes sont préparées (protection contre l'injection SQL).
 */
class UtilisateurRepository implements RepositoryInterface {
    private PDO $pdo;

    public function __construct(?PDO $pdo = null) {
        $this->pdo = $pdo ?? Database::getConnection();
    }

    public function findAll(): array {
        $stmt = $this->pdo->prepare(
            "SELECT id_utilisateur, pseudo, email, mot_de_passe, role, langue, date_creation
             FROM utilisateur
             ORDER BY id_utilisateur"
        );
        $stmt->execute();

        $utilisateurs = [];
        foreach ($stmt->fetchAll() as $row) {
            $utilisateurs[] = $this->creerUtilisateur($row);
        }

        return $utilisateurs;
    }

    public function findById(int $id): ?Utilisateur {
        $stmt = $this->pdo->prepare(
            "SELECT id_utilisateur, pseudo, email, mot_de_passe, role, langue, date_creation
             FROM utilisateur
             WHERE id_utilisateur = :id"
        );
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch();

        return $row ? $this->creerUtilisateur($row) : null;
    }

    public function findByEmail(string $email): ?Utilisateur {
        $stmt = $this->pdo->prepare(
            "SELECT id_utilisateur, pseudo, email, mot_de_passe, role, langue, date_creation
             FROM utilisateur
             WHERE email = :email"
        );
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch();

        return $row ? $this->creerUtilisateur($row) : null;
    }

    public function emailExiste(string $email): bool {
        return $this->findByEmail($email) !== null;
    }

    /**
     * Enregistre un objet Utilisateur dans la base.
     * L'objet contient déjà le mot de passe HASHÉ (jamais en clair).
     * Retourne l'id du nouvel utilisateur.
     */
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

    // Transforme une ligne de la base en objet Utilisateur
    private function creerUtilisateur(array $row): Utilisateur {
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
}
