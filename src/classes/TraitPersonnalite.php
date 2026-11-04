<?php

/**
 * Représente un trait de personnalité (une ligne de la table `trait`).
 * Exemples : Ambition, Calme, Aventure.
 */
class TraitPersonnalite {
    // Constante : langue utilisée si on ne précise rien
    public const LANGUE_PAR_DEFAUT = 'fr';

    // Attributs privés (encapsulation)
    private int $id;
    private string $nomFr;
    private string $nomEn;

    // Constructeur
    public function __construct(int $id, string $nomFr, string $nomEn) {
        $this->id = $id;
        $this->nomFr = $nomFr;
        $this->nomEn = $nomEn;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getNom(string $langue = self::LANGUE_PAR_DEFAUT): string {
        return $langue === 'en' ? $this->nomEn : $this->nomFr;
    }
}
