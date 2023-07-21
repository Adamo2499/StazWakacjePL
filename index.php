<?php
$csvFile = "php_internship_data.csv";
$names = array();

// Sprawdzenie czy plik istnieje
if(!file_exists($csvFile)) die("Plik $csvFile nie istnieje!");

$file = fopen($csvFile,"r");

// Sprawdzenie czy plik został poprawnie otwarty
if(!$file) die("Nie udało się otworzyć pliku: $file!");

while (($data = fgetcsv($file)) !== false) {
    $name = $data[0];
    $birthDate = $data[1];
    // Zamiana pierwszej litery na wielką i resztę na 
    // echo  $name."\n";
    // echo $name[0].strtolower(substr($name,1))."\n";
    // echo "<br>";
        // Sprawdzenie czy imie występuje już w tablicy a jeżeli nie to ustawia jego licznik na 1
        if (!isset($names[$name])) {
            $names[$name] = 1;
        } else {
            // Jeżeli imie istnieje to zwiększamy licznik o 1
            $names[$name]++;
        }
}


// Zamknięcie 
fclose($file);

arsort($names);

$top10Results = array_slice($names, 0, 10);

print_r($top10Results);