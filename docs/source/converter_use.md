## Użycie konwertera

### 1. Pobieramy plik

```php
$doc = $_FILES["documentFile"]["tmp_name"];
```

### 2. Pobieramy treść pliku

```php
$content = file_get_contents($doc);
```

### 3. Tworzymy instancje konwertera i importujemy dokument

```php
use MT940Converter\MT940Converter;

try {
  $converter = new MT940Converter($_ENV);
  $results = $converter->importDocument(file_get_contents($doc));
} catch(Exception $e) {
  echo "Błąd";
}
```

### 4. Obsługujemy wynik

Wynik konwersji jest przedstawiony w postaci tablicy z dwoma liczbami:

* Pierwsza liczba to ilość zaimportowanych wyciągów;
* Druga liczba to ilość zaimportowanych transakcji;

```php
echo "Wimportowano: {$results[0]} wyciągów i {$results[1]} transakcji.";
```

Błędy są "uciszane" przez zewnętrzne paczki, więc pamiętaj, żeby sprawdzić czy te dwie liczby są większe od zera, może to być dobrym wskaźnikiem błędu.

```php
if($results[0] === 0 && $results[1] === 0) {
  echo "Błąd";
}
```
