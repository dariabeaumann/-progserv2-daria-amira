<?php

// Tous les repositories doivent avoir ces deux méthodes
interface RepositoryInterface {
    // Retourne un tableau d'objets
    public function findAll(): array;

    // Retourne l'objet qui a cet id, ou null s'il n'existe pas
    public function findById(int $id);
}
