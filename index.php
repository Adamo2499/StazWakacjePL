<?php
$csvFile = "php_internship_data.csv";
$names = array();
$birthDates = array();

// Sprawdzenie czy plik istnieje
if (!file_exists($csvFile)) die("Plik $csvFile nie istnieje!");

// Otwarcie pliku w trybie do odczytu
$file = fopen($csvFile, "r");

// Sprawdzenie czy plik został poprawnie otwarty
if (!$file) die("Nie udało się otworzyć pliku: $file!");

// Przejście po każdej linijce w pliku
while (($singleData = fgetcsv($file)) !== false) {
    // Przypisanie wartości z linii do zmiennych
    $name = $singleData[0];
    $birthDate = $singleData[1];
    // Zamiana liter na małe (z uwzględnieniem polskich znaków diakrytycznych) i dołączenie do pierwszej litery (dużej z automatu)
    $clearName = $name[0] . mb_strtolower(substr($name, 1), 'UTF-8');
    // Sprawdzenie czy imie występuje już w tablicy
    if (!isset($names[$clearName])) {
        //  jeżeli nie to ustawia jego licznik na 1
        $names[$clearName] = 1;
    } else {
        // jeżeli tak to zwiększamy licznik
        $names[$clearName]++;
    }
    // Zadanie dodatkowe

    // Sprawdzenie czy osoba jest urodzona w lub po 1 stycznia 2000
    if ($birthDate >= "2000-01-01") {
        // Zamiana formatu daty z YYYY-MM-DD na DD.MM.YYYY
        $newDate = date("d.m.Y", strtotime($birthDate));
        // Sprawdzenie czy element już wystąpił (analogicznie jak przy imionach)
        if (!isset($birthDates[$newDate])) {
            $birthDates[$newDate] = 1;
        } else {
            $birthDates[$newDate]++;
        }
    }
}

// Zamknięcie odczytywania pliku
fclose($file);

print("Imiona:");

// Wyświetlenie top 10 najczęśniej występujących imion
showTop10Records($names);

print("Daty narodzin:");

// Wyświetlenie top 10 najczęśniej występujących dat urodzin
showTop10Records($birthDates);

function showTop10Records(array $array)
{
    arsort($array); // posortowanie tablicy asocjacyjnej malejąco
    $top10Records = array_slice($array, 0, 10); // Wycięcie pierwszych 10 elementów tablicy i dołączenie do nowej tablicy
    print("<pre>" . print_r($top10Records, true) . "</pre>"); // Wyswietlenie nowo utworzonej tablicy
}
