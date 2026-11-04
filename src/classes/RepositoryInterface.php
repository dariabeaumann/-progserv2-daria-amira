<?php

/**
 * Contrat que doit respecter chaque repository de l'application.
 * Il garantit que tous les repositories ont les mêmes méthodes de base.
 */
interface RepositoryInterface {
    /**
     * Retourne tous les objets (tableau).
     */
    public function findAll(): array;

    /**
     * Retourne un objet selon son id, ou null s'il n'existe pas.
     */
    public function findById(int $id): ?object;
}
