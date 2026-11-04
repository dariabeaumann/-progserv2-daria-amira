<?php

/**
 * Représente un utilisateur (une ligne de la table `utilisateur`).
 */
class Utilisateur {
    // Constantes : les deux rôles possibles dans l'application
    public const ROLE_USER = 'user';
    public const ROLE_ADMIN = 'admin';

    // Attributs privés (encapsulation)
    private ?int $id; // null tant que l'utilisateur n'est pas enregistré
    private string $pseudo;
    private string $email;
    private string $motDePasseHash; // jamais le mot de passe en clair !
    private string $role;
    private string $langue;
    private ?string $dateCreation; // null tant que l'utilisateur n'est pas enregistré

    public function __construct(
        ?int $id,
        string $pseudo,
        string $email,
        string $motDePasseHash,
        string $role,
        string $langue,
        ?string $dateCreation
    ) {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->motDePasseHash = $motDePasseHash;
        $this->role = $role;
        $this->langue = $langue;
        $this->dateCreation = $dateCreation;
    }

    // Getters
    public function getId(): ?int {
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

    public function getDateCreation(): ?string {
        return $this->dateCreation;
    }

    public function estAdmin(): bool {
        return $this->role === self::ROLE_ADMIN;
    }
}
