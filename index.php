<?php
$csvFile = "php_internship_data.csv";
$names = array();

// Sprawdzenie czy plik istnieje
if (!file_exists($csvFile)) die("Plik $csvFile nie istnieje!");

$file = fopen($csvFile, "r");

// Sprawdzenie czy plik został poprawnie otwarty
if (!$file) die("Nie udało się otworzyć pliku: $file!");

while (($singleData = fgetcsv($file)) !== false) {
    $name = $singleData[0];
    $birthDate = $singleData[1];
    // Zamiana liter na małe (z uwzględnieniem polskich znaków diakrytycznych) i dołączenie do pierwszej litery (dużej z automatu)
    $clearName = $name[0] . mb_strtolower(substr($name, 1), 'UTF-8');
    // Sprawdzenie czy imie występuje już w tablicy a jeżeli nie to ustawia jego licznik na 1
    if (!isset($names[$clearName])) {
        $names[$clearName] = 1;
    } else {
        // Jeżeli imie istnieje to zwiększamy licznik o 1
        $names[$clearName]++;
    }
}


// Zamknięcie odczytywania pliku
fclose($file);

// Posortowanie tablicy asocjacyjnej w kolejności malejącej
arsort($names);

// Uzyskanie pierwszych dziesięciu wyników
$top10Results = array_slice($names, 0, 10);

// Wyświetlenie tablicy
print("<pre>".print_r($top10Results,true)."</pre>");