<?php
require_once 'functions.php';

// Az eredeti bemenet
$cat = "na2t5u25re spo12r54t funn82y cake2! 8sea au#!tumn!";
$categories_from_function = getCategories($cat);

// Kategóriák tömb inicializálása
$categories = [];

// A szűrt kategóriák feldolgozása
foreach ($categories_from_function as $word) {
    // Számokat kinyerjük az adott szóból
    preg_match_all('/\d+/', $word, $matches);
    $numbers = implode('', $matches[0]); // Számokat összefűzzük

    // Karaktereket kinyerjük (nem számokat)
    $letters = preg_replace('/\d/', '', $word);

    // Csak akkor dolgozunk vele, ha van szám és betű is
    if (!empty($numbers) && !empty($letters)) {
        // Véletlenszerű szám hozzáadása az indexhez
        $randomizedIndex = intval($numbers) + rand(1000, 5000);

        // A tömb feltöltése az új indexel
        $categories[$randomizedIndex] = $letters;
    }
}

// Indexek szerinti rendezés növekvő sorrendben
ksort($categories);

// Eredmény kiíratása
echo '<pre>';
print_r($categories);
echo '</pre>';