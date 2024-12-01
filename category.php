<?php
require_once 'functions.php';

// Az eredeti bemenet
$cat = " na2t5u25re spo12r54t funn82y cake2! 8sea au#!tumn!";

// A getCategories függvény meghívása
$cat_temp = getCategories($cat);

// Az új tömb létrehozása
$categories = [];
foreach ($cat_temp as $item) {
    // Számok és betűk különválasztása
    if (preg_match('/(\d+)([a-zA-Z]+)/', $item, $matches)) {
        $index = (int)$matches[1] + rand(1000, 5000); // Véletlen szám hozzáadása
        $categories[$index] = $matches[2]; // Érték hozzárendelése
    }
}

// Indexek szerint növekvő sorrendbe rendezés
ksort($categories);

// Eredmény kiíratása (teszt)
foreach ($categories as $index => $value) {
    echo "Index: $index Value: $value\n";
}