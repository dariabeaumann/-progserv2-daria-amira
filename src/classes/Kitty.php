<?php

/**
 * Représente une Kitty (une ligne de la table `kitty`).
 */
class Kitty {
    // Constante : langue utilisée si on ne précise rien
    public const LANGUE_PAR_DEFAUT = 'fr';

    // Attributs privés : on ne peut pas les modifier de l'extérieur
    private int $id;
    private string $nomFr;
    private string $nomEn;
    private ?string $descriptionFr;
    private ?string $descriptionEn;
    private ?string $illustrationSvg;
    private int $prioriteDepartage;

    // Constructeur : appelé quand on fait "new Kitty(...)"
    public function __construct(
        int $id,
        string $nomFr,
        string $nomEn,
        ?string $descriptionFr,
        ?string $descriptionEn,
        ?string $illustrationSvg,
        int $prioriteDepartage
    ) {
        $this->id = $id;
        $this->nomFr = $nomFr;
        $this->nomEn = $nomEn;
        $this->descriptionFr = $descriptionFr;
        $this->descriptionEn = $descriptionEn;
        $this->illustrationSvg = $illustrationSvg;
        $this->prioriteDepartage = $prioriteDepartage;
    }

    // Getters : la seule façon de lire les attributs
    public function getId(): int {
        return $this->id;
    }

    public function getNom(string $langue = self::LANGUE_PAR_DEFAUT): string {
        return $langue === 'en' ? $this->nomEn : $this->nomFr;
    }

    public function getDescription(string $langue = self::LANGUE_PAR_DEFAUT): ?string {
        return $langue === 'en' ? $this->descriptionEn : $this->descriptionFr;
    }

    public function getIllustrationSvg(): ?string {
        return $this->illustrationSvg;
    }

    public function getPrioriteDepartage(): int {
        return $this->prioriteDepartage;
    }
}
