<?php
require_once 'config.php';
/**
 * @throws Exception
 */
function connectToDatabase(): PDO
{
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

function getCategories(string $cat): array
{
    // Szavak szétválasztása szóköz mentén
    $cat_temp = explode(' ', $cat);

    // Szavak megtisztítása nem alfanumerikus karakterektől és feltételek ellenőrzése
    $filtered = array_filter($cat_temp, function ($word) {
        // Csak akkor vesszük figyelembe, ha csak számokat és betűket tartalmaz, és hossza > 4
        return preg_match('/^[a-zA-Z0-9]+$/', $word) && strlen($word) > 4;
    });

    // Visszatérés a szűrt tömbbel, indexek újraszámozása
    return array_values($filtered);
}