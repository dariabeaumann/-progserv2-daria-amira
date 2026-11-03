<?php

/**
 * Gère la connexion à la base de données.
 * Une seule connexion est créée et réutilisée partout.
 */
class Database {
    // Constante : valeur qui ne change jamais
    private const CHARSET = 'utf8mb4';

    // Attribut privé : personne d'autre ne peut y toucher
    private static ?PDO $connection = null;

    // Méthode publique : c'est la seule porte d'entrée
    public static function getConnection(): PDO {
        if (self::$connection === null) {
            $config = require __DIR__ . '/../public/config.php';

            $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=" . self::CHARSET;

            self::$connection = new PDO($dsn, $config['db_user'], $config['db_pass'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        }

        return self::$connection;
    }
}
