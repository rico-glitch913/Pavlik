# Game App (PHP + MySQL)

Jednoduchá webová aplikácia na evidenciu hier vytvorená v jazyku PHP s využitím databázy MySQL (mysqli).
Projekt slúži ako ukážka práce s databázou, formulármi a CRUD operáciami.

---

## Funkcie

* Registrácia používateľa
* Prihlásenie a odhlásenie (session)
* Pridanie hry (Create)
* Zobrazenie hier (Read)
* Úprava hry (Update)
* Vymazanie hry (Delete)

---

## Databáza

Aplikácia obsahuje 3 tabuľky:

* users – ukladanie používateľov
* games – zoznam hier
* categories – kategórie hier

---

## Technológie

* PHP (bez frameworku)
* MySQL (mysqli)
* HTML + jednoduchý Bootstrap dizajn

---

## Spustenie

1. Zapni XAMPP alebo WAMP

2. Spusti Apache a MySQL

3. Otvor phpMyAdmin:
   http://localhost/phpmyadmin

4. Importuj súbor `db.sql`

5. Skopíruj projekt do priečinka:
   htdocs/game_app

6. Otvor v prehliadači:
   http://localhost/game_app/auth.php

---

## Použitie

1. Zaregistruj sa
2. Prihlás sa
3. Po prihlásení môžeš spravovať hry (pridávať, upravovať, mazať)

---

## Poznámky

* Aplikácia používa session na autentifikáciu
* Dáta sú uložené v MySQL databáze
* Projekt je určený ako školská CRUD aplikácia

---

## Štruktúra projektu

```
game_app/
│── db.php
│── auth.php
│── index.php
│── add.php
│── edit.php
│── delete.php
│── db.sql
```
