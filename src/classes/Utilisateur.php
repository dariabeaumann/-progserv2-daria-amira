<?php

// Un utilisateur de l'application (une ligne de la table utilisateur)
class Utilisateur {
    // Les deux rôles possibles
    public const ROLE_USER = 'user';
    public const ROLE_ADMIN = 'admin';

    private int $id;
    private string $pseudo;
    private string $email;
    private string $motDePasseHash;
    private string $role;
    private string $langue;
    private string $dateCreation;

    // Pour un nouvel utilisateur pas encore enregistré : id = 0 et dateCreation = ''
    public function __construct(
        int $id,
        string $pseudo,
        string $email,
        string $motDePasseHash,
        string $role,
        string $langue,
        string $dateCreation
    ) {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->motDePasseHash = $motDePasseHash;
        $this->role = $role;
        $this->langue = $langue;
        $this->dateCreation = $dateCreation;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getPseudo(): string {
        return $this->pseudo;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getMotDePasseHash(): string {
        return $this->motDePasseHash;
    }

    public function getRole(): string {
        return $this->role;
    }

    public function getLangue(): string {
        return $this->langue;
    }

    public function getDateCreation(): string {
        return $this->dateCreation;
    }

    public function estAdmin(): bool {
        return $this->role === self::ROLE_ADMIN;
    }
}
