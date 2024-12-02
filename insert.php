<?php
require_once 'config.php'; // Az adatbázis kapcsolathoz szükséges konfiguráció
require_once 'functions.php'; // A függvények, pl. getCategories()
require_once 'category.php';
global $categories;

try {
    $pdo = connectToDatabase(); // A config.php fájlban definiált csatlakozási függvény
} catch (PDOException $e) {
    die("Nem sikerült kapcsolódni az adatbázishoz: " . $e->getMessage());
} catch (Exception $e) {
}

// Az adatok beszúrása a táblába
try {

    // Prepare the statement once
    $stmt = $pdo->prepare("INSERT INTO categories (code, name) VALUES (?, ?)");
    foreach ($categories as $code => $name) {
        if (!$stmt->execute([$code, $name])) {
            // Ha az execute sikertelen, írd ki az információkat
            print_r($stmt->errorInfo());
        }
    }
    if($stmt->rowCount() > 0) {
        echo "Adatok sikeresen beszúrva a categories táblába!";
    }
    else
        echo "Nothing";
} catch (PDOException $e) {
    die("Hiba történt az adatok beszúrása során: " . $e->getMessage());
}