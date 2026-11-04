<?php

/**
 * Va chercher les Kitty dans la base de données.
 * Toutes les requêtes sont préparées (protection contre l'injection SQL).
 */
class KittyRepository implements RepositoryInterface {
    private PDO $pdo;

    // Constructeur : on reçoit la connexion, ou on utilise celle de Database
    public function __construct(?PDO $pdo = null) {
        $this->pdo = $pdo ?? Database::getConnection();
    }

    /**
     * Retourne toutes les Kitty (tableau d'objets Kitty).
     */
    public function findAll(): array {
        $stmt = $this->pdo->prepare(
            "SELECT id_kitty, nom_fr, nom_en, description_fr, description_en,
                    illustration_svg, priorite_departage
             FROM kitty
             ORDER BY id_kitty"
        );
        $stmt->execute();

        $kitties = [];
        foreach ($stmt->fetchAll() as $row) {
            $kitties[] = $this->creerKitty($row);
        }

        return $kitties;
    }

    /**
     * Retourne une Kitty selon son id, ou null si elle n'existe pas.
     */
    public function findById(int $id): ?Kitty {
        $stmt = $this->pdo->prepare(
            "SELECT id_kitty, nom_fr, nom_en, description_fr, description_en,
                    illustration_svg, priorite_departage
             FROM kitty
             WHERE id_kitty = :id"
        );
        // bindValue : la valeur est échappée automatiquement par PDO
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch();

        return $row ? $this->creerKitty($row) : null;
    }

    // Méthode privée : transforme une ligne de la base en objet Kitty
    private function creerKitty(array $row): Kitty {
        return new Kitty(
            (int) $row['id_kitty'],
            $row['nom_fr'],
            $row['nom_en'],
            $row['description_fr'],
            $row['description_en'],
            $row['illustration_svg'],
            (int) $row['priorite_departage']
        );
    }
}
