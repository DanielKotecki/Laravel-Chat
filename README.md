Laravel chat – uruchomienie projektu wersja developerska na Sail

Problem, który opisujesz, jest bardzo częsty: po sklonowaniu projektu z Gita katalog `vendor` nie istnieje (jest ignorowany w `.gitignore`).  
Bez `vendor` nie ma pliku `vendor/bin/sail`, więc polecenie `./vendor/bin/sail` nie działa – to klasyczny "problem kurczaka i jajka".

Rozwiązanie: najpierw zainstaluj zależności Composer **bez użycia sail**, korzystając z oficjalnego obrazu Docker Laravel Sail.

Krok po kroku (zaktualizowany przewodnik)
---------------------------------------

1.  ### Skopiuj plik `.env` (jeśli nie istnieje)

        cp .env.example .env

    Edytuj `.env` jeśli potrzeba (np. `APP_NAME`, `DB_*` itp.).

2.  ### Zainstaluj zależności Composer (gdy nie ma katalogu `vendor`)

    Uruchom **jednorazowo** to polecenie (dostosuj wersję PHP do swojego projektu – sprawdź w `compose.yaml` lub `docker-compose.yml`, zazwyczaj 8.1, 8.2 lub 8.3):

    **Dla PHP 8.5 (najnowsze Laravel 11/12):**

        docker run --rm \
            -u "$(id -u):$(id -g)" \
            -v "$(pwd):/var/www/html" \
            -w /var/www/html \
            laravelsail/php83-composer:latest \
            composer install --ignore-platform-reqs --no-interaction

    **Dla PHP 8.2:**

        laravelsail/php82-composer:latest

    **Dla PHP 8.1:**

        laravelsail/php81-composer:latest

    To polecenie:
    - Pobiera tymczasowy kontener z Composerem i odpowiednią wersją PHP.
    - Instaluje wszystkie zależności do katalogu `vendor`.
    - Nie wymaga lokalnego PHP ani Composera.

    Po tym kroku będziesz mieć katalog `vendor` i plik `vendor/bin/sail`.

3.  ### (Opcjonalnie) Dodaj alias sail – ułatwia życie

    Dodaj do `~/.bashrc` lub `~/.zshrc`:

        alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'

    Następnie:

        source ~/.bashrc  # lub ~/.zshrc

    Dzięki temu możesz używać po prostu `sail` zamiast `./vendor/bin/sail`.

4.  ### Wygeneruj klucz aplikacji

        sail artisan key:generate

5.  ### Uruchom kontenery Docker

        sail up -d

    Przy pierwszym uruchomieniu budowanie obrazów zajmie kilka minut.

6.  ### Zainstaluj zależności Node.js (jeśli projekt używa frontend)

        sail npm install

    (Jeśli nie ma `package.json`, pomiń ten krok.)

7.  ### Uruchom migracje bazy danych

        sail artisan migrate

8.  ### Zaseeduj bazę danych (opcjonalnie)

        sail artisan db:seed

9.  ### Uruchom Vite / frontend

    W osobnym terminalu:

        sail npm run dev

10. ### Uruchom Laravel Reverb (jeśli używany) w odzielnym oknie terminalu

        sail artisan reverb:start --debug

Dostęp do aplikacji
-------------------

*   Aplikacja: **http://localhost** (lub port zdefiniowany w `.env` jako `APP_PORT`)
*   Vite: **http://localhost:5173** (standardowy port)
*   Baza danych: host `mysql` (w kontenerze), z zewnątrz `localhost:3306`

Zatrzymywanie
-------------

    sail down          # zatrzymaj
    sail down -v       # zatrzymaj i usuń wolumeny (baza danych!)

W razie problemów
-----------------

*   Logi: `sail logs -f`
*   Wejście do kontenera: `sail shell`

