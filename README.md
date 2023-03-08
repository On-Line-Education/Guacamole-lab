# Guacamole Lab

---

## Spis treści
- [Guacamole Lab](#guacamole-lab)
  - [Spis treści](#spis-treści)
  - [Instalacja](#instalacja)
  - [Instalacja pod dalszy rozwój](#instalacja-pod-dalszy-rozwój)
  - [Opis struktury systemu](#opis-struktury-systemu)
    - [Action](#action)
    - [ActionService](#actionservice)
    - [Responder](#responder)
    - [Service](#service)
    - [Obsługa błędów](#obsługa-błędów)
    - [Kontrolery endpointów](#kontrolery-endpointów)
    - [Definicje endpointów](#definicje-endpointów)
    - [Połączenie z Guacamole](#połączenie-z-guacamole)
      - [Połączenie z Api](#połączenie-z-api)
      - [Obiekty wewnętrzne](#obiekty-wewnętrzne)
      - [Obiekty pomocnicze](#obiekty-pomocnicze)
  - [Endpointy](#endpointy)
    - [Logowanie](#logowanie)
    - [Użytkownik](#użytkownik)
    - [Sale](#sale)
    - [Grupy / Klasy](#grupy--klasy)
    - [Komputery](#komputery)
  - [Instrukcja obsługi](#instrukcja-obsługi)
  - [Dodatkowe informacje](#dodatkowe-informacje)

## Instalacja

Niniejszy projekt składa się z dwóch części. Pierwszą jest aplikacja webowa zawierająca klienta oraz serwer (ten projekt),
natomiast drugą częścią jest serwer Guacamole. W celu uruchomienia Guacamole należy **TODO**. Mając uruchomiony serwer
Guacamole, można kontynuować instalację aplikacji webowej:
1. Należy zainstalować PHP w wersji 8.0 lub nowszej. W tym celu należy albo udać się na stronę [PHP](https://www.php.net)
i postępować zgodnie z przedstawionymi tam krokami, albo zainstalować z repozytorium danego systemu.
2. Po instalacji PHP należy się upewnić, czy jest on zainstalowany oraz działa prawidłowo. W tym celu należy uruchomić
terminal i wpisać komendę `php -v`. Zwrot powinien wyglądać podobnie do następującego:
![](./documentation/wersja-php.png)
3. Następnie należy zainstalować [Dockera](https://www.docker.com) 
4. Jeśli instalacja przebiegła prawidłowo, należy sprawdzić, czy docker działa. Można to zrobić wykonując polecenie 
`docker run hello-world`. Po jego wykonaniu powinien się wyświetlić napis:
    >    Hello from Docker! <br>
   This message shows that your installation appears to be working correctly.
5. Po zainstalowaniu wymaganych zależności, w katalogu głównym należy wykonać polecenie `php composer.phar install`
6. Następnie należy utworzyć plik `.env` w katalogu głównym projektu i skopiować do niego zawartość pliku `.env.example`.
Następnie należy go uzupełnić odpowiednimi danymi. 
7. Po uzupełnieniu pliku `.env` można uruchomić projekt. W tym celu z głównego katalogu projektu trzeba wykonać polecenie
`./vendor/bin/sail up -d`.
8. Następnie należy zbudować aplikację klienta wykonując polecenie `./vendor/bin/sail npm run prod`
9. Na koniec uruchamiamy migrację bazy danych poleceniem `./vendor/bin/sail artisan migrate`
10. Aplikacja powinna być gotowa i dostępna na wpisanym w pliku `.env` porcie

## Instalacja pod dalszy rozwój

Należy wykonać wszystkie punkty z [Instalacji](#instalacja), z wyjątkiem 8, gdzie zamiast `./vendor/bin/sail npm run prod`
należy wykonać `./vendor/bin/sail npm run watch`.

## Opis struktury systemu

TODO

### Action

### ActionService

### Responder

### Service

### Obsługa błędów

### Kontrolery endpointów

### Definicje endpointów

### Połączenie z Guacamole

#### Połączenie z Api

#### Obiekty wewnętrzne

#### Obiekty pomocnicze

## Endpointy

*Uwaga*: Każdy endpoint wymaga dodania headera `Accept: application/json`
Dla endpointów wymagających logowania, należy podać token w headerze. Przykład: `Authorization: Bearer 27|KfrnopPZ5xRFs5jfHHVDYiYqpSbuTfvjbsKbhdEa`
Do testów endpointów dostępna jest kolekcja postman w `documentation/Guacamole-lab.postman_collection.json`.
Należy ją zaimportować w postmanie i następnie zmienić zmienną URL na odpowiediną w danym środowisku.

### Logowanie

| Ścieżka     | Metoda | Opis                            | Wymaga logowania |
| ----------- | ------ | ------------------------------- | ---------------- |
| /api/user   | POST   | Umozliwia logowanie do systemu  | NIE              |
| /api/logout | GET    | Umozliwia wylogowanie z systemu | TAK              |

### Użytkownik

| Ścieżka                     | Metoda | Opis                                                                                                                                | Wymaga logowania |
| --------------------------- | ------ | ----------------------------------------------------------------------------------------------------------------------------------- | ---------------- |
| /api/user/all               | GET    | Umozliwia pobranie wszystkich użytkowników systemu                                                                                  | TAK              |
| /api/user/{userID}          | GET    | Umozliwia pobranie użytkownika z systemu o id podanym jako {userId}                                                                 | TAK              |
| /api/user/search/{search}   | GET    | Umozliwia pobranie użytkownika z systemu, zawierającego dany fragment podanego tekstu (jako {search}) w nazwie                      | TAK              |
| /api/user                   | POST   | Umozliwia utworzenie nowego użytkownika w systemie                                                                                  | TAK              |
| /api/user/import            | POST   | Umozliwia zaimportowanie nowych użytkowników o roli student do systemu na podstawie przykładu documentation/example_user_import.csv | TAK              |
| /api/user/{userId}          | PATCH  | Umozliwia aktualizacje danych użytkownika o id {userId} w systemie                                                                  | TAK              |
| /api/user/{userId}/password | PATCH  | Umozliwia zmianę hasła użytkownika o id {userId} w systemie                                                                         | TAK              |
| /api/user/{userId}          | DELETE | Umozliwia usunięcie użytkownika o id {userId} z systemu                                                                             | TAK              |

### Sale

| Ścieżka                             | Metoda | Opis                                                                 | Wymaga logowania |
| ----------------------------------- | ------ | -------------------------------------------------------------------- | ---------------- |
| /api/classroom/all                  | GET    | Umozliwia pobranie wszystkich sal z systemu                          | TAK              |
| /api/classroom/all/with-instructors | GET    | Umozliwia pobranie wszystkich sal z systemu włącznie z instruktorami | TAK              |
| /api/classroom/{classroomId}        | GET    | Umozliwia pobranie sali z systemu o id podanym jako {classroomId}    | TAK              |
| /api/classroom                      | POST   | Umozliwia utworzenie nowej sali w systemie                           | TAK              |
| /api/classroom/{classroomId}        | PATCH  | Umozliwia aktualizacje danej sali o id {classroomId} w systemie      | TAK              |
| /api/classroom/{classroomId}        | DELETE | Umozliwia usunięcie sali o id {classroomId} z systemu                | TAK              |

### Grupy / Klasy

| Ścieżka                            | Metoda | Opis                                                                             | Wymaga logowania |
| ---------------------------------- | ------ | -------------------------------------------------------------------------------- | ---------------- |
| /api/class/all                     | GET    | Umozliwia pobranie wszystkich grup/klas z systemu                                | TAK              |
| /api/class/{classId}               | GET    | Umozliwia pobranie grupyy/klas z systemu o id podanym jako {classId}             | TAK              |
| /api/class                         | POST   | Umozliwia utworzenie nowej grupy/klasy w systemie                                | TAK              |
| /api/class/{classId}               | PATCH  | Umozliwia aktualizacje danej grupy/klasy o id {classId} w systemie               | TAK              |
| /api/class/{classId}               | DELETE | Umozliwia usunięcie grupy/klasy o id {classId} z systemu                         | TAK              |
| /api/class/{classId}/add/{user}    | GET    | Umozliwia dodanie do grupy/klasy o id {classId} w systemie studenta o id {user}  | TAK              |
| /api/class/{classId}/remove/{user} | GET    | Umozliwia usunięcie studenta o id {user} z grupy/klasy w systemie o id {classId} | TAK              |

### Komputery

| Ścieżka                                             | Metoda | Opis                                                                                                            | Wymaga logowania |
| --------------------------------------------------- | ------ | --------------------------------------------------------------------------------------------------------------- | ---------------- |
| /api/classroom/computers                            | GET    | Umozliwia pobranie wszystkich komputerów z systemu                                                              | TAK              |
| /api/classroom/computers/import                     | POST   | Umozliwia zaimportowanie komputerów do systemu na podstawie przykładu documentation/example_computer_import.csv | TAK              |
| /api/classroom/computers/all/{user}                 | GET    | Umozliwia pobranie wszystkich komputerów z systemu przypisanych dla uzytkownika o id {user}                     | TAK              |
| /api/classroom/computers/{computer}/assign/{user}   | GET    | Umozliwia przypisanie komputera o id {computer} do uzytkownika o id {user}                                      | TAK              |
| /api/classroom/computers/{computer}/unassign/{user} | GET    | Umozliwia usunięcie przypisania komputera o id {computer} do uzytkownika o id {user}                            | TAK              |
| /api/classroom/{classroom}/computer/all             | GET    | Umozliwia pobranie wszystkich komputerów z systemu znajdujacych się w klasie {classroom}                        | TAK              |
| /api/classroom/{classroom}/computer/{computerId}    | GET    | Umozliwia pobranie komputera z systemu o id podanym jako {computerId} w klasie {classroom}                      | TAK              |
| /api/classroom/{classroom}/computer                 | POST   | Umozliwia utworzenie nowego komputera w systemie, przypisanego do klasy {classroom}                             | TAK              |
| /api/classroom/{classroom}/computer/{computerId}    | PATCH  | Umozliwia aktualizacje danego komputera o id {computerId} przypisanego do klasy {classroom}                     | TAK              |
| /api/classroom/{classroom}/computer/{computerId}    | DELETE | Umozliwia usunięcie komputera o id {computerId} przypisanego do klasy {classroom} z systemu                     | TAK              |

## Instrukcja obsługi

TODO

## Dodatkowe informacje

Dane dostępowe do guacamole:
Login: guacadmin
Hasło: guacadmin

Znalezienie adresu ip kontenera z guacamole:
`docker inspect -f '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' guacamole_compose`