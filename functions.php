<?php

/**
 * @throws Exception
 */
function connectToDatabase(): PDO {
    // Importáljuk a konfigurációs konstansot
    if (!defined('DB_CONFIG')) {
        throw new Exception("Adatbázis konfiguráció nincs definiálva.");
    }

    $config = DB_CONFIG;

    // PDO DSN létrehozása
    $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";

    try {
        // PDO kapcsolat létrehozása
        $pdo = new PDO($dsn, $config['username'], $config['password']);
        // Hiba mód beállítása
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        // Hiba dobása, ha nem sikerül kapcsolódni
        throw new Exception("Adatbázis kapcsolódási hiba: " . $e->getMessage());
    }
}
function getCategories(string $cat): array {
    // Szavak szétválasztása szóköz mentén
    $cat_temp = explode(' ', $cat);

    // Szavak megtisztítása nem alfanumerikus karakterektől
    $cleaned = array_map(function ($word) {
        return preg_replace('/[^a-zA-Z0-9]/', '', $word);
    }, $cat_temp);

    // Csak azok a szavak maradnak, amelyek hossza nagyobb mint 4
    $filtered = array_filter($cleaned, function ($word) {
        return strlen($word) > 4;
    });

    // Visszatérés a tömbbel
    return array_values($filtered); // Indexek újraszámozása
}