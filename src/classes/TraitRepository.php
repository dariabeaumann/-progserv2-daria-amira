<?php

/**
 * Va chercher les traits de personnalité dans la base de données.
 * Toutes les requêtes sont préparées (protection contre l'injection SQL).
 */
class TraitRepository implements RepositoryInterface {
    private PDO $pdo;

    // Constructeur : on reçoit la connexion, ou on utilise celle de Database
    public function __construct(?PDO $pdo = null) {
        $this->pdo = $pdo ?? Database::getConnection();
    }

    /**
     * Retourne tous les traits (tableau d'objets TraitPersonnalite).
     */
    public function findAll(): array {
        $stmt = $this->pdo->prepare(
            "SELECT id_trait, nom_fr, nom_en FROM trait ORDER BY id_trait"
        );
        $stmt->execute();

        $traits = [];
        foreach ($stmt->fetchAll() as $row) {
            $traits[] = $this->creerTrait($row);
        }

        return $traits;
    }

    /**
     * Retourne un trait selon son id, ou null s'il n'existe pas.
     */
    public function findById(int $id): ?TraitPersonnalite {
        $stmt = $this->pdo->prepare(
            "SELECT id_trait, nom_fr, nom_en FROM trait WHERE id_trait = :id"
        );
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch();

        return $row ? $this->creerTrait($row) : null;
    }

    // Méthode privée : transforme une ligne de la base en objet TraitPersonnalite
    private function creerTrait(array $row): TraitPersonnalite {
        return new TraitPersonnalite(
            (int) $row['id_trait'],
            $row['nom_fr'],
            $row['nom_en']
        );
    }
}
