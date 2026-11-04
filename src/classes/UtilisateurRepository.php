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
     * Crée un utilisateur. Le mot de passe est hashé ici :
     * le mot de passe en clair n'est JAMAIS enregistré.
     * Retourne l'id du nouvel utilisateur.
     */
    public function creer(string $pseudo, string $email, string $motDePasseClair): int {
        $hash = password_hash($motDePasseClair, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare(
            "INSERT INTO utilisateur (pseudo, email, mot_de_passe)
             VALUES (:pseudo, :email, :mot_de_passe)"
        );
        $stmt->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':mot_de_passe', $hash, PDO::PARAM_STR);
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
